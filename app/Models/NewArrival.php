<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewArrival extends Model
{
    use HasFactory;

    protected $table = 'new_arrivals';
    public $timestamps = false;

    protected $fillable = [
        'product_name',
        'section_heading',
        'product_price',
        'product_size',
        'product_image',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
