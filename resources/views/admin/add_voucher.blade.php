@extends('admin.master')
@section('title',"Quản lý voucher")
@section('title-page',"Add voucher")
@section('main-content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới voucher</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('voucher.add_voucher') }}">
                        @csrf
                        <div class="box-body">

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

                            <div class="form-group">
                                <label for="code_voucher">Mã voucher</label>
                                <div class="">
                                    <input id="code_voucher" type="text"
                                           class="form-control @error('code_voucher') is-invalid @enderror"
                                           name="code_voucher" value="{{ old('code_voucher', Str::random(8)) }}" readonly>
                                    @error('code_voucher')
                                    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="amount">Giảm giá</label>
                                <div class="">
                                    <input id="amount" type="text"
                                           class="form-control @error('amount') is-invalid @enderror"
                                           name="amount">
                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="number_use">Số lượt</label>
                                <div class="">
                                    <input id="number_use" type="text"
                                           class="form-control @error('number_use') is-invalid @enderror"
                                           name="number_use">
                                    @error('number_use')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <div class="">
                                    <select id="status" class="form-control @error('status') is-invalid @enderror"
                                            name="status">
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hoạt Động
                                        </option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Không Hoạt Động
                                        </option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type">kiểu mã giảm giá (%):</label>
                                    <div class="">
                                        <select id="type" class="form-control @error('type') is-invalid @enderror"
                                                name="type">
                                            <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Giảm thẳng
                                            </option>
                                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Phần trăm
                                            </option>
                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                        @enderror
                                    </div>


                            </div>
                            <div class="form-group">
                                <label for="start_date">Ngày bắt đầu</label>
                                <div class="">
                                    <input id="start_date" type="date"
                                           class="form-control @error('start_date') is-invalid @enderror"
                                           name="start_date" value="{{ old('start_date') }}">
                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end_date">Ngày kết thúc</label>
                                <div class="">
                                    <input id="end_date" type="date"
                                           class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                           value="{{ old('end_date') }}">
                                    @error('end_date')
                                    <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Thêm mới</button>
                            </div>
                    </form>
                </div>

                <!-- /.box -->

            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection

