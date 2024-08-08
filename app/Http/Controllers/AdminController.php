<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->flash('message', 'User successfully logged out');
        return redirect()->back();
    }

    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function editProfile(){
        $id = Auth::user()->id;
        $adminEdit = User::find($id);
        return view('admin.admin_profile_edit',compact('adminEdit'));

    }
    public function storeProfile(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->profile_image = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword(){
        return view('admin.admin_change_Password');
    }


    public function updatePassword(Request $request){

        $validate = $request->validate([
            'oldpassword' =>'required',
            'newpassword' =>'required',
            'password_confirmation' =>'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword, $hashedPassword)){
           $user = User::find(Auth::id());
            $user->password = bcrypt($request->newpassword);
            $user->save();

            session()->flash('message', 'Password changed');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old password is incorrect');
            return redirect()->back();
        }
    }
    

}
