<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopsDetails extends Model
{
    use HasFactory;

    protected $table = 'category_tops_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
