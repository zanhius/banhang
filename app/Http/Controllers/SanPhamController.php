<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sanPhams = SanPham::all();
        return view('admin.category.san_pham', compact('sanPhams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.add_san_pham');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:san_pham,name',
            'amount' => 'required',
            'quantity' => 'required',
            'status' => 'required',
            'is_apply_voucher' => 'required',
        ], [
            'name.required' => 'Vui lòng điền tên',
            'name.unique' => 'Tên đã tồn tại',
            'amount.required' => 'Vui lòng điền giá',
            'quantity.required' => 'Vui lòng điền số lượng',
            'status.required' => 'Vui lòng điền trạng thái',
            'is_apply_voucher.required' => 'Vui lòng điền trạng thái'
        ]);
        SanPham::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'is_apply_voucher' => $request->is_apply_voucher
        ]);
        session()->flash('success', 'Thêm thành công.');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $sanPhams = SanPham::findOrFail($id);
            return view('admin.category.edit_san_pham',compact('sanPhams'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
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
            'name.required' => 'Vui lòng điền tên',
            'name.unique' => 'Tên đã tồn tại',
            'amount.required' => 'Vui lòng điền giá',
            'quantity.required' => 'Vui lòng điền số lượng',
            'status.required' => 'Vui lòng điền trạng thái',
            'is_apply_voucher.required' => 'Vui lòng điền trạng thái'
        ]);
        $sanPhams->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'is_apply_voucher' => $request->is_apply_voucher
        ]);
        session()->flash('success', 'Thêm thành công.');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sanPhams = SanPham::findOrFail($id);
        try {
            $sanPhams->delete($id);

            session()->flash('success', 'Đã xóa thành công.');
            return redirect()->route('category.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }
}
