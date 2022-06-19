@extends('layouts.master')
@section('header')
    <h3>Edit Data User {{ $user->name }}</h3>
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
<form action="{{ url('/user',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="example-select" class="form-label">Role :</label>
            <select name="role" class="form-select" id="example-select">
                <option class="text-center" value="" disabled>=== Select Role === </option>
                <option {{ $user->role == 'member' ? 'selected' : '' }} class="text-center" value="member">Member</option>
                <option {{ $user->role == 'admin' ? 'selected' : '' }} class="text-center" value="admin">Admin</option>
            </select>
        </div>  
        <div class="col-md-6 mb-3">
            <label for="example-select" class="form-label">Status :</label>
            <select name="status" class="form-select" id="example-select">
                <option class="text-center" value="" disabled>=== Select Role === </option>
                <option {{ $user->status == 'active' ? 'selected' : '' }} class="text-center" value="active">Active</option>
                <option {{ $user->status == 'non active' ? 'selected' : '' }} class="text-center" value="non active">Non Active</option>
            </select>
        </div>   
    </div>
    <div class="mt-2 d-flex">
        <a href="{{ url('/user') }}" class="btn btn-danger rounded-pill mr-2">Cancel</a>
        <button type="submit" class="btn btn-success rounded-pill mx-2">Submit</button>
    </div>
</form>
@endsection