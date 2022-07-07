<!DOCTYPE html>
<html>
<head>
<style>
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #00e5ff;
    color: black;
    }
</style>
</head>
<body>
<center>
    <h1>Data Barang</h1>
    <h5>{{ $date }}</h5>
</center>
    
<table id="customers">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kode</th>
            <th>Kategori</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $d)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->kode }}</td>
                <td>{{ $d->kategori->nama }}</td>
                <td>{{ $d->stock }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>


