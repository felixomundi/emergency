<?php

namespace App\Models;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentReceipt extends Model
{
    use HasFactory;
    protected $table = "payment_receipts";
    protected $fillable = [
        "user_id",
        "courses_id",
        "total_fees",
        "amount_paid",
        "balance",
        "remarks",
        "payment_date",
        "payment_mode",
        "status",
        "served_by",
        "reference_number",
        "billing_id",
        "sales_receipt_no",
        "phone_number",

        "description",
        "MerchantRequestID",
        "CheckoutRequestID",
        "ResultDesc",
        "MpesaReceiptNumber",
        "TransactionDate",


    ];
    public function user(){
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function course(){
        return $this->belongsTo(Courses::class, "courses_id", "id");
    }
    public function server(){
        return $this->belongsTo(User::class, "served_by", "id");
    }

}
