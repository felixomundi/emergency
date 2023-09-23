<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignUserSalaryFormRequest;
use App\Models\AreasOfWork;
use App\Models\Position;
use App\Models\SalaryType;
use App\Models\User;
use App\Models\UsersSalary;

class AssignUserSalariesController extends Controller
{
    public function index(){
        $salaries = UsersSalary::all();
        return view("admin.salary.manage.index", compact("salaries"));
    }
    public function create(){
        $data["users"] = User::where("status", 0)->get();
        $data["areas"] = AreasOfWork::where("status", 0)->get();
        $data["positions"] = Position::where("status", 0)->get();
        $data["types"] = SalaryType::all();
        return view("admin.salary.manage.create", $data);
    }
    public function store(AssignUserSalaryFormRequest $request){
        $data = [
        "salary_type_id" =>$request->salary_type_id,
        "user_id"=>$request->user_id,
        "position_id"=>$request->position_id,
        "areas_of_work_id" =>$request->areas_of_work_id,
        ];
        $salaryExist = UsersSalary::where($data)->first();
        if($salaryExist){
            return redirect("/admin/manage-salary")->with("error","Data Already Exist");
        }
        else{
            UsersSalary::create([
                "salary_type_id" =>$request->salary_type_id,
                "user_id"=>$request->user_id,
                "position_id"=>$request->position_id,
                "areas_of_work_id" =>$request->areas_of_work_id,
                "total"=>$request->total,
                "created_by"=>auth()->user()->id,
            ]);
            return redirect("/admin/manage-salary")->with("success","User salary saved successfully");
        }
    }
    public function edit($id){
        $salary = UsersSalary::find($id);
        if($salary){
            $data['salary'] = $salary;
            $data["areas"] = AreasOfWork::where("status", 0)->get();
            $data["positions"] = Position::where("status", 0)->get();
            $data["types"] = SalaryType::all();
            return view("admin.salary.manage.edit", $data);
        }else{
            return redirect("/admin/manage-salary")->with("error", "Salary Not Found");
        }
    }
    public function update(AssignUserSalaryFormRequest $request, $id){
        $salary = UsersSalary::find($id);
        if($salary){
            $user = User::find($request->user_id);
            if($user){
                $area = AreasOfWork::find($request->areas_of_work_id);
                if($area){
                    $salaryType = SalaryType::find($request->salary_type_id);
                    if($salaryType){
                        $position = Position::find($request->position_id);
                        if($position){
                            $data = [
                                "salary_type_id" =>$request->salary_type_id,
                                "user_id"=>$request->user_id,
                                "position_id"=>$request->position_id,
                                "areas_of_work_id" =>$request->areas_of_work_id,
                                ];
                           $salaryExist = UsersSalary::where($data)->first();
                           if($salaryExist){
                            return redirect("/admin/manage-salary")->with("error", "Salary Exist");
                           }
                           else{
                            $salary->update([
                                "salary_type_id" =>$request->salary_type_id,
                                "user_id"=>$request->user_id,
                                "position_id"=>$request->position_id,
                                "areas_of_work_id" =>$request->areas_of_work_id,
                                "total"=>$request->total,
                            ]);
                        return redirect("/admin/manage-salary")->with("success", "Salary Updated Successfully");
                           }
                        }else{
                        return redirect("/admin/manage-salary")->with("error", "Position Not Found");
                    }

                    } else{
                        return redirect("/admin/manage-salary")->with("error", "Salary Type Not Found");
                    }
                }else{
                return redirect("/admin/manage-salary")->with("error", "Area of Work Not Found");
            }

            }else{
                return redirect("/admin/manage-salary")->with("error", "User Not Found");
            }

        }else{
            return redirect("/admin/manage-salary")->with("error", "Salary Not Found");
        }

    }
}
