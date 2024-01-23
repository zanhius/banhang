@extends('category.master')
@section('title', "Trang Chủ")
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

                                <form method="POST" action="{{ route('mua_hang') }}">
                                    @csrf
                                    @method('POST')
                                    @foreach($sanPhams as $sanPham)
                                        @if($sanPham->is_apply_voucher == 0)
                                        <input type="hidden" name="sanPhamIds[]" value="{{ $sanPham->id }}">
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Tên</label>
                                            <div class="col-md-6">
                                                <p id="name" type="text" class="form-control" readonly>{{ $sanPham->name }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="amount" class="col-md-4 col-form-label text-md-right">Giá tiền</label>
                                            <div class="col-md-6">
                                                <p type="text" class="form-control" readonly>{{ $sanPham->amount }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-md-4 col-form-label text-md-right">Số lượng</label>
                                            <div class="col-md-6">
                                                <p id="quantity" type="text" class="form-control" readonly>{{ $sanPham->quantity }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="quantity" class="col-md-4 col-form-label text-md-right">Số lượng mua</label>
                                            <div class="col-md-6">
                                                <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity[]" value="" autocomplete="quantity" autofocus>
                                                @error('quantity')
                                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    <div class="form-group row">
                                        <label for="code_voucher" class="col-md-4 col-form-label text-md-right">Nhập mã giảm giá</label>
                                        <div class="col-md-6">
                                            <input id="code_voucher" type="text" class="form-control @error('code_voucher') is-invalid @enderror" name="code_voucher" value="" autocomplete="code_voucher" autofocus>
                                            @error('code_voucher')
                                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4" style="text-align: right">
                                            <button type="submit" class="btn btn-primary">Mua hàng</button>
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
