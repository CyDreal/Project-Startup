<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method get
        $route = Route::all();
        return response()->json([
            'status' => true,
            'massage' => 'data route berhasil ditemukan',
            'data' => $route
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Method post
        $validator = Validator::make($request->all(), [
            'pickup_location' => 'required',
            'destination' => 'required',
            'distance' => 'required',
            'base_price' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $route = Route::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data route berhasil ditambahkan',
            'data' => $route
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail di salah satu id
        $route = Route::findOrFail($id);
        return response()->json([
            'status' => true,
            'massage' => 'data route berhasil ditemukan',
            'data' => $route
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Method put
        $validator = Validator::make($request->all(), [
            'pickup_location' => 'required',
            'destination' => 'required',
            'distance' => 'required',
            'base_price' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $route = Route::findOrFail($id);
        $route->update($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data route berhasil diupdate',
            'data' => $route
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method delete
        $route = Route::findOrFail($id);
        $route->delete();
        return response()->json([
            'status' => true,
            'massage' => 'data route berhasil dihapus'
        ], 204);
    }
}
