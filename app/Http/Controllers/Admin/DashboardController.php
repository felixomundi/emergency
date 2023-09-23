<?php

namespace App\Http\Controllers\Admin;
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

        return view("admin.dashboard.index");
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

    public function profileUpdate(AdminPhotoUpdateRequest $request){
        $user = User::find(Auth::user()->id);
       if($user){
        $fileName = "";
        if ($request->hasFile("image")){
        $path = public_path("users/" . $user->image);
        if(File::exists($path)){
        File::delete($path);
        }
        $file = $request->file("image");
        $fileName = time() . "." . $file -> getClientOriginalExtension();
        $file -> move(public_path("users/"), $fileName);

        }else
        {
            $fileName = $user -> image;
        }
        $user->update([
            "image"=>$fileName,
        ]);
        return redirect()->back()->with("success","Your Profile Photo is Updated Sucessfully");
       }
       else{
        Auth::logout();
        return redirect(url("/"));
    }

    }

}
