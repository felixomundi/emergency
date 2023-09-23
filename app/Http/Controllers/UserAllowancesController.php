<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAllowanceFormRequest;
use App\Http\Requests\UserAttendanceFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UsersAllowance;

class UserAllowancesController extends Controller
{
    public function index(){
        $allowances = UsersAllowance::all();
        return view("admin.allowances.index", compact("allowances"));
    }
    public function create(){
        $users = User::all();
        return view("admin.allowances.create", compact("users"));
    }
    public function store(UserAllowanceFormRequest $request){

        $data = [
            "user_id"=>$request->user,
            "effective_date"=>$request->effective_date,
            "closing_date"=>$request->closing_date,
            "allowance_name"=>$request->allowance_name,
        ];
        $exist = UsersAllowance::where($data)->first();
        if(!$exist){
            UsersAllowance::create([
                "user_id"=>$request->user,
                "effective_date"=>$request->effective_date,
                "closing_date"=>$request->closing_date,
                "allowance_name"=>$request->allowance_name,
                "created_by"=>auth()->user()->id,
                "amount"=>$request->amount,
                "status"=>$request->status,
            ]);
            return redirect("/admin/user_allowances")->with("success", "Allowance Saved Successfully");
        }else{
            return redirect("/admin/user_allowances")->with("error", "Allowance Already Exist");
        }
    }
    public function edit($id){
        $allowance = UsersAllowance::find($id);
        if($allowance){
            return view("admin.allowances.edit", compact("allowance"));
        }else{
            return redirect("/admin/user_allowances")->with("error", "Allowance Not Found");
        }
    }
    public function update(UserAllowanceFormRequest $request, $id){
        $allowance = UsersAllowance::find($id);
        if($allowance){
            $data =[
                 "allowance_name"=>$request->allowance_name,
                 "amount"=>$request->amount,
                 "status"=>$request->status,
            ];
            $allowance->update($data);
            return redirect("/admin/user_allowances")->with("success", "Allowance Updated Successfully");
        }else{
            return redirect("/admin/user_allowances")->with("error", "Allowance Not Found");
        }
    }

}
