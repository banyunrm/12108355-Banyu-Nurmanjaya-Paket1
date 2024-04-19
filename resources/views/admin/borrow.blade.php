@extends('layout.sidebar')

@section('content2')
    <h1 class="h3 mb-2 text-gray-800">Book borrowed</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Borrowed
                {{-- untuk export excel --}}
                <a href="{{route('export.borrow')}}" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
              </h6>
        </div>
        {{-- membuat alert jika berhasil atau gagal menambah data --}}
        @if($errors->any())
        <div class="container alert alert-danger">
            @foreach($errors->all() as $error)
            {{$error}}
            @endforeach
        </div>
        @endif
        @if(Session::get('success'))
        <div class="container alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Borrowed date</th>
                            <th>Return</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($borrows as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->books->title }}</td>
                                <td>{{ $data->borrowed_date}}</td>
                                <td>{{ $data->return}}</td>
                                <td class="d-flex justify-content-around">
                                    <div>
                                        <div>
                                            @if($data->return == '')
                                            <form action="{{route('borrow.return', $data->id)}}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary">return</button>
                                           </form>
                                           @else
                                               <button type="submit" class="btn btn-dark" disabled>done</button>
                                           @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
