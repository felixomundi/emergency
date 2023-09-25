<?php

namespace App\Http\Controllers\CommonUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\CasesFormRequest;
use App\Models\Cases;
use App\Models\County;
use App\Models\SubCounty;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    public function index(){
        $data["cases"] = Cases::where("user_id", auth()->user()->id)->get();
        return view("user.cases.index", $data);
    }
    public function create(){
        $counties = County::all();
        return view("user.cases.create", compact("counties"));
    }
    public function getSubcountiesByCountyId($id){
        $data["subcounties"] = SubCounty::where("county_id", $id)->get();
        return $data;
    }
    public function store(CasesFormRequest $request){
        Cases::create([
            "user_id"=>auth()->user()->id,
            "sub_county_id"=>$request->sub_county,
            "status"=>"Reported",
            "title"=>$request->title,
            "message"=>$request->message_case,
        ]);
        return redirect("/user/cases")->with("success", "Case Reported Successfully");
    }
    public function active(){
        $fdata = [
            "user_id"=>auth()->user()->id,            
        ];
        $data["cases"] = Cases::where($fdata)->whereNot("status", "Completed")->get();      
        return view("user.cases.active", $data);
    }
    public function completed(){
        $fdata = [
            "user_id"=>auth()->user()->id,
            "status"=>"Completed",
        ];
        $data["cases"] = Cases::where($fdata)->get();
        return view("user.cases.completed", $data);
    }
}
