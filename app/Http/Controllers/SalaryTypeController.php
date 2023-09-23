<?php

namespace App\Http\Controllers;

use App\Models\SalaryType;
use Illuminate\Http\Request;
use App\Http\Requests\SalaryTypeFormRequest;

class SalaryTypeController extends Controller
{
    public function index(){
        $types = SalaryType::all();
        return view("admin.salary.types.index", compact("types"));
    }
    public function create(){
        return view("admin.salary.types.create");
    }
    public function store(SalaryTypeFormRequest $request){
        SalaryType::create([
            "title"=>$request->title,
        ]);
        return redirect("/admin/salary/types")->with("success", "Salary Type Saved Successfully");
    }
    public function edit($id){
       $type =  SalaryType::find($id);
       if($type){
        return view("admin.salary.types.edit", compact("type"));
      }else{
        return redirect("/admin/salary/types")->with("error", "Salary Type Not Found");
      }
    }
    public function update($id, SalaryTypeFormRequest $request){
        $type =  SalaryType::find($id);
        if($type){
         $type->update([
         "title"=>$request->title,
        ]);
        return redirect("/admin/salary/types")->with("success", "Salary Type Updated Successfully");
       }else{
         return redirect("/admin/salary/types")->with("error", "Salary Type Not Found");
       }
     }

}
