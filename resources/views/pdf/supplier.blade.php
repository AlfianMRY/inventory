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
    <h1>Data Supplier</h1>
    <h5>{{ $date }}</h5>
</center>
    
<table id="customers">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Supplier</th>
            <th>No Hp</th>
            <th>Keterangan</th>
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
                <td>{{ $d->no_hp }}</td>
                <td>{{ $d->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>


