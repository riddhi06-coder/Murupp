<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterCollections extends Model
{
    use HasFactory;

    protected $table = 'master_collections';
    public $timestamps = false;

    protected $fillable = [
        'collection_name',
        'slug',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
