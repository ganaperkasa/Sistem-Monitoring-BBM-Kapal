@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-body">

            <!-- MENU PILIHAN -->
            <ul class="nav nav-tabs mb-3" id="profileTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile">
                        Edit Profile
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password">
                        Ubah Password
                    </button>
                </li>
            </ul>

            <div class="tab-content">

                <!-- ================= EDIT PROFILE ================= -->
                <div class="tab-pane fade show active" id="profile">

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ auth()->user()->name }}">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ auth()->user()->email }}">
                        </div>

                        <button class="btn btn-primary">Update Profile</button>
                    </form>

                </div>

                <!-- ================= UBAH PASSWORD ================= -->
                <div class="tab-pane fade" id="password">

                    <form method="POST" action="{{ route('password.update.manual') }}">
                        @csrf

                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="old_password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>

                        <button class="btn btn-warning">Ubah Password</button>
                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
