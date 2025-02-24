<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPermission extends Model
{
    use HasFactory;

    protected $table = 'users_permission';
    
    protected $fillable = [
        'user_id',
        'permission_id',
    ];

    protected $casts = [
        'permission_id' => 'array', // Cast permissions to array for easy access
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permission', 'user_id', 'permission_id');
    }
}
