<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {

        if ($request->hasFile('excelFile')) {
            $file = $request->file('excelFile');
            $disk = 'public';
            $filename = 'ePassbook'.'.'.$file->getClientOriginalExtension();

            if ($request->selectedBank == "pluspe") {
                $path = $file->storeAs('uploads/Pluspe', $filename, $disk);
                if ($file->getClientOriginalExtension() == "xlsx"){
                    $excelParse  = new PluspeController();
                    $excelParse->excelParse();
                }
            }

            return response()->json(['message' => 'Excel file uploaded successfully']);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }
    public function uploadCSV(Request $request)
    {
//        $request->validate([
//            'csv' => 'required|mimes:csv|max:2048',
//        ]);
        if ($request->hasFile('csvFile')) {
            $file = $request->file('csvFile');
            $disk = 'public';
            $filename = 'ePassbook'. '.' . $file->getClientOriginalExtension();

            if ($request->selectedBank == "pluspe") {
                    $file->storeAs('uploads/Pluspe/Csv', $filename, $disk);
                    $excelParse = new PluspeController();
                    $excelParse->csvParse();
                }

            return response()->json(['message' => 'CSV file uploaded successfully']);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }

}
