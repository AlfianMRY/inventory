<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Exports\RequestExport;
// use Illuminate\Http\Request;
use App\Exports\BarangMasukExport;
use Maatwebsite\Excel\Facades\Excel;

class GetExcelController extends Controller
{
    public function barangMasuk(){
        $namaFile = date('Y-m-d-His').'-barang-masuk.xlsx';
        return Excel::download(new BarangMasukExport,$namaFile);
    }

    public function barang(){
        $namaFile = date('Y-m-d-His').'-list-barang.xlsx';
        return Excel::download(new BarangExport,$namaFile);
    }
    
    public function requestBarang($key){
        $namaFile = date('Y-m-d-His').'-request-barang-'.$key.'.xlsx';
        return Excel::download(new RequestExport($key),$namaFile);
    }
}
