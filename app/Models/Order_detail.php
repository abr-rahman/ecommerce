<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    function relationtproduct(){
        return $this->hasOne(Product::class, 'id','product_id');
    }
    function relationtocolor(){
        return $this->hasOne(Color::class, 'id','color_id');
    }
    function relationto_i_color(){
        return $this->hasOne(Color::class, 'id','i_color');
    }
    function relationtosize(){
        return $this->hasOne(Size::class, 'id','size_id');
    }
    function relationto_i_size(){
        return $this->hasOne(Size::class, 'id','i_size');
    }

}
