<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'order_id',
        'payment_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'images',
        'sizes',
        'address',
        'total_price',
        'status',
        'product_ids',
        'product_names',
        'quantities',
        'prices',
        'created_at',
        'created_by',
    ];
    
}
