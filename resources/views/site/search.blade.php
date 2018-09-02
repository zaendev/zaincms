@extends('site.master')
@section('content')

    <div class="bg-header"></div>

    <div class="container">
        <div class="content">
            <div class="bg-title-category">
                @if(count((array)$post) == 0)
                    <h1>Pencarian Tidak di Temukan</h1>
                @else
                    <h1>{{ $_GET['search'] }}</h1>
                @endif
            </div>
            <div class="content-blog">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row container-mobile">
                            @foreach ($post as $p)
                                <div class="box-blog col-md-4 col-6 col-sm-6">
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
                                            <span class="float-right">
                                        <a href="{{ url($p->menu->slug) }}"> {{ $p->menu->title }}</a>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="pagination">
                                {{ $post->appends(array("search" => !empty($_GET['search']) ? $_GET['search']:'' ))->render() }}
                            </div>
                        </div>
                    </div>
                </div>
>>>>>>> update
            </div>
        </div>
    </div>

@endsection
