<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Customer;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'Nama' => 'required',
            'Password' => 'required',
        ]);

        $customer = Customer::where('Nama_Customer', $request->Nama)->first();
        $employee = Employee::where('Nama_Employee', $request->Nama)->first();

        if ($customer && $request->Password == $customer->Password) {
            return response()->json([
                'message' => 'Selamat Datang Customer',
                'data' => $customer
            ], 200);
        } else if ($employee && $employee->ID_Jabatan == 'POS-002') {
            return response()->json([
                'message' => 'Selamat Datang MO',
                'data' => $employee
            ], 200);
        } else {
            return response(['message' => 'Invalid login credentials'], 401);
        }
    }

    public function loginCustomer(Request $request)
    {

        $request->validate([
            'Nama_Customer' => 'required',
            'Password' => 'required',
        ]);

        $customer = Customer::where('Nama_Customer', $request->Nama_Customer)->first();

        if ($customer && $request->Password == $customer->Password) {
            return response()->json([
                'message' => 'Selamat Datang Customer',
                'data' => $customer
            ], 200);
        } else {
            return response(['message' => 'Invalid login credentials'], 401);
        }
    }

    public function loginEmployee(Request $request)
    {

        $request->validate([
            'Nama_Employee' => 'required',
            'Password' => 'required',
        ]);

        $employee = Employee::where('Nama_Employee', $request->Nama_Employee)->first();

        if ($employee && $employee->ID_Jabatan == 'POS-002') {
            return response()->json([
                'message' => 'Selamat Datang MO',
                'data' => $employee
            ], 200);
        } else {
            return response(['message' => 'Invalid login credentials'], 401);
        }
    }
}
