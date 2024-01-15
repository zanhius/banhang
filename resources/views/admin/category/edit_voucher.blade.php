@extends('admin.master')
@section('title', "Trang Chủ")
@section('title-page', "Quản lý phân loại tủ")
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
                    <div class="box-header">

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                       placeholder="Search">

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
                            <form method="POST" action="{{ route('voucher.edit_voucher', $vouchers->id) }}">
                                @csrf
                                @method('PUT')


                                <div class="form-group row">
                                    <label for="code_voucher" class="col-md-4 col-form-label text-md-right">Mã
                                        voucher</label>
                                    <div class="col-md-6">
                                        <input id="code_voucher" type="text"
                                               class="form-control @error('code_voucher') is-invalid @enderror"
                                               name="code_voucher" value="{{ $vouchers->code_voucher }}" required
                                               autocomplete="code_voucher" autofocus>
                                        @error('code_voucher')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-md-4 col-form-label text-md-right">Giảm giá</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="amount"
                                               value="{{ $vouchers->amount }}" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Trạng thái</label>
                                    <div class="col-md-6">
                                        <select id="status" class="form-control @error('status') is-invalid @enderror"
                                                name="status" required>
                                            <option value="0" {{ $vouchers->status == 0 ? 'selected' : '' }}>Chưa sử
                                                dụng
                                            </option>
                                            <option value="1" {{ $vouchers->status == 1 ? 'selected' : '' }}>Đã sử
                                                dụng
                                            </option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="type" class="col-md-4 col-form-label text-md-right">Kiểu giám
                                        giá</label>
                                    <div class="col-md-6">
                                        <select id="type" class="form-control @error('type') is-invalid @enderror"
                                                name="type" required>
                                            <option value="0" {{ $vouchers->type == 0 ? 'selected' : '' }}>Giảm trực
                                                tiếp
                                            </option>
                                            <option value="1" {{ $vouchers->type == 1 ? 'selected' : '' }}>Giảm theo
                                                phần trăm
                                            </option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="start_date" class="col-md-4 col-form-label text-md-right">Ngày bắt
                                        đầu</label>
                                    <div class="col-md-6">
                                        <input id="start_date" type="date"
                                               class="form-control @error('start_date') is-invalid @enderror"
                                               name="start_date" value="{{ $vouchers->start_date }}" required autofocus>
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="end_date" class="col-md-4 col-form-label text-md-right">Ngày kết
                                        thúc</label>
                                    <div class="col-md-6">
                                        <input id="end_date" type="date"
                                               class="form-control @error('end_date') is-invalid @enderror"
                                               name="end_date" value="{{ $vouchers->end_date }}" required autofocus>
                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4" style="text-align: right">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
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



