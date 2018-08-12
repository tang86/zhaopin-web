@extends('home.layout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
    <div class="block00">
        <div class="container">
            <div class="row clearfix">
                @foreach($news as $n)
                    <a href="{{ url('/news/'.$n->id) }}">
                        <div class="col-md-6 column">
                            <div class="block00-item">
                                <div class="block00-img">
                                    <img src="{{ asset($n->banner) }}" alt="">
                                </div>
                                <div class="block00-text">
                                    <h1 title="{{ $n->title }}">{{ str_limit($n->title, $limit = 18, $end = '...') }}</h1>
                                    <p title="{{ $n->brief }}">{{ str_limit($n->brief, $limit = 100, $end = '...') }}</p>
                                    <div class="block00-foot">
                                        <div class="hits">浏览量：<span class="hits-number">{{ $n->hits }}</span></div>
                                        <div class="date">{{ date('Y-m-d', strtotime($n->created_at)) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                @endforeach



                <div class="col-md-12 column text-center">{{ $news->links() }}</div>
            </div>
        </div>
    </div>
@stop
