<?php

namespace App\Http\Controllers;

use App\Classes\BankTransactionDetails;
use App\Imports\UsersImport;
use App\Models\BankTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;


class PluspeController extends Controller
{
    public function excelParse()
    {
        $transaction_array = Excel::toArray(new UsersImport, "D:/Pluspe.xlsx");
        $accountNumber = null;
        $ifscCode = null;
        if (isset($transaction_array) && !empty($transaction_array) && count($transaction_array) > 0) {
            if (isset($transaction_array[0][1][0]) && !empty($transaction_array[0][1][0])) {
                $accountString = $transaction_array[0][1][0];
                $explode = explode(" ", $accountString);
//                dd($explode);
                if (isset($explode) && !empty($explode) && count($explode) > 0) {
                    $accountNumber = isset($explode[2]) ? str_replace(',', '', $explode[2]) : null;
                }
            }
        }
        $bank_records_Arr = array();
//        dd($transaction_array[0]);
        foreach ($transaction_array[0] as $txn) {

//            dd($transaction_array[0]);
            if (isset($txn[4])){
//                dd($txn[4]);
                if (is_numeric((float)trim($txn[4])) && empty(trim($txn[5]))) {
//                    dd($txn[4]);
                    $amount = (float)$txn[4];
//                    dd($amount);
                    $utrInfo = null;

// Use $txn[2] directly in preg_match
                    preg_match('/UPI\/(\d+)\/CR\//', $txn[2], $utrdata);

                    if (isset($utrdata[1])) {
                        // Extracted UTR value
                        $utrInfo = $utrdata[1];
                    }


                    $bankrecords = new BankTransactionDetails();
                        $bankrecords->account_number = $accountNumber;
                        $bankrecords->payment_utr = $utrInfo;
                        $bankrecords->utr_number = $utrInfo;
                        $bankrecords->amount = trim($amount);
                        $bankrecords->bank_name = "Pluspe";
                        $bankrecords->payment_mode = "UPI";
                        $bankrecords->account_number_desc = trim($txn[2]);
                        $bankrecords->received_from = trim($txn[2]);
                        $bankrecords->created_at = Carbon::now()->toDateTimeString();
                        $bankrecords->transaction_date = Carbon::now()->toDateTimeString();

                    $bank_records_Arr[] = $bankrecords;
                }
            }
        }
        return Response::json(['data' => $bank_records_Arr]);
    }
}
