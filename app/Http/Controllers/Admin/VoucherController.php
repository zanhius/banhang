<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all();
        return view('admin.voucher', compact('vouchers'));
    }


    public function create()
    {
        return view('admin.add_voucher');
    }


    public function store(Request $request)
    {
        $request->validate([
            'code_voucher' => 'required|unique:voucher,code_voucher|min:8|max:8',
            'amount' => 'required',
            'number_use' => 'required',
            'status' => 'required',
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ], [
            'code_voucher.required' => '* Vui lòng nhập mã voucher.',
            'code_voucher.min' => '* Vui lòng nhập đủ 8 ký tự.',
            'code_voucher.max' => '* Vui lòng nhập đủ 8 ký tự.',
            'code_voucher.unique' => '* Mã voucher đã tồn tại.',
            'amount.required' => '* Vui lòng nhập giá giảm.',
            'number_use.required' => '* Vui lòng nhập số lượt sử dụng.',
            'status.required' => '* Vui lòng chọn trạng thái.',
            'type.required' => '* Vui lòng chọn loại.',
            'start_date.required' => '* Vui lòng chọn ngày.',
            'start_date.date' => '* Vui lòng chọn đúng định dạng ngày.',
            'end_date.required' => '* Vui lòng chọn ngày.',
            'end_date.date' => '* Vui lòng chọn đúng định dạng ngày.',
        ]);

        Voucher::create([
            'code_voucher' => $request->code_voucher,
            'amount' => $request->amount,
            'status' => $request->status,
            'number_use' => $request->number_use,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        session()->flash('success', 'Thêm thành công.');
        return redirect()->route('voucher.index');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        try {
        $vouchers = Voucher::findOrFail($id);
        return view('admin.edit_voucher',compact('vouchers'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        session()->flash('error', 'ID không tồn tại.');
        return redirect()->back();
    }
    }


    public function update(Request $request, string $id)
    {
        //
        $vouchers = Voucher::findOrFail($id);
        $request->validate([
            'code_voucher' => 'required|unique:voucher,code_voucher,'. $id . ',id|min:8|max:8',
            'amount' => 'required',
            'status' => 'required',
            'number_use' => 'required',
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ], [
            'code_voucher.required' => 'Vui lòng nhập mã voucher.',
            'code_voucher.min' => 'Vui lòng nhập đủ 8 ký tự.',
            'code_voucher.max' => 'Vui lòng nhập đủ 8 ký tự.',
            'code_voucher.unique' => 'Mã voucher đã tồn tại.',
            'amount.required' => 'Vui lòng nhập giá giảm.',
            'number_use.required' => 'Vui lòng nhập số lượt sử dụng.',
            'status.required' => 'Vui lòng chọn trạng thái.',
            'type.required' => 'Vui lòng chọn loại.',
            'start_date.required' => 'Vui lòng chọn ngày.',
            'start_date.date' => 'Vui lòng chọn đúng định dạng ngày.',
            'end_date.required' => 'Vui lòng chọn ngày.',
            'end_date.date' => 'Vui lòng chọn đúng định dạng ngày.',
        ]);

        $vouchers->update([
            'code_voucher' => $request->code_voucher,
            'amount' => $request->amount,
            'status' => $request->status,
            'number_use' => $request->number_use,
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        session()->flash('success', 'Thêm thành công.');
        return redirect()->route('voucher.index');
    }


    public function destroy(string $id)
    {
        $vouchers = Voucher::findOrFail($id);
        try {
            $vouchers->delete($id);

            session()->flash('success', 'Đã xóa thành công.');
            return redirect()->route('voucher.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }
}
