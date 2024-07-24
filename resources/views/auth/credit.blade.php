@extends('layouts.auth')

@section('title', 'Credit')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5 col-md-12">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12">
                <div class="mx-auto text-center">
                    <img src="img/Logo-merge.png" alt="" style="max-width: 40%; height: auto; border-radius:50px; margin-top:2%">
                </div>
                <hr class="my-4">
                <div class="container text-center text-dark">
                    <h3 class="mb-4 font-weight-bold">Our Team</h3>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/jonatan.png" alt="Jonatan Brindle" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Jonathan Brindle</h6>
                                    <p class="text-muted" style="font-size: 14px">Client and Collaborator</p>
                                    <small class="font-italic">Université Polytechnique Hauts-de-France</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/mufida.jpg" alt="Miratul Khusna Mufida" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Miratul Khusna Mufida</h6>
                                    <p class="text-muted" style="font-size: 14px">Client and Collaborator</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/gilang.png" alt="Gilang Bagus Ramadhan" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 17px; font-weight: bold; margin-bottom: 0px">Gilang Bagus Ramadhan</h6>
                                    <p class="text-muted" style="font-size: 14px">Project Manager</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/rendi.png" alt="Rendi Sinaga" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Rendi Sinaga</h6>
                                    <p class="text-muted" style="font-size: 14px">Team Leader</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/nisa.jpg" alt="Khairunnisa" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Khairunnisa</h6>
                                    <p class="text-muted" style="font-size: 14px">Team Member</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/okta.jpg" alt="Oktarira Die Ananda" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Oktarira Die Ananda</h6>
                                    <p class="text-muted" style="font-size: 14px">Team Member</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/cindy.jpg" alt="Cindy Anggraeni" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Cindy Anggraeni</h6>
                                    <p class="text-muted" style="font-size: 14px">Team Member</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/salzi.jpg" alt="Syalzi Astaudi" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Syalzi Astaudi</h6>
                                    <p class="text-muted" style="font-size: 14px">Team Member</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <img src="img/farrel.jpg" alt="Farrel Ariq Nadhil" class="card-img-top" style="max-width: 100%; height: 250px; object-fit: cover; border-radius: 50%;">
                                <div class="card-body text-center">
                                    <h6 style="font-size: 18px; font-weight: bold; margin-bottom: 0px">Farrel Ariq Nadhil</h6>
                                    <p class="text-muted" style="font-size: 14px">Team Member</p>
                                    <small class="font-italic">Politeknik Negeri Batam</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <div class="mx-auto text-center">
                    <small class="text-muted">&copy; <a href="https://polibatam.ac.id" target="_blank">Politeknik Negeri Batam</a>, in collaboration with <a href="https://www.linkedin.com/in/jonathan-brindle/" target="_blank">Jonathan Brindle</a>, International Office, <a href="https://www.uphf.fr/" target="_blank">Université Polytechnique Hauts-de-France</a>.</small>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>

@endsection
