<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    function getCategory(){
       return $this->hasOne('App\Models\Category','id','category_id');
       // kategori tablosuna git, orada 1 tane id değeri bendeki category_id değeriyle eşleşen kategori var. onu al getir.
    }
}
