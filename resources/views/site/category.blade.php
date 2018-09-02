@extends('site.master')
@section('content')

    <div class="content search">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        @foreach ($post as $p)
                            <div class="box-blog col-md-4 col-6 col-sm-4">
                                <div class="card">
                                    <a href="{{ url('/'.$p['slug_cat'].'/'.$p['slug']) }}">
                                        <img class="card-img-top" src="{{ url('thumb/'.$p['image']) }}"
                                             alt="{{ $p['title'] }}">
                                        <div class="card-body">
                                            <span class="date">{{ \Carbon\Carbon::parse($p['created_at'])->format('l, d F Y') }}</span>
                                            <p class="card-text">
                                                {{ $p['title'] }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
