

@extends('category.master')
@section('title', "Mua hàng")
@section('title-page', "Mua hàng")
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
                        <form action="{{ route('post_mua_hang') }}" method="POST">
                            @csrf

                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                                @foreach($sanPhams as $sanPham)
                                    @if($sanPham->quantity > 0 && $sanPham->status == 0)
                                        <tr>
                                            <td>{{ $sanPham->id }}</td>
                                            <td>{{ $sanPham->name }}</td>
                                            <td>{{ $sanPham->amount }}</td>
                                            <td>{{ $sanPham->quantity }}</td>
                                            <td>
                                                @if ($sanPham->status == 0)
                                                    Đang bán
                                                @elseif ($sanPham->status == 1)
                                                    Không bán
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" name="sanPhamIds[]" value="{{ $sanPham->id }}">
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-success">Mua các sản phẩm đã chọn</button>
                        </form>
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


