<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courses;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeStructureFormRequest;
use App\Models\FeeCategory;

class FeeStructureController extends Controller
{

    public function index()
      {
        $fee_categories = FeeCategory::all();
        return view("admin.fee_structure.index", compact("fee_categories"));
    }
    public function create()
      {
        $courses = Courses::where("status", [0])->get();
        $fee_categories = FeeCategory::all();
        return view("admin.fee_structure.create", compact('courses', 'fee_categories'));
    }
    public function store(FeeStructureFormRequest $request)
      {
        $feeStructure_exixts = FeeStructure::where("courses_id", $request->course)->where("fee_category", $request->fee_category)->first();
        if($feeStructure_exixts){
        $course = Courses::find($request->course);
        $fee_cat = FeeCategory::find($request->fee_category);
        if($course && $fee_cat ){
            $course_name =$course->title;
            $fee_cat_name = $fee_cat->name;
            return redirect()->back()->with("error", "Course '$course_name' has been assigned '$fee_cat_name' Fee Category go update");
        }
        else{
            return redirect()->back()->with("error", "Fee Cetegory or Course Not Found");
        }

        }else{
        $feeStructure =new FeeStructure();
        $feeStructure->user_id = auth()->user()->id;
        $feeStructure->courses_id = $request->course;
        $feeStructure->fee_category =$request->fee_category;
        $feeStructure->amount=round($request->amount,2);
        $feeStructure->save();
        return redirect()->back()->with("success", "Fee Structure Saved Successfully");
        }
    }

    public function edit($id)
      {
        $fee_cat = FeeCategory::find($id);
        if($fee_cat){
            $data["fee_category_name"] = $fee_cat->name;
            $data["fee_category_id"] = $fee_cat->id;
            $data["courses"] = Courses::where("status", [0])->get();
            $data["fees_structures"] = FeeStructure::where("fee_category", $id)->orderby("courses_id","desc")->get();
            return view("admin.fee_structure.edit" , $data);
        }
        else{
            return redirect()->back()->with("error", "Fee Category Not Found");
        }

    }
    public function update(Request $request)
     {
        $courses = $request->course;
        if($courses != ""){
         FeeStructure::where("fee_category", $request->fee_category_id )->delete();
         for($i = 0; $i <count($courses); $i ++){
            $feeStructure = new FeeStructure();
            $feeStructure ->courses_id = $request->course[$i];
            $feeStructure ->amount = round($request->amount[$i] , 2) ;
            $feeStructure ->user_id = auth()->user()->id;
            $feeStructure ->fee_category= $request->fee_category_id;
            $feeStructure->save();
           }
        }
        return redirect()->back()->with("success", "Fee Structure updated successfully");

    }
    public function destroy($id)
    {
        $data = FeeStructure::find($id);
        $data->delete();
        return response()->json([
            "status"=>200,
            "message"=>"Fees Structure Deleted Successfully"
        ]);
    }

    public function view_fee_structure()
      {
        $courses = Courses::where("status", 0)->get();
        return view("admin.fee_structure.courses", compact("courses"));
    }
    public function print_fee_structure($id){
        $course = Courses::find($id);
        if($course){
            $feestructure = FeeStructure::where("courses_id", $course->id)->first();
           if($feestructure){
            $feestructures = FeeStructure::where("courses_id", $course->id)->get();
            $sum = FeeStructure::where("courses_id", $course->id)->sum('amount');
            return view("commons.courses.fee-structure", compact("feestructures", "course", "sum"));

           }else{
            return redirect()->back()->with("error", "Course Does Not Have Fee Categories");
           }

        }else{
            return redirect()->back()->with("error", "Course Not Found");
        }

    }
}

