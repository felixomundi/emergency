<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaOfWorkFormRequest;
use App\Models\AreasOfWork;
use Illuminate\Http\Request;

class AreasofWorkController extends Controller
{
    public function index(){
        $areas = AreasOfWork::all();
        return view("admin.areas.index", compact("areas"));
    }
    public function create(){

        return view("admin.areas.create");
    }
    public function store(AreaOfWorkFormRequest $request){
        AreasOfWork::create([
            "name"=>$request->name,
            "status"=>$request->status,
        ]);
        return redirect("/admin/areas-of-work")->with("success","Area Of Work Created Successfully");

    }

    public function edit($id){
       $area = AreasOfWork::find($id);
       if($area){
        return view("admin.areas.edit", compact("area"));
       }else{
          return redirect("/admin/areas-of-work")->with("error","Area Of Work Not Found");
        }
    }
    public function update(AreaOfWorkFormRequest $request, $id){
        $area = AreasOfWork::find($id);
        if($area){
         $area->update([
            "name"=>$request->name,
            "status"=>$request->status,
        ]);
        return redirect("/admin/areas-of-work")->with("success","Area Of Work Updated Successfully");
        }else{
           return redirect("/admin/areas-of-work")->with("error","Area Of Work Not Found");
         }
     }

}
