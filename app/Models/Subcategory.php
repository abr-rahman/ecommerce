<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $guarded =[];

    protected static function boot()
    {
        parent::boot();

        Subcategory::creating(function ($model){
            $model->added_by = auth()->id();
        });
    }
}
