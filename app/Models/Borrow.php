<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    public function books() {
       return $this->belongsTo(Book::class, 'book_id');
    }
}
