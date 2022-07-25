@extends('layouts.master')
@section('header')
<div class="row justify-content-between align-content-center">
    <div class="col-md-3">
        <h3>Daftar Barang {{ $search ? $search : '' }}</h3>
    </div>
    <div class="col-md-5">
        <form action="{{ url('/list-barang') }}" method="post">
            @csrf
            <div class="input-group mt-1">
                @csrf
                <input type="text" class="form-control" name="search" placeholder="Search">
                <button class="btn btn-info" type="submit">Search <i class="uil uil-search-alt"></i></button>
            </div>
        </form>
    </div>
    <ul class="side-nav btn btn-success mt-2 col-md-5 ms-auto">
        <a data-bs-toggle="collapse" href="#kategori" aria-expanded="false" aria-controls="kategori" class="text-white">
            <li class="side-nav-item">Kategori</li>
        </a>
        <div class="collapse" id="kategori">
            <ul class="side-nav-second-level row">
                <li class="side-nav-item ps-lg-3 col-6">
                    <a href="{{ url('/list-barang/semua') }}" class="side-nav-link">
                        <span>Semua Kategori</span>
                    </a>
                </li>
                @foreach ($kategori as $i)
                    <li class="side-nav-item ps-lg-3 col-6">
                        <a href="{{ url('/list-barang',$i->nama) }}" class="side-nav-link">
                            <span>{{ $i->nama }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </ul>
</div>
@endsection
@section('content')
    <div class="row ">
        @if (empty($barang))
            <h1 class="text-center">Barang Belum Tersedia</h1>
        @else
            @foreach ($barang as $b)
            @php
                if($b->stock >= 100){
                    $bg = 'success';
                    $title = 'Ready';
                }elseif ($b->stock >= 1 && $b->stock < 100) {
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
                        <p class="card-text">
                            Stock : {{ $b->stock }}
                            <br>
                            Kategori : 
                            <a href="{{ url('/list-barang',$b->kategori->nama) }}" class="card-text">
                                <span>{{ $b->kategori->nama }}</span>
                            </a>
                        </p>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#standard-modal{{ $b->id }}" {{ $b->stock <= 0 ? 'disabled' : '' }}>Pesan</button>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div><!-- end col -->

            <!-- Standard modal -->
            <div id="standard-modal{{ $b->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content">
                        <form action="{{ url('/tambah-req') }}" method="post">
                            @csrf
                            <div class="modal-header">
                                <h4 class="modal-title" id="standard-modalLabel">Pesan : {{ $b->nama }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <img class="card-img-top" src="{{ asset('/img/barang/'.$b->foto) }}" alt="Card image cap">
                            <div class="modal-body">
                                <input type="hidden" name="barang_id" value="{{ $b->id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="status" value="menunggu">
                                <div class="mb-3">
                                    <label for="simpleinput" class="form-label">Quantity</label>
                                    <input type="number" name="quantity" max="{{ $b->stock }}" id="simpleinput" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" id="example-textarea" rows="3" placeholder="Keperluan Anda"></textarea>
                                </div>
                                <input type="hidden" name="tanggal_request" value="{{ date('Y-m-d') }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            @endforeach
        @endif
    </div>
@endsection