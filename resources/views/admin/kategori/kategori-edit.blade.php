@extends('layouts.master')
@section('header')
    <h3>Edit Data Kategori</h3>
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
<form action="{{ url('/kategori',$kategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="row mb-2">
            <label  class="col-2 col-form-label">Nama Kategori : </label>
            <div class="col-10">
                <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" placeholder="Nama Kategori">
            </div>
        </div>   
    </div>
    <div class="mt-2 d-flex">
        <a href="{{ url('/kategori') }}" class="btn btn-danger rounded-pill mr-2">Cancel</a>
        <button type="submit" class="btn btn-success rounded-pill mx-2">Submit</button>
    </div>
</form>
@endsection