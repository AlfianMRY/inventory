<?php

namespace App\Http\Controllers;

use App\Models\RequestBarang;
use App\Models\Barang;
use Illuminate\Http\Request;

class RequestBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RequestBarang::latest()->get();
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
        RequestBarang::create($request->all());
        return redirect()->back()->with('success','Pemesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestBarang  $requestBarang
     * @return \Illuminate\Http\Response
     */
    public function tolak(Request $request)
    {
        $req = RequestBarang::find($request->id);
        $req->update([
            'status'=>'ditolak',
            'keterangan'=>$request->keterangan
        ]);
        return redirect('/req-barang')->with('success','Request Barang Telah Ditolak');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestBarang  $requestBarang
     * @return \Illuminate\Http\Response
     */
    public function terima(Request $request)
    {
        $req = RequestBarang::find($request->id);
        $barang = Barang::find($req->barang_id);
        if ($req->quantity <= $barang->stock) {
            $total = $barang->stock - $req->quantity;
            $barang->update(['stock'=>$total]);
            $req->update(['status'=>'disetujui']);
        }else {
            return redirect()->back()->with('error','Jumlah Stock Kurang!');
        }
        return redirect('/req-barang')->with('success','Request Barang Telah Disetujui');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestBarang  $requestBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestBarang $requestBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestBarang  $requestBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestBarang $requestBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestBarang  $requestBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestBarang $requestBarang)
    {
        //
    }
}
