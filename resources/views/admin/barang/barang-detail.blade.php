@extends('layouts.master')
@section('header')
    <h3>Detail Barang</h3>
@endsection
@section('content')
    <!-- Simple card -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card d-block">
                <img class="card-img-top" src="{{ asset('img/barang/'.$barang->foto) }}" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">Nama Barang : <strong>{{ $barang->nama }}</strong></h2>
                    <h3>Kode Barang : <strong>{{ $barang->kode }}</strong></h3>
                    <h3>kategori Barang : <strong>{{ $barang->kategori->nama }}</strong></h3>
                    <a href="{{ url('/barang') }}" class="btn btn-primary">Kembali</a>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>
@endsection