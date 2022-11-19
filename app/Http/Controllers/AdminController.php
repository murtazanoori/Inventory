<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller

{
    //
     /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array('message' =>'Admin Logged Out',
        'alert-type' => 'error');

        return redirect('/login')->with($notification);
    }

    public function profile (){
        //getting that logged in users ID
        $id = Auth::user()->id;

        //finding which user is logged in ?
        $adminData = User::find($id);
        return view('admin.profile', compact('adminData'));
    }

    public function Editprofile(){
          //getting that logged in users ID
          $id = Auth::user()->id;

          //finding which user is logged in ?
          $editData = User::find($id);
          return view('admin.edit_profile', compact('editData'));
    }

    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;

        if ($request->file('profile_image')) {
           $file = $request->file('profile_image');

           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$filename);
           $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array('message' =>'Admin Profile Updated Successfully',
        'alert-type' => 'success');

        return redirect()->route('admin.profile')->with($notification);
    }

    public function ChangePassword(){

        return view('admin.change_password');
    }

    public function UpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',

        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message','Password Updated Successfully');
            return redirect()->back();
        } else{
            session()->flash('message','Old password Not Matched');
            return redirect()->back();
        }


    }


}
