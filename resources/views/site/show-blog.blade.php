@extends('site.master')
@section('content')

    <div class="bg-header"></div>

    <div class="container">
        <div class="content">
            <div class="bg-img-blog" style="background-image: url('{{ $data->image }}')"></div>
            <div class="content-blog">
            <div class="row">
                <div class="col-md-9">
                        <span class="date">{{ \Carbon\Carbon::parse($data->created_at)->format('l, d F Y') }}</span>
                        <h1 class="title-blog">{{ $data->title }}</h1>

                        {!! $data->content !!}

                        <hr>
                        <div class="float-right" id="share">Share :</div>
                </div>
                    <div class="col-md-3">
                        <div class="list-group">
                            <h4 class="list-group-item text-center">Artikel Terkait</h4>
                            @foreach($oPost as $p)
                                <a href="{{ url($p->menu->slug.'/'.$p->slug) }}"
                                   class="list-group-item list-group-item-action">
                                    <p>{{ $p->title }}</p>
                                    <small>
                                        <span class="date">{{ \Carbon\Carbon::parse($p->created_at)->format('l, d F Y') }}</span>
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#share").jsSocials({
            showLabel: false,
            showCount: false,
            shares: ["email", "twitter", "facebook", "googleplus", "pinterest", "whatsapp"]
        });
    </script>

@endsection
