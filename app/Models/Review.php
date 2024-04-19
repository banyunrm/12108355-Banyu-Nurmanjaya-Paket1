<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function books() {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
