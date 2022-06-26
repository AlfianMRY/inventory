<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangMasukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = BarangMasuk::join('barang','barang.id','=','barang_masuk.barang_id')
                            ->join('supplier','supplier.id','=','barang_masuk.supplier_id')
                            ->get(['barang.nama AS barang','supplier.nama AS supplier','barang_masuk.tanggal_masuk','barang_masuk.quantity']);
        // dd($data);
        return $data;
    }
    public function headings(): array
    {
        return [
            'Barang',
            'Supplier',
            'Tanggal Masuk',
            'Stock'
        ];
    }
}
