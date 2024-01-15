@extends('admin.master')
@section('title',"Trang Chu")
@section('title-page',"Quan ly bai viet")
@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Quản lý menu trang giao diện

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
     <div class="col-md-8">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm mới menu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <form role="form" method="POST" action="{{ route('category.add_san_pham') }}">
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
                          <label for="name">Tên</label>
                          <div class="">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                     name="name">
                              @error('name')
                              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="amount">Giá</label>
                          <div class="">
                              <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror"
                                     name="amount">
                              @error('amount')
                              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="quantity">Số lượng</label>
                          <div class="">
                              <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror"
                                     name="quantity">
                              @error('quantity')
                              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group">
                      <label for="status">Trạng thái</label>
                      <div class="">
                          <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                              <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hoạt động</option>
                              <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Không hoạt động</option>
                          </select>
                          @error('status')
                          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                          @enderror
                      </div>
                  </div>

                      <div class="form-group">
                          <label for="is_apply_voucher">Trạng thái có áp dụng mã giảm giá không:</label>
                          <div class="">
                              <select id="is_apply_voucher" class="form-control @error('is_apply_voucher') is-invalid @enderror" name="is_apply_voucher">
                                  <option value="0" {{ old('is_apply_voucher') == '0' ? 'selected' : '' }}>Hoạt động</option>
                                  <option value="1" {{ old('is_apply_voucher') == '1' ? 'selected' : '' }}>Không hoạt động</option>
                              </select>
                              @error('is_apply_voucher')
                              <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                              @enderror
                          </div>
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

