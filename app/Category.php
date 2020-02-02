<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['parent_id', 'name', 'slug', 'description', 'image', 'status'];

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


    public function children(){
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function categoryProducts()
    {
        return $this->hasMany(Product::class);
    }


}
