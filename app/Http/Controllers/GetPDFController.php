<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\RequestBarang;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Kategori;
use PDF;

class GetPDFController extends Controller
{
    public function barangMasuk(Request $request)
    {
        $data = BarangMasuk::latest()->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pdf.barang-masuk',compact('data','date'));
        return $pdf->download('barang-masuk-'.$date.'.pdf');
    }
    
    public function barang(Request $request)
    {
        $data = Barang::latest()->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pdf.barang',compact('data','date'));
        return $pdf->download('barang-'.$date.'.pdf');
    }

    public function user(Request $request)
    {
        $data = User::latest()->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pdf.barang',compact('data','date'));
        return $pdf->download('user-'.$date.'.pdf');
    }

    public function supplier(Request $request)
    {
        $data = Supplier::latest()->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pdf.supplier',compact('data','date'));
        return $pdf->download('supplier-'.$date.'.pdf');
    }

    public function kategori(Request $request)
    {
        $data = Kategori::latest()->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pdf.kategori',compact('data','date'));
        return $pdf->download('kategori-'.$date.'.pdf');
    }

    public function requestBarang(Request $request,$status)
    {
        $data = RequestBarang::where('status',$status)->latest()->get();
        $date = date('d-m-Y');
        $pdf = PDF::loadView('pdf.request',compact('data','date','status'));
        return $pdf->download('request-barang-'.$status.'-'.$date.'.pdf');
    }
}
