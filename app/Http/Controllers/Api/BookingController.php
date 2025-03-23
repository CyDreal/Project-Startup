<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method get
        $booking = Booking::all();
        return response()->json([
            'status' => true,
            'massage' => 'data booking berhasil ditemukan',
            'data' => $booking
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Method post
        $validator = Validator::make($request->all(), [
            'customer_id'=>'required',
            'bus_id'=>'required',
            'booking_date'=>'required',
            'return_date'   => 'required',
            'total_seats'=>'required',
            'seat_type'=>'required',
            'pickup_location'=>'required',
            'destination'=>'required',
            'status'=>'required',
            'total_amount'  => 'required',
            'payment_status'=>'required',
            'payment_token',
            'snap_token',
            'special_requests',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $booking = Booking::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data booking berhasil ditambahkan',
            'data' => $booking
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail di salah satu id
        $booking = Booking::findOrFail($id);
        return response()->json([
            'status' => true,
            'massage' => 'data booking berhasil ditemukan',
            'data' => $booking
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Method put
        $validator = Validator::make($request->all(), [
            'customer_id'=>'required',
            'bus_id'=>'required',
            'booking_date'=>'required',
            'return_date'   => 'required',
            'total_seats'=>'required',
            'seat_type'=>'required',
            'pickup_location'=>'required',
            'destination'=>'required',
            'status'=>'required',
            'total_amount'  => 'required',
            'payment_status'=>'required',
            'payment_token',
            'snap_token',
            'special_requests',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data booking berhasil diupdate',
            'data' => $booking
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method delete
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return response()->json([
            'status'=>true,
            'massage'=>'data booking berhasil dihapus'
        ], 204);
    }
}
