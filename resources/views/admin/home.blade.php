@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('admin/post') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-edit"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Page</span>
                            <span class="info-box-number">{{ $data['count_post'] }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('admin/page') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fa fa-file-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pages</span>
                            <span class="info-box-number">{{ $data['count_page'] }}</span>
                        </div>
                    </div>
                </a>
            </div>
            <!-- /.col -->

        </div>
    </section>

@endsection
