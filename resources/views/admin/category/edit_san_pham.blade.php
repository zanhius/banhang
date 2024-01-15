

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
                            <form method="POST" action="{{ route('category.edit_san_pham', $sanPhams->id) }}">
                                @csrf
                                @method('PUT')



                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Tên</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $sanPhams->name }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-md-4 col-form-label text-md-right">Giá tiền</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="amount" value="{{ $sanPhams->amount }}" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">Số luợng</label>
                                    <div class="col-md-6">
                                        <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $sanPhams->quantity }}" required autocomplete="quantity" autofocus>
                                        @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Trạng thái</label>
                                    <div class="col-md-6">
                                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                            <option value="0" {{ $sanPhams->status == 0 ? 'selected' : '' }}>Hoạt động</option>
                                            <option value="1" {{ $sanPhams->status == 1 ? 'selected' : '' }}>Không hoạt động</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="is_apply_voucher" class="col-md-4 col-form-label text-md-right">Trạng thái áp mã giảm giá</label>
                                    <div class="col-md-6">
                                        <select id="is_apply_voucher" class="form-control @error('is_apply_voucher') is-invalid @enderror" name="is_apply_voucher" required>
                                            <option value="0" {{ $sanPhams->is_apply_voucher == 0 ? 'selected' : '' }}>Hoạt động</option>
                                            <option value="1" {{ $sanPhams->is_apply_voucher == 1 ? 'selected' : '' }}>Không hoạt động</option>
                                        </select>
                                        @error('is_apply_voucher')
                                        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4" style="text-align: right">
                                        <button type="submit" class="btn btn-primary"  >Cập nhật</button>
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



