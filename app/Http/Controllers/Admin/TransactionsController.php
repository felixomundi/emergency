<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\PartialFeesPayments;
use App\Models\PaymentReceipt;

class TransactionsController extends Controller
{
    public function index(){
        $amountbilled = Billing::sum("total_fees");
        $amountbilled = number_format($amountbilled, 2);
        $totalpartialpayment = number_format((PartialFeesPayments::sum("amount_paid")),2);
        $totalfullpayment = number_format((PaymentReceipt::sum("amount_paid")),2);
        return view("admin.transactions.index", compact("amountbilled","totalpartialpayment","totalfullpayment"));
    }
}
