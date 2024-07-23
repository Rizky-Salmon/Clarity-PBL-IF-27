@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5"
            style="background-image: url('img/background_login.png'); background-size: cover;">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome! Please login to start your session</h1>
                            </div>
                            <form class="user" method="post" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        aria-describedby="emailHelp" value="{{ old('email') }}"
                                        placeholder="Enter Email Address..." name="email" autocomplete="email">
                                    @error('email')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        placeholder="Password" name="password">
                                    @error('password')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" name="remember" class="custom-control-input"
                                            id="customCheck">
                                        <label class="custom-control-label" style="color: #9a9cb2;"
                                            for="customCheck">Remember Me</label>
                                    </div>
                                </div>

                                <button name="submit" type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/register">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="mx-auto text-center">
                            <img src="img/Logo-merge.png" alt=""
                                style="max-width: 70%; height: auto;border-radius:50px; margin-top:5%">
                            <img src="img/clarity_login.png" alt="" style="max-width: 85%; height: auto;">
                        </div>
                        <div class="mx-auto text-center"
                            style="margin-top: -100px;font-family: 'Alike'; font-style: normal; font-weight: 400; font-size: 25px; line-height: 38px; color: #9a9cb2;">
                            <p class="small"><b>MAKE YOUR DATA EASY TO SEARCH<br>WITH CLARITY</b></p>
                        </div>
                    </div>
                </div>
                <footer class="footer py-3 shadow-sm">
                    <div class="container">
                        <div class="text-center">
                            <small class="text-muted">&copy;<a href="https://polibatam.ac.id"
                                target="_blank">Politeknik Negeri Batam</a>, in collaboration with <a
                                href="https://www.linkedin.com/in/jonathan-brindle/" target="_blank">Jonathan
                                Brindle</a>, International Office, <a href="https://www.uphf.fr/"
                                target="_blank">Université Polytechnique Hauts-de-France</a>. <br>
                                <a href="{{ route('credit') }}"> Credits and Team </a></small>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
