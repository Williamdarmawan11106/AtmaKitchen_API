<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPesanan;
use App\Models\Produk;
use App\Models\Hampers;
use Carbon\Carbon;
use Exception;

class ProdukDashboardController extends Controller
{
    public function index()
    {
        try {
            $hampers = Hampers::with('detailHampers.produk')->get();
            $produk = Produk::all();
            $now = Carbon::now()->toDateString();

            foreach ($produk as $produks) {
                $dataTgl = Carbon::parse($produks->updated_at)->toDateString();
                if ($dataTgl < $now) {
                    $produks->kuota = 15;
                    $produks->updated_at = $now;
                    $produks->save();
                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diambil',
                'data' => [
                    'produk' => $produk,
                    'hampers' => $hampers,
                ]
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
}
