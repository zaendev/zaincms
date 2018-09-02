@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Menu</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="show-error-msg" style="color:red; display:none">
                            <ul></ul>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug">
                        </div>
                        <button id="save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="cf nestable-lists">
                            <div class="dd" id="nestable">
                                <div id="viewMenu">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="id">
        <input type="hidden" id="nestable-output">
        <input type="hidden" id="urlView" value="{{ url('admz/menu/view') }}">
        <input type="hidden" id="urlStore" value="{{ url('admz/menu/store') }}">
        <input type="hidden" id="urlUpdate" value="{{ url('admz/menu/update') }}">
        <input type="hidden" id="urlDelete" value="{{ url('admz/menu/destroy') }}">
        <input type="hidden" id="urlShow" value="{{ url('admz/menu/show') }}">

    </section>

    <script src="{{ asset('admin/js/menu.js') }}"></script>

@endsection
