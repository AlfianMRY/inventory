<?php

namespace App\Http\Controllers;

use App\Models\RequestSuplyBarang;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RequestSuplyBarang::latest()->get();
        return view('admin.requestbarang.index',compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RequestSuplyBarang::create($request->all());
        return redirect()->back()->with('success','Pemesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestSuplyBarang  $requestBarang
     * @return \Illuminate\Http\Response
     */
    public function tolak(Request $request)
    {
        $req = RequestSuplyBarang::find($request->id);
        DB::beginTransaction();
        
        try {
            $req->update([
                'status'=>'ditolak',
                'keterangan'=>$request->keterangan
            ]);
            $barangs = BarangKeluar::where('request_suply_barang_id','=',$request->id)->get();
            // dd($barangs);
            foreach ($barangs as $i) {
                $reqStock = $i->stock;
                $barang = Barang::find($i->barang_id);
                $tambahStock = $barang->stock + $reqStock;
                $barang->update(['stock'=>$tambahStock]);
            }
            DB::commit();
            return redirect('/req-barang')->with('success','Request Barang Telah Ditolak');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('/req-barang')->with('error','Request Barang Gagal Ditolak');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestSuplyBarang  $requestBarang
     * @return \Illuminate\Http\Response
     */
    public function terima(Request $request)
    {
        $req = RequestSuplyBarang::find($request->id);
        try {
            $req->update([
                'status'=>'disetujui'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Request Barang Gagal Di setujui');
        }
        return redirect('/req-barang')->with('success','Request Barang Telah Disetujui');
    }
}
