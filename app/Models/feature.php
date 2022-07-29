<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feature extends Model
{
    use HasFactory;
    protected $fillable = ['feature_name', 'about_feature', 'feature_photo'];
}
