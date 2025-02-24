<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTag extends Model
{
    use HasFactory;

    protected $table = 'seo_details';
    public $timestamps = false;

    protected $fillable = [
        'page_name',
        'page_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'canonical_tag',
        'hreflang_tag',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
