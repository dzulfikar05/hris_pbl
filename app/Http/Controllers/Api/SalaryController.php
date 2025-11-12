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
            'message' => 'Daftar data gaji berhasil diambil.',
            'data' => $data,
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
            'message' => 'Data gaji berhasil ditambahkan.',
            'data' => $salary,
        ], 201);
    }

    public function show($id)
    {
        $salary = Salary::find($id);

        if (!$salary) {
            return response()->json([
                'success' => false,
                'message' => 'Data gaji tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data gaji berhasil diambil.',
            'data' => $salary,
        ]);
    }

    public function update(Request $request, $id)
    {
        $salary = Salary::find($id);

        if (!$salary) {
            return response()->json([
                'success' => false,
                'message' => 'Data gaji tidak ditemukan.',
            ], 404);
        }

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
            'message' => 'Data gaji berhasil diperbarui.',
            'data' => $salary,
        ]);
    }

    public function destroy($id)
    {
        $salary = Salary::find($id);

        if (!$salary) {
            return response()->json([
                'success' => false,
                'message' => 'Data gaji tidak ditemukan.',
            ], 404);
        }

        $salary->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data gaji berhasil dihapus.',
        ]);
    }
}
