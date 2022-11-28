<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ListBarang extends Component
{
    protected $listeners =[
        'search',
        'searchKategori',
        'batalRequestBarang'=>'render'
    ];
    public $search,$quantity;
    public $sKategori=1;
    public $limit = 20;
    public function render()
    {
        $id = Kategori::select('id','nama')->where('nama',$this->sKategori)->first();
        $kategori = Kategori::all();
        
        if ($id != null) {
            $barang = Barang::
                where('kategori_id',$id->id)
                ->where('nama','like','%'.$this->search.'%')
                ->orderBy('updated_at','desc')->paginate($this->limit);
        }
        else{
            $barang = Barang::where('nama','like','%'.$this->search.'%')
                ->orderBy('updated_at','desc')->paginate($this->limit);
        }
        return view('livewire.list-barang',compact('kategori','barang'));
    }

    public function search($data){
        $this->search = $data;
    }
    public function searchKategori($data){
        $this->sKategori = $data;
    }

    public function loadMore(){
        $this->limit +=8;
    }

    public function createCart($user, $barang){
        DB::beginTransaction();
        try {
            BarangKeluar::create([
                'stock'=>$this->quantity,
                'barang_id'=>$barang,
                'user_id'=>$user
            ]);
            $barang = Barang::find($barang);
            $stockBarang = $barang->stock - $this->quantity;
            $barang->update([
                'stock'=>$stockBarang,
            ]);

            $this->quantity = 0;
            $this->emit('createBarangKeluar');
            DB::commit();
            Alert::success('Berhasil Menambah Pesanan');
        } catch (\Throwable $th) {
            DB::rollback();
            Alert::error('Gagal Menamba Pesanan');
        }
    }
}
