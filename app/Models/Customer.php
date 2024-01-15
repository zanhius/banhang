<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends AuthenticatableUser implements Authenticatable
{
    use SoftDeletes, HasApiTokens, HasFactory, Notifiable;

    protected $table = 'customers';
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'email', 'password', 'phone_number', 'address'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Các phần còn lại của lớp Customer
    // ...
}
