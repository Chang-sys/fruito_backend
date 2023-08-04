<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::all();

        if ($customer->count() > 0) {
            return response()->json([
                'status' => 200,
                'customer' => $customer
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Record Found!'
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|max:225',
            'phone_number' => 'required|digits:9',
            'house_number' => 'required|string|max:191',
            'province_city' => 'required|string|max:191',
            'country' => 'required|string|max:191',
            'postal_code' => 'required|digits_between:6,9'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            $customer = Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'house_number' => $request->house_number,
                'province_city' => $request->province_city,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
            ]);
            if ($customer) {
                return response()->json([
                    'status' => 200,
                    'message' => "Customer Created Successfully..."
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ], 500);
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json([
                'status' => 200,
                'customer' => $customer
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Customer with this ID was found!"
            ], 404);
        }
    }


    public function edit(int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json([
                'status' => 200,
                'customer' => $customer
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Customer with this ID was found!"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'email' => 'required|email|max:225',
            'phone_number' => 'required|digits:9',
            'house_number' => 'required|string|max:191',
            'province_city' => 'required|string|max:191',
            'country' => 'required|string|max:191',
            'postal_code' => 'required|digits_between:6,9'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            $customer = Customer::find($id);

            if ($customer) {
                $customer->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'house_number' => $request->house_number,
                    'province_city' => $request->province_city,
                    'country' => $request->country,
                    'postal_code' => $request->postal_code,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Customer Updated Successfully..."
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No Customer with this ID was found!"
                ], 404);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $customer = Customer::find($id);
        if ($customer) {

            $customer->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Customer Deleted Successfully...'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Customer with this ID was found!"
            ], 404);
        }
    }
}