@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Config</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                @if (session('message'))
                    <div class="callout callout-success alert-dismissible">
                        <button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
 <br>
                <form action="{{ url('admz/config', $data->id) }}" enctype="multipart/form-data" method="post">
                    @method('PUT')
                    @csrf

                    <div class="form-group row {{ !empty($errors->first('site_title')) ? 'has-error':'' }}">
                        <label for="siteTitle" class="col-sm-2 col-form-label">Site Title</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="siteTitle" name="site_title" placeholder="Site Title" value="{{ $data->site_title }}">
                        </div>
                        <div class="error">{{ $errors->first('site_title') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('author')) ? 'has-error':'' }}">
                        <label for="author" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="author" name="author" placeholder="Author" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="error">{{ $errors->first('author') }}</div>
                    </div>
<br>
                    <div class="form-group row {{ !empty($errors->first('telp')) ? 'has-error':'' }}">
                        <label for="telp" class="col-sm-2 col-form-label">Telp</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="telp" name="telp" placeholder="Telp" value="{{ $data->telp }}">
                        </div>
                        <div class="error">{{ $errors->first('telp') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('address')) ? 'has-error':'' }}">
                        <label for="editor" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-5">
                            <textarea id="editor" class="form-control" name="address" placeholder="Address">{{ $data->address }}</textarea>
                        </div>
                        <div class="error">{{ $errors->first('address') }}</div>
                    </div>
<br>
                    <div class="form-group row {{ !empty($errors->first('fb')) ? 'has-error':'' }}">
                        <label for="fb" class="col-sm-2 col-form-label">Facebook</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="fb" name="fb" placeholder="Facebook" value="{{ $data->fb }}">
                        </div>
                        <div class="error">{{ $errors->first('fb') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('twitter')) ? 'has-error':'' }}">
                        <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter" value="{{ $data->twitter }}">
                        </div>
                        <div class="error">{{ $errors->first('twitter') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('instagram')) ? 'has-error':'' }}">
                        <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="{{ $data->instagram }}">
                        </div>
                        <div class="error">{{ $errors->first('instagram') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('gplus')) ? 'has-error':'' }}">
                        <label for="gplus" class="col-sm-2 col-form-label">Google+</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="gplus" name="gplus" placeholder="Google+" value="{{ $data->gplus }}">
                        </div>
                        <div class="error">{{ $errors->first('gplus') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('pinterest')) ? 'has-error':'' }}">
                        <label for="pinterest" class="col-sm-2 col-form-label">Pinterest</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="pinterest" name="pinterest" placeholder="Pinterest" value="{{ $data->pinterest }}">
                        </div>
                        <div class="error">{{ $errors->first('pinterest') }}</div>
                    </div>
<br>
                    <div class="form-group row {{ !empty($errors->first('lng')) ? 'has-error':'' }}">
                        <label for="lng" class="col-sm-2 col-form-label">Longitude</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="lng" name="lng" placeholder="Longitude" value="{{ $data->lng }}">
                        </div>
                        <div class="error">{{ $errors->first('lng') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('lat')) ? 'has-error':'' }}">
                        <label for="lng" class="col-sm-2 col-form-label">Latitude</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="lat" name="lat" placeholder="Latitude" value="{{ $data->lat }}">
                        </div>
                        <div class="error">{{ $errors->first('lat') }}</div>
                    </div>
<br>
                    <div class="form-group row {{ !empty($errors->first('seo')) ? 'has-error':'' }}">
                        <label for="seo" class="col-sm-2 col-form-label">Description Seo</label>
                        <div class="col-sm-5">
                            <textarea id="seo" name="seo" class="form-control" rows="3" placeholder="Description Seo">{{ $data->seo }}</textarea>
                        </div>
                        <div class="error">{{ $errors->first('seo') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('keyword')) ? 'has-error':'' }}">
                        <label for="keyword" class="col-sm-2 col-form-label">Keyword</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword" value="{{ $data->keyword }}">
                        </div>
                        <div class="error">{{ $errors->first('keyword') }}</div>
                    </div>
<br>
                    <div class="form-group row {{ !empty($errors->first('email')) ? 'has-error':'' }}">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-5">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="error">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group row {{ !empty($errors->first('password')) ? 'has-error':'' }}">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-5">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="">
                        </div>
                        <div class="error">{{ $errors->first('password') }}</div>
                    </div>
    <br>
                    <div class="row">
                        <div class="col-sm-2"><b>Image</b></div>
                        <div class="col-sm-4">
                            <div class="error">{{ $errors->error->first('image') }}</div>
                            <div class="row">
                                <div class="col-md-6 box-img">
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
                                    <div id="change-img1" style="display: none" class="text-center">
                                        <label for="file1"><i class="fa fa-edit"></i></label> |
                                        <label onclick="removeImage(1);"><i class="fa fa-trash"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 mt-2">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>

    <script>
        CKEDITOR.replace('editor', {
        });
    </script>

@endsection
