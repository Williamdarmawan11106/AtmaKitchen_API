<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;


class PemesananController extends Controller
{
    public function index()
    {
        try{
            $pemesanan = Pemesanan::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data pemesanan',
                "data" => $pemesanan
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

    public function show($id)
    {
        try{
            $pemesanan = Pemesanan::find($id);

            if(!$pemesanan) throw new \Exception("Data Pemesanan tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data pemesanan',
                "data" => $pemesanan
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

    public function store(Request $request)
    {
        try{
            $pemesanan = Pemesanan::create($request->all());
            return response()->json([
                "status" => true,
                "message" => 'Berhasil menambah pemesanan',
                "data" => $pemesanan
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

    public function update(Request $request, $id)
    {
        try{
            $pemesanan = Pemesanan::find($id);

            if(!$pemesanan) throw new \Exception("Data pemesanan tidak ditemukan");

            $pemesanan->update($request->all());

            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengubah data pemesanan',
                "data" => $pemesanan
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

    public function destroy($id)
    {
        try{
            $pemesanan = Pemesanan::find($id);

            if(!$pemesanan) throw new \Exception("Data pemesanan tidak ditemukan");

            $pemesanan->delete();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil menghapus data pemesanan',
                "data" => $pemesanan
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
