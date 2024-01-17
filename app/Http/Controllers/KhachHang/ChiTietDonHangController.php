<?php

namespace App\Http\Controllers\KhachHang;

use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use Illuminate\Http\Request;

class ChiTietDonHangController extends Controller
{

    public function index()
    {
        //
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
            $chiTietDonHang = ChiTietDonHang::findOrFail($id);
            return view('category.chi_tiet_don_hang', compact('chiTietDonHang'));
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
