@extends('layouts.master')
@section('css')
   <!-- Datatables css -->
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('header')
    <div class="d-flex justify-content-between w-100 ">
        <h4>Data Kategori</h4>
        <a href="{{ url('/kategori/create') }}" class="btn btn-success"> <i class="uil-file-plus-alt"></i> Tambah </a>
    </div>
@endsection
@section('content')
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="dripicons-checkmark me-2"></i><strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="dripicons-wrong me-2"></i><strong>{{ $message }}</strong>
    </div>
@endif
@php
    $no = 1;
@endphp
    <table id="basic-datatable" class="table dt-responsive nowrap w-100 table-striped">
        <a href="{{ url('pdf-kategori') }}" class="btn btn-danger mb-3">PDF</a>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $d)
                <tr>
                    <th width="10%">{{ $no++ }}</th>
                    <td>{{ $d->nama }}</td>
                    <td class="text-center" width="30%">
                        <form action="{{ url('/kategori',$d->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('/kategori/'.$d->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="uil-file-edit-alt"></i> Edit</a>
                            <button type="submit"  class="show_confirm btn btn-danger btn-sm"><i class=" uil-file-minus-alt"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection
@section('js')
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>

<!-- Datatable Init js -->
<script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script>
@endsection