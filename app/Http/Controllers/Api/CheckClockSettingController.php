<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckClockSetting;
use Illuminate\Http\Request;

class CheckClockSettingController extends Controller
{
    public function index()
    {
        $data = CheckClockSetting::query()->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List of check clock settings retrieved successfully.',
            'data' => $data->items(),
            'meta' => [
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'total' => $data->total(),
                'per_page' => $data->perPage(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|integer|min:1',
        ]);

        $setting = CheckClockSetting::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Check clock setting created successfully.',
            'data' => $setting,
        ], 201);
    }

    public function show(CheckClockSetting $checkClockSetting)
    {
        return response()->json([
            'success' => true,
            'message' => 'Check clock setting retrieved successfully.',
            'data' => $checkClockSetting,
        ]);
    }

    public function update(Request $request, CheckClockSetting $checkClockSetting)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:50',
            'type' => 'sometimes|integer|min:1',
            'deleted_at' => 'sometimes|nullable|string|max:30',
        ]);

        $checkClockSetting->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Check clock setting updated successfully.',
            'data' => $checkClockSetting,
        ]);
    }

    public function destroy(CheckClockSetting $checkClockSetting)
    {
        $checkClockSetting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Check clock setting deleted successfully.',
        ], 200);
    }
}
