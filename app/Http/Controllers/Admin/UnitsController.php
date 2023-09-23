<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Staff;
use App\Models\Units;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitFormRequest;
use Illuminate\Support\Facades\Response;

class UnitsController extends Controller
{

    public function units(){
        $units = Units::all();

      return view("admin.units.units",compact("units"));
    }

    public function create(){
      $staffs = User::fetchTutors();
      $courses = Courses::where("status","0")->get();
      return view("admin.units.create",compact("courses","staffs"));
    }

    public function store(UnitFormRequest $request){
        $data = $request->validated();
        $course = Courses::find(intval($data["courses_id"]));
        $staff = Staff::where("user_id", $data["staff"])->exists();
        if($staff && $course){
            $course ->units()->create([
                            "title"=>$data["title"],
                            "unit_code"=>$data["unit_code"],
                            "status"=>$data["status"],
                            "courses_id"=>$course -> id,
                            "staff_id"=>$staff,
                            "unit_duration"=>$data["unit_duration"],
                            "pass_marks"=>$data["pass_marks"],
                            "ful_marks"=>$data["full_marks"],
                        ]);

                        return redirect()->back()->with("message", "Unit added successfully");
        }
        else{
            return redirect()->back()->with("error","Course or Staff Not Found");
        }

    }

    public function editUnit(Request $request,int $id){
        $unit = Units::find($id);
        $users = User::fetchTutors();
        if($unit){
            $courses = Courses::where("status","0")->get();
            return view("admin.units.edit", compact("unit","courses","users"));
        }else{
            return redirect()->back()->with("message","Unit Not Found");

        }
    }

    public function updateUnit(UnitFormRequest $request, int $id){
        $data = $request->validated();
        $unit = Courses::findOrFail($data["course"])->units()->where("id", $id)->first();
       if($unit){
        $unit->update([
            "title"=>$data["title"],
            "unit_code"=>$data["unit_code"],
            "status"=>$data["status"],
            "courses_id"=>$data["courses_id"],
            "staff_id"=>$data["staff"],
            "unit_duration"=>$data["unit_duration"],
            "pass_marks"=>$data["pass_marks"],
            "ful_marks"=>$data["full_marks"],
        ]);
        return redirect()->back()->with("message", "Unit Updated Successfully");

       }
       else{
        return redirect()->back()->with("error", "Unit Not Found");
       }
    }
    public function deleteUnit(int $id){
        $unit =Units::find($id);
        if($unit){
            $unit->delete();
            return Response::json([
                "status"=>200,
                "message"=>"Unit Deleted successfully",
            ]);
        }
        else{
            return Response::json([
                "status"=>404,
                "message"=>"Unit Not Found",
            ]);
        }
    }



}
