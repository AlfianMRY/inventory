@extends('layouts.master')
@section('header')
<form action="" method="post">
<div class="row justify-content-between align-content-center">
    <div class="col-md-3">
        <h3 class="font-bold">Daftar Barang</h3>
    </div>
    <div class="col-md-4 ">
        <div class="input-group mt-1">
            <input type="text" id="simpleinput" class="form-control " name="search" placeholder="Search">
            <button class="btn btn-info" type="submit">Search</button>
        </div>
    </div>
</div>
</form>
@endsection
@section('content')
    <div class="row ">
        @foreach ($barang as $b)
        @php
            if($b->stock >= 100){
                $bg = 'success';
                $title = 'Ready';
            }elseif ($b->stock >= 50 && $b->stock < 100) {
                $bg = 'warning';
                $title = 'Hampir Habis';
            }else {
                $bg = 'danger';
                $title = 'Habis';
            }
        @endphp
        <div class="col-md-4 col-lg-3 col-sm-6">
            <!-- Simple card -->
            <div class="card d-block ribbon-box border-info border ">
                <img class="card-img-top" src="{{ asset('/img/barang/'.$b->foto) }}" alt="Card image cap">
                <div class="card-body">
                    <div class="ribbon-two ribbon-two-{{ $bg }}"><span>{{ $title }}</span></div>
                    <h5 class="card-title text-info">{{ $b->nama }}</h5>
                    <p class="card-text">Stock : {{ $b->stock }}</p>
                    {{-- <a href="javascript: void(0);" class="btn btn-primary" disabled>Button</a> --}}
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#standard-modal{{ $b->id }}" {{ $b->stock <= 0 ? 'disabled' : '' }}>Pesan</button>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div><!-- end col -->

        <!-- Standard modal -->
        <div id="standard-modal{{ $b->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Request Barang : {{ $b->nama }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="barang_id" value="{{ $b->id }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="status" value="menunggu">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Quantity</label>
                                <input type="number" name="quantity" max="{{ $b->stock }}" id="simpleinput" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="example-textarea" class="form-label">Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="example-textarea" rows="5">Keperluan Anda</textarea>
                            </div>
                            <input type="hidden" name="tanggal_request" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @endforeach
    </div>
@endsection