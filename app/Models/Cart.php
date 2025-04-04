<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart'; // Tên bảng trong database

    protected $fillable = ['user_id', 'book_id', 'quantity'];

    public function book()
    {
        return $this->belongsTo(Book::class); //1 Cart thuộc về 1 sách
    }
}
