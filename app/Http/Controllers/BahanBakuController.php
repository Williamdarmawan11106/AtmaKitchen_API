<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use Carbon\Carbon;


class BahanBakuController extends Controller
{
    public function index()
    {
        try{
            $bahanbaku = BahanBaku::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data bahan baku',
                "data" => $bahanbaku
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }
}
