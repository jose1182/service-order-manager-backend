<?php

namespace App\Http\Controllers\Api;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Imports\CustomerOrdersImport;
use App\Http\Resources\ServiceOrderResource;

class CustomerOrdersController extends Controller
{

    public function index(){

        if (Gate::allows('view-admin-dashboard')) {
            return new ServiceOrderResource(Auth::user());
        }
    }

    public function import(Request $request){



        $path = $request->file('file');
        $import = new CustomerOrdersImport();
        $import->import($path);

        //dd($import->errors());
        if ($import->failures()->isNotEmpty()) {
            return response()->json([
                'message' => 'Import Error',
                'errors' => $import->failures()
            ]);
        }

        return response()->json([
            'message' => 'Successfully'
        ]);
    }
}
