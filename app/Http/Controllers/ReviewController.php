<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;

class ReviewController extends Controller
{
    /**
     * Simpan review baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Buat objek Review baru
        $review = new Review();
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->user_id = auth()->user()->id; 
        $review->book_id = $id; 
        $review->save();

        return redirect()->back()->with('success', 'Review berhasil ditambahkan');
    }
}
