<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $books = Book::all();
        $books_export = [];

        $books_export[] = [
            'title' =>'title',
            'cover' =>'cover',
            'writer' =>'writer',
            'publisher' =>'publisher',
            'release' =>'release',
            'category' =>'category',
            'synopsis' =>'synopsis',
            'available' =>'available',
            'slug' =>'slug',
        ];

        foreach($books as $book){
            $books_export[] = [
            'title' => $book->title,
            'cover' => $book->cover,
            'writer' => $book->writer,
            'publisher' => $book->publisher,
            'release' => $book->release,
            'category' => $book->category,
            'synopsis' => $book->synopsis,
            'available' => $book->available,
            'slug' => $book->slug,
            ];
        }

        return collect($books_export);  
    }
}
