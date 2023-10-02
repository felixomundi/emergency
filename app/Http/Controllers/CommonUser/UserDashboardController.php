<?php

namespace App\Http\Controllers\CommonUser;

use App\Http\Requests\ProfileFormRequest;
use App\Models\Cases;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordUpdateFormRequest;

class UserDashboardController extends Controller
{
    public function index(){
        $userdata = [
            "user_id"=>auth()->user()->id,            
        ];
        $data["activecases"] = Cases::where($userdata)->whereNot("status", "Completed")->get()->count();    
        $fdata = [
            "user_id"=>auth()->user()->id,
            "status"=>"Completed",
        ];
        $data["completedcases"] = Cases::where($fdata)->get()->count(); 
        return view("user.dashboard.index", $data);
    }
    public function changePassword(){
      return view("user.dashboard.changepassword");
    }
    public function updatePassword(PasswordUpdateFormRequest $request){
        $data = $request->validated();
        $password =$data["current_password"];
        $currentPasswordStatus = Hash::check($password, Auth::user()->password);
        if($currentPasswordStatus){
            User::findOrFail(Auth::user()->id)->update([

                "password"=>Hash::make($data["password"])
            ]);
            return redirect()->back()->with("success", "Password updated successfully");
        }
        else{
            return redirect()->back()->with("error", "Current Password does not match with old password");
        }
    }
    public function profile(){
        $user = User::where("id", Auth::user()->id)->where("role_as", "0")->first();
        return view("user.dashboard.profile", compact("user"));
    }
}
