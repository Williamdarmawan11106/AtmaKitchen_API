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
            $data = DetailPesanan::join('produk', 'produk.ID_Produk', '=', 'detail_pesanan.ID_Produk')
                     ->join('pemesanan', 'pemesanan.ID_Pemesanan', '=', 'detail_pesanan.ID_Pemesanan')
                     ->where('pemesanan.ID_Customer', '=', $id)
                     ->where('produk.Nama_Produk', '=', $nama)
                     ->select('produk.Nama_Produk', 'detail_pesanan.Jumlah', 'detail_pesanan.Harga', 'pemesanan.Tanggal_Pesanan')
                     ->get();

 
            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil data produk',
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
            $data = Pemesanan::join('detail_pesanan', 'detail_pesanan.ID_Pemesanan', '=', 'pemesanan.ID_Pemesanan')
                     ->join('produk', 'produk.ID_Produk', '=', 'detail_pesanan.ID_Produk')
                     ->where('pemesanan.ID_Customer', '=', $id)
                     ->select('produk.Nama_Produk', 'detail_pesanan.Jumlah', 'detail_pesanan.Harga', 'pemesanan.Tanggal_Pesanan')
                     ->get();

 
            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil data produk',
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
