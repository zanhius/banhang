

@extends('admin.master')
@section('title', "Quản lý voucher")
@section('title-page', "Quản lý voucher")
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
            <a href="{{ route('voucher.get_add_voucher') }}" class="btn btn-success">+Thêm voucher</a>

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
                                <th>STT</th>
                                <th>Mã Voucher </th>
                                <th>Giảm giá</th>
                                <th>Số lượt</th>
                                <th>Tráng thái</th>
                                <th>Kiểu giảm giá </th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Ngày sử dụng</th>
                                <th>Hành động</th>
                            </tr>
                            @foreach($vouchers as $voucher)

                                <tr>
                                    <td>{{ $voucher->id }}</td>
                                    <td>{{ $voucher->code_voucher }}</td>
                                    <td>{{ $voucher->amount }}</td>
                                    <td>{{ $voucher->number_use }}</td>
                                    <td> @if ($voucher->status == 0)
                                           Hoạt Động
                                        @elseif ($voucher->status == 1)
                                           Không Hoạt Động
                                        @endif</td>
                                    <td>@if ($voucher->type == 0)
                                            Giảm trực tiếp
                                        @elseif ($voucher->type == 1)
                                            Phần trăm
                                        @endif</td>
                                    <td>{{ $voucher->start_date }}</td>
                                    <td>{{ $voucher->end_date}}</td>
                                    <td>{{ $voucher->use_date}}</td>
                                    <td>
                                        <a href="{{ route('voucher.edit_voucher', $voucher) }}" class="btn btn-success" style="display: inline-block; margin-right: 10px;">Sửa</a>
                                        <form action="{{ route('voucher.delete_voucher', $voucher) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger " onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                        </form>
                                    </td>
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


