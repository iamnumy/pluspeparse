<?php

namespace App\Classes;

class BankTransactionDetails
{
    public  $utr_number;
    public  $amount;
    public  $transaction_date;
    public  $account_number=null;
    public  $ifsc_code;
    public  $account_number_desc;
    public  $bank_name;
    public  $received_from=null;
    public  $created_at="-";
    public  $payment_mode=null;
    public  $payment_utr=null;
    public  $upi_id=null;
    public  $is_validate=false;
    public  $mobile_no=null;
    public  $transaction_id=null;
}
