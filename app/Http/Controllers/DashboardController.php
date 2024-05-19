<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPesanan;
use App\Models\Produk;
use Exception;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $produkPopuler = DetailPesanan::select('id_produk', DB::raw('SUM(jumlah) as total'))
                ->whereNotNull('id_produk')
                ->groupBy('id_produk')
                ->orderBy('total', 'desc')
                ->with('produk')
                ->get();

            $hampersPopuler = DetailPesanan::select('id_hampers', DB::raw('SUM(jumlah) as total'))
                ->whereNotNull('id_hampers')
                ->groupBy('id_hampers')
                ->orderBy('total', 'desc')
                ->with('hampers')
                ->get();

            $populer = [];

            foreach ($produkPopuler as $item) {
                $populer[] = [
                    'nama' => $item->produk->nama_produk,
                    'harga' => $item->produk->harga,
                    'gambar' => url('img/' . $item->produk->gambar_produk),
                    'jumlah' => $item->total,
                    'tipe' => 'Produk'
                ];
            }

            foreach ($hampersPopuler as $item) {
                $populer[] = [
                    'nama' => $item->hampers->nama_hampers,
                    'harga' => $item->hampers->harga_hampers,
                    'gambar' => url('img/' . $item->hampers->gambar_hampers),
                    'jumlah' => $item->total,
                    'tipe' => 'Hampers'
                ];
            }

            usort($populer, function ($a, $b) {
                return $b['jumlah'] - $a['jumlah'];
            });

            $countPopuler = count($populer);
            if ($countPopuler < 4) {
                $needed = 4 - $countPopuler;
                $defaultProducts = Produk::orderBy('id')->take($needed)->get();

                foreach ($defaultProducts as $product) {
                    $populer[] = [
                        'nama' => $product->nama_produk,
                        'harga' => $product->harga,
                        'gambar' => url('img/' . $product->gambar_produk),
                        'jumlah' => 0,
                        'tipe' => 'Produk'
                    ];
                }
            }

            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengambil data populer',
                "data" => $populer
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
                "data" => []
            ], 500);
        }
    }
}
