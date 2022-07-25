<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Facade\FlareClient\Http\Response;


class BarangController extends Controller
{
    
    /**
     * @OA\Get(
     * path="/api/barang",
     * summary="Get Barang ",
     * description="Get Barang ",
     * operationId="GetBarang",
     * security={ {"bearer": {} }},
     * tags={"Barang"},
     *  
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     * )
     */
    public function index()
    {
        $data = Barang::all();
        return response()->json([
            'success'=>true,
            'messege'=>'Data Barang',
            'data'=>$data,
        ],200);
    }

    /**
     * @OA\Get(
     * path="/api/barang/{id}",
     * summary="Get Barang Details",
     * description="Get Barang Details",
     * operationId="GetBarangDetails",
     * security={ {"bearer": {} }},
     * tags={"Barang"},
     *  
     *  @OA\Parameter(
     *    description="ID of Barang",
     *    in="path",
     *    name="id",
     *    required=true,
     *    example="1",
     *    @OA\Schema(
     *       type="integer",
     *       format="int64"
     *    )
     * ),@OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     * )
     */
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
