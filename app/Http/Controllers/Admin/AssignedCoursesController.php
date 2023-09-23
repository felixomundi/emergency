<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Staff;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\AssignedCourses;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignCourseFormRequest;

class AssignedCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $assignedcourses = AssignedCourses::all();
    return view("admin.assigncourses.index", compact("assignedcourses"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::fetchTutors();
        $courses = Courses::where("status", "0")->get();
        return view("admin.assigncourses.assign", compact("courses","users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignCourseFormRequest $request)
    {
        $courses_id = $request->course;
        $user_id = $request->user;
        $data = ["courses_id" => $courses_id, "user_id"=> $user_id ];
        $exist = AssignedCourses::where($data)->exists();
        if($exist){
            return redirect()->back()->with("error","That Course  is Already Assigned to that Staff");
        }else{
            AssignedCourses::create([
                "courses_id"=>$courses_id,
                "user_id" =>$user_id,
                ]
            );
            return redirect()->back()->with("success","Course Assigned Successfully");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignedCourses  $assignedCourses
     * @return \Illuminate\Http\Response
     */
    public function show(AssignedCourses $assignedCourses)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignedCourses  $assignedCourses
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignedCourses $assignedCourses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignedCourses  $assignedCourses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignedCourses $assignedCourses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignedCourses  $assignedCourses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
        {
            $assignedCourses = AssignedCourses::find($id);
            if($assignedCourses){
            $assignedCourses->delete();
            return redirect("/admin/assigned_courses")->with("success","Assigned Course Deleted Successfully");
        }else{
            return redirect("/admin/assigned_courses")->with("error","Assigned Course Not Found");
        }

    }
}
