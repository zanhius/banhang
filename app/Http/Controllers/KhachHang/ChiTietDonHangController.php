<?php

namespace App\Http\Controllers\KhachHang;

use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietDonHangController extends Controller
{

    public function index()
    {
        $customerId = Auth::guard('customer')->id();

        $hoaDons = HoaDon::where('id_customer', $customerId)->get();
        $chiTietDonHangs = collect();
        foreach ($hoaDons as $hoaDon) {
            $chiTietDonHangs = $chiTietDonHangs->concat(
                ChiTietDonHang::where('hoa_don_id', $hoaDon->id)->get()
            );
        }


        return view('category.don_hang', ['chiTietDonHangs' => $chiTietDonHangs]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        try {
            $chiTietDonHangs = ChiTietDonHang::where('hoa_don_id', $id)->get();
            return view('category.chi_tiet_don_hang', compact('chiTietDonHangs'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
