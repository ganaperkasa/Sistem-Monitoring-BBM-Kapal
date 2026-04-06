@extends('layouts.login')

@section('content')
    <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                <div class="card mb-0">
                    <div class="card-body">
                        <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="../assets/images/logos/logopoltekpel.png" width="100" alt="">
                        </a>
                        <p class="text-center mb-4">Sistem Monitoring BBM Kapal</p>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login.post') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    required>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                {{-- <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div> --}}
                                <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                            {{-- <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</a> --}}
                            {{-- <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</a> --}}
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-3 mb-0 fw-bold">Don't have account?</p>
                                <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an
                                    account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
