<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Employee;
use Carbon\Carbon;


class PresensiController extends Controller
{

    public function generatePresensi()
    {
        try {
            $employees = Employee::all();
            $date = Carbon::now()->toDateString();

            foreach ($employees as $employee) {
                $existingPresensi = Presensi::where('id_employee', $employee->id)
                    ->where('tanggal_kehadiran', $date)
                    ->first();

                if (!$existingPresensi) {
                    Presensi::create([
                        'id_employee' => $employee->id,
                        'tanggal_kehadiran' => $date,
                        'status_kehadiran' => 1 
                    ]);
                }
            }

            return response()->json([
                "status" => true,
                "message" => 'Presensi records generated successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => $e->getMessage(),
            ], 400);
        }
    }


    public function showAllPresensi()
    {
        try{
            $presensi = Presensi::join('employees', 'presensi.id_employee', '=', 'employees.id')
            ->select('presensi.id','employees.nama_employee', 'presensi.tanggal_kehadiran', 'presensi.status_kehadiran')
            ->get();

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

    public function searchPresensiByNamaEmployee($namaKaryawan)
    {
        try{
            $presensi = Presensi::join('employees', 'presensi.id_employee', '=', 'employees.id')
            ->where('employees.nama_employee', '=', $namaKaryawan)
            ->select('presensi.id','employees.nama_employee', 'presensi.tanggal_kehadiran', 'presensi.status_kehadiran')
            ->get();

            if(!$presensi) throw new \Exception("Data Presensi Karyawan tidak ditemukan");

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

    public function updatePresensi(Request $request, $id)
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
}
