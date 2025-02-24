<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FabricsComposition extends Model
{
    use HasFactory;

    protected $table = 'master_fabrics_composition';
    public $timestamps = false;

    protected $fillable = [
        'composition_name',
        'slug',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
