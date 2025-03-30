<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 
        'role', 'birth', 'gender', 'address'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'birth' => 'date',
        'email_verified_at' => 'datetime'
    ];

    // Kiểm tra role admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
