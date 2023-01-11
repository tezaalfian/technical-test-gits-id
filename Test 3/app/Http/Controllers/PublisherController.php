<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublisherController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Publisher::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        try {
            $publisher = Publisher::create([
                'name' => $request->name
            ]);
            return response()->json([
                'data' => $publisher
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        return response()->json([
            'data' => Publisher::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        try {
            $publisher = Publisher::find($id);
            $publisher->name = $request->name;
            $publisher->save();
            return response()->json([
                'data' => $publisher
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Publisher::destroy($id);
            return response()->json([
                'message' => 'Publisher deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
