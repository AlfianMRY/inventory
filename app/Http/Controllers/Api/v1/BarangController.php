<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Facade\FlareClient\Http\Response;


class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::all();
        return response()->json([
            'success'=>true,
            'messege'=>'Data Barang',
            'data'=>$data,
        ],200);
    }

    public function show($id)
    {
        $data = Barang::find($id);
        if ($data) {
            return response()->json([
                'success'=>true,
                'messege'=>'Detail Barang',
                'data'=>$data
            ],201);
        }else{
            return response()->json([
                'success'=>false,
                'messege'=>'Barang Tidak Ditemukan'
            ],404);
        }
    }
}
