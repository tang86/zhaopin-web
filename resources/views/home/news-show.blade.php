@extends('home.layout')
<link rel="stylesheet" href="{{ asset('css/news-show.css') }}">
@section('content')

    <div class="block00">
        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class="crumbs">就业资讯 > 资讯详情</div>
                    <div class="title">{{ $news->title }}</div>
                    <div class="date">时间：{{ $news->created_at }}</div>
                    <div class="content">{!! $news->content !!}</div>

                </div>


            </div>
        </div>
    </div>
@stop
