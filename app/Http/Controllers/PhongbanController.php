<?php

namespace App\Http\Controllers;

use App\Models\PhongBan;
use Illuminate\Http\Request;

class PhongBanController extends Controller
{
    public function getData(Request $request)
    {
        $query = PhongBan::with(['phongBanCha', 'truongPhong']);

        if ($request->filled('search')) {
            $query->where('ten_phong_ban', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('per_page')) {
            return response()->json($query->paginate((int) $request->per_page));
        }

        return response()->json($query->select('id', 'ten_phong_ban', 'id_phong_ban_cha', 'id_truong_phong')->get());
    }

    public function getDataOpen(Request $request)
    {
        $query = PhongBan::query();
        if ($request->filled('search')) {
            $query->where('ten_phong_ban', 'like', '%' . $request->search . '%');
        }
        return response()->json($query->select('id', 'ten_phong_ban', 'id_phong_ban_cha')->get());
    }

    public function index()
    {
        return response()->json(
            PhongBan::with(['phongBanCha', 'truongPhong'])->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_phong_ban'    => 'required|string|max:100',
            'id_phong_ban_cha' => 'nullable|exists:phong_bans,id',
            'id_truong_phong'  => 'nullable|exists:nhan_viens,id',
            'tinh_trang'       => 'integer|in:0,1',
        ]);
        return response()->json(PhongBan::create($validated), 201);
    }

    public function show(PhongBan $phongBan)
    {
        return response()->json(
            $phongBan->load(['phongBanCha', 'truongPhong', 'phongBanCon', 'nhanViens'])
        );
    }

    public function update(Request $request, PhongBan $phongBan)
    {
        $validated = $request->validate([
            'ten_phong_ban'    => 'string|max:100',
            'id_phong_ban_cha' => 'nullable|exists:phong_bans,id',
            'id_truong_phong'  => 'nullable|exists:nhan_viens,id',
            'tinh_trang'       => 'integer|in:0,1',
        ]);
        $phongBan->update($validated);
        return response()->json($phongBan);
    }

    public function destroy(PhongBan $phongBan)
    {
        $phongBan->delete();
        return response()->json(['message' => 'Đã xóa phòng ban']);
    }

    // Route wrappers for POST endpoints
    public function changeStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:phong_bans,id',
            'tinh_trang' => 'required|in:0,1',
        ]);

        $phongBan = PhongBan::findOrFail($validated['id']);
        $phongBan->update(['tinh_trang' => $validated['tinh_trang']]);
        return response()->json($phongBan);
    }

    public function updatePhongBan(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:phong_bans,id',
            'ten_phong_ban'    => 'string|max:100',
            'id_phong_ban_cha' => 'nullable|exists:phong_bans,id',
            'id_truong_phong'  => 'nullable|exists:nhan_viens,id',
            'tinh_trang'       => 'integer|in:0,1',
        ]);

        $phongBan = PhongBan::findOrFail($validated['id']);
        $phongBan->update(array_filter([
            'ten_phong_ban' => $validated['ten_phong_ban'] ?? null,
            'id_phong_ban_cha' => $validated['id_phong_ban_cha'] ?? null,
            'id_truong_phong' => $validated['id_truong_phong'] ?? null,
            'tinh_trang' => $validated['tinh_trang'] ?? null,
        ], function ($v) {
            return !is_null($v);
        }));

        return response()->json($phongBan);
    }

    public function deletePhongBan(Request $request)
    {
        $request->validate(['id' => 'required|exists:phong_bans,id']);
        $phongBan = PhongBan::findOrFail($request->id);
        $phongBan->delete();
        return response()->json(['message' => 'Đã xóa phòng ban']);
    }
}
