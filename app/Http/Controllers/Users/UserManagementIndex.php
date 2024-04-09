<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseUser;
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
                return view('users.v_user_management', compact('users', 'whs'));
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
        if (Auth::check() && Auth::user()->role === "warehouse_manager") {
            $user = User::where('number', $number)->first();

            if ($user === null) {
                return abort(404);
            } else {
                $whs = Warehouse::all();
                return view('users.v_user_edit_detail', compact('user', 'whs'));
            }
        } else {
            return redirect('/');
        }
    }

    public function edit_user_info(Request $req, $id)
    {
        $user = User::find($id);

        if ($user) {
            $fname = $req->input('fname');
            $lname = $req->input('lname');
            $role = $req->input('role');
            $wh_id = $req->input('wh_id');
            $email = $req->input('email');
            $phone = $req->input('phone');
            //dd($fname .' '. $lname .' '. $email .' '. $phone );



            if ($user->id === null) {
                return response()->json([
                    'success' => false,
                    'data' => 'User not found.'
                ], 404);
            }

            if (!empty($fname) && $user->fname!== $fname) {
                $user->update([
                    'fname' => $fname
                ]);
            }
            if (!empty($lname) && $user->lname!== $lname) {
                $user->update([
                    'lname' => $lname
                ]);
            }
            if (!empty($role) && $user->role!== $role) {
                $user->update([
                    'role'=> $role
                    ]);
                }
            if (!empty($email) && $user->email!== $email) {
                $user->update([
                    'email' => $email
                ]);
            }
            if (!empty($phone) && $user->phone!== $phone) {
                $user->update([
                    'phone'=> $phone
                ]);
            }





            if (!empty($wh_id) && $wh_id !== $user->warehouses[0]->wh_id && $user->role !== "warehouse_manager") {
                $wh_id = $user->warehouses[0]->wh_id;
                $user_wh = WarehouseUser::where('wh_id', $wh_id)->first();

                if ($user_wh) {
                    // Delete existing warehouse user record
                    WarehouseUser::where('user_id', $user->id)->delete();
                }

                // Create new warehouse user record
                WarehouseUser::create([
                    "wh_id" => $wh_id,
                    "user_id" => $user->id
                ]);
            } else{
                $wh_id = $user->warehouses[0]->wh_id;
                $user_wh = WarehouseUser::where('wh_id', $wh_id)->first();

                if ($user_wh) {
                    // Delete existing warehouse user record
                    WarehouseUser::where('user_id', $user->id)->delete();
                }
                $warehouses = Warehouse::all();

                // สร้าง WarehouseUser record สำหรับแต่ละ warehouse
                foreach ($warehouses as $warehouse) {
                    WarehouseUser::create([
                        "wh_id" => $warehouse->wh_id,
                        "user_id" => $user->id
                    ]);
                }
            }


            // if ($req->has('fname')) {
            //     $user->fname = $req->input('new_fname');
            // }
            // if ($req->has('lname')) {
            //     $user->lname = $req->input('new_lname');
            // }
            // if ($req->has('email')) {
            //     $user->email = $req->input('new_email');
            // }
            // if ($req->has('phone')) {
            //     $user->phone = $req->input('new_phone');
            // }



            if ($user->wasChanged()) {
                return response()->json(['success' => true, 'data' => 'อัปเดตชื่อสำเร็จ'], 200);
            }
            return response()->json(['success' => true, 'data' => 'ไม่มีการเปลี่ยนแปลง'], 200);
        } else {
            return response()->json(['success' => false, 'data' => 'User not found'], 404);
        }
    }

    //สร้างข้อมูล
    public function create_new_user(Request $request)
    {
        // รับข้อมูลจาก Request
        $fname = $request->fname;
        $lname = $request->lname;
        $email = $request->email;
        $role = $request->role;
        $phone = $request->phone;
        $wh_id = $request->wh_id;

        $last_user = User::OrderBy('number', 'desc')->take(1)->first();
        $last_number = User::max('number');
        $new_number = $last_number + 1;


        // ตรวจสอบการอัพโหลดไฟล์
        // $path = $request->file('dropzone-file');
        // if ($path !== null) {
        //     $imageName = $path->getClientOriginalName();
        //     $path->move('assets/img', $imageName);
        // } else {
        //     $imageName = 'default_image.jpg';
        // }

        if ($request->hasFile('image')) {
            // บันทึกไฟล์ภาพลงในโฟลเดอร์ที่ต้องการ
            $image = $request->file('image');
            dd($image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
        } else {
            $imageName = 'default_image.jpg';
        }



        // สร้างผู้ใช้ใหม่
        $newUser = User::create([
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'role' => $role,
            'phone' => $phone,
            'wh_id' => $wh_id,
            'password' => $email, // ตั้งค่ารหัสผ่านเริ่มต้น
            'image' => $imageName,
            'number' => $new_number,
        ]);

        //dd($role);
        $whs = Warehouse::all();
        if ($role == 'warehouse_manager') {
            foreach ($whs as $wh) {
                $new_warehouse_user = WarehouseUser::create([
                    'wh_id' => $wh->wh_id,
                    'user_id' => $newUser->id,
                ]);
            }
        } else {
            $new_warehouse_user = WarehouseUser::create([
                'wh_id' => $wh_id,
                'user_id' => $newUser->id,
            ]);
        }

        if ($newUser->id !== null) {
            // ส่งข้อมูลการสำเร็จกลับไปยังผู้ใช้งาน
            return response()->json(['success' => true, 'data' => 'เพิ่มข้อมูลสำเร็จ'], 200);
        }
    }
    public function delete($user_id)
    {
        try {
            // ลบข้อมูล WarehouseUser โดยใช้ id ที่ระบุ
            $deleted = WarehouseUser::where('user_id', $user_id)->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'data' => 'WarehouseUser deleted successfully'], 200);
            } else {
                return response()->json(['success' => false, 'data' => 'WarehouseUser not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'data' => 'Failed to delete WarehouseUser'], 500);
        }

    }
}
