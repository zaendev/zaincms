@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Posts</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        <form method="post" action="{{ url('admz/post/'.$data->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group {{ !empty($errors->first('title')) ? 'has-error':'' }}">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="{{ $data->title }}" required>
                                <div class="error">{{ $errors->first('title') }}</div>
                            </div>
                            <div class="form-group {{ !empty($errors->first('slug')) ? 'has-error':'' }}">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{ $data->slug }}">
                                <div class="error">{{ $errors->first('slug') }}</div>
                            </div>
                            <div class="form-group {{ !empty($errors->first('description')) ? 'has-error':'' }}">
                                <label for="editor">Content</label>
                                <textarea id="editor" class="form-control" rows="3" placeholder="Content"
                                          name="description">{{ $data->content }}</textarea>
                                <div class="error">{{ $errors->first('description') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <span>Seo</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group {{ !empty($errors->first('keyword')) ? 'has-error':'' }}">
                                <label for="keyword">Keyword</label>
                                <input type="text" class="form-control" id="keyword" placeholder="Keyword"
                                       name="keyword" value="{{ $data->keyword }}">
                                <div class="error">{{ $errors->first('keyword') }}</div>
                            </div>
                            <div class="form-group {{ !empty($errors->first('description')) ? 'has-error':'' }}">
                                <label for="description-seo">Description</label>
                                <textarea id="description-seo" class="form-control" rows="3" placeholder="Description"
                                          name="seo">{{ $data->seo }}</textarea>
                                <div class="error">{{ $errors->first('seo') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <span>Publish</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="publish" name="publish" {{ $data->status == 1 ? 'checked':'' }} class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="publish">Publish</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="draft" name="publish" {{ $data->status == 0 ? 'checked':'' }} class="custom-control-input" value="0">
                                    <label class="custom-control-label" for="draft">Draft</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="saveData" class="btn btn-primary float-right">Publish</button>
                        </div>
                    </div>

                    <div class="card" id="app">
                        <div class="card-header">
                            <span>Menu</span>
                        </div>
                        <div class="card-body">
                            <div id="viewMenu">
                                <div class="mb-2">
                                    <select class="form-control" name="dataMenu" id="dataMenu" required>
                                        <option value="">--Select Menu--</option>
                                        {!! $menu !!}
                                    </select>
                                </div>

                                <div class="showMenu" style="display: none">
                                    <hr>
                                    <div id="formMenu">
                                        <div class="show-error-msg" style="color:red; display:none">
                                            <ul></ul>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="menu" placeholder="menu"
                                                   name="menu">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="parentMenu" id="parentMenu">
                                                <option value="0">--Parent Menu--</option>
                                                {!!  $menu  !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="btn-a pull-left" id="addMenu">Add New menu</a>
                            <a class="btn-a pull-right showMenu" id="saveMenu" style="display: none">Save</a>
                        </div>
                    </div>

                    <div class="card" id="app">
                        <div class="card-header">
                            <span>Category</span>
                        </div>
                        <div class="card-body">
                            <div id="viewCat">
                                <div class="form-group">
                                    <select class="form-control" name="dataCategory" id="dataCategory">
                                        <option value="">--Select Category--</option>
                                        {!! $category !!}
                                    </select>
                                </div>
                                <div class="showCat" style="display: none">
                                    <hr>
                                    <div id="formCategory">
                                        <div class="show-error-msg" style="color:red; display:none">
                                            <ul></ul>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="category" placeholder="Category"
                                                   name="category"  value="{{ old('titleCategory') }}">
                                        </div>
                                        <input type="hidden" value="post" id="module" name="module">
                                        <div class="form-group">
                                            <select class="form-control" name="parentCat" id="parentCat">
                                                <option value="0">--Parent Category--</option>
                                                {!! $category !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="btn-a pull-left" id="addCat">Add New Category</a>
                            <a class="btn-a pull-right showCat" id="saveCat" style="display: none">Save</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <span>Featured Image</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group {{ !empty($errors->first('image')) ? 'has-error':'' }}">
                                <div class="input-group">
                                    <div class="box-image" id="box-image1">
                                        <input type="file" id="file1" name="image" class="input-image"
                                               onchange="uploadImage(this, 1);" accept="image/*"/>
                                        <input hidden name="updateImg1" id="updateImg1">
                                        @if($data->image)
                                            <img id="ShowImage11" src="{{ url('media/thumb/'.$data->image) }}"
                                                 class="img-responsive">
                                            <label class="icon-upload" for="file1" id="showUpload1"
                                                   style="display: none">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                                     viewBox="0 0 20 17">
                                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                </svg>
                                                <br>
                                                <span>Pilih Gambar</span>
                                            </label>
                                            <div id="change-img11">
                                                <label for="file1"><i class="fa fa-edit"></i></label> |
                                                <label onclick="removeImage(1);"><i class="fa fa-trash"></i></label>
                                            </div>
                                        @else
                                            <label class="icon-upload" for="file1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17"
                                                     viewBox="0 0 20 17">
                                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                </svg>
                                            </label>
                                            <br>
                                            <span>Pilih Gambar</span>
                                        @endif
                                    </div>
                                    <div id="ShowImage1" class="img-responsive"></div>
                                    <div id="change-img1" style="display: none" class="text-center edit-image">
                                        <label for="file1"><i class="fa fa-edit"></i></label> |
                                        <label onclick="removeImage(1);"><i class="fa fa-trash"></i></label>
                                    </div>
                                </div>
                                <div class="error">{{ $errors->first('image') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" id="dataCheckedPlugin" name="dataPlugin">
            <input type="hidden" id="urlSaveCategory" value="{{ url('/admz/category/save/post') }}">
            <input type="hidden" id="urlSaveMenu" value="{{ url('admz/menu/save') }}">

           </form>

    </section>

    <script>
        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl: '{{ asset('admin/plugins/ckeditor/plugins/filemanager/dialog.php') }}?type=2&editor=ckeditor&fldr=',
            filebrowserUploadUrl: '{{ asset('admin/plugins/ckeditor/plugins/filemanager/dialog.php') }}?type=2&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl: '{{ asset('admin/plugins/ckeditor/plugins/filemanager/dialog.php') }}?type=1&editor=ckeditor&fldr='
        });

        $("#dataMenu").val({{ $data->menu_id }});
        $("#dataCategory").val({{ $data->category_id }});
    </script>

@endsection
