@extends('site.master')
@section('content')

    <div class="bg-header"></div>

    <div class="container">
        <div class="content">
            <div class="bg-title-category">
                <h1>{{ $data->title }}</h1>
                <p>{!! $data->content !!}</p>
            </div>
            <div class="content-blog">

            </div>
        </div>
    </div>

@endsection
