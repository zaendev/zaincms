@extends('home.master')
@section('content')

     @if( !empty($page->img) )
         <div class="jumbotron jumbotron-category bg-img" style="background-image: url('{{ url('image/'.$page->img) }}')">
     @else
        <div class="jumbotron jumbotron-category">
     @endif
            <div class="container">
                <h1 class="display-3 text-center">{{ $page->title }}</h1>
            </div>
        </div>


    <div class="container mb-5">
        <div class="row">

            <div class="col-md-12">
                {!! $page->description !!}
            </div>

        </div>
    </div>

@endsection
