<?php

namespace App\Http\Controllers\KhachHang;

use App\Http\Controllers\Controller;
use App\Models\ChiTietDonHang;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HoaDonController extends Controller
{

    public function index()
    {
        $sanPhams = SanPham::all();
        return view('category.ban_hang', compact('sanPhams'));
    }

    public function hoaDon(Request $request)
    {
        $id = $request->query('id');

        try {
            $hoaDon = HoaDon::findOrFail($id);
            return view('category.hoa_don', compact('hoaDon'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }

    }
    public function donHang()
    {
        $hoaDons = HoaDon::all();
        $chiTietDonHangs = ChiTietDonHang::all();
        return view('admin.don_hang', compact('hoaDons', 'chiTietDonHangs'));
    }


    public function create($id)
    {
        try {
            $sanPhams = SanPham::findOrFail($id);
            return view('category.mua_hang',compact('sanPhams'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }


    public function store(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required'
        ],[
            'quantity.required' => '* Hãy nhập số lượng'
        ]);

        $sanPhams = SanPham::findOrFail($id);
        $voucher = Voucher::where('code_voucher',$request->code_voucher)->where('status', 0)->first();
        $voucherCheck = Voucher::where('code_voucher',$request->code_voucher)->where('status', 1)->first();

        if ($request->quantity > $sanPhams->quantity) {
            session()->flash('error', 'Số lượng sản phẩm không đủ');
            return redirect()->back();
        }

        if ($sanPhams->status != 0) {
            session()->flash('error', 'Sản phẩm đang không bán');
            return redirect()->back();
        }

        if ($sanPhams->is_apply_voucher == 1 && !empty($request->code_voucher)) {
            session()->flash('error', 'Sản phẩm không được nhập voucher');
            return redirect()->back();
        }
        if ($sanPhams->is_apply_voucher == 1) {
            if (!empty($request->code_voucher)) {
                session()->flash('error', 'Sản phẩm không được nhập voucher');
                return redirect()->back();
            } else {
                $realAmount = $sanPhams->amount * $request->quantity;
                $totalAmount = $realAmount -0;
                $hoaDon = HoaDon::create([
                    'id_customer' => Auth::guard('customer')->id(),
                    'id_voucher' => null,
                    'quantity' => $request->quantity,
                    'real_amount' => $realAmount,
                    'total_amount' => $totalAmount,
                    'status' => 0
                ]);

                $sanPhams->update([
                    'quantity' => $sanPhams->quantity - $hoaDon->quantity
                ]);

                ChiTietDonHang::create([
                    'hoa_don_id' => $hoaDon->id,
                    'id_san_pham' => $sanPhams->id,
                    'quantity' => $hoaDon->quantity,
                    'amount' => $hoaDon->total_amount
                ]);
                session()->flash('success', 'Mua thành công');
                return redirect()->route('hoadon.index', ['id' => $hoaDon->id]);
            }
        }


        if ($sanPhams->is_apply_voucher == 0) {
            if ($voucher) {

                $currentDate = Carbon::now()->format('Y-m-d');
                $startDate = $voucher->start_date;
                $endDate = $voucher->end_date;

                if ($voucher && $voucher->number_use<=0) {
                    session()->flash('error', 'Mã voucher hết lượt sử dụng');
                    return redirect()->back();
                }

                if ($currentDate >= $startDate && $currentDate <= $endDate && $voucher->number_use >0 ) {
                    $realAmout = $sanPhams->amount * $request->quantity;
                    if ($voucher->type == 0) {
                        $total_amount = $realAmout - $voucher->amount;
                    } elseif ($voucher->type == 1) {
                        $total_amount = $realAmout - (($voucher->amount / 100) * $realAmout);
                    }
                    $hoaDon = HoaDon::create([
                        'id_customer' => Auth::guard('customer')->id(),
                        'id_voucher' => $voucher->id,
                        'quantity' => $request->quantity,
                        'real_amount' => $realAmout,
                        'total_amount' => $total_amount,
                        'status' => 0
                    ]);

                    $sanPhams->update([
                        'quantity' => $sanPhams->quantity - $hoaDon->quantity
                    ]);

                    $voucher->update([
                        'number_use' => $voucher->number_use - 1,
                        'use_date' => now()
                    ]);

                    ChiTietDonHang::create([
                        'hoa_don_id' => $hoaDon->id,
                        'id_san_pham' => $sanPhams->id,
                        'quantity' => $hoaDon->quantity,
                        'amount' => $hoaDon->total_amount
                    ]);
                    session()->flash('success', 'Mua thành công');
                    return redirect()->route('hoadon.index',['id' => $hoaDon->id]);
                } else {
                    session()->flash('error', 'Voucher không có hiệu lực trong khoảng thời gian này');
                    return redirect()->back();
                }

            }
            if ($voucherCheck) {
                session()->flash('error', 'Mã voucher không hoạt động');
                return redirect()->back();
            }
            if (empty($request->code_voucher))  {
                $realAmount = $sanPhams->amount * $request->quantity;
                $totalAmount = $realAmount -0;
                $hoaDon = HoaDon::create([
                    'id_customer' => Auth::guard('customer')->id(),
                    'id_voucher' => null,
                    'quantity' => $request->quantity,
                    'real_amount' => $realAmount,
                    'total_amount' => $totalAmount,
                    'status' => 0
                ]);

                $sanPhams->update([
                    'quantity' => $sanPhams->quantity - $hoaDon->quantity
                ]);

                ChiTietDonHang::create([
                    'hoa_don_id' => $hoaDon->id,
                    'id_san_pham' => $sanPhams->id,
                    'quantity' => $hoaDon->quantity,
                    'amount' => $hoaDon->total_amount
                ]);
                session()->flash('success', 'Mua thành công');
                return redirect()->route('hoadon.index', ['id' => $hoaDon->id]);
            } else {
                session()->flash('error', 'Mã voucher sai');
                return redirect()->back();
            }
        }
    }

    public function show(string $id)
    {
        //
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
