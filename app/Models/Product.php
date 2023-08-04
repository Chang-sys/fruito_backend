<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    public function category(){
        return $this->belongsTo(Category::class, "category_id")->select('id','name'); //one to many
    }
    public function item(){
        return $this->belongsTo(Item::class, "item_id")->select('id','name');
    }
    public function cart(){
        return $this->hasMany(Cart::class, "product_id");
    }
}
