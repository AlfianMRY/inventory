@extends('layouts.master')
@section('header')
    <h3 class="font-bold">Edit Profile</h3>
@endsection
@section('content-top')
    <div class="card bg-primary">
        <div class="card-body profile-user-box">
            <div class="row">
                <div class="col-sm-8">
                    <div class="row align-items-center">
                        <div class="col-md-4 ">
                            <div class="avatar-lg mx-auto">
                                @php
                                    if (!empty($user->foto)) {
                                        $foto = $user->foto;
                                    } else {
                                        $foto = 'default.png';
                                    }
                                    if ($user->status == 'active') {
                                        $stat = 'success';
                                    } else {
                                        $stat = 'danger';
                                    }
                                @endphp
                                <img src="{{ asset('/img/profile/' . $foto) }}" alt=""
                                    class="rounded-circle img-thumbnail">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <h4 class="mt-1 mb-1 text-white">{{ $user->name }}</h4>
                                <p class="font-13 text-white-50"> {{ $user->email }}</p>
                                <ul class="mb-0 list-inline text-light">
                                    <li class="list-inline-item me-3">
                                        <h5 class="mb-1"><i class="mdi mdi-circle text-{{ $stat }}"> </i>
                                            {{ ucwords($user->status) }}</h5>
                                        <p class="mb-0 font-13 text-white-50">Status Akun</p>
                                    </li>
                                    <li class="list-inline-item">
                                        <h5 class="mb-1">{{ $user->requestsuplybarang()->count() }}x</h5>
                                        <p class="mb-0 font-13 text-white-50">Melakukan Pemesanan</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col-->

                <div class="col-sm-4">
                    <div class="text-center mt-sm-0 mt-3 text-sm-end">
                        <a href="{{ url('/profile', $user->id) }}" class="btn btn-light">
                            <i class="mdi mdi-account me-1"></i> Kembali
                        </a>
                    </div>
                </div> <!-- end col-->
            </div>
        </div>
    </div>
    @if ($message = Session::get('error'))
        <div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <i class="dripicons-wrong me-2"></i><strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show " role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="mt-2" style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li><i class="dripicons-wrong me-2"></i><strong> {{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
@section('content')
    <form action="{{ url('/profile', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="example-fileinput" class="form-label">Nama :</label>
                <input type="text" name="name" value="{{ $user->name }}" id="example-fileinput"
                    class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="example-fileinput" class="form-label">Email :</label>
                <input type="email" name="email" value="{{ $user->email }}" id="example-fileinput"
                    class="form-control">
            </div>
            <h4>Ganti Password :</h4>
            <hr>
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password Baru :</label>
                <div class="input-group input-group-merge">
                    <input type="password" name="password1" id="password" class="form-control"
                        placeholder="Enter your password">
                    <div class="input-group-text" data-password="false" style="cursor:pointer;">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Confirm Password Baru :</label>
                <div class="input-group input-group-merge">
                    <input type="password" name="password2" id="password" class="form-control"
                        placeholder="Enter your password">
                    <div class="input-group-text" data-password="false" style="cursor:pointer;">
                        <span class="password-eye"></span>
                    </div>
                </div>
            </div>
            <h4 class="mt-3">Ganti Foto Profile</h4>
            <hr>
            <div class="col-md-6 mb-3">
                <label for="example-fileinput" class="form-label">Foto Profile :</label>
                <input type="file" name="foto" id="example-fileinput" class="form-control">
            </div>
            <div class="col-md-6 d-flex justify-content-end py-3">
                <button class="btn btn-success ms-auto" type="submit">Simpan</button>
            </div>
        </div>
    </form>
@endsection
