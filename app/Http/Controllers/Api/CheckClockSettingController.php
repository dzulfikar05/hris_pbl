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
            'message' => 'Daftar pengaturan absensi berhasil diambil.',
            'data' => $data,
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
            'message' => 'Pengaturan absensi berhasil ditambahkan.',
            'data' => $setting,
        ], 201);
    }

    public function show($id)
    {
        $setting = CheckClockSetting::find($id);

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengaturan absensi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail pengaturan absensi berhasil diambil.',
            'data' => $setting,
        ]);
    }

    public function update(Request $request, $id)
    {
        $setting = CheckClockSetting::find($id);

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengaturan absensi tidak ditemukan.',
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:50',
            'type' => 'sometimes|integer|min:1',
            'deleted_at' => 'sometimes|nullable|string|max:30',
        ]);

        $setting->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan absensi berhasil diperbarui.',
            'data' => $setting,
        ]);
    }

    public function destroy($id)
    {
        $setting = CheckClockSetting::find($id);

        if (!$setting) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengaturan absensi tidak ditemukan.',
            ], 404);
        }

        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan absensi berhasil dihapus.',
        ]);
    }
}
