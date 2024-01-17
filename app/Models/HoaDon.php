<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table = 'hoa_don';

    protected $fillable = [
        'id_customer',
        'id_voucher',
        'quantity',
        'total_amount',
        'real_amount',
        'status'
    ];

    public  function codeVoucher()
    {
        return $this->belongsTo(Voucher::class, 'id_voucher', 'id');
    }

    public  function customers()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }
}
