<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\SaveUserFormRequest;

class UsersController extends Controller
{
    public function users(){
        $users = User::all();
        return view("admin.users.users" , compact("users"));
    }
    public function create()  {
        return view("admin.users.create");
    }
    public function store(SaveUserFormRequest $request){

        $data = $request ->validated();
        if($request->hasFile("image")){
            $image = $data["image"];
            $imagename = time() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('users/'),$imagename);
        }
        else{

            $imagename = "";
        }

        User::create([
            "name"=>$data["name"],
            "email"=>$data["email"],
            "role_as"=> $data["role_as"],
            "password"=>Hash::make($data['password']),
            "father_name"=>$data["father_name"],
            "father_occupation"=>$data["father_occupation"],
            "father_phone_number"=>$data["father_phone_number"],
            "mother_name"=>$data["mother_name"],
            "mother_occupation"=>$data["mother_occupation"],
            "mother_phone_number"=>$data["father_phone_number"],
            "phone"=>$data["phone"],
            "county"=>$data["county"],
            "district"=>$data["district"],
            "division"=>$data["division"],
            "location"=>$data["location"],
            "sub_location"=>$data["sub_location"],
            "gender"=>$data["gender"],
            "dob"=>$data["dob"],
            "image"=>$imagename,
        ]);
        return redirect("/admin/users")->with("success","User Saved Sucessfully");
    }
    public function editUser($id){
        $user = User::find($id);
        if($user){
            return view("admin.users.edit", compact("user"));
        }
        else{
            return redirect("/admin/users")->with("error","User Not Found");
        }
    }

    public  function updateUser(SaveUserFormRequest $request ,$id){
        $user = User::find($id);
        if($user){
            $password = "";
            if($request->password){
                $password = Hash::make($request->password);
            }
            else{
                $password = $user->password;
            }
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
                "name"=>$request->name,
                "email"=>$request->email,
                "password" =>$password,
                "phone"=>$request->phone,
                "gender"=>$request->gender,
                "image"=>$fileName,
                "father_name"=>$request->father_name,
                "father_occupation"=>$request->father_occupation,
                "father_phone_number"=>$request->father_phone_number,
                "mother_name"=>$request->mother_name,
                "mother_occupation"=>$request->mother_occupation,
                "mother_phone_number"=>$request->father_phone_number,
                "county"=>$request->county,
                "district"=>$request->district,
                "division"=>$request->division,
                "location"=>$request->location,
                "sub_location"=>$request->sub_location,
                "dob"=>$request->dob,
                "role_as"=>$request->role_as,

            ]);

            return redirect("/admin/users")->with("message","User Updated Successfully");

        }else {
            return redirect("/admin/users")->with("error","User Not Found");
        }

    }


}
