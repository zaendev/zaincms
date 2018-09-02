@extends('site.master')
@section('content')

    @if( !empty($post->image) )
        <div class="banner bg-img" style="background-image: url('{{ url('images/'.$post->image) }}')">
        </div>
    @endif

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <span class="date">{{ \Carbon\Carbon::parse($post->created_at)->format('l, d F Y') }}</span>
                    <h1 class="title-blog">{{ $post->title }}</h1>

                    {!! $post->content !!}

                    @include('site.comment.index')
                </div>
                <div class="col-md-3">
                    <div class="list-group">
                        <h4 class="list-group-item text-center">Category</h4>

                        @foreach($category as $c)
                            <a href="{{ url('category/'.$c['slug']) }}"
                               class="list-group-item list-group-item-action">{{ $c['title'] }}</a>
                            @if(array_key_exists('child', $c))
                                @foreach($c['child'] as $c1)
                                    <a href="{{ url('category/'.$c1['slug']) }}" class="list-group-item list-group-item-action">
                                        - {{ $c1['title'] }}</a>
                                    @if(array_key_exists('child', $c1))
                                        @foreach($c1['child'] as $c2)
                                            <a href="{{ url('category/'.$c2['slug']) }}" class="list-group-item list-group-item-action">
                                                -- {{ $c2['title'] }}</a>
                                            @if(array_key_exists('child', $c2))
                                                @foreach($c2['child'] as $c3)
                                                    <a href="{{ url('category/'.$c3['slug']) }}"
                                                       class="list-group-item list-group-item-action">
                                                        --- {{ $c3['title'] }}</a>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
