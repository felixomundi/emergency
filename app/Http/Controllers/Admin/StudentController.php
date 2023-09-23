<?php

namespace App\Http\Controllers\Admin;


use Throwable;
use App\Models\User;
use App\Models\Courses;
use App\Models\Student;
use App\Models\Branches;
use App\Mail\RegisterSuccessMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\StudentFormRequest;

class StudentController extends Controller
{

    public function students() {
        $students = Student::all();
        return view("admin.students.students", compact("students"));
    }
    public function create(){
        $courses = Courses::where("status","0")->get();
        $branches= Branches::where("status","0")->get();
        return view("admin.students.create", compact("courses","branches"));
    }
    public function store(StudentFormRequest $request) {

        $data =$request->validated();
        if($request->hasFile("image")){
            $image = $request->file("image");
            $imagename = time() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('users/'), $imagename);
        }

        $user = User::create([
            "name"=>$data["name"],
            "email"=>$data["email"],
            "role_as"=> "2",
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
            $user->student()->create([
                "admission_number"=>rand(1,10000),
                "user_id"=>$user->id,
                "courses_id"=>$data["course"],
                "branch_id"=>$data["branch"],
            ]);

            // send email after registration
            $course_name = "";
            $course = Courses::find($request->course);
            if($course){
                $course_name = $course->title;
            }

            try {
                Mail::to($user->email)->send(new RegisterSuccessMail($user, $request->password, $course_name));
                return redirect("/reception/students")->with("success","Student Saved Sucessfully");
            } catch (Throwable $th) {
                return redirect()->back()->with("error", $th->getMessage());
            }
        }

    }
    public function edit($id){
        $courses = Courses::where("status","0")->get();
        $branches= Branches::where("status","0")->get();
        $student = Student::find($id);
        if($student){
           return view("admin.students.edit",compact("student","courses","branches"));
        } else{
                return redirect()->back()->with("error","Student Not Found");
            }
    }
    public function destroy($userId, int $id){
        $user = User::findOrFail(intval($userId));
        $student = $user->student()->where("id", intval($id))->first();
        if($student){
            $user->delete();
            return Response::json([
                        "status"=>200,
                        "message"=>"Student deleted successfully"
            ]);
            }
            else{
                return Response::json([
                    "status"=> 404,
                    "message"=>"Student not Found"
           ]);
            }
    }
    public function updateStudent(StudentFormRequest $request,$id){
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
                    "phone"=>$data["phone"],
                    "gender"=>$data["gender"],
                    "image"=>$fileName,
                    "father_name"=>$data["father_name"],
                    "father_occupation"=>$data["father_occupation"],
                    "father_phone_number"=>$data["father_phone_number"],
                    "mother_name"=>$data["mother_name"],
                    "mother_occupation"=>$data["mother_occupation"],
                    "mother_phone_number"=>$data["father_phone_number"],
                    "county"=>$data["county"],
                    "district"=>$data["district"],
                    "division"=>$data["division"],
                    "location"=>$data["location"],
                    "sub_location"=>$data["sub_location"],
                    "dob"=>$data["dob"],


                ]);
                $user->student()->update([
                    "courses_id"=> $data["course"],
                    "branch_id"=>$data["branch"],

                ]);

                return redirect("/admin/students")->with("success", "Student Updated Sucessfully");
            }else{
                return redirect("/admin/students")->with("error", "Student Not Found");
            }

    }
}
