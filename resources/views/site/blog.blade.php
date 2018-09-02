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
                <div class="row">
                    <div class="col-md-9">
                        <div class="row container-mobile">
                            @foreach ($post as $p)
                                <div class="box-blog col-md-6 col-6 col-sm-6">
                                    <div class="card">
                                        <a href="{{ url($p->menu->slug.'/'.$p->slug) }}">
                                            <img class="card-img-top" src="{{ $p->thumb }}"
                                                 alt="{{ $p->title }}">
                                            <div class="card-body">
                                                <span class="date">{{ \Carbon\Carbon::parse($p->created_at)->format('l, d F Y') }}</span>
                                                <p class="card-text">
                                                    {{ $p->title }}
                                                </p>
                                            </div>
                                        </a>
                                        <div class="card-footer">
                                    <span class="float-left">
                                         <i class="fa fa-eye"></i> {{ $p->view }}
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="pagination">
                                {{ $post->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="list-group">
                            <h4 class="list-group-item text-center">Artikel Populer</h4>
                            @foreach($oPost as $key => $op)
                                @if($key == 10)
                                    @breack
                                @endif
                                <a href="{{ url($op->menu->slug.'/'.$op->slug) }}" class="list-group-item list-group-item-action">
                                    <p>{{ $op->title }}</p>
                                    <small>
                                        <span class="date">{{ \Carbon\Carbon::parse($op->created_at)->format('l, d F Y') }}</span>
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
