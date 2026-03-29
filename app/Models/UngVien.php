<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UngVien extends Model
{
   protected $table = 'ung_viens';

    protected $fillable = [
        'ho_ten',
        'email',
        'so_dien_thoai',
        'file_cv',
        'tinh_trang',
        'ghi_chu',
    ];
}
