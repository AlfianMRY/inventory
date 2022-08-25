<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function landingPage()
    {
        $barang = Barang::orderBy('updated_at','asc')->limit(4)->get();
        return view('landingpage.index',compact('barang'));
    }

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
                
            }else{
                $foto = 'default.jpg';
            }
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
        $kategori = Kategori::all();
        $barang = Barang::orderBy('updated_at','asc')->get();
        $search = '';
        return view('admin.list-barang',compact('barang','search','kategori'));
    }

    /**
     * Menerima request dan mencari list barang
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search1 = '%'.$request->search.'%';
        $barang = Barang::where('nama','LIKE',$search1)->get();
        $search = ': '.ucwords($request->search);
        $kategori = Kategori::all();
        return view('admin.list-barang',compact('barang','search','kategori'));
    }

    public function kategori($keys)
    {
        if ($keys == 'semua') {
            $barang = Barang::orderBy('updated_at','asc')->get();
        }else {
            $key = Kategori::select('id')->where('nama',$keys)->first();
            $barang = Barang::orderBy('updated_at','asc')->where('kategori_id',$key->id)->get();
        }
        $kategori = Kategori::all();
        $search = '';
        return view('admin.list-barang',compact('barang','search','kategori'));
    }
}
