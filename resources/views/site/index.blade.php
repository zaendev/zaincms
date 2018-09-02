@extends('site.master')
@section('content')

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for($i = 0; $i < count($slide); $i++)
             <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active':'' }}"></li>
            @endfor
        </ol>
        <div class="carousel-inner">
            @foreach($slide as $key => $s)
                <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
                    <img class="d-block w-100" src="{{ asset('media/images/'. $s->image) }}" alt="{{ $s->title }}">
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="content-home">
        <div class="container">
            <div class="row container-mobile">
                @foreach ($post as $key => $p)
                    @if($key == 9)
                       @break
                    @endif
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
            </div>
        </div>
    </div>

@endsection