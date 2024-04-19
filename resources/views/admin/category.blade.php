@extends('layout.sidebar')

@section('content2')
    <h1 class="h3 mb-2 text-gray-800">Category list</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- button untuk menambahkan kategori --}}
            <h6 class="m-0 font-weight-bold text-primary"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Category
              </button>
              {{-- untuk export excel --}}
              <a href="{{route('export.category')}}" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
              </h6>
        </div>
        {{-- alert untuk berhil atau tidak --}}
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
                            <th>Name</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->category }}</td>
                                <td class="d-flex justify-content-around">
                                    <div>
                                        <div>
                                            <form action="{{route('category.delete', $data->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">delete</button>
                                           </form>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('category.create')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" id="exampleFormControlInput1">
                  </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
