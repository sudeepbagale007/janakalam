<?php

namespace App\Http\Controllers\admin;

use App\Model\admin\AdminFailLoginLogs;
use App\Model\admin\AdminGroup;
use App\Model\admin\AdminSuccessLoginLogs;
use App\Model\admin\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller {

    public function login(Request $request){
        $value = $request->session()->get('admin');
        if ($value) {
            return redirect(route('dashboard'));
        }
        return view('admin.login');
    }

    public function loginCheck(Request $request){
        $this->validate($request, [
                'username'              => 'required|string|min:6',
                'password'              => 'required|string|min:6',
            ]);
        $userdetail = AdminUser::getUserPassword($request->username);
        if (!empty($userdetail)) {
            if (Hash::check($request->password, $userdetail->password)) {
                // update login time
                $user = AdminUser::findOrFail($userdetail->id);
                $user->lastlogin = date('Y-m-d H:i:s');
                $user->save();

                $succeslogs = new AdminSuccessLoginLogs;
                $succeslogs->user_id = $userdetail->id;
                $succeslogs->login_date = date('Y-m-d H:i:s');
                $succeslogs->login_device = Self::getBrowserName($_SERVER['HTTP_USER_AGENT']);
                $succeslogs->ip_address = $request->ip();
                $succeslogs->save();

                $request->session()->put('admin', array(
                    'userid'                => $userdetail->id,
                    'user_group_id'         => $userdetail->user_group_id,
                ));
                return redirect(route('dashboard'));
            }
            else {
                $faillogs = new AdminFailLoginLogs;
                $faillogs->user_name = $request->username;
                $faillogs->fail_password = $request->password;
                $faillogs->ip_address = $request->ip();
                $faillogs->login_device = Self::getBrowserName($_SERVER['HTTP_USER_AGENT']);
                $faillogs->save();
                Session::flash('message', "Login Credential, Incorrect !!! ");
                return redirect(route('login'));
            }
        } else {
            $faillogs = new AdminFailLoginLogs;
            $faillogs->user_name = $request->username;
            $faillogs->fail_password = $request->password;
            $faillogs->ip_address = $request->ip();
            $faillogs->login_device = Self::getBrowserName($_SERVER['HTTP_USER_AGENT']);
            $faillogs->save();
            Session::flash('message', "Login Credential, Incorrect !!! ");
            return redirect(route('login'));
        }
    }

    public function userRegister(){
        $value = self::id();
        if ($value != '1') {
          return redirect(route('dashboard'));
        } else{
            $admingroup = AdminGroup::orderBy('title','asc')->get();
            // $admingroup = AdminGroup::all();
            $result = array(
                'page_header'       => 'User Registration',
                'admingroup'        => $admingroup,
            );
           return view('admin.adminuser.register', compact('result'));
        }
    }

    public function userRegisterData(Request $request){
        $user_id = self::id();
        $crud = new AdminUser;
        $this->validate($request, [
                'name'                  => 'required|string|min:6',
                'email'                 => 'required|string|min:6|email',
                'mobileno'              => 'required|string|min:6',
                'username'              => 'required|string|min:6',
                'password'              => 'required|string|min:6|confirmed',
            ]);
        $crud->name = $request->name;
        $crud->email = $request->email;
        $crud->mobileno = $request->mobileno;
        $crud->username = $request->username;
        $crud->user_group_id = $request->user_group_id;
        $crud->password = bcrypt($request->password);
        $crud->status = $request->status;
        $crud->created_by = $user_id;
        $crud->save();
        return redirect(route('user.list'));
    }

    public function dashboard(){
        return view('admin.home');
    }

    public function adminUserList(){
        $value = self::id();
        if ($value != '1') {
          return redirect(route('dashboard'));
        } else{
            $userlist = AdminUser::all();
            // $userlist = AdminUser::find(1);
            $result = array(
                'userlist'          => $userlist,
            );
            return view('admin.adminuser.list', compact('result'));
        }
    }

     public static function id(){
        $value = session('admin')['userid'];
        return $value;
    }

    public static function deleteUser($id) {
        $value = self::id();
        if ($value != '1') {
          return redirect(route('dashboard'));
        } else{
            $user = AdminUser::findOrFail($id);
            $user->delete();
            Session::flash('success_message',DELETED);
            return redirect(route('user.list'));
        }
    }

    public static function editUser($id){ // when admin want to edit other user profile
        $value = self::id();
        if ($value != '1') {
          return redirect(route('dashboard'));
        } else{
            $userlist = AdminUser::findOrFail($id);
            $admingroup = AdminGroup::orderBy('title','asc')->get();
             $result = array(
                'record'            => $userlist,
                'page_header'       => 'Edit User Registration',
                'admingroup'        => $admingroup,
            );
            return view('admin.adminuser.edit', compact('result'));
        }
    }

    public function updateuser(Request $request, $id){
        $crud = AdminUser::findOrFail($id);
        $user_id = self::id();
        if (isset($request->changepwd) && $request->changepwd == 'on') {
            $this->validate($request, [
                'name'                  => 'required|string|min:6',
                'email'                 => 'required|string|min:6|email',
                'mobileno'              => 'required|string|min:6',
                'username'              => 'required|string|min:6',
                'password'              => 'required|string|min:6|confirmed',
            ]);
            $crud->password = bcrypt($request->password);
            $crud->name = $request->name;
            $crud->email = $request->email;
            $crud->mobileno = $request->mobileno;
            $crud->user_group_id = $request->user_group_id;
            $crud->username = $request->username;
            $crud->status = isset($request->status)?$request->status:'1';
            $crud->updated_by = $user_id;
            $crud->save();
        } else{
             $this->validate($request, [
                'name'                  => 'required|string|min:6',
                'email'                 => 'required|string|min:6|email',
                'mobileno'              => 'required|string|min:6',
                'username'              => 'required|string|min:6',
                'username'              => 'required|string|min:6',
            ]);
            $crud->name = $request->name;
            $crud->email = $request->email;
            $crud->mobileno = $request->mobileno;
            $crud->user_group_id = $request->user_group_id;
            $crud->username = $request->username;
            $crud->status = isset($request->status)?$request->status:'1';
            $crud->updated_by = $user_id;
            $crud->save();
        }
        Session::flash('success_message',SUCCESSFULLY_UPDATED);
        return redirect(route('user.list'));
    }

    public function logout(Request $request){
        /*$request->session()->flush();*/
        $request->session()->forget('admin');
        return redirect(route('login'));
    }

    public function getBrowserName($user_agent) {
        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        return 'Other';
    }

    /*public static function is_superadmin(){
        $value = self::id();
        if ($value != '1') {
          return redirect(route('dashboard'));
        }
    }*/

}