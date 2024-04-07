<?php

namespace App\Http\Controllers\Users;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Profile extends Controller
{
    public function get_user_profile($number)
    {
        try {
            if (Auth::check() && Auth::user()->number === $number) {

                $user = User::where('number', $number)->first();

                if ($user->number === Auth::user()->number) {
                    return view('users.v_user_profile', compact('user'));
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkPassword(Request $request)
    {
        $user = Auth::user(); // ดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบ
        $oldPassword = $request->old_password;
        $newPassword = $request->new_password;
        $confirmPassword = $request->confirm_password;

        // ตรวจสอบว่ารหัสผ่านเก่าถูกต้องหรือไม่
        if (!Hash::check($oldPassword, $user->password)) {
            return response()->json(['success' => false, 'error' => 'รหัสผ่านเก่าไม่ถูกต้อง'], 400);
        }

        // ตรวจสอบรหัสผ่านใหม่และยืนยันรหัสผ่าน
        if ($newPassword !== $confirmPassword) {
            return response()->json(['success' => false, 'error' => 'รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน'], 400);
        }

        // อัปเดตรหัสผ่านใหม่ของผู้ใช้
        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json(['success' => true]);
    }

}
