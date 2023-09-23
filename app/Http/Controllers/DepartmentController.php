<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentsFormRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::all();
        return view("admin.departments.index", compact("departments"));
    }
    public function create(){

        return view("admin.departments.create");
    }
    public function store(DepartmentsFormRequest $request){
        Department::create([
            "name"=>$request->name,
            "status"=>$request->status,
        ]);
        return redirect("/admin/departments")->with("success","Department Created Successfully");

    }

    public function edit($id){
       $department = Department::find($id);
       if($department){
        return view("admin.departments.edit", compact("department"));
       }else{
          return redirect("/admin/departments")->with("error","Department Not Found");
        }
    }
    public function update(DepartmentsFormRequest $request, $id){
        $department = Department::find($id);
        if($department){
         $department->update([
            "name"=>$request->name,
            "status"=>$request->status,
        ]);
        return redirect("/admin/departments")->with("success","Department Updated Successfully");
        }else{
           return redirect("/admin/departments")->with("error","Department Not Found");
         }
     }
}
