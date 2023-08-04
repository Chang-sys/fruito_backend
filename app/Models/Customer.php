<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'house_number',
        'province_city',
        'country',
        'postal_code'
    ];
}
