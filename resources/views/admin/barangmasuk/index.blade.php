@extends('layouts.master')
@section('css')
    <!-- Datatables css -->
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('header')
<div class="d-flex justify-content-between w-100 ">
    <h4>Barang Masuk</h4>
    <a href="{{ url('/barang-masuk/create') }}" class="btn btn-success"> <i class="uil-file-plus-alt"></i> Tambah Barang Masuk</a>
</div>
@endsection
@section('content-top')
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <i class="dripicons-checkmark me-2"></i><strong>{{ $message }}</strong>
</div>
@endif
@endsection
@section('content')
@php
    $no = 1;
@endphp
<div class="d-flex">
    <div class="btn-group">
        <a href="{{ url('/pdf-barang-masuk') }}" class="btn btn-sm btn-danger mb-2">PDF</a>
        <a href="{{ url('/excel-barang-masuk') }}" class="btn btn-sm btn-success mb-2">Excel</a>
    </div>
</div>
<table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Suply</th>
            <th>Tanggal Masuk</th>
            <th>Supplier</th>
            <th>Barang</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $d->kode_suply }}</td>
            <td>{{ $d->tanggal_masuk }}</td>
            <td>{{ $d->supplier->nama }}</td>
            <td>
                @foreach ($d->barangMasuk as $i)
                    <ul>
                        <li>
                            {{ $i->barang->nama }}
                        </li>
                    </ul>
                @endforeach
            </td>
            </td>
            <td>
                @foreach ($d->barangMasuk as $i)
                    <ul>
                        <li>
                            {{ $i->stock }} 
                        </li>
                    </ul>
                @endforeach
            <th>
                <a href="{{ url('/barang-masuk/'.$d->id.'/edit') }}" class="btn btn-warning btn-sm"> Edit</a>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('js')
<!-- Datatables js -->
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

<!-- Datatable Init js -->
<script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script>

@endsection