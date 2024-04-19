<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // untuk menampilkan  data dari database yang ada di table
    public function index()
    {
        $borrows = Borrow::with('books')->where('user_id', Auth::user()->id)->get();
        return view('user.borrow', compact('borrows'));
    }

    // untuk  mengambil data buku dan user yg sedang login
    public function borrowlist()
    {
        $borrows = Borrow::all();
        return view('admin.borrow', compact('borrows'));
    }


    // untuk  memproses saat tombol pinjam di klik
    public function borrow($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        $book->update([
            'available' => false,
        ]);
        Borrow::create([
            'book_id' => $book->id,
            'user_id' => Auth::user()->id,
            'borrowed_date' => now(),
            'status' => 'dipinjam'
        ]);
        return redirect()->back()->with('success', 'sukses menambah ke peminjaman');
    }

//    untuk  proses saat tombol kembali/selesaikan di klik
    public function return($id)
    {
        $borrowed = Borrow::where('id', $id)->where('user_id', Auth::user()->id)->first();
        $book = Book::where('id', $borrowed->book_id);
        $book->update([
            'available' => true
        ]);

        $borrowed->update([
            'return' => Carbon::now(),
            'status' => 'kembali'
        ]);
        return redirect()->back()->with('success', 'sukses mengembalikan buku');
    }

}
