@extends('layout.sidebar')

@section('content2')
    <h1 class="h3 mb-2 text-gray-800">Book list</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Book
              </button>
              {{-- untuk export excel --}}
              <a href="{{route('export.book')}}" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
              </h6>
        </div>
        {{-- membuat alert jika data berhasil ditambahkan  --}}
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
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Publisher</th>
                            <th>Release</th>
                            <th>Category</th>
                            <th>Synopsis</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($books as $data)
                            <tr>
                                <td><img src="{{ asset('assets/img/' . $data->cover) }}" width="300" alt=""></td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->writer }}</td>
                                <td>{{ $data->publisher }}</td>
                                <td>{{ $data->release }}</td>
                                <td>{{ $data->category }}</td>
                                <td>{{ $data->synopsis }}</td>
                                <td>
                                    <div  class="d-flex justify-content-around">
                                        <div>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">
                                                Edit 
                                              </button>
                                        </div>
                                        <div>
                                            <form action="{{route('book.delete', $data->id)}}" method="POST">
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
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('book.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1">
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Writer</label>
                    <input type="text" name="writer" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Cover</label>
                    <input class="form-control" name="cover" type="file" id="formFile">
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Publisher</label>
                    <input type="text" name="publisher" class="form-control" id="exampleFormControlInput1">
                  </div>
                <div class="mb-3">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                    <select class="form-control form-select" name="category" aria-label="Default select example">
                        <option hdden>Open this select menu</option>
                        @foreach($categories as $data)
                      <option value="{{$data->category}}">{{$data->category}}</option>
                      @endforeach
                      </select>
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Release</label>
                    <input type="date" name="release" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Synopsis</label>
                    <textarea class="form-control" name="synopsis" id="exampleFormControlTextarea1" rows="3"></textarea>
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
      @foreach($books as $data)
      <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('book.update', $data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" value="{{$data->title}}" name="title" class="form-control" id="exampleFormControlInput1">
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Writer</label>
                    <input type="text" name="writer" value="{{$data->writer}}" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Cover</label>
                    <input class="form-control"  name="cover" type="file" id="formFile">
                    <p>Before change :</p>
                    <img src="{{asset('asset/img/' . $data->id)}}" alt="">
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Publisher</label>
                    <input type="text" name="publisher" value="{{$data->publisher}}" class="form-control" id="exampleFormControlInput1">
                  </div>
                <div class="mb-3">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category</label>
                    <select class="form-control form-select" name="category" aria-label="Default select example">
                        <option value="{{$data->category}}" selected hidden>{{$data->category}}u</option>
                        @foreach($categories as $data)
                      <option value="{{$data->category}}">{{$data->category}}</option>
                      @endforeach
                      </select>
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Release</label>
                    <input type="date" name="release" value="{{$data->release}}" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Synopsis</label>
                    <textarea class="form-control" name="synopsis" id="exampleFormControlTextarea1" rows="3">{{$data->synopsis}}</textarea>
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
      @endforeach
@endsection
