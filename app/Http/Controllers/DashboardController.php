<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index(){
        $kategori = Kategori::get()->count();
        $readyStock = Barang::where('stock','>',0)->get()->count();
        $emptyStock = Barang::where('stock','<=',0)->get()->count();
        $supplier = Supplier::get()->count();
        $user = User::get()->count();
        // dd($kategori,$readyStock,$emptyStock,$supplier);
        return view('admin.dashboard',compact('kategori','readyStock','emptyStock','user','supplier'));
    }
}
