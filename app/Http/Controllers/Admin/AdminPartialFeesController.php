<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\Mpesa;
use App\Models\Billing;
use App\Models\Courses;
use App\Models\PaymentReceipt;
use App\Models\PartialFeesPayments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPartialFeesController extends Controller
{
    public function partialPayments(){
        $data["feepayments"] = PartialFeesPayments::all();
        return view("admin.fees.partial_payments.index", $data);
    }
    public function create(){
        $data["courses"] = Courses::where("status",[0])->get();
        return view("admin.fees.partial_payments.create", $data);
    }
    public function store(Request $request){
        $bill = Billing::find($request->bill_id);
        $payment_mode = $request->payment_mode;
        if($bill){
            $data = ["user_id" => $request->user, "courses_id" => $request->course, "billing_id" =>$bill->id ];

            // check if payment already recorded in full paid table
            $paymentCompleted = PaymentReceipt::where($data)->first();
            if(!$paymentCompleted)
            {
            $payexist = PartialFeesPayments::where($data)->first();
            if($payexist){
            return response()->json([
            "status"=>400,
            "message"=> "Payment Already Exists Go Update",
            ]);

            }
            else{
                if($payment_mode == "Cheque"){
                    PartialFeesPayments::create([
                    "user_id"=>$request->user,
                    "courses_id"=>$request->course,
                    "total_fees"=>$request->total_fees,
                    "amount_paid"=>$request->amount_paid,
                    "balance"=>$request->balance,
                    "remarks"=>$request->remarks,
                    "payment_date"=>$request->payment_date,
                    "payment_mode"=>$request->payment_mode,
                    "status" => "Partly Paid",
                    "served_by"=>auth()->user()->id,
                    "reference_number"=> $request->reference_number,
                    "net_days" =>$request->net_days,
                    "due_date"=>$request->due_date,
                    "billing_id"=>$bill->id,
                    ]);
                    return response()->json([
                        "status"=>200,
                        "message"=>"Payment Record added successfully"
                    ]);

                    }


                    // paybill
                    else if($payment_mode == "Paybill"){

                        PartialFeesPayments::create([
                            "user_id"=>$request->user,
                            "courses_id"=>$request->course,
                            "total_fees"=>$request->total_fees,
                            "amount_paid"=>$request->amount_paid,
                            "balance"=>$request->balance,
                            "remarks"=>$request->remarks,
                            "payment_date"=>$request->payment_date,
                            "payment_mode"=>$request->payment_mode,
                            "status" => "Partly Paid",
                            "served_by"=>auth()->user()->id,
                            "reference_number"=> $request->m_reference_number,
                            "net_days" =>$request->net_days,
                            "due_date"=>$request->due_date,
                            "billing_id"=>$bill->id,
                            "phone_number"=>$request->phone_number,
                            ]);
                            return response()->json([
                                "status"=>200,
                                "message"=>"Payment Record added successfully"
                            ]);

                    }
                    // mpesa

                    else if($payment_mode == "Mpesa"){
                        $user_id = $request->user;
                        $courses_id = $request->course;
                        $total_fees = $request->total_fees;
                        $balance = $request->balance;
                        $remarks = $request->remarks;
                        $amount_paid = $request->amount_paid;
                        $payment_date = $request->payment_date;
                        $served_by = auth()->user()->id;
                        $billing_id = $bill->id;
                        $phone_number = $request->stk_phone_number;
                        $due_date =  $request->due_date;
                        $net_days =  $request->net_days;

                        // receive stk prompt
                        $amount = 1;
                        $partyA = 254745566505;
                        $phoneNumber = 254745566505;
                        $account_reference = "Kadesea Agency";
                        $transaction_description ="Pay Partial School Fees";

                        $mpesa  = new Mpesa();
                        $response  = $mpesa->initializeStkPush($amount, $partyA, $phoneNumber, $account_reference, $transaction_description);
                       //  return $response;
                       $rescode = $response->ResponseCode;
                       if($rescode == 0){
                        $merchantId = $response->MerchantRequestID;
                        $checkoutId = $response->CheckoutRequestID;
                        $customerMessage = $response->CustomerMessage;

                        $partial_payment = new PartialFeesPayments();
                        $partial_payment->phone_number = $phoneNumber;
                        $partial_payment->amount_paid = $amount;
                        $partial_payment->reference_number = $account_reference;
                        $partial_payment->remarks =$remarks;
                        $partial_payment->description = $transaction_description;
                        $partial_payment->MerchantRequestID = $merchantId;
                        $partial_payment->CheckoutRequestID = $checkoutId;
                        $partial_payment->status = "Requested";

                        // other fields
                        $partial_payment->user_id = $user_id;
                        $partial_payment->courses_id = $courses_id;
                        $partial_payment->total_fees = $total_fees;
                        $partial_payment->balance = $balance;
                        $partial_payment->payment_mode = $payment_mode;
                        $partial_payment->served_by = $served_by;
                        $partial_payment->billing_id = $billing_id;
                        $partial_payment->payment_date = $payment_date;
                        $partial_payment ->due_date = $due_date;
                        $partial_payment->net_days = $net_days;

                        $partial_payment ->save();
                        return response()->json([
                            "status"=> 200,
                            "message" =>$customerMessage,
                        ]);
                    }
                    // return an error message from mpesa
                    else
                    {

                    }



                    }

                    // any other mode of payment
            }
            }
            else{
                return response()->json([
                    "status"=>400,
                    "message"=>"This payment is already made",
                ]);

            }

          }

            else{
                return response()->json([
                    "status"=>404,
                    "message"=>"An error has occured",
                ]);

            }
    }
    public function delete($id){
        $payment = PartialFeesPayments::find($id);
        if($payment){
            $payment->delete();
            return redirect("/admin/partial_payments")->with("success", "Partial Payment Deleted Successfully");
        }
        return redirect("/admin/partial_payments")->with("error", "Partial Payment Not Found");

    }
    public function print_receipt($invoice, $id){
        $billing = Billing::find($invoice);
        if($billing){
            $data = ["id"=>$id, "billing_id" => $billing->id];
            $payment = PartialFeesPayments::where($data)->first();
            if($payment){
            // return view("admin.fees.partial_payments.print", compact("payment"));
            return view("commons.partialpayment.print", compact("payment"));
            }else{
                return redirect("/admin/partial_payments")->with("error", "Fees payment Not Found");
            }
        }
        else{
            return redirect("/admin/partial_payments")->with("error", "Invoice Not Found");
        }
    }
    public function edit(){
        $data["courses"] = Courses::where("status",[0])->get();
        return view("admin.fees.partial_payments.edit", $data);
    }
    public function amountPaid($billId, $userId, $courseId){
        $data = ["billing_id" =>$billId, "user_id"=>$userId,"courses_id" => $courseId];
        $amountpaid = PartialFeesPayments::where($data)->sum("amount_paid");
        return response()->json([
            "status"=>200,
            "message"=>$amountpaid
        ]);
    }
    public function update(Request $request){
        $bill = Billing::find($request->bill_id);
        $payment_mode = $request->payment_mode;

        if($bill){
        $data = ["user_id" => $request->user, "courses_id" => $request->course, "billing_id" => $bill->id ];

        $paid_amount = PartialFeesPayments::where($data)->sum("amount_paid");
        //  check if payment cleared before save
        if($paid_amount == $bill->total_fees){
            return response()->json([
            "status"=>400,
            "message"=>"Payment Already Cleared",
            ]);
        }
        else{

        if($payment_mode == "Cheque"){
                $balance = $request->balance;
                $status = "";
                if($balance == "0" || $balance == "0.00"){
                    $status = "Completed";
                }
                else{
                    $status = "Partly Paid";
                }
                PartialFeesPayments::create([
                "user_id"=>$request->user,
                "courses_id"=>$request->course,
                "total_fees"=>$request->total_fees,
                "amount_paid"=>$request->amount,
                "balance"=>$request->balance,
                "remarks"=>$request->remarks,
                "payment_date"=>$request->payment_date,
                "payment_mode"=>$request->payment_mode,
                "status" => $status,
                "served_by"=>auth()->user()->id,
                "reference_number"=> $request->reference_number,
                "net_days" =>$request->net_days,
                "due_date"=>$request->due_date,
                "billing_id"=>$bill->id,
                ]);
                return response()->json([
                    "status"=>200,
                    "message"=>"Payment Record added successfully"
                ]);
                }
                // if payment mode is paybill
                else if($payment_mode == "Paybill"){
                    $balance = $request->balance;
                    $status = "";
                    if($balance == "0" || $balance == "0.00"){
                        $status = "Completed";
                    }
                    else{
                        $status = "Partly Paid";
                    }
                    PartialFeesPayments::create([
                        "user_id"=>$request->user,
                        "courses_id"=>$request->course,
                        "total_fees"=>$request->total_fees,
                        "amount_paid"=>$request->amount,
                        "balance"=>$request->balance,
                        "remarks"=>$request->remarks,
                        "payment_date"=>$request->payment_date,
                        "payment_mode"=>$request->payment_mode,
                        "status" => $status,
                        "served_by"=>auth()->user()->id,
                        "reference_number"=> $request->m_reference_number,
                        "net_days" =>$request->net_days,
                        "due_date"=>$request->due_date,
                        "billing_id"=>$bill->id,
                        "phone_number"=>$request->phone_number,
                        ]);
                        return response()->json([
                            "status"=>200,
                            "message"=>"Payment Record added successfully"
                        ]);
                }

                // if payment mode is mpesa
                else if($payment_mode == "Mpesa"){

                }
                }


                }
                // if no bill
                else{
                    return response()->json([
                        "status"=>404,
                        "message"=>"An error has occured",
                    ]);
                }
    }



}
