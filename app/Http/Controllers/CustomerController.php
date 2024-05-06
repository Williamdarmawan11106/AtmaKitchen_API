<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        try{
            $customer = Customer::all();
            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data customer',
                "data" => $customer
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

    public function show($id)
    {
        try{
            $customer = User::where('id', '=', $id)->select('id', 'username', 'email', 'password', 'tanggal_lahir', 'promo_poin', 'saldo', 'image', 'role', 'active')->first();

            if(!$customer) throw new \Exception("Data Customer tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data customer',
                "data" => $customer
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

    public function store(Request $request)
    {
        try{
            $customer = Customer::create($request->all());
            return response()->json([
                "status" => true,
                "message" => 'Berhasil menambah customer',
                "data" => $customer
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

    public function update(Request $request, $id)
    {
        try{
            $customer = Customer::find($id);

            if(!$customer) throw new \Exception("Data Customer tidak ditemukan");

            $customer->update($request->all());

            return response()->json([
                "status" => true,
                "message" => 'Berhasil mengubah data customer',
                "data" => $customer
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

    public function destroy($id)
    {
        try{
            $customer = Customer::find($id);

            if(!$customer) throw new \Exception("Data Customer tidak ditemukan");

            $customer->delete();

            return response()->json([
                "status" => true,
                "message" => 'Berhasil menghapus data customer',
                "data" => $customer
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

    public function searchByEmail($email)
    {
        try{
            $customer = User::where('email', '=', $email)->select('id', 'username', 'email', 'password', 'tanggal_lahir', 'promo_poin', 'saldo', 'image', 'role', 'active')->first();

            if(!$customer) throw new \Exception("Data Customer tidak ditemukan");

            return response()->json([
                "status" => true,
                "message" => 'Berhasil ambil data customer',
                "data" => $customer
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
