@extends('layouts.master')
@section('header')
<div class="d-flex justify-content-between w-100 ">
    <h3>Tambah Barang Masuk</h3>
    {{-- <a href="{{ url('/barang-masuk') }}" class="btn btn-success">Kembali</a> --}}
</div>
@endsection
@section('content-top')
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show pt-3" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ url('/barang-masuk') }}" method="post">
    <div class="bg-white mb-3 p-3 rounded-top">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-2">
                <label for="example-select" class="form-label">Pilih Supplier</label>
                <select class="form-select " name="supplier" >
                    <option selected disabled> === Pilih Supplier === </option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-2">
                <label for="example-date" class="form-label">Date</label>
                <input class="form-control" onchange="dateKode(this.value)" id="suply-date" type="date" name="tgl_masuk" required>
            </div>
            <div class="col-md-6 mb-2">
                <label for="example-date" class="form-label">Kode Suply</label>
                <input class="form-control" id="kode-suply" type="text" value="SPY-" name="kode" disabled>
            </div>
            <div class="col-md-6 mb-2 ">
                <label for="" class="form-label">Tambah Barang</label>
                <button type="button" class="btn btn-success col-12" onclick="tambahBarang()">Tambah Barang yang Masuk</button>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div id="form-content" class=" rounded-bottom">
    <div class="row my-2" id="1">
        <div class="col-md-5">
            <label for="example-select" class="form-label">Pilih Barang</label>
            <select class="form-select " name="barang[]" >
                <option selected disabled> === Pilih Barang === </option>
                @foreach ($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
            </select>
        </div>
        
        <div class=" col-md-5">
            <label class="form-label">Jumlah Barang Masuk</label>
            <input type="number" placeholder="1" name="quantity[]" min="1" class="form-control" required>
        </div>
        <div class="col-md-2 align-self-center">
            <button class="btn btn-danger" onclick="hapusBarang(1)" type="button">X Hapus</button>
        </div>
    </div>
</div>
@endsection
@section('content-bottom')
    
<div class="mb-5 d-flex">
    <a href="{{ url('/barang-masuk') }}" class="btn btn-danger rounded mr-2">Cancel</a>
    <button type="submit" class="btn btn-success rounded mx-2">Submit</button>
</div>
</form>
@endsection
@section('js')
<script>
    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;

        return [year, month, day].join('');
    }
    function dateKode(val) {
        let date = formatDate(val)
        let target = document.getElementById('kode-suply')
        target.value = `SPY-${date}`

        // console.log(word);
    }
</script>
<script>
    var no = 2
    function tambahBarang() {
        let content = document.getElementById('form-content')
        content.innerHTML += `
        <div class="row my-2" id="${no}">
            <div class="col-md-5">
                <label for="example-select" class="form-label">Pilih Barang</label>
                <select class="form-select select-option" name="barang[]" >
                    <option selected disabled> === Pilih Barang === </option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class=" col-md-5">
                <label class="form-label">Jumlah Barang Masuk</label>
                <input type="number" placeholder="1" name="quantity[]" min="1" class="form-control" required>
            </div>
            <div class="col-md-2 align-self-center">
                <button class="btn btn-danger" onclick="hapusBarang(${no})" type="button">X Hapus</button>
            </div>
        </div>
        
        `
        no += 1

    }
    function hapusBarang(id) {
        let elemen = document.getElementById(id)
        elemen.remove()
    }
</script>
<script>
    $(document).ready(function() {
        $('.select-option').select2();
    });
</script>
@endsection
