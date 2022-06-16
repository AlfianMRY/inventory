@extends('layouts.master')
@section('header')
    <h3>Tambah Data Supplier</h3>
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
<form action="{{ url('/supplier') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama Supplier :</label>
                <input type="text" name="nama" id="simpleinput" class="form-control">
            </div>
        </div>   
        <div class="col-md-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">No HP :</label>
                <input type="number" name="no_hp" id="simpleinput" class="form-control">
            </div>
        </div>   
        <div class="mb-3">
            <label for="example-textarea" class="form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="example-textarea" rows="5"></textarea>
        </div>
    </div>
    <div class="mt-2 d-flex">
        <a href="{{ url('/supplier') }}" class="btn btn-danger rounded-pill mr-2">Cancel</a>
        <button type="submit" class="btn btn-success rounded-pill mx-2">Submit</button>
    </div>
</form>
@endsection