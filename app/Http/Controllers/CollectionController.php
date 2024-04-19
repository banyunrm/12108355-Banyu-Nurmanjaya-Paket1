<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  untuk menampilkan user.collection
    public function index()
    {
        $collections = Collection::with('books')->where('user_id', Auth::user()->id)->get();
        return view('user.collection', compact('collections'));
    }

    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $bookId = $request->book_id;
        $existingCollection = Collection::where('user_id',$userId)->where('book_id', $bookId)->exists();

        if($existingCollection){
            return redirect()->back()->with('error', 'buku telah ada di koleksi');
        }
        Collection::create([
            'user_id' => $userId,
            'book_id' => $bookId
        ]);
        return redirect()->back()->with('success', 'sukses menambah buku ke koleksi');
    }

}
