<?php

namespace App\Http\Controllers;

use App\Models\ChucVu;
use Illuminate\Http\Request;
class ChucVuController extends Controller
{
    public function getData(Request $request)
    {
        $query = ChucVu::query();

        if ($request->filled('search')) {
            $query->where('ten_chuc_vu', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('per_page')) {
            return response()->json($query->paginate((int) $request->per_page));
        }

        return response()->json($query->select('id', 'ten_chuc_vu', 'tinh_trang')->get());
    }

    public function getDataOpen(Request $request)
    {
        $query = ChucVu::query();
        if ($request->filled('search')) {
            $query->where('ten_chuc_vu', 'like', '%' . $request->search . '%');
        }
        return response()->json($query->select('id', 'ten_chuc_vu')->get());
    }

    public function index()
    {
        return response()->json(ChucVu::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_chuc_vu' => 'required|string|max:100|unique:chuc_vus',
            'tinh_trang'  => 'integer|in:0,1',
        ]);
        $chucVu = ChucVu::create($validated);
        return response()->json($chucVu, 201);
    }

    public function show(ChucVu $chucVu)
    {
        return response()->json($chucVu->load('nhanViens'));
    }

    public function update(Request $request, ChucVu $chucVu)
    {
        $validated = $request->validate([
            'ten_chuc_vu' => 'string|max:100|unique:chuc_vus,ten_chuc_vu,' . $chucVu->id,
            'tinh_trang'  => 'integer|in:0,1',
        ]);
        $chucVu->update($validated);
        return response()->json($chucVu);
    }

    public function destroy(ChucVu $chucVu)
    {
        $chucVu->delete();
        return response()->json(['message' => 'Đã xóa chức vụ']);
    }

    // Route wrappers for POST endpoints
    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:chuc_vus,id',
            'tinh_trang' => 'required|in:0,1',
        ]);

        $chucVu = ChucVu::findOrFail($validated['id']);
        $chucVu->update(['tinh_trang' => $validated['tinh_trang']]);
        return response()->json($chucVu);
    }

    public function updateChucVu(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:chuc_vus,id',
            'ten_chuc_vu' => 'string|max:100',
            'tinh_trang'  => 'integer|in:0,1',
        ]);

        $chucVu = ChucVu::findOrFail($validated['id']);
        $chucVu->update(array_filter([
            'ten_chuc_vu' => $validated['ten_chuc_vu'] ?? null,
            'tinh_trang' => $validated['tinh_trang'] ?? null,
        ], function ($v) {
            return !is_null($v);
        }));

        return response()->json($chucVu);
    }

    public function deleteChucVu(Request $request)
    {
        $request->validate(['id' => 'required|exists:chuc_vus,id']);
        $chucVu = ChucVu::findOrFail($request->id);
        $chucVu->delete();
        return response()->json(['message' => 'Đã xóa chức vụ']);
    }
}
