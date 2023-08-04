<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function product(){
        return $this->hasMany(Category::class,'item_id');
    }
}
