<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\DetailPesanan;
use App\Models\Produk;


class DetailPesananController extends Controller
{
    public function searchByNamaProduk($id, $nama)
    {
        try {
            $data = DetailPesanan::join('produks', 'produks.id', '=', 'detail_pemesanans.id_produk')
                     ->join('pemesanans', 'pemesanans.id', '=', 'detail_pemesanans.id_pemesanan')
                     ->where('pemesanans.id_customer', '=', $id)
                     ->where('produks.nama_produk', '=', $nama)
                     ->select('pemesanans.id','produks.nama_produk', 'detail_pemesanans.jumlah', 'detail_pemesanans.harga', 'pemesanans.tanggal_diambil')
                     ->get();

 
            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil history by data produk',
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

    public function gethistory($id)
    {
        try {
            $data = Pemesanan::join('detail_pemesanans', 'detail_pemesanans.id_pemesanan', '=', 'pemesanans.id')
                     ->join('produks', 'produks.id', '=', 'detail_pemesanans.id_produk')
                     ->where('pemesanans.id_customer', '=', $id)
                     ->select('pemesanans.id', 'produks.nama_produk', 'detail_pemesanans.jumlah', 'detail_pemesanans.harga', 'pemesanans.tanggal_diambil')
                     ->get();

 
            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil data history produk',
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
}
