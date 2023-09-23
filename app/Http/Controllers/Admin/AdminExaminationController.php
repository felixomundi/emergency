<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Units;
use App\Models\Courses;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminExaminationController extends Controller
{
    public function index(){
        $courses = Courses::where("status", "0")->get();
        return view("admin.exam.index", compact("courses"));
    }
    public function students($id){
        $students = User::adminfetchStudentsByCourse($id);
        return $students;
    }
    public function fetchStudentResult(Request $request){
        $course = $request->course;
        $user_ = $request->user;
        if($course && $user_){
        $user = User::find($user_);
        if($user){
        $studentId = $user->student->id;
        $userId = $user->id;
        $singleResult = ExamResult::where("courses_id", $course)->where("user_id", $userId)->where("student_id", $studentId)->first();
        if($singleResult){
        $data['results'] = ExamResult::select("courses_id", "student_id", "user_id", "unit_id", "marks")->where("courses_id", $course)->where("student_id", $studentId)->where("user_id", $userId)->get();
        // dd($data["results"]->toArray());
        return view("admin.exam.results", $data);
        // $pdf = Pdf::loadView('admin.exam.results', $data);
        // return $pdf->download('invoice.pdf');

        }else{
        return redirect()->back()->with("error", "Student Result Not Found");
        }

        }else{
        return redirect()->back()->with("error","User Not Found");
        }
        }
        else{
        return redirect()->back()->with("error","Some fields are missing");
        }

    }
    public function register(){
        $courses = Courses::where("status", [0])->get();
        return view("admin.exam.register", compact("courses"));

    }
    public function fetchSubjects($id){
        $units = Courses::getSubjects($id);
        return $units;
    }
    public function fetchStudents(Request $request){
        $course = $request->course;
        $students = User::adminfetchStudentsByCourse($course);
        return   $students;
    }
    public function saveResult(Request $request){
        $user = $request->user;
        $marks =$request->marks;
        $course =$request->course;
        $unit =$request->unit;
        if($course && $user && $unit){
            $data = ["courses_id" => $course, "user_id"=> $user, "unit_id" => $unit];
            $ex = ExamResult::where($data)->exists();
            $unit = Units::find($unit);
            $userexists = User::find($user);
            if($userexists){
                $user_name = $userexists->name;
                $student_id = $userexists->student->id;
            }
            if($unit){
                $unit_name =$unit->title;
            }

            if($ex){
            return redirect()->back()->with("error","Marks for student $user_name and  Unit $unit_name already added go update");
            }
            else{

                $examresult = new ExamResult();
                $examresult ->courses_id =$request->course;
                $examresult ->user_id = $request->user;
                $examresult ->unit_id =$request->unit;
                $examresult ->student_id =$student_id;
                $examresult ->marks =$marks;
                $examresult->save();
                return redirect()->back()->with("message", "Marks saved successfully");

            }
        }
        else{
            return redirect()->back()->with("error", "Some fields are missing");
        }
    }
    public function editResult(){
        $data["courses"] = Courses::where("status",[0])->get();
        return view("admin.exam.edit", $data);
    }
    public function fetchMarks(Request $request){
        $course = $request->course;
        $unit = $request->unit;
        $students = User::_adminfetchStudentResults($unit, $course);
        return $students;

    }
    public function updateResult(Request $request){
        $studentIds = $request->student_id;
        $unit =$request->unit;
        $course =$request->course;
        ExamResult::where("courses_id", $course)->where("unit_id", $unit)->delete();
        if($studentIds && $course && $unit){
        for($i = 0; $i < count($studentIds); $i ++){
        $examresult = new ExamResult();
        $examresult ->courses_id =$request->course;
        $examresult ->student_id = $request->student_id[$i];
        $examresult ->user_id = $request->user_id[$i];
        $examresult ->unit_id =$request->unit;
        $examresult ->marks =$request->marks[$i];
        $examresult->save();
        }
        return redirect()->back()->with("message", "Marks updated successfully");
        }
        else{
        return redirect()->back()->with("error", "Some fields are missing");
        }
    }
}
