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
    <h1>Data Request {{ ucwords($status) }}</h1>
    <h5>{{ $date }}</h5>
</center>
    
<table id="customers">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>User</th>
            <th>Quantity</th>
            <th>Tanggal Request</th>
            <th>Tanggal Status</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($data as $d)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $d->barang->nama }}</td>
                <td>{{ $d->user->name }}</td>
                <td>{{ $d->quantity }}</td>
                <td>{{ $d->tanggal_request }}</td>
                <td>{{ucwords($d->status)}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>


