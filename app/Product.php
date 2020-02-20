<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


}
