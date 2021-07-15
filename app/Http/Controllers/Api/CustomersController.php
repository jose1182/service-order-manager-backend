<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\CustomerImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class CustomersController extends Controller
{
    public function import(Request $request) {
        $path = $request->file('file');

       //Excel::import(new CustomerImport, $path);

        (new CustomerImport)->import($path);

       return response()->json([
            'message' => 'import successfully',
            'file' => $path
        ]);
    }
}
