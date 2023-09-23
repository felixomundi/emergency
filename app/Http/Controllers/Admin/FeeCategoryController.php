<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeesCategoryRequest;
use App\Models\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees_categories= FeeCategory::all();
        return view("admin.fees_category.index", compact("fees_categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.fees_category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeesCategoryRequest $request)
    {
        $name = $request->name;
        $fees = new FeeCategory();
        $fees->name = $name;
        $fees->user_id = auth()->user()->id;
        $fees->save();
        return redirect()->back()->with("success", "Fees Category Saved Successfully");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FeeCategory $feeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fee_category = FeeCategory::find($id);
        if($fee_category){
            return view("admin.fees_category.edit", compact("fee_category"));
        }
        else{
            return redirect()->back()->with("error", "Fee Category Not Found");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(FeesCategoryRequest $request)
            {
        $fee = FeeCategory::find($request->fee_category);
        if($fee){
            $fee->update([
                "name"=> $request-> name,
            ]);
            return redirect()->back()->with("success", "Fee Category Updated Successfully");
        }
        else{
            return redirect()->back()->with("error", "Fee Category Not Found");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FeeCategory::destroy($id);
        return redirect()->back()->with("success", "Fee Category Deleted Successfully");
    }
}
