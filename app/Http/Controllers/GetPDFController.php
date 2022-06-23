<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use PDF;

class GetPDFController extends Controller
{
    public function barangMasuk(Request $request){
        $data = BarangMasuk::all();
        $date = date('d-m-Y');
        
        $pdf = PDF::loadView('pdf.barang-masuk',compact('data','date'));
        return $pdf->download('barang-masuk-'.$date.'.pdf');
    }
}
