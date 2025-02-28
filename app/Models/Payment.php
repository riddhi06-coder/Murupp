<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    public $timestamps = false;

    protected $fillable = ['order_id', 'payment_id', 'status','created_at'];
}
