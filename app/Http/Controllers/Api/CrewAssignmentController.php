<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CrewAssignment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Filament\Resources\CrewAssignmentResource\Pages\CreateCrewAssignment;

class CrewAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method get
        $crewAssignment = CrewAssignment::all();
        return response()->json([
            'status' => true,
            'massage' => 'data crewAssignment berhasil ditemukan',
            'data' => $crewAssignment
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
            'crew_id' => 'required',
            'status' => 'required',
            'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $crewAssignment = CrewAssignment::create($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data crewAssignment berhasil ditambahkan',
            'data' => $crewAssignment
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Detail di salah satu id
        $crewAssignment = CrewAssignment::findOrFail($id);
        return response()->json([
            'status' => true,
            'massage' => 'data crewAssignment berhasil ditemukan',
            'data' => $crewAssignment
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
            'crew_id' => 'required',
            'status' => 'required',
            'notes' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'validasi error',
                'errors' => $validator->errors()
            ], 422);
        }

        $crewAssignment = CrewAssignment::findOrFail($id);
        $crewAssignment->update($request->all());
        return response()->json([
            'status' => true,
            'massage' => 'data crewAssignment berhasil diupdate',
            'data' => $crewAssignment
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Method delete
        $crewAssignment = CrewAssignment::findOrFail($id);
        $crewAssignment->delete();
        return response()->json([
            'status'=>true,
            'massage'=>'data crewAssignment berhasil dihapus'
        ], 204);
    }
}
