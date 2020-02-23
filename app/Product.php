<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Product extends Model
{

    protected  $guarded = [];

    public function productCategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function setSlugAttribute($value)
    {
        $slug = trim(preg_replace("/[^\w\d]+/i", '-',$value));
        $count = $this->where('slug', 'like', "%${slug}%")->count();
        $slug = $slug.($count + 1);
        $this->attributes['slug'] = strtolower($slug);
    }

    public function getSlugAttribute($value)
    {
        if ($value == null){
            return $this->id;
        }
        return $value;
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public static function getCurrencyRates($price)
    {
        $getCurrencies = Currencie::all();

        foreach ($getCurrencies as $currency)
        {
            if (trim(strtolower($currency->currency_code) == 'usd'))
            {
                $usdRate = round($price/$currency->exchange_rate, 2);

            }elseif (trim(strtolower($currency->currency_code) == 'eur'))
            {
                $eurRate = round($price/$currency->exchange_rate, 2);

            }elseif (trim(strtolower($currency->currency_code) == 'inr'))
            {
                $inrRate = round($price/$currency->exchange_rate, 2);
            }
        }

        $currenciesArr = [
            'usdRate' => $usdRate,
            'eurRate' => $eurRate,
            'inrRate' => $inrRate,
        ];
        return $currenciesArr;
    }


    public static function deleteCartProduct($product_id, $user_email)
    {
        Cart::where(['product_id' =>$product_id, 'user_email' => $user_email])->delete();
    }

    public static function desiableProduct($product_id)
    {
        $desibleProduct = Product::where('id', $product_id)->first()->status;
        if($desibleProduct == 1)
        {
           return true;
        }
        return false;

    }


    public static function getGrandTotal()
    {
        $carts = Cart::where('user_email', auth()->user()->email)->get();
        foreach ($carts as $cart)
        {
            $product = ProductAttribute::where(['product_id' => $cart->product_id, 'size' => $cart->size])->first()->price;
            $productPriceArr[] = $product;
        }
        return array_sum($productPriceArr) + Session::get('shipping_charge') - Session::get('couponAmount');
    }



}
