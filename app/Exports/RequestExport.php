<?php

namespace App\Exports;

use App\Models\RequestBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RequestExport implements FromCollection, WithHeadings
{
    public function __construct(string $keyword)
    {
        $this->key = $keyword;
    }

    public function collection()
    {
        return RequestBarang::join('barang','barang.id','=','request_barang.barang_id')
                    ->join('users','users.id','=','request_barang.user_id')
                    ->where('request_barang.status',$this->key)
                    ->get([
                        'barang.nama as barang',
                        'users.name as user',
                        'request_barang.quantity',
                        'request_barang.tanggal_request',
                        'request_barang.status as status',
                        'request_barang.keterangan',

                    ]);
    }

    public function headings(): array
    {
        return [
            'Barang',
            'User',
            'Quantity',
            'tgl_request',
            'Status',
            'Keterangan',
        ];
    }
}
