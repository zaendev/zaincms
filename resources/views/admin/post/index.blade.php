@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Posts</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        <div class="row">
            <div class="col-12">

                @if (session('message'))
                    <div class="callout callout-success alert-dismissible">
                        <button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('admz/post/create') }}" class="btn btn-default">Add New</a>

                        <div class="card-tools">
                            <form method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Menu</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            @foreach( $data as $key => $d )
                                <tr style="font-style: {{ $d->status == 0 ? ' italic':'' }}">
                                    <td class="no">{{ $key + 1 }}</td>
                                    <td>{{ $d->title }} {{ $d->status == 0 ? ' --Draf':'' }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>
                                        @if($d->menu <> null)
                                            {{ $d->menu->title }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($d->category <> null)
                                            {{ $d->category->title }}
                                        @endif
                                    </td>
                                    <td>{{ $d->created_at }}</td>
                                    <td class="no">
                                        <a href="{{ url('admz/post/'.$d->id.'/edit') }}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form style="display: inline" action="{{ url('admz/post/'.$d->id)}}"
                                              method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button class="btn-del" type="submit" style="border: none" onclick="return confirm(' you want to delete?');">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{ $data->appends(['search' => !empty($_GET['search']) ? $_GET['search']:''])->links() }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>

@endsection
