@extends('layouts.master')
@section('css')
    <!-- Datatables css -->
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
@endsection
{{-- @section('header')
    <h3 class="font-bold">Profile</h3>
@endsection --}}
@section('content-top')
<div class="card bg-primary">
    <div class="card-body profile-user-box">
        <div class="row">
            <div class="col-sm-8">
                <div class="row align-items-center">
                    <div class="col-md-4 ">
                        <div class="avatar-lg mx-auto">
                            @php
                                if (!empty($user->foto)) {
                                    $foto = $user->foto;
                                }else {
                                    $foto = 'default.png';
                                }
                                if ($user->status == 'active') {
                                    $stat = 'success';
                                }else{
                                    $stat = 'danger';
                                }
                            @endphp
                            <img src="{{ asset('/img/profile/'.$foto) }}" alt="" class="rounded-circle img-thumbnail">
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <h4 class="mt-1 mb-1 text-white">{{ $user->name }}</h4>
                            <p class="font-13 text-white-50"> {{ $user->email }}</p>

                            <ul class="mb-0 list-inline text-light">
                                <li class="list-inline-item me-3">
                                    <h5 class="mb-1"><i class="mdi mdi-circle text-{{ $stat }}"> </i> {{ ucwords($user->status) }}</h5>
                                    <p class="mb-0 font-13 text-white-50">Status Akun</p>
                                </li>
                                <li class="list-inline-item">
                                    <h5 class="mb-1">{{ $user->request()->count() }}x</h5>
                                    <p class="mb-0 font-13 text-white-50">Melakukan Pemesanan</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-sm-4">
                <div class="text-center mt-sm-0 mt-3 text-sm-end">
                    <a href="{{ url('/profile/'.$user->id.'/edit') }}" class="btn btn-light">
                        <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                    </a>
                </div>
            </div> <!-- end col-->
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <i class="dripicons-checkmark me-2"></i><strong>{{ $message }}</strong>
    </div>
@endif
@endsection
@section('content')
    <h3>Riwayat Request Barang</h3>
    <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>No</th>
                <th>Barang</th>
                <th>Quantity</th>
                <th>Tanggal Request</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($user->request as $d)
            @php
                if ($d->status == 'menunggu') $stat = 'warning'; 
                if ($d->status == 'ditolak') $stat = 'danger'; 
                if ($d->status == 'disetujui') $stat = 'success'; 
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->barang->nama }}</td>
                <td>{{ $d->quantity }}</td>
                <td>{{ $d->tanggal_request }}</td>
                <td><span class="badge bg-{{ $stat }} ">{{ucwords($d->status)}}</span></td>
                <td>{{ $d->keterangan }}</td>
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