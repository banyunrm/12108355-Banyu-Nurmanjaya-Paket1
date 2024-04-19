@extends('layout.cdn')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
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
                            <form class="user" action="{{route('register.auth')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="name"
                                            id="exampleFirstName" placeholder="Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="username"
                                            id="exampleLastName" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            placeholder="Email">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" class="form-control form-control-user"
                                           placeholder=" Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea type="address" name="address" class="form-control form-control-user"
                                        placeholder="address"></textarea>
                                </div>
                                <button type="submit"  class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                            </div>
                            <div class="text-center">
                                <a class="small" href="/">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
