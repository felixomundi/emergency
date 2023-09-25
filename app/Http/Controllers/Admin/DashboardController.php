<?php

namespace App\Http\Controllers\Admin;
use App\Models\Cases;
use App\Models\User;
use App\Models\Staff;
use App\Models\Units;
use App\Models\Courses;
use App\Models\Student;
use App\Models\Branches;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminPhotoUpdateRequest;
use App\Http\Requests\PasswordUpdateFormRequest;

class DashboardController extends Controller
{
    public function index(){
        $data["users"] = User::all()->count();
        $fdata = [            
            "status"=>"Completed",
        ];
        $data["completecases"] = Cases::where($fdata)->get()->count();
        $data["activecases"] = Cases::whereNot("status", "Completed")->get()->count();   
        return view("admin.dashboard.index", $data);
    }



public function changePassword(){
    return view("admin.dashboard.changepassword");
}

public function updatePassword(PasswordUpdateFormRequest $request){
    $data = $request->validated();
    $password =$data["current_password"];
    $currentPasswordStatus = Hash::check($password, Auth::user()->password);

    if($currentPasswordStatus){
        User::findOrFail(Auth::user()->id)->update([

            "password"=>Hash::make($data["password"])
        ]);

        return redirect()->back()->with("message", "Password updated successfully");
    }

    else{
        return redirect()->back()->with("error", "Current Password does not match with old password");
    }
    }

    public function profile(){
        return view("admin.dashboard.profile");

    }

}
