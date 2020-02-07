<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
   protected $guarded = [];


    public function setSlugAttribute($value)
    {
        $slug = trim(preg_replace("/[^\w\d]+/i", '-',$value));
        $this->attributes['slug'] = strtolower($slug);
    }



}
