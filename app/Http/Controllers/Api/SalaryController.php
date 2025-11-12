<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $data = Salary::query()->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'List of salaries retrieved successfully.',
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
            'user_id' => 'required|integer',
            'type' => 'required|integer|min:1',
            'rate' => 'required|numeric',
            'effective_date' => 'required|date',
        ]);

        $salary = Salary::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Salary created successfully.',
            'data' => $salary,
        ], 201);
    }

    public function show(Salary $salary)
    {
        return response()->json([
            'success' => true,
            'message' => 'Salary retrieved successfully.',
            'data' => $salary,
        ]);
    }

    public function update(Request $request, Salary $salary)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|integer',
            'type' => 'sometimes|integer|min:1',
            'rate' => 'sometimes|numeric',
            'effective_date' => 'sometimes|date',
            'deleted_at' => 'sometimes|nullable|string|max:30',
        ]);

        $salary->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Salary updated successfully.',
            'data' => $salary,
        ]);
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();

        return response()->json([
            'success' => true,
            'message' => 'Salary deleted successfully.',
        ], 200);
    }
}
