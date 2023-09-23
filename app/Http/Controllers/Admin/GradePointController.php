<?php

namespace App\Http\Controllers\Admin;
use App\Models\GradePoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradeFormRequest;
use App\Helpers\Helper;
use App\Models\Form;
class GradePointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $gradepoints = GradePoint::all();
            return view("admin.grades.grades", compact("gradepoints"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
        {
            return view("admin.grades.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeFormRequest $request)
      {
        $gradePoint = new GradePoint();
        // $gradePoint = new GradePoint();
        $gradePoint->grade_name = $request->grade_name;
        $gradePoint->grade_point = $request->grade_point;
        $gradePoint->start_marks = $request->start_marks;
        $gradePoint->end_marks = $request->end_marks;
        $gradePoint->start_point = $request->start_point;
        $gradePoint->end_point = $request->end_point;
        $gradePoint->remarks = $request->remarks;
        $gradePoint->save();
        return redirect()->back()->with("success", "Grade Saved Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradePoint  $gradePoint
     * @return \Illuminate\Http\Response
     */
    public function show(GradePoint $gradePoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradePoint  $gradePoint
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
        {
            $grade = GradePoint::find($id);
            if($grade){
                return view("admin.grades.edit", compact("grade"));
            }
            else{
                return redirect()->back()->with("error","Grade not Found");
            }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradePoint  $gradePoint
     * @return \Illuminate\Http\Response
     */
    public function update(GradeFormRequest $request,$id)
        {

            $grade = GradePoint::find($id);
            if($grade){
                $grade->update([
                    "grade_name" => $request->grade_name,
                "grade_point" => $request->grade_point,
                "start_marks" => $request->start_marks,
                "end_marks" => $request->end_marks,
                "start_point" => $request->start_point,
                "end_point" => $request->end_point,
                "remarks" => $request->remarks,
                ]);
                return redirect()->back()->with("success", "Grade Updated Successfully");
            }
            else{
                return redirect()->back()->with("error","Grade not Found");
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradePoint  $gradePoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradePoint $gradePoint)
    {
        //
    }
}
