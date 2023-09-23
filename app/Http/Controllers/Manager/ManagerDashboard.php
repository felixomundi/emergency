<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Branches;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StaffUpdateFormRequest;
use App\Http\Requests\PasswordUpdateFormRequest;

class ManagerDashboard extends Controller
{
    public function index(){
            $totalUsers = User::count();
            return view("manager.dashboard.index", compact("totalUsers"));

    }
    public function changePassword(){
        return view("manager.dashboard.changepassword");
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
        $user = User::where("id", Auth::user()->id)->where("role_as", "5")->first();
        return view("manager.dashboard.profile", compact("user"));
    }

    public function updateProfile(StaffUpdateFormRequest $request){
        $data=$request->validated();
        $user = User::findOrFail(intval($data["userId"]));
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
        // $user->staff()->update([
        //         "father_name"=>$data["father_name"],
        //         "father_occupation"=>$data["father_occupation"],
        //         "father_phone_number"=>$data["father_phone_number"],
        //         "mother_name"=>$data["mother_name"],
        //         "mother_occupation"=>$data["mother_occupation"],
        //         "mother_phone_number"=>$data["father_phone_number"],
        //         "phone"=>$data["phone"],
        //         "county"=>$data["county"],
        //         "district"=>$data["district"],
        //         "division"=>$data["division"],
        //         "location"=>$data["location"],
        //         "sub_location"=>$data["sub_location"],
        //         "gender"=>$data["gender"],
        //         "dob"=>$data["dob"],
        //         "date_joined"=>$data["date_joined"],
        //         "experience"=>$data["experience"],
        //         "qualification"=>$data["qualification"],
        //         "image"=>$fileName,
        //     ]);

        return redirect("/manager/profile")->with("success","Your Photo is Updated Sucessfully");
        }else{
        return redirect()->back()->with("error","No matching records for given manager");
        }
    }

}
