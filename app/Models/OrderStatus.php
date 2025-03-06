<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status_details';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'order_id',
        'order_status',
        'status_updated_by',
        'status_updated_at',
        'order_remarks',
        'delivery_date',
    ];
}
