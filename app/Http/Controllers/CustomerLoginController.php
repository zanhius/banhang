<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerLoginController extends Controller
{
    public function login(Request $request)
    {
        return view('customer.login');
    }
    public function welcome(Request $request)
    {
        return view('welcome');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email không được phép trống',
            'email.string' => 'Email phải là kiểu chuỗi',
            'password.required' => 'Mật khẩu không được trống',
        ]);

        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            // Xác thực thành công
            return redirect()->route('welcome');
        } else {
            // Xác thực thất bại
            return redirect()->route('customer.login')->with("failed", "Tài khoản hoặc mật khẩu không hợp lệ");
        }
    }

    public function register()
    {
        return view('customer.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . Customer::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);
        try {
           Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);
            return redirect()->route('customer.login')->with("success", "Đăng ký thành công, vui lòng nhập thông tin vừa tạo để tiếp tục");
        } catch (\Throwable $th) {
            return redirect()->route('customer.register')->with("failed", "Đã xảy ra lỗi không xác định");
        }
    }

    public function logout()
    {
        // session flush là xoá toàn bộ session
        session()->flush();

        return redirect()->route('login')->with("logout", "Đăng xuất thành công");
    }

    }
