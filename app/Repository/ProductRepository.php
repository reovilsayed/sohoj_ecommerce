<?php

namespace App\Repository;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProductRepository
{

    protected $select = ['id', 'slug', 'name', 'shop_id', 'views', 'post_code', 'status', 'parent_id', 'images', 'image', 'price', 'sale_price'];
    protected $relations = ['shop:id,name,status', 'ratings', 'prodcats:id,name,slug'];
    protected $locationPostcodes;
    protected $recommand;

    public function __construct()
    {
        $this->locationPostcodes = Session::get('location.postcode', []);
        $this->recommand = Session::get('recommand', []);
    }

    public static function getLatestProducts(int $limit = 24)
    {
        return (new self())->latestProducts($limit);
    }

    public  function latestProducts(int $limit = 24)
    {

        $locationPostcodes = $this->locationPostcodes;
        return Cache::remember('latest_products_' . md5(json_encode($locationPostcodes)) . '_' . $limit, 3600, function () use ($locationPostcodes, $limit) {
            return Product::query()
                ->select($this->select)
                ->where('status', 1)
                ->whereNull('parent_id')
                ->whereHas('shop', fn($q) => $q->where('status', 1))
                ->when(!empty($locationPostcodes), fn($q) => $q->whereIn('post_code', $locationPostcodes))
                ->orderByDesc('views')
                ->latest()
                ->limit($limit)
                ->with($this->relations)
                ->get();
        });
    }

    public static function getBestsaleProducts(int $limit = 16)
    {
        return (new self())->bestsaleProducts($limit);
    }

    public  function bestsaleProducts(int $limit = 16)
    {
        $locationPostcodes = $this->locationPostcodes;
        return   Cache::remember('bestsaleproducts:' . md5(json_encode($locationPostcodes)) . '_' . $limit, 3600, function () use ($locationPostcodes, $limit) {

            return Product::query()
                ->select($this->select)
                ->where('status', 1)
                ->whereNull('parent_id')
                ->whereHas('shop', fn($q) => $q->where('status', 1))
                ->when(!empty($locationPostcodes), fn($q) => $q->whereIn('post_code', $locationPostcodes))
                ->orderByDesc('total_sale')
                ->latest()
                ->limit($limit)
                ->with($this->relations)
                ->get();
        });
    }

    public static function getRecommandProducts(int $limit = 16)
    {
        return (new self())->recommandProducts($limit);
    }

    public  function recommandProducts(int $limit = 16)
    {
        $recommand = $this->recommand;
        return  Cache::remember('recommandProducts:' . md5(json_encode($recommand)) . '_' . $limit, 3600, function () use ($recommand, $limit) {
            return Product::query()
                ->select($this->select)
                ->whereNull('parent_id')
                ->whereIn('id', $recommand)
                ->with($this->relations)
                ->limit($limit)
                ->get();
        });
    }

    public static function getAllProducts(int $paginate = 12)
    {
        return (new self())->allProducts($paginate);
    }

    public function allProducts(int $paginate = 12)
    {
        return Product::where("status", 1)->whereNull('parent_id')->whereHas('shop', function ($q) {
            $q->where('status', 1);
        })->filter()->paginate($paginate);
    }

    public static function getVendorProducts(Shop $shop, array $filters = [])
    {
        return Product::where("status", 1)->whereNull('parent_id')->whereHas('shop', function ($q) {
            $q->where('status', 1);
        })->filter()->paginate(12);
    }
}
