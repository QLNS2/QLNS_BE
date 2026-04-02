<?php

use App\Http\Controllers\ChiTietPhanQuyenController;
use App\Http\Controllers\ChucNangController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\DaiLyController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DiaChiController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\MaGiamGiaController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\NhapKhoController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\SanPhamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//phòng ban
Route::get('/admin/phong-ban/data', [PhongBanController::class, 'getData']);
Route::get('/admin/phong-ban/data-open', [PhongBanController::class, 'getDataOpen']);
Route::get('/admin/phong-ban/index', [PhongBanController::class, 'index']);
Route::post('/admin/phong-ban/store', [PhongBanController::class, 'store']);
Route::get('/admin/phong-ban/show/{phongBan}', [PhongBanController::class, 'show']);
Route::post('/admin/phong-ban/update/{phongBan}', [PhongBanController::class, 'update']);
Route::post('/admin/phong-ban/destroy/{phongBan}', [PhongBanController::class, 'destroy']);
Route::post('/admin/phong-ban/change-status', [PhongBanController::class, 'changeStatus']);
Route::post('/admin/phong-ban/update-phong-ban', [PhongBanController::class, 'updatePhongBan']);
Route::post('/admin/phong-ban/delete-phong-ban', [PhongBanController::class, 'deletePhongBan']);
//chức vụ
Route::get('/admin/chuc-vu/data', [ChucVuController::class, 'getData']);
Route::get('/admin/chuc-vu/data-open', [ChucVuController::class, 'getDataOpen']);
Route::get('/admin/chuc-vu/index', [ChucVuController::class, 'index']);
Route::post('/admin/chuc-vu/store', [ChucVuController::class, 'store']);
Route::get('/admin/chuc-vu/show/{chucVu}', [ChucVuController::class, 'show']);
Route::post('/admin/chuc-vu/update/{chucVu}', [ChucVuController::class, 'update']);
Route::post('/admin/chuc-vu/destroy/{chucVu}', [ChucVuController::class, 'destroy']);
Route::post('/admin/chuc-vu/change-status', [ChucVuController::class, 'changeStatus']);
Route::post('/admin/chuc-vu/update-chuc-vu', [ChucVuController::class, 'updateChucVu']);
Route::post('/admin/chuc-vu/delete-chuc-vu', [ChucVuController::class, 'deleteChucVu']);
