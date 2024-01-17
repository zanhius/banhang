

@extends('admin.master')
@section('title', "Admin")
@section('title-page', "Admin")
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
            <a href="{{ route('admin.add-sp') }}" class="btn btn-success">+Thêm Sản phẩm</a>
        </section>
        <!-- /.content -->
    </div>
@endsection


