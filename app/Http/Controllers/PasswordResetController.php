<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\User;
use App\Mail\ResetPassword;

class PasswordResetController extends Controller
{
    public function show($id)
    {
        $customers = User::find($id);

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
            $messages = [
                'new_password.required' => 'Password baru wajib diisi',
                'current_password.required' => 'Password lama wajib diisi',
                'new_password.confirmed' => 'Konfirmasi password tidak sesuai',
                'new_password_confirmation.required' => 'Konfirmasi password wajib diisi',
            ];

            $customer = User::find($id);

            if(!$customer) throw new \Exception("Data Customer tidak ditemukan");

            if ($request->input('current_password') == null || $request->input('new_password') == null || $request->input('new_password_confirmation') == null) {
                throw new \Exception("Semua Kolom Wajib Diisi!");
            } else {
                if (!Hash::check($request->input('current_password'), $customer->password)) {
                    throw new \Exception("Password Lama Tidak Sesuai!");
                } else if ($request->input('new_password') != $request->input('new_password_confirmation')) {
                    throw new \Exception("Konfirmasi Password Tidak Sesuai");
                }
            }

            $customer->password = bcrypt($request->input('new_password'));
            $customer->save();

            // return redirect()->route('updateBerhasil');
            return redirect()->route('updateBerhasil')->with('success', 'Password berhasil diubah!');

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
        $customers = User::where("username", $nama)->first();

        $details = [
            'username' => $customers->username,
            'website' => 'Atma Kitchen',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => '127.0.0.1:8000' . '/api/resetPassword/' . $customers->id . '/' . $str
        ];

        Mail::to($customers->email)->send(new ResetPassword($details));

        return response()->json([
            'message' => 'Email Reset Password Telah Dikirimkan'
        ], 200);
    }
}