<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersAdvance;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceFormRequest;
use App\Models\Purpose;

class UserAdvanceController extends Controller
{
    public function index() {
        $advances  = UsersAdvance::all();
        return view("admin.advance.index", compact("advances"));
    }
    public function create() {
        $data = [
            "status"=>0,
        ];
        $data["users"] = User::where($data)->get();
        $data["purposes"]= Purpose::all();
        return view("admin.advance.create", $data);
    }
    public function store(AdvanceFormRequest $request){
        $data = [
            "user_id"=>$request->user,
            "effective_date"=>$request->effective_date,
            "closing_date"=>$request->closing_date,
        ];
        $ae = UsersAdvance::where($data)->first();
        if(!$ae){
            UsersAdvance::create([
                "user_id"=>$request->user,
                "effective_date"=>$request->effective_date,
                "closing_date"=>$request->closing_date,
                "purpose_id"=>$request->purpose,
                "period"=>$request->period,
                "status"=>$request->status,
                "duration"=>$request->duration,
                "installment"=>$request->installment,
                "amount"=>$request->amount,
                "created_by"=>auth()->user()->id,
            ]);
            return redirect("/admin/advance")->with("success", "Advance Saved Successfully");
        }else{
            return redirect("/admin/advance")->with("error", "Advance within that period Exist");
        }

    }
    public function edit($id){
        $advance = UsersAdvance::find($id);
        if($advance){
            $data["advance"]=$advance;
            $data["purposes"]= Purpose::all();
            return view("admin.advance.edit", $data);
        }else{
            return redirect("/admin/advance")->with("error", "Advance Not Found");
        }
    }
    public function update(AdvanceFormRequest $request, $id){
        $advance = UsersAdvance::find($id);
        if($advance){
           $advance->update([
            "effective_date"=>$request->effective_date,
            "closing_date"=>$request->closing_date,
            "purpose_id"=>$request->purpose,
            "period"=>$request->period,
            "status"=>$request->status,
            "duration"=>$request->duration,
            "installment"=>$request->installment,
            "amount"=>$request->amount,
           ]);
           return redirect("/admin/advance")->with("success", "Advance Updated Successfully");
        }else{
            return redirect("/admin/advance")->with("error", "Advance Not Found");
        }

    }

}
