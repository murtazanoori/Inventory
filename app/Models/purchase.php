<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class purchase extends Model
{
    use HasFactory;
    protected $guarded =[];


    //connecting tables with databases
    // -> it means to access an objects value
    // => it means to create an array
    public function product_details(){
        return $this->hasOne(product::class, 'id', 'product_id');
    }
    public function supplier_details(){
        return $this->hasOne(supplier::class, 'id', 'supplier_id');
    }
    public function category_details(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }


}
