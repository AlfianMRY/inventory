@extends('layouts.master')
@section('header')
    <h3 class="font-bold">Profile</h3>
@endsection
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
                                    <h5 class="mb-1">5482</h5>
                                    <p class="mb-0 font-13 text-white-50">Number of Orders</p>
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