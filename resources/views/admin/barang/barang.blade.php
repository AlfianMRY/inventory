@extends('layouts.master')
@section('css')
    <!-- Datatables css -->
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('header')
    <div class="d-flex justify-content-between w-100 ">
        <h4>Data Barang</h4>
        <a href="{{ url('/barang/create') }}" class="btn btn-success"> <i class="uil-file-plus-alt"></i> Tambah </a>
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
        <a href="{{ url('pdf-barang') }}" class="btn btn-danger mb-3">PDF</a>
        <a href="{{ url('excel-barang') }}" class="btn btn-success mb-3">Excel</a>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Kode</th>
                <th>Kategori</th>
                <th class="text-center">Stock</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $d)
                <tr>
                    <th width="5%" class="text-center">{{ $no++ }}</th>
                    <td width="10%">{{ $d->nama }}</td>
                    <td>{{ $d->kode }}</td>
                    <td>{{ $d->kategori }}</td>
                    <td class="text-center">{{ $d->stock }}</td>
                    <td class="text-center">
                        <form action="{{ url('/barang',$d->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group ">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail-barang-{{ $d->id }}"><i class="uil-eye"></i></button>
                                <a href="{{ url('/barang/'.$d->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="uil-edit"></i></a>
                                <button type="submit" class="btn btn-danger btn-sm show_confirm"><i class=" uil-trash-alt"></i></button>
                            </div>
                        </form>
                    </td>
                </tr>

                {{-- Modal Detail Barang --}}
                <!-- Large modal -->
                <div class="modal fade" id="detail-barang-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>{{ $d->nama }}</strong></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-md-6 overflow-hidden align-items-center">
                                    <img class="w-100" src="{{ asset('img/barang/'.$d->foto) }}" alt="Card image cap">
                                </div>
                                <div class="col-md-6">
                                    <h3>Kode Barang : <strong>{{ $d->kode }}</strong></h3>
                                    <h3>kategori Barang : <strong>{{ $d->kategori }}</strong></h3>
                                    <h3>Stok Barang : <strong>{{ $d->stock }}</strong></h3>
                                </div>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
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