<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Mail\ResetPassword;

class PasswordResetController extends Controller
{
    public function show($id)
    {
        $customers = Customer::find($id);

        return view('ResetPassword.ResetPasswordView', [
            'customer' => $customers,
            'message' => []
        ]);
    }

    public function indexBerhasil() {
        return view('ResetPassword.ResetBerhasil');
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $customer = Customer::find($id);

            if(!$customer) throw new \Exception("Data Customer tidak ditemukan");

            $password = $request->input('password');
            $passwordTemp = $request->input('passwordTemp');

            if($password !== $passwordTemp) {
                throw new \Exception("Password Tidak Sama!");
            }

            $customer->Password = $password;
            $customer->save();

            return redirect()->route('updateBerhasil');

        } catch (\Exception $e) {
            return view('ResetPassword.ResetPasswordView', [
                'customer' => $customer,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function sendResetLink($nama)
    {
        $str = Str::random(100);
        $customers = Customer::where("Nama_Customer", $nama)->first();

        $details = [
            'username' => $customers->Nama_Customer,
            'website' => 'Atma Kitchen',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => '127.0.0.1:8000' . '/api/resetPassword/' . $customers->ID_Customer . '/' . $str
        ];

        Mail::to($customers->Email)->send(new ResetPassword($details));

        return response()->json([
            'message' => 'Email Reset Password Telah Dikirimkan'
        ], 200);
    }
}