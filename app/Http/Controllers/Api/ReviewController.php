<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method get
        $review = Review::all();
        return response()->json([
            'status' => true,
            'massage' => 'data review berhasil ditemukan',
            'data' => $review
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
            'customer_id' => 'required',
            'rating' => 'required',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $review = Review::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data review berhasil ditambahkan',
            'data' => $review
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail di salah satu id
        $review = Review::findOrFail($id);
        return response()->json([
            'status' => true,
            'massage' => 'data review berhasil ditemukan',
            'data' => $review
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
            'customer_id' => 'required',
            'rating' => 'required',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $review = Review::findOrFail($id);
        $review->update($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data review berhasil diupdate',
            'data' => $review
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method delete
        $review = Review::findOrFail($id);
        $review->delete();
        return response()->json([
            'status' => true,
            'massage' => 'data review berhasil dihapus'
        ], 204);
    }
}
