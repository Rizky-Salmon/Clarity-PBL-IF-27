@extends('layouts.auth')

@section('title', 'Register')

@section('content')

        <div class="card o-hidden border-0 shadow-lg my-5"
            style="background-image: url('img/background_login.png'); background-size: cover;">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="exampleFullName"
                                        name="full_name" placeholder="Full Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        name="email" placeholder="Email Address" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" name="password_confirmation"
                                            placeholder="Repeat Password" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>

                            <hr>
                            {{-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div> --}}
                            <div class="text-center">
                                <a class="small" href="/">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="mx-auto text-center">
                            <img src="img/clarity_login.png" alt="" style="max-width: 85%; height: auto;">

                        </div>
                        <div class="mx-auto text-center"
                            style="margin-top: -100px;font-family: 'Alike';
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
@endsection
