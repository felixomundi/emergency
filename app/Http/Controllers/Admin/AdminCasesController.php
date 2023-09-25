<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cases;
use Illuminate\Http\Request;

class AdminCasesController extends Controller
{
    public function index(){
        $data["cases"] = Cases::all();
        return view("admin.cases.index" , $data);
    }
    public function edit($id){
        $case = Cases::find($id);
        if($case){
            return view("admin.cases.edit" , compact("case"));
        }else{
            return redirect("/admin/cases")->with("error", "Case Not Found");
        }
    }
    public function update($id, Request $request){
        $case = Cases::find($id);
        if($case){
            $case->update([
                "status"=>$request->status,
            ]);
            return redirect("/admin/cases")->with("success", "Case Updated Successfully");
        }else{
            return redirect("/admin/cases")->with("error", "Case Not Found");
        }
    }
    public function destroy($id){
        $case = Cases::find($id);
        if($case){
            $case->delete();
            return response()->json([
                "message"=>"Case Deleted",
                "status"=>200,
            ]);
        }else{
            return response()->json([
                "message"=>"Case Not Found",
                "status"=>404,
            ]);
        }
    }
    public function active(){        
        $data["cases"] = Cases::whereNot("status", "Completed")->get();      
        return view("admin.cases.active", $data);
    }
    public function completed(){
        $fdata = [           
            "status"=>"Completed",
        ];
        $data["cases"] = Cases::where($fdata)->get();
        return view("admin.cases.completed", $data);
    }

}
