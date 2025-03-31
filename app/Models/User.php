<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role', 
        'birth', 
        'gender', 
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token', // Thêm vào để hỗ trợ remember me
    ];

    protected $casts = [
        'birth' => 'date',
        'email_verified_at' => 'datetime', // Nếu có xác thực email
    ];

    // Tự động hash password khi set
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) 
            ? Hash::make($value) 
            : $value;
    }
}
