@extends('layouts.master')
@section('header')
<div class="d-flex justify-content-between w-100 ">
    <h3>Edit Suply Barang Masuk</h3>
    {{-- <a href="{{ url('/barang-masuk') }}" class="btn btn-success">Kembali</a> --}}
</div>
@endsection
@section('content-top')
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <i class="dripicons-wrong me-2"><strong>{{ $message }}</strong>
</div>
@endif
<form action="{{ url('/barang-masuk',$suply->id) }}" method="post">
    @csrf @method('PUT')
    <div class="bg-white mb-3 p-3 rounded-top">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="example-select" class="form-label">Pilih Supplier</label>
                <select class="form-select select-option" name="supplier" >
                    <option selected disabled> === Pilih Supplier === </option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->id }}" {{ $suply->supplier_id  == $s->id ? 'selected' : ''}}>{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <label for="example-date" class="form-label">Date</label>
                <input onchange="dateKode(this.value)" class="form-control" value="{{ $suply->tanggal_masuk }}" id="suply-date" type="date" name="tgl_masuk" required>
            </div>
            <div class="col-md-4 mb-2">
                @php
                    $sup = $suply->where('tanggal_masuk',date('Y-m-d'))->count();
                @endphp
                <label for="example-date" class="form-label">Kode Suply</label>
                <input class="form-control" id="kode-suply" type="text" value="{{ $suply->kode_suply }}" name="kode" disabled>
            </div>
        </div>
    </div>
@endsection
@section('content')
@php
    $no = 1;
@endphp
@foreach ($suply->barangMasuk as $i)
<div id="form-content" class=" rounded-bottom">
    <div class="row my-2" id="1">
        <div class="col-md-6">
            <label for="example-select" class="form-label">Barang {{ $no++ }}</label>
            <select class="form-select select-option" name="barang[]" >
                <option selected disabled> === Pilih Barang === </option>
                @foreach ($barang as $b)
                    <option value="{{ $b->id }}" {{ $b->id == $i->barang_id ? 'selected' : '' }}>{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        
        <div class=" col-md-6">
            <label class="form-label">Jumlah Barang Masuk</label>
            <input type="number" value="{{ $i->stock }}" placeholder="1" name="quantity[]" min="1" class="form-control" required>
        </div>
    </div>
</div>
@endforeach
@endsection
@section('content-bottom')
    
<div class="mb-5 d-flex">
    <a href="{{ url('/barang-masuk') }}" class="btn btn-danger rounded mr-2">Cancel</a>
    <button type="submit" class="btn btn-success rounded mx-2">Submit</button>
</div>
</form>
@endsection
@section('js')
@php
    use Carbon\carbon;
    // if (isset($_COOKIE)) {
    //     $date = $_COOKIE['tgl'];
    // }else{
        $date = 0;
    // }
    // dd($date);
@endphp
<script>
    function createCookie(name, value, sec) {
        var expires;
        
        if (sec) {
            var date = new Date();
            date.setTime(date.getTime() + (1 * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        
        document.cookie = escape(name) + "=" + 
            escape(value) + expires + "; path=/";
    }
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;
        var date = [year, month, day].join('-')
        createCookie("tgl", date, "10")
        var now = {{ $suply->where('tanggal_masuk','=',$date)->count() }}
        console.log(now);
        return [year, month, day].join('')+'-'+now;
    }
    function dateKode(val) {
        let date = formatDate(val)
        let target = document.getElementById('kode-suply')
        let word = target.value.split('-')
        target.value = `SPY-${date}`

        // console.log(word);
    }
</script>
@endsection