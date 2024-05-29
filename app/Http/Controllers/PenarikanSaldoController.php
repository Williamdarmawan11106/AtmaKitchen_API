<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenarikanSaldo;

class PenarikanSaldoController extends Controller
{
    public function searchHistoryPenarikanByDate($id, $tanggal)
    {
        try {
            $data = PenarikanSaldo::join('users', 'users.id' , '=', 'penarikan_saldo.id_customer')
                     ->where('penarikan_saldo.id_customer', '=', $id)
                     ->whereDate('penarikan_saldo.tanggal_penarikan', '=', $tanggal)
                     ->select('penarikan_saldo.id','penarikan_saldo.nominal_penarikan', 'penarikan_saldo.bank', 'penarikan_saldo.no_rekening', 'penarikan_saldo.status', 'penarikan_saldo.tanggal_penarikan', 'users.saldo')
                     ->get();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil history by date',
                "data" => $data
            ], 200);
           
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }

    public function getAllPenarikan($id)
    {
        try {
            $data = PenarikanSaldo::join('users', 'users.id' , '=', 'penarikan_saldo.id_customer')
                     ->where('penarikan_saldo.id_customer', '=', $id)
                     ->select('penarikan_saldo.id','penarikan_saldo.nominal_penarikan', 'penarikan_saldo.bank', 'penarikan_saldo.no_rekening', 'penarikan_saldo.status', 'penarikan_saldo.tanggal_penarikan', 'users.saldo')
                     ->get();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil data history penarikan',
                "data" => $data
            ], 200);
           
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nominal_penarikan' => 'required|numeric',
                'bank' => 'required|string',
                'no_rekening' => 'required|string',
                'id_customer' => 'required|exists:users,id'
            ]);

            $penarikanSaldo = PenarikanSaldo::create([
                'nominal_penarikan' => $request->input('nominal_penarikan'),
                'bank' => $request->input('bank'),
                'no_rekening' => $request->input('no_rekening'),
                'status' => 0, 
                'tanggal_penarikan' => now(),
                'id_customer' => $request->input('id_customer')
            ]);

            return response()->json([
                "status" => true,
                "message" => 'Berhasil membuat penarikan saldo',
                "data" => $penarikanSaldo
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 400);
        }
    }
}
