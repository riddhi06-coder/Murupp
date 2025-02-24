<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFabrics extends Model
{
    use HasFactory;

    protected $table = 'master_product_fabrics';
    public $timestamps = false;

    protected $fillable = [
        'fabrics_name',
        'slug',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
