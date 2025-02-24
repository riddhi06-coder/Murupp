<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPolicy extends Model
{
    use HasFactory;

    protected $table = 'product_policies';
    public $timestamps = false;

    protected $fillable = [
        'heading',
        'description',
        'policy_image',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
