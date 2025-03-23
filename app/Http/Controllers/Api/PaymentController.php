<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::all();
        return response()->json([
            'status' => true,
            'massage' => 'data payment berhasil ditemukan',
            'data' => $payment
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Method post
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'payment_id' => 'required',
            'amount' => 'required',
            'payment_type' => 'required',
            'status' => 'required',
            'payment_details' => 'required',
            'paid_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $payment = Payment::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data payment berhasil ditambahkan',
            'data' => $payment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail di salah satu id
        $payment = Payment::findOrFail($id);
        return response()->json([
            'status' => true,
            'massage' => 'data payment berhasil ditemukan',
            'data' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Method put
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'payment_id' => 'required',
            'amount' => 'required',
            'payment_type' => 'required',
            'status' => 'required',
            'payment_details' => 'required',
            'paid_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data payment berhasil diupdate',
            'data' => $payment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method delete
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return response()->json([
            'status'=>true,
            'massage'=>'data payment berhasil dihapus'
        ], 204);
    }
}
