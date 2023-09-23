<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests\SubCountyFormRequest;
use App\Models\SubCounty;
use Illuminate\Http\Request;
use App\Models\County;
class SubCountyController extends Controller
{
   
    public function index()
    {
        $data["sub_counties"] = SubCounty::all();
        return view("admin.subcounties.index", $data);
    }

    public function create()
    {
        $data["counties"] = County::all();
        return view("admin.subcounties.create", $data);
    }
  
    public function store(SubCountyFormRequest $request)
    {
        $data = [ "name"=>$request->name,
        "county_id"=>$request->county,];
        
        $subCounty = SubCounty::where($data)->first();
        if($subCounty){
            return redirect("/admin/sub-counties")->with("error", "Sub County Already Exist");
        }else{
            SubCounty::create([
                "name"=>$request->name,
                "county_id"=>$request->county,
            ]);
            return redirect("/admin/sub-counties")->with("success", "Sub County created successfully");
        }
    }
  
    public function show(SubCounty $subCounty)
    {
        //
    }
   
    public function edit($id)
    {
       $subcounty =SubCounty::find($id);
       if($subcounty){
        return view("admin.subcounties.edit",compact("subcounty") );
       }else{
        return redirect("/admin/subcounties")->with("error", "Sub County Not Found");
       }
       
    }

  
    public function update(SubCountyFormRequest $request, $id)
    {
        $subcounty =SubCounty::find($id);
        if($subcounty){
            $subcounty->update([
                "name"=>$request->name,
            ]);
            return redirect("/admin/sub-counties")->with("success", "Sub County updated successfully");
        }else{
             return redirect("/admin/subcounties")->with("error", "Sub County Not Found");
        }
    }

   
    public function destroy(SubCounty $subCounty)
    {
        //
    }
}
