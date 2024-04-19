@extends('layout.sidebar')
@section('content2')
{{-- alert jika berhasil --}}
@if(Session::get('success'))
<div class="container alert alert-success">
    {{session('success')}}
</div>
@endif
@if(Session::get('error'))
<div class="container alert alert-danger">
    {{session('error')}}
</div>
@endif
{{-- mengecek rolenya apa --}}
@if(Auth::user()->role == 'user')
<div class="container m-4">
    <h1>Check it out {{Auth::user()->username}}!!!!</h1>
</div>
<div class="container d-flex justify-content-center gap-3">
@foreach($books as $data)
<div class="card" style="width: 18rem;">
    <img src="{{asset('assets/img/' . $data->cover)}}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$data->title}}</h5>
      <p class="card-text">by: {{$data->writer}}</p>
      <div class="d-flex  justify-content-center items-center" style="flex-wrap: wrap">
        <div>
            @if($data->available == true)
            <form action="{{route('borrow.add', $data->slug)}}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Borrow</button>
            </form>
            @else
            <button class="btn btn-dark" disabled>Borrowed</button>
            @endif
        </div>
        <div>
            <form action="{{route('collection.store')}}" method="post">
                @csrf
                <input type="hidden" name="book_id" value="{{$data->id}}">
                <button type="submit" class="btn btn-success">Collection</button>
            </form>
        </div>
        <div>
            <a href="{{route('review', $data->id)}}" class="btn btn-warning">Review</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
</div>
@else
<div class="container">
    <h1>Welcome to Online Library {{Auth::user()->username}}!!!!</h1>
</div>
@endif
@endsection