<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return response()->json([
            'success'=>true,
            'messege'=>'Data Kategori',
            'data'=>$data,
        ],200);
    }

    public function show($id)
    {
        $data = Kategori::find($id);
        if ($data) {
            return response()->json([
                'success'=>true,
                'messege'=>'Detail Kategori',
                'data'=>$data,
            ],201);
        }else{
            return response()->json([
                'success'=>false,
                'messege'=>'Data Yang dicari Tidak Ada',
            ],404);
        }
    }

    public function create(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nama'=>'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success'=>false,
                'messege'=>$validate->errors()
            ],401);
        }else{
            try {
                $data = Kategori::create([
                    'nama'=>$request->input('nama')
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'success'=>false,
                    'messege'=>$th->getMessage(),
                ],401);
            }
            return response()->json([
                'success'=>true,
                'messege'=>'Data Berhasil Ditambah!',
                'data'=>$data
            ],201);
        }
    }

    public function update(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'nama'=>'required'
        ]);
        if ($validate->fails()) {
            return response()->json([
                'success'=>false,
                'messege'=>$validate->errors()
            ],402);
        }else {
            try {
                $data = Kategori::find($id);
            } catch (\Throwable $th) {
                return response()->json([
                    'success'=>false,
                    'messege'=>$th->getMessage()
                ],402);
            }
            $data->update([
                'nama'=>$request->input('nama')
            ]);
            return response()->json([
                'success'=>true,
                'messege'=>'Data Berhasil di Update!',
                'data'=>$data
            ],202);
        }
    }

    public function destroy($id)
    {
        $data = Kategori::find($id);
        if ($data) {
            $data->delete();
            return response()->json([
                'success'=>true,
                'messege'=>'Data Berhasil Dihapus!'
            ],200);
        }else{
            return response()->json([
                'success'=>false,
                'messege'=>'Data Tidak Ada'
            ],404);
        }
    }
}
