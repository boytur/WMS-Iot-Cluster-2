<?php

namespace App\Http\Controllers\Users;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserManagementIndex extends Controller
{
    public function user_management_index()
    {
        try {
            if (Auth::check() && Auth::user()->role === "warehouse_manager") {
                $users = User::paginate(20);
                return view('users.v_user_management', compact('users'));
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
}
