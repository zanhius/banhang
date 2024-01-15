<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'voucher';

    protected $fillable = [
        'code_voucher',
        'amount',
        'status',
        'type',
        'start_date',
        'end_date',
        'use_date',
    ];
}
