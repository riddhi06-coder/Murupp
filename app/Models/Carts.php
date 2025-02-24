<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $table = 'carts';
    public $timestamps = false;

    protected $fillable = [
        'transaction_token',
        'user_id',
        'product_id',
        'quantity',
        'colors',
        'print',
        'size',
        'product_image',
        'product_total_price',
        'payment_status',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
