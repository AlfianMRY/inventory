<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = Barang::join('kategori', 'barang.kategori_id', '=', 'kategori.id')
        ->get(['barang.*', 'kategori.nama as kategori']);
        return view('admin.barang.barang',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.barang.barang-input',compact('kategori'));
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
            'nama'=>'required',
            'kode'=>'required|unique:barang',
            'kategori'=>'required',
            'stock'=>'required',
            'foto'=>'image|mimes:jpeg,png,jpg,|max:2048'
        ]);
        if(!empty($request->foto)){
            $foto = $request->kode.'-'.time().'.'.$request->foto->extension();
            $request->foto->move(public_path('img/barang'), $foto);
        }else{
            $foto = 'default.jpg';
        }
        Barang::create([
            'nama'=>$request->nama,
            'kode'=>$request->kode,
            'kategori_id'=>$request->kategori,
            'stock'=>$request->stock,
            'foto'=>$foto
        ]);
        return redirect('/barang')->with('success','Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        // dd($barang->id);
        // $barang = Barang::join('kategori', 'barang.kategori_id', '=', 'kategori.id')
        // ->get(['barang.*', 'kategori.nama as kategori'])
        // ->where('barang.id',$barang->id);
        return view('admin.barang.barang-detail',compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        return view('admin.barang.barang-edit',compact('barang','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama'=>'required',
            'kode'=>'required',
            'kategori'=>'required',
            'stock'=>'required',
            'foto'=>'image|mimes:jpeg,png,jpg,|max:2048'
        ]);
        if(!empty($request->foto)){
            if ($barang->foto != 'default.jpg') {
                if(file_exists(public_path('img/barang/'.$barang->foto))){
                    unlink(public_path('img/barang/'.$barang->foto));
                }
                $foto = $request->kode.'-'.time().'.'.$request->foto->extension();
                $request->foto->move(public_path('img/barang'), $foto);
            }
            else{
                $foto = $request->kode.'-'.time().'.'.$request->foto->extension();
                $request->foto->move(public_path('/img/barang'), $foto);
            }
        }else{
            if ($barang->foto != 'default.jpg') {
                $foto = $barang->foto;
            }
            $foto = 'default.jpg';
        }
        $barang->update([
            'nama'=>$request->nama,
            'kode'=>$request->kode,
            'kategori_id'=>$request->kategori,
            'stock'=>$request->stock,
            'foto'=>$foto
        ]);
        return redirect('/barang')->with('success','Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        if ($barang->foto != "default.jpg") {
            if(file_exists(public_path('img/barang/'.$barang->foto))){
                unlink(public_path('img/barang/'.$barang->foto));
            }
        }
        $barang->delete();
        return redirect('/barang')->with('success','Data Berhasil Dihapus!');
    }

    public function listBarang(){
        $barang = Barang::latest()->get();
        return view('admin.list-barang',compact('barang'));
    }
}
