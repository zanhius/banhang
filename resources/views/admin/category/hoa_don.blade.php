@extends('admin.master')
@section('title', "Quản lý ngăn")
@section('title-page', "Quản lý ngăn")
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
                                <th>Khách hàng</th>
                                <th>Số lượng</th>
                                <th>Tên hàng</th>
                                <th>Voucher</th>
                                <th>Tổng tiền ban đầu</th>
                                <th>Tổng tiền phải trả</th>
                            </tr>

                            <tr>
                                <td>{{ $hoaDon->customers->name ?? ''}}</td>
                                <td>{{ $hoaDon->quantity }}</td>
                                <td>{{ $hoaDon->quantity }}</td>
                                <td>{{ $hoaDon->voucher->code_voucher ?? 'Không có voucher' }}</td>
                                <td>{{ $hoaDon->real_amount }}</td>
                                <td>{{ $hoaDon->total_amount }}</td>
                                <td>
                                    <a href="{{ route('chi-tiet-don-hang', $hoaDon->id) }}" class="btn btn-primary">Xem chi tiết</a>
                                </td>
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



