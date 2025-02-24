<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footer_details';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'map_url',
        'contact_number',
        'about',
        'media_platform',
        'media_link',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
