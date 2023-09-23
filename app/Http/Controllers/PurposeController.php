<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurposeFormRequest;
use App\Models\Purpose;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    public function index(){
        $data["purposes"] = Purpose::all();
        return view("admin.purpose.index", $data);
    }
    public function create(){
        return view("admin.purpose.create");
    }
    public function store(PurposeFormRequest $request){
       Purpose::create([
        "name"=>$request->name,
       ]);
       return redirect("/admin/purpose")->with("success", "Purpose Created Successfully");
    }
    public function edit($id){
        $purpose = Purpose::find($id);
        if($purpose){
            return view("admin.purpose.edit", compact("purpose"));
        }else{
            return redirect("/admin/purpose")->with("error", "Purpose Not Found");
        }
    }
    public function update(PurposeFormRequest $request, $id){
        $purpose = Purpose::find($id);
        if($purpose){
            $purpose->update([
                "name"=>$request->name,
            ]);
            return redirect("/admin/purpose")->with("success", "Purpose Updated Successfully");
        }else{
            return redirect("/admin/purpose")->with("error", "Purpose Not Found");
        }
     }

}
