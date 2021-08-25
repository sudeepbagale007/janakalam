<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\AdminLoginController;
use App\Model\admin\AdminUser;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminProfileController extends Controller {

   public static function editUserProfile(){ // when user wants to change their profile
        $user_id = AdminLoginController::id();
        $userlist = AdminUser::findOrFail($user_id);
        $result = array(
            'page_header'   => 'Edit Profile',
            'record'        => $userlist,
        );

        return view('admin.profile.edit', $result);
    }

    public function updateuser(Request $request, $id){
        $user_group_id = session('admin')['user_group_id'];
        $crud = AdminUser::findOrFail($id);
        $user_id = AdminLoginController::id();
        if (isset($request->changepwd) && $request->changepwd == 'on') {
            $this->validate($request, [
                'name'                  => 'required|string|min:6',
                'email'                 => 'required|string|min:6|email',
                'mobileno'              => 'required|string|min:6',
                'username'              => 'required|string|min:6',
                'password'              => 'required|string|min:6|confirmed',
                'oldpassword'           => 'required|string',
            ]);
            if (Hash::check($request->oldpassword, $crud->password)) {
                $crud->password = bcrypt($request->password);
                $crud->name = $request->name;
                $crud->email = $request->email;
                $crud->mobileno = $request->mobileno;
                $crud->username = $request->username;
                $crud->status = '1';
                $crud->updated_by = $user_id;
                $crud->save();
                $request->session()->forget('admin');
                Session::flash('message',PASSWORD_MESSAGE);   
                return redirect(route('login'));
            } else{
                Session::flash('success_message',OLD_PASSWORD_MESSAGE);   
                return redirect(route('userprofile.editprofile'));
            }

        } else{
             $this->validate($request, [
                'name'                  => 'required|string|min:6',
                'email'                 => 'required|string|min:6|email',
                'mobileno'              => 'required|string|min:6',
                'username'              => 'required|string|min:6',
            ]);
            $crud->name = $request->name;
            $crud->email = $request->email;
            $crud->mobileno = $request->mobileno;
            $crud->username = $request->username;
            $crud->status = '1';
            $crud->updated_by = $user_id;
            $crud->save();
        }
        $request->session()->forget('admin')['username'];
        $request->session()->put('admin', array(
            'userid'                => $id,
            'username'              => $crud->name,
            'user_group_id'         => $user_group_id,
        ));
        Session::flash('success_message',SUCCESSFULLY_UPDATED);
        return redirect(route('userprofile.editprofile'));
    }
}
