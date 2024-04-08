<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserManagementIndex extends Controller
{
    public function user_management_index()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
                $whs = Warehouse::all();
                $users = User::paginate(20);
                return view('users.v_user_management', compact('users','whs'));
            } else {
                return redirect('/product/inbounds');
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function search_user(Request $request)
    {
        try {
            $user_search = $request->input('user_search');
            $attribute = $request->input('user_attribute');
            $user_type = $request->input('user_type');

            $query = User::query();

            // If user search is provided, apply appropriate search criteria
            if (!empty($user_search)) {
                if ($attribute === 'number') {
                    $query->where('number', 'like', "%$user_search%");
                } elseif ($attribute === 'name') {
                    $query->where(function ($query) use ($user_search) {
                        $query->where('fname', 'like', "%$user_search%")
                            ->orWhere('lname', 'like', "%$user_search%");
                    });
                }
            }

            // If user type filter is provided, filter by user role
            if ($user_type === "all") {
            } else {
                $query->where('role', $user_type);
            }
            $users = $query->paginate(10);

            return response($users, 200);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function user_management_detail($number)
    {
        try {
            $user = User::where('number', $number)->first();

            return view('users.v_user_management_detail', compact('user'));
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function edit_user_password(Request $request)
    {
        try {
            if ($request->new_password == null || $request->old_password === null) {
                return response()->json(['success' => false, 'data' => 'กรุณาเช็ครหัสผ่านอีกครั้ง']);
            }
            $hashed_password = User::find(Auth::user()->id)->password;

            $new_password = $request->new_password;

            if (Hash::check($request->old_password, $hashed_password)) {

                $user = User::find(Auth::user()->id);

                $user->update([
                    'password' => Hash::make($new_password)
                ]);

                return response()->json(['success' => true, 'data' => 'เปลี่ยนรหัสผ่านสำเร็จ']);
            } else {
                return response()->json(['success' => false, 'data' => 'รหัสผ่านเดิมไม่ถูกต้อง']);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function user_edit_index($number)
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager"){
                $user = User::where('number', $number)->first();
                return view('users.v_user_edit_detail', compact('user'));
            } else {
            return redirect('/');
            }
        }catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function create_user()
    {
        return view('users.v_user_management');
    }
    public function store_user(Request $request)
    {
        $file = $request->file('file');
        $validatedData = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'date' => 'required|date',
            'role' => 'required',
            'wh_id' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
        dd($validatedData);
        return redirect()->back();

    }
}

