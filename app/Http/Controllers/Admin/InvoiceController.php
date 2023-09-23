<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Billing;
use App\Models\Courses;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function manage_billings(){
        $data["billings"] = Billing::all();
        return view("admin.fees.bills.billed", $data);
    }

    public function viewbill($id){
        $billed = Billing::find($id);
        if($billed){
            return view("admin.fees.bills.view", compact("billed"));
        }else{
            return redirect("/admin/manage_billings")->with("error", "The Above Student Fees Bill Not Found");
        }
    }

    public function printbill($billId){
        $billed = Billing::find($billId);
        if($billed){
            // return view("admin.fees.bills.print", compact("billed"));
            return view("commons.invoices.print", compact("billed"));
        }else{
            return redirect("/admin/manage_billings")->with("error", "The Above Student Fees Bill Not Found");
        }
    }

    public function admingetstudentsbycourseId($id){
        $users = User::adminfetchStudentsByCourse($id);
        return $users;
    }
    public function totalfees($id){
            $sum = FeeStructure::where("courses_id", [$id])->sum('amount');
            return $sum;
    }



    public function billStudent(){
        $data["courses"] = Courses::where("status",[0])->get();
        return view("admin.fees.bills.bill", $data);
    }
    public function storeBill(Request $request){
        $user_id = $request->user;
        $courseId = $request->course;
        $total_fees =  $request->total_fees;
        $remarks =  $request->remarks;
        $billing_date = $request->billing_date;
        $user = User::find($user_id);
        $course = Courses::find($courseId);
        $net_days =$request->net_days;
        $due_date = $request->due_date;
        if($user && $course){
            $billed = Billing::where("user_id", $user->id)->where("courses_id", $course->id)->first();
            if($billed){
                return response()->json([
                    "status"=>400,
                    "message"=> "$user->name is Already Billed",
                    ]);
            }
            else{
                $billing = new Billing();
                $billing ->user_id = $user->id;
                $billing->courses_id =$course->id;
                $billing->total_fees =$total_fees;
                $billing->remarks =$remarks;
                $billing->billing_date = $billing_date;
                $billing->served_by=auth()->user()->id;
                $billing->net_days = $net_days;
                $billing->due_date = $due_date;
                $billing->save();
                return response()->json([
                "status"=>200,
                "message"=> " $user->name Billed successfully",
                ]);
            }

        }
         else{
            return response()->json(
                [ "status"=> 404,
                 "message" => "User or Course Not Found",]
            );
        }
    }
    public function amountBilled($courseId, $userId){
        $data = ["courses_id"=>$courseId, "user_id" => $userId];
        $billed = Billing::where($data)->first();
        if($billed){
            $total_fees = $billed->total_fees;
            $bill_id = $billed->id;
            return response()->json([
                "status"=>200,
                "message"=>[$total_fees, $bill_id],
            ]);
        }
        else{
            return response()->json([
                "status"=>404,
                "message"=> ["Student Not billed", ""],
            ]);

        }
    }
    public function deleteInvoice($id){
        $billing = Billing::find($id);
        if($billing){
            $billing->delete();
            return response()->json([
                "status"=>200,
                "message"=> ["Invoice Deleted Successfully"],
            ]);

        }else{
            return response()->json([
                "status"=>404,
                "message"=> ["Invoice Not Found"],
            ]);
        }
    }



}
