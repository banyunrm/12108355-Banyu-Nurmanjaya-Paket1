@extends('layout.sidebar')

@section('content2')
    @if ($books)
        @foreach ($books as $book)
            <div class="d-flex justify-content-center" style="gap: 20px">
                <div>
                    <img src="{{ asset('assets/img/' . $book->cover) }}" width="400" height="" alt="">
                </div>
                <div>
                    <h1>{{ $book->title }}</h1>
                    <h3>{{ $book->writer }}</h3>
                    <h5>{{ $book->release }}</h5>
                    <h4>{{ $book->category }}</h4>
                    <p>{{ $book->synopsis }}</p>
                </div>
            </div>

            <div class="mt-4">
                @if ($book->userHasReviewed(auth()->user()->id)) <!-- Memeriksa apakah pengguna telah memberikan review untuk buku ini -->
                    <h2>Review Anda</h2>
                    @foreach ($book->reviews as $review) <!-- Menampilkan hasil review pengguna -->
                        @if ($review->user_id === auth()->user()->id)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p class="card-text">Review: {{ $review->review }}</p>
                                    <p class="card-text">Rating: 
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            ★
                                        @endfor
                                        ({{ $review->rating }}/5)
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <h2>Tambahkan Review</h2>
                    <form action="{{ route('review.store', $book->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="review" class="form-label">Review:</label>
                            <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating:</label>
                            <select class="form-select" id="rating" name="rating" required>
                                <option value="1">★</option>
                                <option value="2">★★</option>
                                <option value="3">★★★</option>
                                <option value="4">★★★★</option>
                                <option value="5">★★★★★</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @endif
            </div>
        @endforeach
    @endif
@endsection
