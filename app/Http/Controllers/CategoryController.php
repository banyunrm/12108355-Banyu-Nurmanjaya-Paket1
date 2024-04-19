<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // untuk  menampilkan semua data dari tabel category yang ada di database
    public function index()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    // untuk membuat  data baru ke dalam tabel category
    public function create(Request $request)
    {
        $request->validate([
            'category' => 'required'
        ]);
        Category::create([
            'category' => $request->category
        ]);
        return redirect()->back()->with('success', 'sukses tambah kategori!');
    }


    // untuk menghapus   data dari tabel category berdasarkan id yang dipilih
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back()->with('success', 'sukses hapus kategori!');
    }
}
