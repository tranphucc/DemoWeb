<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'birth', 'gender', 'address',
    ];

    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'birth' => 'date', // Tự động chuyển đổi ngày sinh thành đối tượng Carbon
    ];

}
