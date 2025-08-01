<?php

namespace App\Facade;

use Cart;
use Voyager;
use App\Models\Shipping;


class Sohoj
{
    public function price($price)
    {
        return "$" . $this->round_num($price);
        // dd($price);
    }
    public function tax()
    {
        $subtotal = floatval(str_replace(',', '', Cart::subtotal()));
        $total = $subtotal - $this->discount();
        $taxRate = 15;
        return ($taxRate * $total) / 100;
    }

    public function discount()
    {
        if (session()->has('discount')) {
            return session()->get('discount');
        }
        return 0;
    }
    public function discount_code()
    {
        if (session()->has('discount_code')) {
            return session()->get('discount_code');
        }
        return null;
    }
    public function shipping_method()
    {
        if (session()->has('shipping_method')) {
            return session()->get('shipping_method');
        } else {
            $shipping = Shipping::first();
            return $shipping->Shipping_method;
        }
    }
    public function shipping()
    {
        $cart = Cart::content();

        $totalShippingCost = 0;

        foreach ($cart as $item) {
            $shippingCost = $item->model->shipping_cost;
            $totalShippingCost += $shippingCost;
        }

        return $totalShippingCost;
    }
    public function newItemTotal()
    {
        return Cart::subtotal();
    }
    public function newSubtotal()
    {
        $subtotal = floatval(str_replace(',', '', Cart::subtotal()));
        return ($subtotal + $this->tax() + $this->shipping()) - $this->discount();
    }

    public function newTotal()
    {
        return ($this->newSubtotal());
        // return ($this->newSubtotal() + $this->shipping());
    }
    public function round_num($price)
    {
        return sprintf(newSubtotal $price);
    }
    public function average_rating($ratings)
    {
        if ($ratings->count() > 0) {
            return $ratings->sum('rating') / $ratings->count();
        }
        return 0.00;
    }

    public function flatCommision($price)
    {
        if ($price < 30) {
            return  1.95;
        } elseif ($price > 30 && $price < 300) {
            return  3.75;
        } elseif ($price > 300 && $price < 1000) {
            return  7.95;
        } else {
            return  20;
        }
    }
    public function vendorprice($price)
    {
        // return $price;

        $tenPercent = $price * .06;
        $sixPercent = $price * .06;
        if ($price < 1000) {
            return ($price - $tenPercent);
        } else {
            return ($price - $sixPercent);
        }
    }
}
