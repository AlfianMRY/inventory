<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Barang::join('kategori','kategori.id','=','barang.kategori_id')
                            ->get([
                                'barang.nama as Nama',
                                'barang.kode as Kode',
                                'barang.stock as Stok',
                                'kategori.nama as Kategori'
                            ]);
        // dd($data);
        return $data;
    }
    public function headings(): array
    {
        return [
            'Nama Barang',
            'Kode Barang',
            'Stok Barang',
            'Kategori Barang'
        ];
    }
}
