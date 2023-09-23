<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UsersDeduction;
use App\Http\Requests\UserDeductionFormRequest;

class UserDeductionController extends Controller
{
    public function index(){
        $deductions = UsersDeduction::all();
        return view("admin.deductions.index", compact("deductions"));
    }
    public function create(){
        $users = User::all();
        return view("admin.deductions.create", compact("users"));
    }
    public function store(UserDeductionFormRequest $request){

        $data = [
            "user_id"=>$request->user,
            "effective_date"=>$request->effective_date,
            "closing_date"=>$request->closing_date,
            "deduction_name"=>$request->deduction_name,
        ];
        $exist = UsersDeduction::where($data)->first();
        if(!$exist){
            UsersDeduction::create([
                "user_id"=>$request->user,
                "effective_date"=>$request->effective_date,
                "closing_date"=>$request->closing_date,
                "deduction_name"=>$request->deduction_name,
                "created_by"=>auth()->user()->id,
                "amount"=>$request->amount,
                "status"=>$request->status,
            ]);
            return redirect("/admin/user_deductions")->with("success", "Deduction Saved Successfully");
        }else{
            return redirect("/admin/user_deductions")->with("error", "Deduction Already Exist");
        }
    }
    public function edit($id){
        $deduction = UsersDeduction::find($id);
        if($deduction){
            return view("admin.deductions.edit", compact("deduction"));
        }else{
            return redirect("/admin/user_deductions")->with("error", "Deduction Not Found");
        }
    }
    public function update(UserDeductionFormRequest $request, $id){
        $deduction = UsersDeduction::find($id);
        if($deduction){
            $data =[
                 "deduction_name"=>$request->deduction_name,
                 "amount"=>$request->amount,
                 "status"=>$request->status,
            ];
            $deduction->update($data);
            return redirect("/admin/user_deductions")->with("success", "Deduction Updated Successfully");
        }else{
            return redirect("/admin/user_deductions")->with("error", "Deduction Not Found");
        }
    }

}
