<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Units;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\StudentAttendance;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceUpdateRequest;

class AdminStudentAttendanceController extends Controller
{
    public function index(){
        $attendances = StudentAttendance::all();
        return view("admin.attendance.index", compact("attendances"));

    }
    public function view($id){
        $data["attendance"] = StudentAttendance::find($id);
        if($data["attendance"]){
        return view("admin.attendance.edit", $data);
        }
        else{
            return redirect("/admin/attendance")->with("error", "Student Attendance Not Found");
        }
    }
    public function delete($id){
        $attendance = StudentAttendance::find($id);
        if($attendance){
            $attendance->delete();
            return redirect("/admin/attendance")->with("success", "Student Attendance Deleted Successfully");
        }
        else{
            return redirect("/admin/attendance")->with("error", "Student Attendance Not Found");
        }

    }
    public function create(){
        $data["courses"] = Courses::where("status", 0)->get();
        return view("admin.attendance.create", $data);
    }
    public function store(Request $request){
        $courseId = Courses::find($request->course);
        if($courseId){
         $course = $courseId->id;
         $user_exists = User::find($request->user);
         if($user_exists){
          $user = $user_exists->id;
          $unitId = Units::find($request->unit);
         if($unitId){
          $unit = $unitId->id;
          // saved data to database
          if($courseId && $user_exists && $unitId){
             $data = ["user_id"=>$user, "course_id"=>$course, "unit_id" =>$unit, "start_time"=>$request->start_time, "end_time"=>$request->end_time];
             $attendanceexist =StudentAttendance::where($data)->first();
             if(!$attendanceexist){
             StudentAttendance::create([
                 "attendance_date"=>$request->attendance_date,
                 "start_time"=>$request->start_time,
                 "end_time"=>$request->end_time,
                 "content_covered"=>$request->content_covered,
                 "next_lesson_content"=>$request->next_lesson_content,
                 "user_id"=>$user,
                 "unit_id"=>$unit,
                 "course_id"=>$course,
                 "created_by"=>auth()->user()->id,
             ]);
             return response()->json([
                 "status"=> 200,
                 "message"=> "Attendance Saved Successfully",
             ]);
             }else{
                 return response()->json([
                     "status"=> 400,
                     "message"=> "Attendance ALready saved for $user_exists->name on that date and time",
                 ]);
             }
            }
            else{
             return response()->json([
                 "status"=> 400,
                 "message"=> "Error in saving Attendance",
             ]);
            }

            // end of saving
         }
         else{
             return response()->json([
                 "status"=>404,
                 "message"=> "Unit Not Found"
             ]);
         }
         }
         else{
             return response()->json([
                 "status"=> 404,
                 "message"=>"Student not found"
             ]);
         }
        }
        else{
         return response()->json([
             "status"=> 404,
             "message"=> "Course not Found",
         ]);

        }
    }
    public function edit($id){

        $data["attendance"] = StudentAttendance::find($id);
        if($data["attendance"]){
        return view("admin.attendance.edit", $data);
        }
        else{
            return redirect("/admin/attendance")->with("error", "Student Attendance Not Found");
        }

    }
    public function update(AttendanceUpdateRequest $request, $id){
        $data =[
            "course_id"=>$request->course,
            "user_id"=>$request->user,
            "unit_id"=>$request->unit,
        ];
        $attendance = StudentAttendance::find($id);
        if($attendance){
            $aexist = StudentAttendance::where($data)->exists();
            if($aexist){
                StudentAttendance::where($data)->update([
                    "attendance_date"=>$request->attendance_date,
                    "start_time"=>$request->start_time,
                    "end_time"=>$request->end_time,
                    "content_covered"=>$request->content_covered,
                    "next_lesson_content"=>$request->next_lesson_content,
                ]);
                return redirect("/admin/attendance")->with("success", "Student Attendance  Updated Successfully");
            }
            else{
                return redirect("/admin/attendance")->with("error", "Student Attendance Not Found");
            }
        }else{
            return redirect("/admin/attendance")->with("error", "Student Attendance Not Found");
        }

    }

}
