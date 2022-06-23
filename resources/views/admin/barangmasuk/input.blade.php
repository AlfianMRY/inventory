@extends('layouts.master')
@section('header')
<div class="d-flex justify-content-between w-100 ">
    <h3>Tambah Barang Masuk</h3>
    {{-- <a href="{{ url('/barang-masuk') }}" class="btn btn-success">Kembali</a> --}}
</div>
@endsection
@section('content-top')
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show pt-2" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
@section('content')
<form action="{{ url('/barang-masuk') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="example-select" class="form-label">Pilih Barang</label>
            <select class="form-select select-option" name="barang" >
                <option selected disabled> === Pilih Barang === </option>
                @foreach ($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="example-select" class="form-label">Pilih Supplier</label>
            <select class="form-select select-option" name="supplier" >
                <option selected disabled> === Pilih Supplier === </option>
                @foreach ($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="example-date" class="form-label">Date</label>
            <input class="form-control" id="example-date" type="date" name="tgl_masuk">
        </div>
        <div class=" col-md-6 mb-3">
            <label class="form-label">Jumlah Barang Masuk</label>
            <input data-toggle="touchspin" type="text" value="1" name="quantity" min="1" data-bts-button-down-class="btn btn-danger" data-bts-button-up-class="btn btn-success">
        </div>
    </div>
    <div class="mt-2 d-flex">
        <a href="{{ url('/barang-masuk') }}" class="btn btn-danger rounded-pill mr-2">Cancel</a>
        <button type="submit" class="btn btn-success rounded-pill mx-2">Submit</button>
    </div>
</form>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $('.select-option').select2();
});
</script>
@endsection