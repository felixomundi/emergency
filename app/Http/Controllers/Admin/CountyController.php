<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountyFormRequest;
use App\Models\County;
use Illuminate\Http\Request;
class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["counties"] = County::all();
        return view("admin.counties.index", $data);
    }
  
    public function create()
    {
        return view("admin.counties.create");
    }
  
    public function store(CountyFormRequest $request)
    {
        County::create([
            "name"=>$request->name,
        ]);
        return redirect("/admin/counties")->with("success", "County Created Successfully");
    }
   
    public function show(County $county)
    {
        //
    }
   
    public function edit($id)
    {
       $county = County::find($id);
       if($county){
            $data["county"] = $county;
        return view("admin.counties.edit", $data);
       }else{
            return redirect("/admin/counties")->with("error", "County Not Found");
       }
    }

    
    public function update(CountyFormRequest $request, County $county)
    {
        $county->update([
            "name" => $request->name,
        ]);
        return redirect("/admin/counties")->with("success", "County updated successfully");
    }

  
    public function destroy(County $county)
    {
        //
    }
}
