<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\RequestBarang;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getJumlahBarang(){
        $now = Carbon::today();
        $period = Carbon::now()->startOfMonth()->subMonths(11)->monthsUntil(now());
        $bm = [];
        $data = [];
        $rbs = [];
        $rbt = [];
        $sisa = [];
        $to = $now->format('Y-m-d');
        $from = $now->subYear(1)->format('Y-m-d');
        foreach ($period as $date)
        {
            $barangMasuk = BarangMasuk::whereMonth('tanggal_masuk','=',$date->month)
                ->whereBetween('tanggal_masuk',[$from,$to])
                ->get('quantity')->sum('quantity');
            $barangKeluar = RequestBarang::whereMonth('tanggal_request','=',$date->month)
                ->whereBetween('tanggal_request',[$from,$to])
                ->where('status','=','disetujui')->get('quantity')->sum('quantity');
            $data[] = $date->monthName;
            $bm[] = $barangMasuk;
            $rbs[] = $barangKeluar;
            $sisa[] = $barangMasuk - $barangKeluar;
            $rbt[] = RequestBarang::whereMonth('tanggal_request','=',$date->month)
                ->whereBetween('tanggal_request',[$from,$to])
                ->where('status','=','ditolak')->get('quantity')->sum('quantity');
        }
        return compact('bm','data','rbs','rbt','sisa');
    }
    public function index(){
        $bm = $this->getJumlahBarang();
        $kategori = Kategori::get()->count();
        $readyStock = Barang::where('stock','>',0)->get()->count();
        $emptyStock = Barang::where('stock','<=',0)->get()->count();
        $supplier = Supplier::get()->count();
        $barang = Barang::get();
        $user = User::get();
        return view('admin.dashboard',compact('barang','bm','kategori','readyStock','emptyStock','user','supplier'));
    }
}
