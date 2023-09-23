<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionsFormRequest;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    public function index(){
        $positions = Position::all();
        return view("admin.positions.index", compact("positions"));
    }
    public function create(){
        $departments = Department::where("status", 0)->get();
        return view("admin.positions.create", compact("departments"));
    }
    public function store(PositionsFormRequest $request){
        $data = ["department_id"=>$request->department_id, "name" =>$request->name];
        $exist = Position::where($data)->first();
        if($exist){
            return redirect("/admin/positions")->with("error", "Data ALready Exists");
        }else{
            Position::create([
                "name"=>$request->name,
                "status"=>$request->status,
                "department_id"=>$request->department_id,
            ]);
            return redirect("/admin/positions")->with("success", "Position Saved Successfully");
        }

    }
    public function edit($id){
        $position = Position::find($id);
        if($position){
            $departments = Department::where("status", 0)->get();
            return view("admin.positions.edit", compact("position", "departments"));
        }
        else{
            return redirect("/admin/positions")->with("error", "Position Not Found");
        }
    }
    public function update(PositionsFormRequest $request, $id){
       $department = Department::find($request->department_id);
       if($department){
        $position = Position::where("department_id", $request->pos_dep_id)->where("id", $id)->first();
       if($position){
        $position->update([
            "name"=>$request->name,
            "status"=>$request->status,
            "department_id"=>$request->department_id,
        ]);
        return redirect("/admin/positions")->with("success", "Position Updated Successfully");

       }else{
        return redirect("/admin/positions")->with("error", "Position Not Found");
       }

       }
       else{
        return redirect("/admin/positions")->with("error", "Department Not Found");
    }
    }
}
