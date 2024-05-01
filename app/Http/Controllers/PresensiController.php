<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;

class PresensiController extends Controller
{
    public function index()
    {
        try{
            $presensi = Presensi::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data Presensi',
                "data" => $presensi
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
            $presensi = Presensi::find($id);

            if(!$presensi) throw new \Exception("Data Presensi tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data Presensi',
                "data" => $presensi
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
            $request->validate([
                'ID_Employee' => 'required|exists:employee,ID_Employee',
            ]);

            $presensi = Presensi::create($request->all());
            return response()->json([
                "status" => true,
                "message" => 'Berhasil menambah Presensi',
                "data" => $presensi
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
            $presensi = Presensi::find($id);

            if(!$presensi) throw new \Exception("Data Presensi tidak ditemukan");

            $presensi->update($request->all());

            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengubah data Presensi',
                "data" => $presensi
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
            $presensi = Presensi::find($id);

            if(!$presensi) throw new \Exception("Data Presensi tidak ditemukan");

            $presensi->delete();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil menghapus data Presensi',
                "data" => $presensi
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
