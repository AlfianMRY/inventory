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
            <div class="col-md-5">
                <label for="example-select" class="form-label">Pilih Supplier</label>
                <select class="form-select select-option" name="supplier" >
                    <option selected disabled> === Pilih Supplier === </option>
                    @foreach ($supplier as $s)
                        <option value="{{ $s->id }}">{{ $s->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="example-date" class="form-label">Date</label>
                <input class="form-control" id="example-date" type="date" name="tgl_masuk" required>
            </div>
            <div class="col-md-2 align-self-center justify-content-center">
                <button type="button" class="btn btn-success" onclick="tambahBarang()">+Tambah</button>
            </div>
        </div>
    </div>
@endsection
@section('content')
<div id="form-content" class=" rounded-bottom">
    <div class="row my-2" id="1">
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
    var no = 2
    function tambahBarang() {
        let content = document.getElementById('form-content')
        
        // content.append(isi)
        let row = document.createElement('div')
        row.classList.add('row','my-2')
        row.setAttribute('id', no)
        // membuat col
        let col1 = document.createElement('div')
        col1.classList.add('col-md-5')
        // membuat label
        let label1 = document.createElement('label')
        label1.classList.add('form-label')
        label1.textContent = 'Pilih Barang'
        // membuat select barang
        let select = document.createElement('select')
        select.classList.add('form-select','select-option')
        select.setAttribute('name','barang[]')
        // select.select2()

        let value = []
        let text = []
        @foreach ($barang as $b)
            value.push({{ $b->id }})
            text.push('{{ $b->nama }}')
        @endforeach
        let opt = document.createElement('option');
        opt.setAttribute('selected','');
        opt.setAttribute('disabled','');
        opt.innerHTML = ' === Pilih Barang === ';
        select.appendChild(opt);
        for (let i = 0; i < value.length; i++) {
            let opt = document.createElement('option');
            opt.value = value[i];
            opt.innerHTML = text[i];
            select.appendChild(opt);
        }

        //membuat col2
        let col2 = document.createElement('div')
        col2.classList.add('col-md-5')
        // membuat label2
        let label2 = document.createElement('label')
        label2.classList.add('form-label')
        label2.textContent = 'Jumlah Barang Masuk'
        // membuat input number
        let number = document.createElement('input')
        number.classList.add('form-control')
        number.setAttribute('type','number')
        number.setAttribute('placeholder','1')
        number.setAttribute('name','quantity[]')
        number.setAttribute('min','1')
        number.setAttribute('required','')

        // membuat col3
        let col3 = document.createElement('div')
        col3.classList.add('col-md-2','align-self-center')
        // membuat button
        let btn = document.createElement('button')
        btn.setAttribute('type','button')
        btn.setAttribute('onclick',`hapusBarang(${no})`)
        btn.classList.add('btn','btn-danger')
        btn.innerHTML = 'X Hapus'
        
        // append
        content.append(row)
        row.append(col1)
        row.append(col2)
        row.append(col3)
        col1.append(label1)
        col2.append(label2)
        col1.append(select)
        col2.append(number)
        col3.append(btn)

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