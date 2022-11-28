<?php

namespace App\Http\Livewire;

use App\Models\BarangKeluar;
use App\Models\Barang;
use App\Models\RequestSuplyBarang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class CartBarang extends Component
{
    public $barang,$barangkeluar,$keterangan;
    protected $listeners = [
        'createBarangKeluar'=>'render'
    ];
    public function render()
    {
        $data = BarangKeluar::where('user_id','=',Auth::user()->id)->where('status','=','keranjang')->get();
        // dd($data);
        return view('livewire.cart-barang',compact('data'));
    }

    public function batalCart($id)
    {
        $this->barangkeluar = BarangKeluar::find($id);
        $this->barang = Barang::find($this->barangkeluar->barang_id);
        
        DB::transaction(function () {
            $stock = $this->barang->stock + $this->barangkeluar->stock;
            $this->barang->update([
                'stock'=> $stock,
            ]);
            $this->barangkeluar->delete();

            $this->emit('batalRequestBarang');
        });
        Alert::success('Pesanan Dibatalkan!');
    }

    public function createRequestSuply($barangs,$user){
        DB::beginTransaction();
        try {
            $suply = RequestSuplyBarang::create([
                'user_id'=>$user,
                'keterangan'=>$this->keterangan,
                'tanggal_request'=> Carbon::today(),
            ]);
            foreach ($barangs as $i) {
                $id = $i['id'];
                $barang = BarangKeluar::find($id);
                $barang->update([
                    'request_suply_barang_id'=>$suply->id,
                    'status'=>'request'
                ]);
            }
            $this->keterangan='';
            DB::commit();
            Alert::success('Berhasil Membuat Request');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Gagal Membuat Request');
        }
    }
}
