<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Email;
use App\Models\Order;
use App\Models\Prodcat;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Shop;
use App\Models\User;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use TCG\Voyager\Models\Page;

class PageController extends Controller
{
    public function home()
    {
        $locationPostcodes = Session::get('location.postcode', []);


        $latest_products = \Cache::remember('latest_products:' . md5(json_encode($locationPostcodes)), 3600, function () use ($locationPostcodes) {
            return Product::query()
                ->select(['id','slug', 'name', 'shop_id', 'views', 'post_code', 'status', 'parent_id','images','image','price','sale_price'])
                ->where('status', 1)
                ->whereNull('parent_id')
                ->whereHas('shop', fn($q) => $q->where('status', 1))
                ->when(!empty($locationPostcodes), fn($q) => $q->whereIn('post_code', $locationPostcodes))
                ->orderByDesc('views')
                ->latest()
                ->limit(24)
                ->with(relations: ['shop:id,name,status', 'ratings'])
                ->get();
        });

        $bestsaleproducts = \Cache::remember('bestsaleproducts:' . md5(json_encode($locationPostcodes)), 3600, function () use ($locationPostcodes) {
            return Product::query()
                ->select(['id','slug', 'name', 'shop_id', 'total_sale', 'post_code', 'status', 'parent_id','image', 'images','price','sale_price'])
                ->where('status', 1)
                ->whereNull('parent_id')
                ->whereHas('shop', fn($q) => $q->where('status', 1))
                ->when(!empty($locationPostcodes), fn($q) => $q->whereIn('post_code', $locationPostcodes))
                ->orderByDesc('total_sale')
                ->latest()
                ->limit(16)
                ->with(['shop:id,name,status'])
                ->get();
        });
        $recommand = session()->get('recommand', []);
        $recommandProducts = \Cache::remember('recommandProducts:' . md5(json_encode($recommand)), 3600, function () use ($recommand) {
            return Product::query()
                ->select(['id', 'slug','name', 'shop_id', 'parent_id' ,'views', 'post_code', 'status','images','image','price','sale_price'])
                ->whereNull('parent_id')
                ->whereIn('id', $recommand)
                ->with(['shop:id,name'])
                ->get();
        });
        $latest_shops = \Cache::remember('latest_shops', 3600, function () {
            return Shop::query()
                ->where('status', 1)
                ->whereHas('products', fn($q) => $q->whereNull('parent_id'))
                ->latest()
                ->limit(8)
                ->with(['products:id,name,shop_id,slug,images,views,image,sale_price,price,post_code,status'])
                ->get();
        });

        $prodcats = \Cache::remember('prodcats', 3600, function () {
            return Prodcat::with('childrens')
                ->whereNull('parent_id')
                ->whereHas('products')
                ->orderBy('role', 'asc')
                ->get();
        });
        // dd($prodcats);

        $sliders = \Cache::remember('sliders', 3600, function () {
            return Slider::latest()->get();
        });

        return view('pages.home', compact('latest_products', 'bestsaleproducts', 'latest_shops', 'prodcats', 'sliders', 'recommandProducts'));
    }
    public function shops()
    {
        $productsQuery = Product::where("status", 1)->whereNull('parent_id')->whereHas('shop', function ($q) {
                $q->where('status', 1);
            })->filter()->simplePaginate(12);
        $products = $productsQuery->groupBy(function ($item) {
            return  $item->shop_id;
        });

        $categories = Prodcat::has('products')->whereNull('parent_id')->latest()->get();

        $latest_shops =  Shop::where("status", 1)->whereHas('products', function ($query) {
            $query->whereNull('parent_id');
        })->latest()->limit(8)->get();
        return view('pages.shops', compact('products', 'categories', 'latest_shops'));
    }
    public function product_details($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $related_products = Product::whereNull('parent_id')->limit(16)->get();
        $product->increment('views');


        $recommand = session()->get('recommand', []);

        if (!in_array($product->id, $recommand)) {
            $recommand[] = $product->id;
            session()->put('recommand', $recommand);
        }
        return view('pages.product_details', compact('related_products', 'product'));
    }
    public function cart()
    {
        $latest_shops =  Shop::where("status", 1)
            ->whereHas('products', function ($query) {
                $query->whereNull('parent_id');
            })->latest()->limit(8)->get();
        return view('pages.cart', compact('latest_shops'));
    }


    public function dashboard()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('auth.user.dashboard', compact('intent'));
    }
    public function addressEdit(Address $address)
    {
        return view('auth.user.information', ['address' => $address]);
    }
    public function addressDestroy(Address $address)
    {

        $address->delete($address);

        return back()->with('success_msg', 'Address has been removed!');
    }



    public function order_index()
    {
        $latest_orders = Order::where('user_id', auth()->user()->id)->where('status', 0)->orWhere('status', 3)->latest()->get();
        $past_orders = Order::where('user_id', auth()->user()->id)->where('status', 1)->latest()->get();

        return view('auth.user.order.index', compact('latest_orders', 'past_orders'));
    }


    public function checkout()
    {

        return view('pages.checkout', ['intent' => auth()->user()->createSetupIntent()]);
    }
    public function store_front($slug)

    {
        $shop = Shop::where('slug', $slug)->products()->firstOrFail();



        return view('pages.store_front', compact('shop'));
    }


    // public function order_page()
    // {
    //     return view('pages.order_page');
    // }
    public function thankyou()
    {
        $latest_products = Product::where("status", 1)->latest()->limit(24)->whereNull('parent_id')->get();
        return view('pages.thankyou', compact('latest_products'));
    }
    public function rating(Request $request)
    {
        //return $request->all();
        $product = Product::find($request->product_id);
        Rating::create([
            "name" => $request->name,
            "email" => $request->email,
            "rating" => intval($request->rating),
            "review" => $request->review,
            "product_id" => $product->id,
            'user_id' => Auth()->id(),
            'shop_id' => $product->shop->id,
        ]);
        return back()->with('success_msg', 'Thanks for your review');
        //return back()->withErrors('Sorry! One of the items in your cart is no longer Available!');
    }
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'unique:emails,email'],
        ], [
            'email.unique' => 'You already subscribed'
        ]);
        Email::create([
            "email" => $request->email,
        ]);
        return back()->with('subscribeEmail', 'Thanks for your subscription');
    }
    public function quickview()
    {
        $product = Product::where('id', request()->product_id)->first();
        return view('layouts.quick_view', compact('product'));
    }

    public function vendors(Request $request)
    {
        if (auth()->check() && $request->type == 'liked') {
            $shops = auth()->user()->followedShops()->active();
        } else {
            $shops = Shop::active();
        }
        $shops = $shops->with(['products' => function ($query) {
            $query->whereHas('prodcats', function ($query) {
                $query->where('slug', request()->category);
            });
        }])
            ->when($request->filled('category'), function ($query) {
                $query->whereHas('products', function ($query) {
                    $query->whereHas('prodcats', function ($query) {
                        $query->where('slug', request()->category);
                    });
                });
            })->when(Session::has('post_city'), function ($q) {
                $post_city = Session::get('post_city');
                return $q->where(function ($qp) use ($post_city) {
                    $qp->where('post_code', 'like', '%' . $post_city . '%')->orWhere('city', 'like', '%' . $post_city . '%');
                });
            })->when(Session::has('state'), function ($q) {
                $state = Session::get('state');
                return $q->where('state', 'like', '%' . $state . '%');
            })
            ->get();
        return view('pages.vendors', compact('shops'));
    }

    public function follow(Shop $shop)
    {
        $user = auth()->user();

        $user->followedShops()->toggle($shop->id);

        if ($user->follows($shop)) {
            return redirect()->back()->with('success_msg', 'You are now following ' . $shop->name);
        } else {
            return redirect()->back()->with('success_msg', 'You have unfollowed ' . $shop->name);
        }
    }
    public function getPage($slug = null)
    {
        $page = Page::where('slug', $slug)->where('status', 'active');
        $page = $page->firstOrFail();
        return view('pages.page')->with('page', $page);
    }
    public function followShops()
    {
        return view('pages.likedShop');
    }
    public function setLocation(Request $request)
    {
        $postcodes = $request->input('postcodes');
        $lng = $request->input('lng');
        $lat = $request->input('lat');
        $radius = $request->input('radius');
        $state = $request->input('state');
        $uniquePostcodes = array_unique($postcodes);

        // Process the data as needed

        // Return the response
        $response = [
            'postcode' => $uniquePostcodes,
            'lng' => $lng,
            'lat' => $lat,
            'radius' => $radius,
            'state' => $state,
        ];
        Session::put('location', $response);

        return response()->json($response);
    }
    public function locationReset()
    {
        Session::forget('post_city');
        Session::forget('state');
        return back()->with('success_msg', 'Location reset Success');
    }
    public function locationSearchQuery(Request $request)
    {
        if ($request->filled('post_city')) {
            $postCityArray = session()->get('post_city', []);
            $updatedArray = array_merge($postCityArray, $request->input('post_city'));
            session()->put('post_city', $updatedArray);
        }
        if ($request->filled('state')) {
            session()->put('state', $request->input('state'));
        }
        return redirect(route('shops'));
    }
    public function getShops(Request $request)
    {
        $state = $request->input('state');
        $shops = Shop::where('state', $state)->pluck('city', 'city');
        // dd($shops);
        return response()->json($shops);
    }
}
