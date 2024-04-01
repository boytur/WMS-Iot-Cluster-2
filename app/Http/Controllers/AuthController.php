<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login_index()
    {
        return view('auth.v_login');
    }

    public function login_process(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            $user = User::where('email', $request->only('email'))->first();

            if (!$user) {
                return back()->withErrors(['login' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง!']);
            }

            $warehouseUsers = WarehouseUser::where('user_id', $user->id)->get();

            if ($warehouseUsers->isEmpty()) {
                return back()->withErrors(['login' => 'คุณไม่มีสิทธิ์ในการเข้าถึงคลังสินค้า!']);
            }

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $warehouse = Auth::user()->warehouses()->get();

                Session::put('user_warehouse', $warehouse[0]->wh_id);
                Session::put('user_warehouse_name', $warehouse[0]->wh_name);

                return redirect('/dashboard/view-all');
            }

            throw ValidationException::withMessages([
                'login' => ['อีเมลหรือรหัสผ่านไม่ถูกต้อง!'],
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['login' => 'เกิดข้อผิดพลาดที่เซิร์ฟเวอร์']);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
