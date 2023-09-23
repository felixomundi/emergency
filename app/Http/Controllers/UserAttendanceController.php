<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserAttendanceFormRequest;
use App\Models\UsersAttendance;

class UserAttendanceController extends Controller
{
    public function index(){
        $data["attendances"] = UsersAttendance::all();
        return view("admin.attendance.index", $data);
    }
    public function create(){
        $data["users"] = User::all();
        return view("admin.attendance.create", $data);
    }
    public function store(UserAttendanceFormRequest $request) {
        $data = [
            "user_id"=>$request->user,
            "attendance_date"=>$request->attendance_date,
        ];
        $att = UsersAttendance::where($data)->first();
        if(!$att){
            UsersAttendance::create([
                "user_id"=>$request->user,
                "attendance_date"=>$request->attendance_date,
                "status"=>$request->status,
                "created_by"=>auth()->user()->id,
            ]);
            return redirect("/admin/user_attendancies")->with("success", "Attendance Saved Successfully");
        }else{
            return redirect("/admin/user_attendancies")->with("error", "Attendance Exist Go Update");
        }

    }
    public function edit($id){
        $attendance = UsersAttendance::find($id);
        if($attendance){
            return view("admin.attendance.edit", compact("attendance"));
        }else{
            return redirect("/admin/user_attendancies")->with("error", "Attendance Not Found");
        }
    }
    public function update(UserAttendanceFormRequest $request, $id){
        $attendance = UsersAttendance::find($id);
        if($attendance){
            $user = User::find($id);
            if($user){

                    $attendance->update([
                        "status"=>$request->status,
                    ]);
                    return redirect("/admin/user_attendancies")->with("success", "Attendance Updated Succeefully");
            }else{
                return redirect("/admin/user_attendancies")->with("error", "User Not Found");
            }

        }else{
            return redirect("/admin/user_attendancies")->with("error", "Attendance Not Found");
        }

    }
}
