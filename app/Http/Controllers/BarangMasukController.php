<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = BarangMasuk::latest()->get();
        return view('admin.barangmasuk.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = Barang::all('id','nama');
        $supplier = Supplier::all('id','nama');
        // dd($barang,$supplier);
        return view('admin.barangmasuk.input',compact('barang','supplier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'barang' => 'required',
            'supplier' => 'required',
            'tgl_masuk' => 'required|date',
            'quantity' => 'required|min:1'
        ]);
        $supplier = $request->supplier;
        $tgl = date('Y-m-d',strtotime($request->tgl_masuk));
        $data = [];
        $no = 0;
        // dd($data,$request->all());
        foreach ($request->barang as $i) {
            $data[] = [
                'barang_id' => $i,
                'supplier_id' => $supplier,
                'tanggal_masuk' => $tgl,
                'quantity' => $request->quantity[$no],
            ];

            $barang = Barang::find($i);
            $stock = $barang->stock + $request->quantity[$no];
            $barang->update(['stock' => $stock]);
            $no++;
        }
        
        BarangMasuk::insert($data);

        return redirect()->route('barang-masuk.index')->with('success','Berhasil Menambah Data Barang');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        
        $barang = Barang::all('id','nama');
        $supplier = Supplier::all('id','nama');
        $data = $barangMasuk;
        // dd($data);
        return view('admin.barangmasuk.edit',compact('data','barang','supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'barang' => 'required',
            'supplier' => 'required',
            'tgl_masuk' => 'required|date',
            'quantity' => 'required'
        ]);
        if ($request->barang != $barangMasuk->barang_id) {
            $old = Barang::find($barangMasuk->barang_id);
            $stockold = $old->stock - $barangMasuk->quantity;
            $old->update(['stock'=>$stockold]);
            $new = Barang::find($request->barang);
            $stocknew = $new->stock + $request->quantity; 
            $new->update(['stock'=>$stocknew]);
        }else {
            $old = Barang::find($barangMasuk->barang_id);
            if ($request->quantity < $barangMasuk->quantity) {
                $quantity = $barangMasuk->quantity - $request->quantity;
                $newstock = $old->stock - $quantity;
            }else {
                $quantity = $request->quantity - $barangMasuk->quantity;
                $newstock = $old->stock + $quantity;
            }
            $old->update(['stock' => $newstock]);
        }
        $tgl = date('Y-m-d',strtotime($request->tgl_masuk));
        $barangMasuk->update([
            'barang_id'=>$request->barang,
            'supplier_id'=>$request->supplier,
            'tanggal_masuk'=>$tgl,
            'quantity'=>$request->quantity
        ]);
        return redirect('/barang-masuk')->with('success','Data Berhasil diUpdate!');
    }
}
