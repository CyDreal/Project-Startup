<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method get
        $bus = Bus::all();
        return response()->json([
            'status' => true,
            'massage' => 'data bus berhasil ditemukan',
            'data' => $bus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Method post
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'number_plate' => 'required',
            'description' => 'required',
            'default_seat_capacity' => 'required',
            'status' => 'required',
            'images',
            'pricing_type' => 'required',
            'price_per_day' => 'required',
            'price_per_km' => 'required',
            'legrest_price_per_seat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $bus = Bus::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data bus berhasil ditambahkan',
            'data' => $bus
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail di salah satu id
        $bus = Bus::findOrFail($id);
        return response()->json([
            'status' => true,
            'massage' => 'data bus berhasil ditemukan',
            'data' => $bus
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Method put
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'number_plate' => 'required',
            'description' => 'required',
            'default_seat_capacity' => 'required',
            'status' => 'required',
            'images',
            'pricing_type' => 'required',
            'price_per_day' => 'required',
            'price_per_km' => 'required',
            'legrest_price_per_seat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $bus = Bus::findOrFail($id);
        $bus->update($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data bus berhasil diupdate',
            'data' => $bus
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method delete
        $bus = Bus::findOrFail($id);
        $bus->delete();
        return response()->json([
            'status'=>true,
            'massage'=>'data bus berhasil dihapus'
        ], 204);
    }
}
