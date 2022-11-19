<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function supplier_details(){
        return $this->hasOne(Supplier::class,'id','supplier_id');
    }

    public function category_details(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function unit_details(){
        return $this->hasOne(unit::class,'id','unit_id');
    }
}
