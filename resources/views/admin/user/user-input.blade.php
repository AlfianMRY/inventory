@extends('layouts.master')
@section('header')
    <h3>Tambah User</h3>
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('/user') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama User :</label>
                <input type="text" name="nama" placeholder="Nama" id="simpleinput" class="form-control">
            </div>
        </div>   
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Email User :</label>
                <input type="email" name="email" placeholder="exemple@gmail.com" id="simpleinput" class="form-control">
            </div>
        </div>   
        <div class="col-md-6 mb-3">
            <label for="password" class="form-label">Password :</label>
            <div class="input-group input-group-merge">
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                <div class="input-group-text" data-password="false" style="cursor:pointer;">
                    <span class="password-eye"></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="example-select" class="form-label">Role :</label>
            <select name="role" class="form-select" id="example-select">
                <option class="text-center" value="" selected disabled>=== Select Role === </option>
                <option class="text-center" value="member">Member</option>
                <option class="text-center" value="admin">Admin</option>
            </select>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="example-fileinput" class="form-label">Foto Profile :</label>
                <input type="file" name="foto" id="example-fileinput" class="form-control">
            </div>
        </div>
    </div>
    <div class="mt-2 d-flex">
        <a href="{{ url('/user') }}" class="btn btn-danger rounded-pill mr-2">Cancel</a>
        <button type="submit" class="btn btn-success rounded-pill mx-2">Submit</button>
    </div>
</form>
@endsection