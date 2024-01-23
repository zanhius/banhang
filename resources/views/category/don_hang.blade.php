@extends('category.master')
@section('title', "Chi tiết đơn hàng")
@section('title-page', "Chi tiết đơn hàng")
@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title-page')
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <!-- Hiển thị thông báo lỗi -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Hiển thị thông báo thành công -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID Hóa đơn</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Mã giảm giá</th>
                                <th>Người mua</th>
                                <th>Địa chỉ</th>
                                <th>Giá ban đầu</th>
                                <th>Giá phải trả</th>
                            </tr>

                            @foreach($chiTietDonHangs as $chiTietDonHang)
                                <tr>
                                    <td>{{ $chiTietDonHang->hoa_don_id }}</td>
                                    <td>{{ $chiTietDonHang->table_sanPham->name }}</td>
                                    <td>{{ $chiTietDonHang->quantity }}</td>
                                    <td>
                                        @if ($chiTietDonHang->table_hoaDon && $chiTietDonHang->table_hoaDon->codeVoucher)
                                            {{ $chiTietDonHang->table_hoaDon->codeVoucher->code_voucher }}
                                            - {{ $chiTietDonHang->table_hoaDon->codeVoucher->amount }}

                                            @php
                                                $type = $chiTietDonHang->table_hoaDon->codeVoucher->type;
                                            @endphp

                                            @if ($type === 0)

                                            @elseif ($type === 1)
                                                 %
                                            @endif
                                        @else
                                            Không có
                                        @endif
                                    </td>
                                    <td>{{ $chiTietDonHang->table_hoaDon->customers->name ?? 'Không có' }}</td>
                                    <td>{{ $chiTietDonHang->table_hoaDon->customers->address ?? 'Không có' }}</td>
                                    <td>{{ $chiTietDonHang->amount ?? 'Không có' }}</td>
                                    <td>{{ $chiTietDonHang->total_amount ?? 'Không có' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection



