<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SeatConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeatConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method get
        $seatConfiguration = SeatConfiguration::all();
        return response()->json([
            'status' => true,
            'massage' => 'data seatConfiguration berhasil ditemukan',
            'data' => $seatConfiguration
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Method post
        $validator = Validator::make($request->all(), [
            'bus_id' => 'required',
            'seat_type' => 'required',
            'number_of_seats' => 'required',
            'price_per_seat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $seatConfiguration = SeatConfiguration::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data seatConfiguration berhasil ditambahkan',
            'data' => $seatConfiguration
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail di salah satu id
        $seatConfiguration = SeatConfiguration::findOrFail($id);
        return response()->json([
            'status' => true,
            'massage' => 'data seatConfiguration berhasil ditemukan',
            'data' => $seatConfiguration
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Method put
        $validator = Validator::make($request->all(), [
            'bus_id' => 'required',
            'seat_type' => 'required',
            'number_of_seats' => 'required',
            'price_per_seat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $seatConfiguration = SeatConfiguration::findOrFail($id);
        $seatConfiguration->update($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data seatConfiguration berhasil diupdate',
            'data' => $seatConfiguration
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method delete
        $seatConfiguration = SeatConfiguration::findOrFail($id);
        $seatConfiguration->delete();
        return response()->json([
            'status' => true,
            'massage' => 'data seatConfiguration berhasil dihapus'
        ], 204);
    }
}
