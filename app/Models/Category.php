<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articleCount(){
        return $this->hasMany('App\Models\Article','category_id','id')->count();
        // hasXXX(BAĞLANACAĞIMIZ TABLO,BAĞLANACAĞIMIZ TABLO KEY,BİZİM KEY)
    }
}
