@extends('layout.sidebar')

@section('content2')
    <h1 class="h3 mb-2 text-gray-800">User list</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
          {{-- tombol untuk menambahkan user --}}
            <h6 class="m-0 font-weight-bold text-primary"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add User
              </button>
              {{-- untuk export excel --}}
              <a href="{{route('export.user')}}" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
              </h6>
        </div>
        {{-- alert jika berhasi atau gagal --}}
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Admin</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $data)
                            <tr>
                               <td>{{$loop->iteration}}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->role }}</td>
                                <td>{{ $data->address }}</td>
                                <td>
                                    <div  class="d-flex justify-content-around">
                                        <div>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$data->id}}">
                                                Edit User
                                              </button>
                                        </div>
                                        <div>
                                            <form action="{{route('user.delete', $data->id)}}" method="post">
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
              <form action="{{route('user.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1">
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleFormControlInput1">
                  </div>
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Email</label>
                    <input class="form-control" name="email" type="email" id="formFile">
                  </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                  </div>
                <div class="mb-3">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Role</label>
                    <select class="form-control form-select" name="role" aria-label="Default select example">
                        <option hidden>Open this select menu</option>
                       <option value="user">User</option>
                       <option value="staff">Staff</option>
                       <option value="admin">Admin</option>
                      </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
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
      @foreach($users as $data)
      <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.update', $data->id)}}" method="post" enctype="multipart/form-data">
                    @method("PATCH")
                  @csrf
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Name</label>
                      <input type="text" value="{{$data->name}}" class="form-control"name="name" class="form-control" id="exampleFormControlInput1">
                    </div>
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Username</label>
                      <input type="text" value="{{$data->username}}" name="username" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                      <label for="formFile" class="form-label">Email</label>
                      <input class="form-control" value="{{$data->email}}" name="email" type="email" id="formFile">
                    </div>
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Password</label>
                      <input type="password" value="{{$data->password}}" name="password" class="form-control" id="exampleFormControlInput1">
                    </div>
                  <div class="mb-3">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Role</label>
                      <select class="form-control form-select" name="role" aria-label="Default select example">
                          <option hidden value="{{$data->role}}">{{$data->role}}</option>
                         <option value="user">User</option>
                         <option value="staff">Staff</option>
                         <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                      <textarea class="form-control" value="{{$data->address}}" name="address" id="exampleFormControlTextarea1" rows="3">{{$data->address}}</textarea>
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
