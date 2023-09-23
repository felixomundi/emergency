<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Staff;
use App\Models\Branches;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StaffFormRequest;
use Illuminate\Support\Facades\Response;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $staffs = Staff::all();
    return view("admin.staff.index", compact("staffs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $branches = Branches::where("status","0")->get();
        return view("admin.staff.create", compact("branches"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffFormRequest $request)
       {
        $data = $request ->validated();
        if($request->hasFile("image")){
            $image = $data["image"];
            $imagename = time() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('users/'),$imagename);
        }
        else{

            $imagename = "";
        }

        $user = User::create([
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

        if($user){
            $user->staff()->create([
                "staff_number"=>rand(1,10000),
                "user_id"=>$user->id,
                "date_joined"=>$data["date_joined"],
                "experience"=>$data["experience"],
                "qualification"=>$data["qualification"],
                "branch_id"=>$data['branch_id'],

            ]);

            return redirect()->back()->with("success","Staff Saved Sucessfully");
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
        {
            $staff = Staff::find($id);
            $branches = Branches::where("status", "0")->get();
            if($staff){
                return view("admin.staff.edit", compact("staff", "branches"));
        }
        else{
            return redirect()->back()->with("error","Staff not Found");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(StaffFormRequest $request, $id)
        {
        $data = $request->validated();
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

        $password = "";
        if(!($request->password)){
        $password = $user-> password;

        }
        else{
        $password = Hash::make($data["password"]);
        }

        $user->update([
        "name"=>$data["name"],
        "email"=>$data["email"],
        "password" =>$password,
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
        "image"=>$fileName,

        ]);
        $user->staff()->update([
        "date_joined"=>$data["date_joined"],
        "experience"=>$data["experience"],
        "qualification"=>$data["qualification"],
        "branch_id"=>$data['branch_id'],


        ]);

        return redirect("/admin/staff")->with("message","Staff Updated Sucessfully");
        }else{
        return redirect()->back()->with("error","No matching records for given staff");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, int $id){
        $user = User::findOrFail(intval($userId));
        $staff = $user->staff()->where("id", intval($id))->first();
        if($staff){
            $user->delete();
            return Response::json([
                        "status"=>200,
                        "message"=>"Staff deleted successfully"
            ]);
            }
            else{
                return Response::json([
                    "status"=> 404,
                    "message"=>"Staff not Found"
           ]);
            }
    }
}
