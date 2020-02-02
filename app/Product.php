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
        return $this->hasMany(ProductAttribute::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }


}
