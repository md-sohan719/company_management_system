<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/'), $fileName);
            $data->profile_image = $fileName;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }



    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirm_password' => 'required|same:newPassword',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldPassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newPassword);
            $user->save();
            session()->flash('message', 'Password Updated Successfully');
            return back();
        } else {
            session()->flash('message', 'Old password is not match');
            return back();
        }
    }












    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }
}
