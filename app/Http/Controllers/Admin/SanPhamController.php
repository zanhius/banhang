<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{

    public function index()
    {
        $sanPhams = SanPham::all();
        return view('admin.san_pham', compact('sanPhams'));
    }

    public function admin()
    {
        return view('admin.index');
    }


    public function create()
    {
        //
        return view('admin.add_san_pham');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:san_pham,name',
            'amount' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'is_apply_voucher' => 'required',
        ], [
            'name.required' => '* Vui lòng điền tên',
            'name.unique' => '* Tên đã tồn tại',
            'amount.required' => '* Vui lòng điền giá',
            'quantity.required' => '* Vui lòng điền số lượng',
            'status.required' => '* Vui lòng chọn trạng thái',
            'is_apply_voucher.required' => '* Vui lòng chọn trạng thái'
        ]);
        SanPham::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'is_apply_voucher' => $request->is_apply_voucher
        ]);
        session()->flash('success', 'Thêm thành công.');
        return redirect()->route('admin.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        try {
            $sanPhams = SanPham::findOrFail($id);
            return view('admin.edit_san_pham',compact('sanPhams'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }


    public function update(Request $request, string $id)
    {
        $sanPhams = SanPham::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:san_pham,name,' . $id . ',id',
            'amount' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'is_apply_voucher' => 'required',
        ], [
            'name.required' => '* Vui lòng điền tên',
            'name.unique' => '* Tên đã tồn tại',
            'amount.required' => '* Vui lòng điền giá',
            'quantity.required' => '* Vui lòng điền số lượng',
            'status.required' => '* ui lòng điền trạng thái',
            'is_apply_voucher.required' => '* Vui lòng điền trạng thái'
        ]);
        $sanPhams->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'is_apply_voucher' => $request->is_apply_voucher
        ]);
        session()->flash('success', 'Thêm thành công.');
        return redirect()->route('admin.index');
    }


    public function destroy(string $id)
    {
        $sanPhams = SanPham::findOrFail($id);
        try {
            $sanPhams->delete($id);

            session()->flash('success', 'Đã xóa thành công.');
            return redirect()->route('admin.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }
}
