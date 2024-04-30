@extends('layouts.auth')

@section('title','Login')

@section('content')
<div class="col-xl-10 col-lg-12 col-md-9">

    <div class="card o-hidden border-0 shadow-lg my-5" style="background-image: url('img/background_login.png'); background-size: cover;">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome ! Please login to start your session</h1>
                        </div>
                        {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $item)
                                        <li>{{ $item }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif --}}
                    <form class="user" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" aria-describedby="emailHelp" value="{{ old('email') }}" placeholder="Enter Email Address..." name="email" autocomplete="email">
                            @error('email') <small class="invalid-feedback">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Password" name="password">
                            @error('password') <small class="invalid-feedback">{{ $message }}</small> @enderror

                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" style="color: #9a9cb2;" for="customCheck">Remember
                                    Me</label>
                            </div>
                        </div>
                        <button name="submit" type="submit" href="" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                        <!-- <hr> -->
                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                    </a> -->
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="/register">Create an Account!</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="mx-auto text-center">
                    <img src="img/clarity_login.png" alt="" style="max-width: 85%; height: auto;">

                </div>
                <div class="mx-auto text-center" style="margin-top: -100px;font-family: 'Alike';
                            font-style: normal;
                            font-weight: 400;
                            font-size: 25px;
                            line-height: 38px;
                            color: #9a9cb2;
                            ">
                    <p class="small"><b>MAKE YOUR DATA EASY TO SEARCH<br>WITH CLARITY</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
