<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BarangMasukExport;
use Maatwebsite\Excel\Facades\Excel;

class GetExcelController extends Controller
{
    public function barangMasuk(){
        $namaFile = date('Y-m-d-His').'-barang-masuk.xlsx';
        return Excel::download(new BarangMasukExport,$namaFile);
    }
}
