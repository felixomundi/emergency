<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Helpers\Mpesa;
use App\Models\Billing;
use App\Models\Courses;
use App\Models\FeeStructure;
use Illuminate\Http\Request;
use App\Models\PaymentReceipt;
use App\Models\PartialFeesPayments;
use App\Http\Controllers\Controller;

class FullFeesPaymentController extends Controller
{
        public function index()
            {
                $data["feepayments"] = PaymentReceipt::all();
                return view("admin.fees.payments.index", $data);
        }
        public function create(){
            $data["courses"] = Courses::where("status",[0])->get();
            return view("admin.fees.payments.create", $data);

        }
        public function payment_detail($invoice){
            $billing = Billing::find($invoice);
                if($billing){
                    $payments = PaymentReceipt::where("billing_id", $billing->id)->get();
                    return view("admin.fees.payments.detail", compact("payments"));
                }
                else{
               return  redirect("/admin/full_payments")->with("error", "Invoice Not Found");

                }
        }
        public function print_receipt($invoice){
            $billing = Billing::find($invoice);
            if($billing){
                $payments = PaymentReceipt::where("billing_id", $billing->id)->get();
                // return view("admin.fees.payments.print", compact("payments"));
                return view("commons.fullpayment.print", compact("payments"));
            }
            else{
                return redirect("/admin/full_payments")->with("error", "Invoice Not Found");
            }
        }
        public function delete($id){
            $payment = PaymentReceipt::find($id);
            if($payment){
                $payment->delete();
                return redirect("/admin/full_payments")->with("success","Payment deleted successfully");
            }
            else{
                return redirect("/admin/full_payments")->with("error","Payment Not Found");
            }

        }

        public function store(Request $request){
            $bill = $request->bill_id;
            $payment_mode = $request->payment_mode;
            if($bill){
                $billing = Billing::find($bill);
                if($billing){
                    $billId = $billing->id;
                    $data = ["user_id" => $request->user, "courses_id" => $request->course, "billing_id" => $billId ];
                    // check if payment exist in complete table
                    $partlyPaid  = PartialFeesPayments::where($data)->first();
                    if(!$partlyPaid){
                    $already_paid = PaymentReceipt::where($data)->first();
                    if(!$already_paid){
                        if($payment_mode == "Cheque"){
                        PaymentReceipt::create([
                        "user_id"=>$request->user,
                        "courses_id"=>$request->course,
                        "total_fees"=>$request->total_fees,
                        "amount_paid"=>$request->amount_paid,
                        "balance"=>$request->balance,
                        "remarks"=>$request->remarks,
                        "payment_date"=>$request->payment_date,
                        "payment_mode"=>$payment_mode,
                        "status" => 1,
                        "served_by"=>auth()->user()->id,
                        "reference_number"=> $request->reference_number,
                        "billing_id"=>$billId,
                        "sales_receipt_no" =>  uniqid(),
                        ]);
                        return response()->json([
                        "status"=>200,
                        "message"=>"Payment Record added successfully"
                        ]);

                        }
                         //  paybill mode of  payment
                        else if($payment_mode == "Paybill") {
                            PaymentReceipt::create([
                                "user_id"=>$request->user,
                                "courses_id"=>$request->course,
                                "total_fees"=>$request->total_fees,
                                "amount_paid"=>$request->amount_paid,
                                "balance"=>$request->balance,
                                "remarks"=>$request->remarks,
                                "payment_date"=>$request->payment_date,
                                "payment_mode"=>$payment_mode,
                                "status" => 1,
                                "served_by"=>auth()->user()->id,
                                "reference_number"=> $request->m_reference_number,
                                "billing_id"=>$billId,
                                "sales_receipt_no" =>  uniqid(),
                                "phone_number"=>$request->phone_number,
                                ]);
                                return response()->json([
                                "status"=>200,
                                "message"=>"Payment Record added successfully"
                                ]);
                        }
                         //  mpesa mode of  payment
                        else if($payment_mode == "Mpesa"){
                        $user_id = $request->user;
                        $courses_id = $request->course;
                        $total_fees = $request->total_fees;
                        $balance = $request->balance;
                        $remarks = $request->remarks;
                        $amount_paid = $request->amount_paid;
                        $payment_date = $request->payment_date;
                        $served_by = auth()->user()->id;
                        $billing_id = $billId;
                        $sales_receipt_no =  uniqid();
                        $phone_number = $request->stk_phone_number;

                        // receive stk prompt
                        $amount = 1;
                        $partyA = 254745566505;
                        $phoneNumber = 254745566505;
                        $account_reference = "Kadesea Agency";
                        $transaction_description ="Pay Full School Fees";

                         $mpesa  = new Mpesa();
                         $response  = $mpesa->initializeStkPush($amount, $partyA, $phoneNumber,$account_reference,$transaction_description);
                        //  return $response;
                        $rescode = $response->ResponseCode;
                        if($rescode == 0){
                            $merchantId = $response->MerchantRequestID;
                            $checkoutId = $response->CheckoutRequestID;
                            $customerMessage = $response->CustomerMessage;

                            $payment = new PaymentReceipt();
                            $payment->phone_number = $phoneNumber;
                            $payment->amount_paid = $amount;
                            $payment->reference_number = $account_reference;
                            $payment->remarks =$remarks;
                            $payment->description = $transaction_description;
                            $payment->MerchantRequestID = $merchantId;
                            $payment->CheckoutRequestID = $checkoutId;
                            $payment->status = "Requested";

                            // other fields
                            $payment->user_id = $user_id;
                            $payment->courses_id = $courses_id;
                            $payment->total_fees = $total_fees;
                            $payment->balance = $balance;
                            $payment->payment_mode = $payment_mode;
                            $payment->served_by = $served_by;
                            $payment->billing_id = $billing_id;
                            $payment->sales_receipt_no =$sales_receipt_no;
                            $payment->payment_date = $payment_date;
                            $payment ->save();
                            return response()->json([
                                "status"=> 200,
                                "message" =>$customerMessage,
                                "checkoutId"=>$checkoutId,
                            ]);
                        }
                        // return an error message from mpesa
                        else
                        {

                        }

                        }

                      }
                      else{
                       // throw an error if the payment already exist
                       return response()->json([
                        "status"=>400,
                        "message"=> "Payment Already Exist",
                       ]);
                      }

                     }
                     else{
                      return response()->json([
                        "status"=>400,
                        "message"=> "Payment Already Exist",
                       ]);

                    }

                    }

                     else{
                        return response()->json([
                            "status" =>404,
                            "message" => "Billing Not Found",
                        ]);

                    }
                }


        }

}
