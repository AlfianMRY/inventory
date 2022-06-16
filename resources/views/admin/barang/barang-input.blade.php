@extends('layouts.master')
@section('header')
    <h3>Tambah Data Barang</h3>
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
<form action="{{ url('/barang') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama Barang :</label>
                <input type="text" name="nama" id="simpleinput" class="form-control">
            </div>
        </div> 
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Kode Barang :</label>
                <input type="text" name="kode" id="simpleinput" class="form-control">
            </div>
        </div> 
        <div class="col-md-6">
            <div class="mb-3">
                <label for="example-select" class="form-label">Pilih Kategori :</label>
                <select name="kategori" class="form-select" id="example-select">
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Stock Barang :</label>
                <input type="number" name="stock" id="simpleinput" class="form-control">
            </div>
        </div> 
        <div class="col-md-6">
            <div class="mb-3">
                <label for="example-fileinput" class="form-label">Foto Barang :</label>
                <input type="file" name="foto" id="example-fileinput" class="form-control">
            </div>
        </div>
    </div>

    <div class="mt-2 d-flex">
        <a href="{{ url('/barang') }}" class="btn btn-danger rounded-pill mr-2">Cancel</a>
        <button type="submit" class="btn btn-success rounded-pill mx-2">Submit</button>
    </div>
</form>
@endsection