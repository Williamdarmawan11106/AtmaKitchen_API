<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\DetailPesanan;
use App\Models\Resep;
use App\Models\DetailHampers;
use App\Models\BahanBaku;
use Illuminate\Support\Facades\Log;

class PenggunaanBahanBakuController extends Controller
{
    public function laporanPenggunaanBahanBaku($tanggal_mulai, $tanggal_selesai)
    {
        $request = new Request(['tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai]);
        $validatedData = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $tanggalMulai = $validatedData['tanggal_mulai'];
        $tanggalSelesai = $validatedData['tanggal_selesai'];

        $statusPesanan = ['selesai', 'diproses', 'siap di-pickup', 'sedang dikirim kurir', 'sudah di-pickup'];
        $pemesanans = Pemesanan::whereBetween('created_at', [$tanggalMulai, $tanggalSelesai])
            ->whereIn('status_pesanan', $statusPesanan)
            ->get();

        Log::info('Pemesanans:', $pemesanans->toArray());

        $bahanBakuUsage = [];
        foreach ($pemesanans as $pemesanan) {

            $detailPemesanans = DetailPesanan::where('id_pemesanan', $pemesanan->id)->get();
            Log::info('Detail Pemesanans:', $detailPemesanans->toArray());
            
            foreach ($detailPemesanans as $detail) {
                if ($detail->id_produk) {
                    $reseps = Resep::where('id_produk', $detail->id_produk)->get();
                    Log::info('Reseps for product ' . $detail->id_produk . ':', $reseps->toArray());
                    foreach ($reseps as $resep) {
                        if (!isset($bahanBakuUsage[$resep->id_bahan_baku])) {
                            $bahanBakuUsage[$resep->id_bahan_baku] = 0;
                        }
                        $bahanBakuUsage[$resep->id_bahan_baku] += $resep->jumlah_bahan_baku * $detail->jumlah;
                    }
                }

                if ($detail->id_hampers) {
                    $detailHampers = DetailHampers::where('id_hampers', $detail->id_hampers)->get();
                    Log::info('Detail Hampers for hampers ' . $detail->id_hampers . ':', $detailHampers->toArray());

                    foreach ($detailHampers as $detailH) {
                        $reseps = Resep::where('id_produk', $detailH->id_produk)->get();
                        Log::info('Reseps for product in hampers ' . $detailH->id_produk . ':', $reseps->toArray());

                        foreach ($reseps as $resep) {
                            if (!isset($bahanBakuUsage[$resep->id_bahan_baku])) {
                                $bahanBakuUsage[$resep->id_bahan_baku] = 0;
                            }
                            $bahanBakuUsage[$resep->id_bahan_baku] += $resep->jumlah_bahan_baku * $detailH->jumlah * $detail->jumlah;
                        }
                    }
                }
            }
        }

        Log::info('Bahan Baku Usage:', $bahanBakuUsage);

        $bahanBakus = BahanBaku::whereIn('id', array_keys($bahanBakuUsage))->get();
        Log::info('Bahan Bakus:', $bahanBakus->toArray());

        return response()->json([
            "status" => true,
            "message" => 'Berhasil mengambil penggunaan bahan baku',
            "data" => [
                'bahanBakus' => $bahanBakus,
                'bahanBakuUsage' => $bahanBakuUsage,
                'tanggalMulai' => $tanggalMulai,
                'tanggalSelesai' => $tanggalSelesai,
            ]
        ]);
    }
}

