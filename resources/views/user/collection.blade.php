@extends('layout.sidebar')
@section('content2')
<div class="container d-flex justify-content-center gap-3">
    @if(Session::get('success'))
    <div class="container alert alert-success">
        {{session('success')}}
    </div>
    @endif
@foreach($collections as $data)
<div class="card" style="width: 18rem;">
    <img src="{{asset('assets/img/' . $data->books->cover)}}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$data->books->title}}</h5>
      <p class="card-text">by: {{$data->books->writer}}</p>
      <div class="d-flex  justify-content-center items-center" style="flex-wrap: wrap">
        <div>
            @if($data->books->available == true)
            <form action="{{route('borrow.add', $data->books->slug)}}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">Borrow</button>
            </form>
            @else
            <button class="btn btn-dark" disabled>Borrowed</button>
            @endif
        </div>
        <div>
            <a href="{{route('review', $data->id)}}" class="btn btn-warning">Review</a>
        </div>
      </div>
    </div>
  </div>
@endforeach
</div>
@endsection