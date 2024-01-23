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

    public function muaHang(Request $request)
    {
        $sanPhamIds = $request->input('sanPhamIds');
        if (!empty($sanPhamIds)) {
            $sanPhams = SanPham::whereIn('id', $sanPhamIds)->get();
            return view('category.mua_hang', compact('sanPhams'));
        } else {
            return redirect()->route('index_mua_hang')->with('error', 'Không có sản phẩm được chọn.');
        }
    }

    public function hoaDon(Request $request)
    {
        $hoaDonIds = $request->input('id');
        $hoaDons = HoaDon::where('id', $hoaDonIds)->get();


        return view('category.hoa_don', ['hoaDons' => $hoaDons]);
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
            return view('category.mua_hang', compact('sanPhams'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            session()->flash('error', 'ID không tồn tại.');
            return redirect()->back();
        }
    }

    public function createOrderDetail($hoaDon, $sanPhams, $quantity, $realAmount, $totalAmount)
    {
        ChiTietDonHang::create([
            'hoa_don_id' => $hoaDon->id,
            'id_san_pham' => $sanPhams->id,
            'quantity' => $quantity,
            'amount' => $realAmount,
            'total_amount' => $totalAmount
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|min:1',
        ], [
            'quantity.required' => 'Hãy nhập số lượng cho ít nhất một sản phẩm',
            'quantity.min' => 'Số lượng phải ít nhất là 1',
        ]);

        $voucher = Voucher::where('code_voucher', $request->code_voucher)->where('status', 0)->first();
        $voucherCheck = Voucher::where('code_voucher', $request->code_voucher)->where('status', 1)->first();

        $hoaDon = HoaDon::create([
            'id_customer' => Auth::guard('customer')->id(),
            'id_voucher' => null,
            'quantity' => 0,
            'real_amount' => 0,
            'total_amount' => 0,
            'status' => 0
        ]);
        foreach ($request->sanPhamIds as $index => $sanPhamId) {
            $sanPham = SanPham::findOrFail($sanPhamId);
            if ($request->quantity[$index] > $sanPham->quantity) {
                session()->flash('error', 'Số lượng sản phẩm không đủ');
                return redirect()->back();
            }

            if ($sanPham->status != 0) {
                session()->flash('error', 'Sản phẩm đang không bán');
                return redirect()->back();
            }

            if ($sanPham->is_apply_voucher == 1) {
                if (!empty($request->code_voucher)) {
                    session()->flash('error', 'Sản phẩm không được nhập voucher');
                    return redirect()->back();
                } else {

                    $realAmount = $sanPham->amount * $request->quantity[$index];
                    $totalAmount = $realAmount - 0;

                    $hoaDon->quantity += $request->quantity[$index];
                    $hoaDon->real_amount += $realAmount;
                    $hoaDon->total_amount += $totalAmount;

                    $sanPham->update([
                        'quantity' => $sanPham->quantity - $request->quantity[$index]
                    ]);

                    $this->createOrderDetail($hoaDon, $sanPham, $request->quantity[$index], $realAmount, $totalAmount);

                }
            }

           if ($sanPham->is_apply_voucher == 0) {
                if ($voucherCheck) {
                    session()->flash('error', 'Mã voucher không hoạt động');
                    return redirect()->back();
                }
                if (empty($request->code_voucher)) {
                    $realAmount = $sanPham->amount * $request->quantity[$index];
                    $totalAmount = $realAmount - 0;

                    $hoaDon->quantity += $request->quantity[$index];
                    $hoaDon->real_amount += $realAmount;
                    $hoaDon->total_amount += $totalAmount;

                    $sanPham->update([
                        'quantity' => $sanPham->quantity - $request->quantity[$index]
                    ]);


                    $this->createOrderDetail($hoaDon, $sanPham, $request->quantity[$index], $realAmount, $totalAmount);

                } else {
                    if ($voucher) {

                        $currentDate = Carbon::now()->format('Y-m-d');
                        $startDate = $voucher->start_date;
                        $endDate = $voucher->end_date;

                        if ($voucher && $voucher->number_use <= 0) {
                            session()->flash('error', 'Mã voucher hết lượt sử dụng');
                            return redirect()->back();
                        }

                        if ($currentDate >= $startDate && $currentDate <= $endDate && $voucher->number_use > 0) {
                            $realAmount = $sanPham->amount * $request->quantity[$index];
                            if ($voucher->type == 0) {
                                $totalAmount = $realAmount - $voucher->amount;
                            } elseif ($voucher->type == 1) {
                                $totalAmount = $realAmount - (($voucher->amount / 100) * $realAmount);
                            }

                            $hoaDon->quantity += $request->quantity[$index];
                            $hoaDon->real_amount += $realAmount;
                            $hoaDon->total_amount += $totalAmount;

                            $sanPham->update([
                                'quantity' => $sanPham->quantity - $request->quantity[$index]
                            ]);

                            $hoaDon->update([
                                'id_voucher' => $voucher->id
                            ]);

                            $voucher->update([
                                'number_use' => $voucher->number_use - 1,
                                'use_date' => now()
                            ]);


                            $this->createOrderDetail($hoaDon, $sanPham, $request->quantity[$index], $realAmount, $totalAmount);


                        } else {
                            session()->flash('error', 'Voucher không có hiệu lực trong khoảng thời gian này');
                            return redirect()->back();
                        }

                    } else {
                        session()->flash('error', 'Voucher sai');
                        return redirect()->back();
                    }

                }
            }
        }
        $hoaDon->save();
        session()->flash('success', 'Mua thành công');
        return redirect()->route('hoadon.index', ['id' => $hoaDon->id]);
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
