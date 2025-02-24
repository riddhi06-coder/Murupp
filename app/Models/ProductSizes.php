<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizes extends Model
{
    use HasFactory;

    protected $table = 'master_product_size';
    public $timestamps = false;

    protected $fillable = [
        'size',
        'bust',
        'waist',
        'hips',
        'slug',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
