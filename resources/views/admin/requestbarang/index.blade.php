@extends('layouts.master')
@section('css')
    <!-- Datatables css -->
    <link href="assets/css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
@endsection
@section('header')
<div class="d-flex justify-content-between w-100 ">
    <h4>Request Barang</h4>
    {{-- <a href="{{ url('/req-barang/create') }}" class="btn btn-success"> <i class="uil-file-plus-alt"></i> Tambah Barang Masuk</a> --}}
</div>
@endsection
@section('content-top')

<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
    <li class="nav-item">
        <a href="#menunggu" data-bs-toggle="tab" aria-expanded="true" onclick="menunggu()" class="nav-link rounded-0 active">
            <i class="mdi mdi-account-circle d-md-none d-block"></i>
            <span class="d-none d-md-block">Menunggu</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#disetujui" data-bs-toggle="tab" aria-expanded="false" onclick="setuju()" class="nav-link rounded-0">
            <i class="mdi mdi-home-variant d-md-none d-block"></i>
            <span class="d-none d-md-block">Disetujui</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#ditolak" data-bs-toggle="tab" aria-expanded="false" onclick="tolak()" class="nav-link rounded-0">
            <i class="mdi mdi-settings-outline d-md-none d-block"></i>
            <span class="d-none d-md-block">Ditolak</span>
        </a>
    </li>
</ul>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show " role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <i class="dripicons-checkmark me-2"></i><strong>{{ $message }}</strong>
</div>
@elseif ($message = Session::get('error'))
<div class="alert alert-success alert-dismissible bg-danger text-white border-0 fade show " role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <i class="dripicons-wrong me-2"></i><strong>{{ $message }}</strong>
</div>
@endif
@endsection
@section('content')
<div class="d-flex">
    <div class="btn-group">
        <a href="{{ url('/pdf-req-barang') }}" class="btn btn-sm btn-danger mb-2">PDF</a>
        <a href="{{ url('/excel-req-barang') }}" class="btn btn-sm btn-success mb-2">Excel</a>
    </div>
</div>


<div class="tab-content">
    <div class="tab-pane show active" id="menunggu">
        <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>User</th>
                    <th>Quantity</th>
                    <th>Tanggal Request</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->where('status','menunggu') as $d)
                <tr>
                    <td>{{ $d->barang->nama }}</td>
                    <td>{{ $d->user->name }}</td>
                    <td>{{ $d->quantity }}</td>
                    <td>{{ $d->tanggal_request }}</td>
                    <td><span class="badge bg-warning">{{ucwords($d->status)}}</span></td>
                    <th class="text-center">
                        <form action="{{ url('/terima-req') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $d->id }}">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success btn-sm"><i class="dripicons-checkmark"></i> Terima</button>
                            <button  type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#fill-danger-modal-{{ $d->id }}"> <i class="dripicons-cross"></i> Tolak</button>
                        </div>
                    </form>
                    </th>
                </tr>

                <div id="fill-danger-modal-{{ $d->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fill-danger-modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content modal-filled bg-danger">
                            <div class="modal-header">
                                <h4 class="modal-title" id="fill-danger-modalLabel">Tolak Pesanan {{ $d->barang->nama }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <form action="{{ url('/tolak-req') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="example-textarea" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" class="form-control bg-transparent text-white border-2 border-white" id="example-textarea" rows="5" placeholder="Kenapa di Tolak?" required ></textarea>
                                        <input type="hidden" name="id" value="{{ $d->id }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-outline-light">Simpan</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane " id="disetujui">
        <table id="basic-datatable" class="basic-datatable table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>User</th>
                    <th>Quantity</th>
                    <th>Tanggal Request</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->where('status','disetujui') as $d)
                <tr>
                    <td>{{ $d->barang->nama }}</td>
                    <td>{{ $d->user->name }}</td>
                    <td>{{ $d->quantity }}</td>
                    <td>{{ $d->tanggal_request }}</td>
                    <td><span class="badge bg-success">{{ucwords($d->status)}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane" id="ditolak">
        <table id="basic-datatable" class="basic-datatable table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>User</th>
                    <th>Quantity</th>
                    <th>Tanggal Request</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->where('status','ditolak') as $d)
                <tr>
                    <td>{{ $d->barang->nama }}</td>
                    <td>{{ $d->user->name }}</td>
                    <td>{{ $d->quantity }}</td>
                    <td>{{ $d->tanggal_request }}</td>
                    <td><span class="badge bg-danger">{{ucwords($d->status)}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
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