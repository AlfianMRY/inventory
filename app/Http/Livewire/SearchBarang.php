<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kategori;

class SearchBarang extends Component
{
    public $search,$searchKategori;

    public function render()
    {
        $this->kategori = Kategori::all();
        $this->emit('search',$this->search);
        return view('livewire.search-barang');
        
    }
    public function kategori($data)
    {
        $this->searchKategori = $data;
        $this->emit('searchKategori',$data);
    }
    
}
