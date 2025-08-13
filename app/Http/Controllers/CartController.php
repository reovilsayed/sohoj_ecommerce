<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Cart;
use App\Models\Product;
use Darryldecode\Cart\Cart as CartCart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
	public function add(Request $request)
	{
		$this->cart($request);

		return redirect()->back()->with('success_msg', 'Item has been added to cart!');
		// return response()->json(['success' => 'Item has been added to cart']);
	}
	// public function update(Request $request)
	// {

	// 	Cart::update($request->product_id, array(
	// 		'quantity' => array(
	// 			'relative' => false,
	// 			'value' => $request->quantity
	// 		),
	// 	));
	// 	return back()->with('success_msg', 'Item has been updated!');
	// }

	// public function update(Request $request)
	// {
	// 	$request->validate([
	// 		'rowId' => 'required',
	// 		'quantity' => 'required|integer|min:1',
	// 	]);
	// 	Cart::update($request->rowId, [
	// 		'qty' => $request->quantity // You can also use 'quantity' => $value but qty is preferred
	// 	]);

	// 	return back()->with('success_msg', 'Item has been updated!');
	// }
	public function update(Request $request)
	{

		$rowId = $request->input('rowId');
		$qty = $request->input('qty');

		if ($request->action == 'increase') {
			Cart::update($rowId, $qty + 1);

			return back()->with('success_msg', 'Item has been updated!');
		} elseif ($request->action == 'decrease' && $qty > 1) {
			Cart::update($rowId, $qty - 1);

			return back()->with('success_msg', 'Item has been updated!');
		}
		return back()->with('success_msg', 'Quantity cannot be less than 1!');
	}


	public function destroy($rowId)
	{
		Cart::remove($rowId);
		return back()->with('success_msg', 'Item has been removed!');
	}

	public function offerToCart(Request $request)
	{

		$product = Product::find(request('product_id'));
		$offer = Offer::find(request('offer'));
		if ($offer->is_offer == 1) {

			// if ($product->sale_price) {
			// 	$price = ($product->sale_price - $request->offer_price);
			// } else {
			// 	$price = ($product->price - $request->offer_price);
			// }
			$price = request('offer_price');
			Cart::add($product->id, $product->name, $price, request('quantity'), 'is_offer')->associate('App\Models\Product');

			$offer->update([
				'is_offer' => 0,
			]);
			//session()->flash('errors', collect(['Please Check Length,Width,Height,Weight again of this product']));
			return redirect()->route('cart')->with('success_msg', 'Item has been added to cart!');
		} else {
			return redirect(env('APP_URL') . '/product/' . $product->slug)->withErrors('Sorry! Please again Offer send');
		}
	}
	public function cartQty()
	{
		$cartqty = Cart::count();

		return response()->json($cartqty);
	}

	public function buynow(Request $request)
	{

		$this->cart($request);

		return redirect('/cart')->with('success_msg', 'Item has been updated!');;
	}

	private function cart($request)
	{
		$variation = null;
		if ($request->filled('selected_variant_sku')) {
			$variation = Product::find($request->product_id)->getVariationBySku($request->selected_variant_sku);
		}



		$product = Product::find($request->product_id);


		$price = $variation ? $variation->price : $product->getPrice();

		Cart::add([
			'id'      => $product->id,
			'name'    => $product->name,
			'price'   => $price,
			'qty'     => $request->quantity,
			'weight'  => 0,
			'options' => [
				'offer'     => 'no_offer',
				'variation' => $variation ? $variation->getSku() : null,
			]
		])->associate('App\Models\Product');

		return response()->json(['success' => 'Product added to cart']);
	}


	// private function cart($request)
	// {
	// 	if ($request->variable_attribute) {
	// 		$variation = json_encode($request->variable_attribute);
	// 		$product = DB::table('products')
	// 			->where('parent_id', $request->product_id)
	// 			->whereRaw("JSON_CONTAINS(variations, ?)", [$variation])
	// 			->first();

	// 		if (!$product) {
	// 			return response()->json(['error' => 'Sorry! This variation is no longer available'], 404);
	// 		}
	// 	} else {
	// 		$product = Product::find($request->product_id);
	// 	}

	// 	$price = $product->sale_price ?: $product->price;

	// 	Cart::add([
	// 		'id'      => $product->id,
	// 		'name'    => $product->name,
	// 		'qty'     => $request->quantity,
	// 		'price'   => $price,
	// 		'weight'  => 0,
	// 		'options' => [
	// 			'offer' => 'no_offer',
	// 			'variation' => $request->variable_attribute ?? null,
	// 		]
	// 	])->associate(Product::class);


	// }
}
