<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;

class StatusPesananCustomerController extends Controller
{
    public function getAllStatuses($id)
    {
        try {
            $data = Pemesanan::join('detail_pemesanans', 'detail_pemesanans.id_pemesanan', '=', 'pemesanans.id')
                     ->join('produks', 'produks.id', '=', 'detail_pemesanans.id_produk')
                     ->where('pemesanans.id_customer', '=', $id)
                     ->where('pemesanans.status_pesanan', '=', 'sudah dikirim')
                     ->select('pemesanans.id', 'produks.nama_produk', 'detail_pemesanans.jumlah', 'detail_pemesanans.harga', 'pemesanans.status_pesanan')
                     ->get();
 
            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil data status pesanan customer',
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

    public function completeOrder($id)
    {
        $pemesanan = Pemesanan::find($id);
        if ($pemesanan) {
            if ($pemesanan->status_pesanan === 'sudah dikirim') {
                $pemesanan->status_pesanan = 'selesai';
                $pemesanan->save();

                return response()->json(['message' => 'Status pesanan diubah menjadi selesai', 'status_pesanan' => $pemesanan->status_pesanan], 200);
            } else {
                return response()->json(['message' => 'Hanya pesanan dengan status "sudah dikirim" yang dapat diperbarui menjadi selesai'], 403);
            }
        } else {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }
    }
}
