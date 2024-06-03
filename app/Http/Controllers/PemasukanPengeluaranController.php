<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\DetailPesanan;
use App\Models\BahanBaku;
use App\Models\Employee;
use App\Models\Presensi;
use App\Models\PembelianBahanBaku;
use App\Models\Pengeluaran;
use App\Models\Penitip; 
use App\Models\Produk; 
use Illuminate\Support\Facades\Log;

class PemasukanPengeluaranController extends Controller
{
    public function laporanPemasukanPengeluaran(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'bulan' => 'required|integer|min:1|max:12',
                'tahun' => 'required|integer|min:2000|max:2100',
            ]);

            $bulan = $validatedData['bulan'];
            $tahun = $validatedData['tahun'];

            $dateObj = \DateTime::createFromFormat('!m', $bulan);
            $monthName = $dateObj->format('F');

            $pemasukanTransaksi = Pemesanan::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $bulan)
                ->get();

            $totalTip = $pemasukanTransaksi->sum('tip');
            $totalPenjualan = $pemasukanTransaksi->sum('nominal_pembayaran') - $totalTip;

            $totalPemasukan = $totalTip + $totalPenjualan;

            $pengeluaranLainnya = Pengeluaran::whereYear('tanggal_pengeluaran', $tahun)
                ->whereMonth('tanggal_pengeluaran', $bulan)
                ->get();

            $totalPengeluaranLainnya = $pengeluaranLainnya->sum('biaya');

            $karyawan = Employee::all();
            $totalGaji = 0;

            foreach ($karyawan as $employee) {
                $hadir = Presensi::where('id_employee', $employee->id)
                    ->whereYear('tanggal_kehadiran', $tahun)
                    ->whereMonth('tanggal_kehadiran', $bulan)
                    ->where('status_kehadiran','=', 1)
                    ->count();

                $bolos = Presensi::where('id_employee', $employee->id)
                    ->whereYear('tanggal_kehadiran', $tahun)
                    ->whereMonth('tanggal_kehadiran', $bulan)
                    ->where('status_kehadiran', '=', 0)
                    ->count();

                $gajiBulanIni = $employee->gaji * $hadir; 

                if ($bolos <= 4) {
                    $gajiBulanIni += $employee->Bonus; 
                }

                $totalGaji += $gajiBulanIni;
            }

            $pembelianBahanBaku = PembelianBahanBaku::whereYear('tanggal_pembelian', $tahun)
                ->whereMonth('tanggal_pembelian', $bulan)
                ->sum('harga_bahan_baku');

            $grandTotalPenitip = $this->getGrandTotalPenitip($bulan, $tahun);

            $totalPengeluaran = $totalPengeluaranLainnya + $totalGaji + $pembelianBahanBaku + $grandTotalPenitip;

            return response()->json([
                'bulan' => $monthName,
                'tahun' => $tahun,
                'pemasukan' => [
                    'totalTip' => $totalTip,
                    'totalPenjualan' => $totalPenjualan,
                    'totalPemasukan' => $totalPemasukan,
                ],
                'pengeluaran' => [
                    'pengeluaranLainnya' => $pengeluaranLainnya,
                    'totalPengeluaranLainnya' => $totalPengeluaranLainnya,
                    'totalGaji' => $totalGaji,
                    'pembelianBahanBaku' => $pembelianBahanBaku,
                    'grandTotalPenitip' => $grandTotalPenitip,
                    'totalPengeluaran' => $totalPengeluaran,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getGrandTotalPenitip($bulan, $tahun)
    {
        try {
            $penitips = Penitip::all();
            $grandTotal = 0;

            foreach ($penitips as $penitip) {
                $produks = Produk::where('id_penitip', $penitip->id)->pluck('id');
                $details = DetailPesanan::whereIn('id_produk', $produks)
                    ->whereMonth('detail_pemesanans.created_at', $bulan) 
                    ->whereYear('detail_pemesanans.created_at', $tahun) 
                    ->join('pemesanans', 'detail_pemesanans.id_pemesanan', '=', 'pemesanans.id')
                    ->where('pemesanans.status_pesanan', 'selesai')
                    ->select('detail_pemesanans.*')
                    ->get();

                foreach ($details as $detail) {
                    $total = ($detail->jumlah * $detail->produk->harga) - (($detail->jumlah * $detail->produk->harga) * 20 / 100);
                    $grandTotal += $total;
                }
            }

            return $grandTotal;
        } catch (\Exception $e) {
            throw new \Exception("Error Processing Request: " . $e->getMessage(), 1);
        }
    }
}
