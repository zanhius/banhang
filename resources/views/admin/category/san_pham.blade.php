

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
            <a href="{{ route('category.add-sp') }}" class="btn btn-success">+Thêm Sản phẩm</a>

            <!-- Default box -->
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <th>STT </th>
                                <th>Tên </th>
                                <th>Giá  tiền</th>
                                <th>Số lương</th>
                                <th>Trạng thái</th>
                                <th>Trạng thái áp mã</th>
                                <th>Hành động</th>

                            </tr>
                            @foreach($sanPhams as $sanPham)

                                <tr>
                                    <td>{{ $sanPham->id }}</td>
                                    <td>{{ $sanPham->name }}</td>
                                    <td>{{ $sanPham->amount }}</td>
                                    <td>{{ $sanPham->quantity }}</td>
                                    <td>@if ($sanPham->status == 0)
                                            Hoạt động
                                        @elseif ($sanPham->status == 1)
                                            Bảo trì
                                        @endif
                                    </td>
                                    <td>@if ($sanPham->is_apply_voucher == 0)
                                            Được áp mã
                                        @elseif ($sanPham->is_apply_voucher == 1)
                                            Không được áp mã
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('category.edit_san_pham', $sanPham) }}" class="btn btn-success" style="display: inline-block; margin-right: 10px;">Sửa</a>
                                        <form action="{{ route('category.delete_san_pham', $sanPham) }}" method="POST" style="display: inline-block;">
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


