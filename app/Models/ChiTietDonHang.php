<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_don_hang';

    protected $fillable = [
        'hoa_don_id',
        'id_san_pham',
        'quantity',
        'amount'
    ];

    public  function table_hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'hoa_don_id', 'id');
    }

    public  function table_sanPham()
    {
        return $this->belongsTo(SanPham::class, 'id_san_pham', 'id');
    }
}
