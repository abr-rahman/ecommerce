<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    public function rel_to_country(){
        return $this->hasOne(Country::class, 'id', 'Country_id');
    }
    public function relationtoCountry(){
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}
