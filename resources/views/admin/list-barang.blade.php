@extends('layouts.master')
@section('header')
<div class="row justify-content-between align-content-center">
    <div class="col-md-3">
        <h3>Daftar Barang {{ $search ? $search : '' }}</h3>
    </div>
    <div class="col-md-7 mt-2">
        @livewire('search-barang')
        
    </div>
    {{-- <ul class="side-nav btn btn-success mt-2 col-md-5 ms-auto">
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
    </ul> --}}
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        @livewire('list-barang')
    </div>
    <div class="col-md-4">
        @livewire('cart-barang')
    </div>
</div>
@endsection