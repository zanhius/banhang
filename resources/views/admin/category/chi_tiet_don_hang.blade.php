@extends('admin.master')
@section('title', "Hoa đơn")
@section('title-page', "Hóa đơn")
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
                                <th>Giá ban đầu</th>
                                <th>Giá phải trả</th>
                            </tr>

                            <tr>
                            <tr>
                                <td>{{ $chiTietDonHang->hoa_don_id }}</td>
                                <td>{{ $chiTietDonHang->table_sanPham->name}}</td>
                                <td>{{ $chiTietDonHang->quantity }}</td>
                                <td>{{ $chiTietDonHang->table_hoaDon->id_voucher  ?? 'Không có voucher' }}</td>
                                <td>{{ $chiTietDonHang->table_hoaDon->real_amount }}</td>
                                <td>{{ $chiTietDonHang->table_hoaDon->total_amount }}</td>
                            </tr>

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



