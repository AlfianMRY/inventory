<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Models\Suply;
use App\Models\Barang;
use App\Models\SuplyBarang;
use Carbon\Carbon;
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
        $data = suply::latest()->get();
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
        $suply = Suply::all();
        $day =Carbon::now();
        $today =  date_format($day,'m/d/Y');
        // dd($today);
        return view('admin.barangmasuk.input',compact('barang','supplier','suply','today'));
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
            'supplier' => 'required',
            'tgl_masuk' => 'required|date',
            'barang' => 'required',
            'quantity' => 'required|min:1'
        ]);
        // dd($request->tgl_masuk);
        $tgl = $request->tgl_masuk;
        $sup = Suply::where('tanggal_masuk',$tgl);
        $kode = 'SPY-'. $tgl.'-'.$sup->count()+1;
        $data = [];
        $no = 0;

        $idSuply = Suply::insertGetId([
            'kode_suply'=> $kode,
            'tanggal_masuk'=> $tgl,
            'supplier_id'=>$request->supplier
        ]);

        foreach ($request->barang as $b) {
            $data[] = BarangMasuk::insertGetId([
                'stock'=>$request->quantity[$no],
                'barang_id'=>$b,
                'created_at'=> Carbon::now()
            ]);

            $barang = Barang::find($b);
            $barang->update([
                'stock' => $request->quantity[$no]+$barang->stock
            ]);
            $no++;
        }
        foreach ($data as $d) {
            SuplyBarang::create([
                'barang_masuk_id'=>$d,
                'suply_id'=>$idSuply
            ]);
        }

        return redirect()->route('barang-masuk.index')->with('success','Berhasil Menambah Data Barang');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::all('id','nama');
        $supplier = Supplier::all('id','nama');
        $data = BarangMasuk::all();
        $suply = Suply::find($id);
        return view('admin.barangmasuk.edit',compact('data','barang','supplier','suply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier' => 'required',
            'tgl_masuk' => 'required|date',
            'barang' => 'required',
            'quantity' => 'required|min:1'
        ]);
        $tgl = date('Y-m-d',strtotime($request->tgl_masuk));
        $suply = Suply::find($id);
        $no = 0;
        
        // dd($suply->barangMasuk);
        foreach ($suply->barangMasuk as $i) {
            $barang = Barang::find($request->barang[$no]);
            if ($request->barang[$no] == $i->barang_id) {
                if ($request->quantity[$no] > $i->stock ) {
                    $selisih = $request->quantity[$no] - $i->stock;
                    $totalStock = $barang->stock + $selisih;
                }elseif ($request->quantity[$no] < $i->stock) {
                    $selisih = $i->stock - $request->quantity[$no];
                    $totalStock = $barang->stock - $selisih;
                }else {
                    $totalStock = $i->stock;
                }
                $barang->update(['stock' => $totalStock]);
                $i->update(['stock'=>$request->quantity[$no]]);
            }else {
                try {
                    $totalStock = $i->barang->stock - $i->stock;
                    $i->barang->update(['stock'=>$totalStock]);
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error',$th->getMessage());
                }
                $totalStock = $barang->stock + $request->quantity[$no];
                $barang->update(['stock'=>$totalStock]);
                $i->update([
                    'barang_id'=>$request->barang[$no],
                    'stock'=>$request->quantity[$no]
                ]);
            }
            $no += 1;
        }
        $sup = Suply::where('tanggal_masuk',$tgl);
        $kode = 'SPY-'. $tgl.'-'.$sup->count()+1;
        Suply::find($id)->update([
            'tanggal_masuk'=>$request->tgl_masuk,
            'supplier_id' =>$request->supplier,
            'kode_suply'=>$kode
        ]);
        return redirect('/barang-masuk')->with('success','Data Berhasil diUpdate!');
    }
}
