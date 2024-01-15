<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table = 'san_pham';

    protected $fillable = [
        'name',
        'amount',
        'quantity',
        'status',
        'is_apply_voucher',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
