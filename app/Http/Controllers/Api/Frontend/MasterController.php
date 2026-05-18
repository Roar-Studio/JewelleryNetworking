<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\{Hash, Auth,Cache};
use Illuminate\Support\Str;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkValidUser(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:100',
            'data' => 'required|string|max:100',
        ]);

        $data = $request->data;

        if($request->type == 'username'){
            $dataExists = Customer::where('username', $data)->where('is_deleted', 0)->exists();
        }
        elseif($request->type == 'email'){
            $dataExists = Customer::where('email', $data)->where('is_deleted', 0)->exists();
        }
        elseif($request->type == 'mobile'){
            $dataExists = Customer::where('mobile_no', $data)->where('is_deleted', 0)->exists();
        }

        // Return response
        if ($dataExists) {
            return response()->json([
                'status' => false,
                'message' => ucfirst($request->type) .' already exists.',
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => ucfirst($request->type) .' is available.',
        ]);
    }
    public function detail()
    {
        return view('admin.manage.transaction_management.detail');
    }
}