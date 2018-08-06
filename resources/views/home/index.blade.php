@extends('home.layout')

@section('content')
    <div id="myCarousel" class="carousel slide row">
        <!-- 轮播（Carousel）指标 -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        </ol>
        <!-- 轮播（Carousel）项目 -->
        <div class="carousel-inner">
            <div class="item active">
                <img class="carousel-inner img-responsive" src="http://cablehc.com/resource/frontend/images/home/banner01.png" alt="First slide">
            </div>
            <div class="item">
                <img class="carousel-inner img-responsive" src="http://cablehc.com/resource/frontend/images/home/banner02.png" alt="Second slide">
            </div>
            <div class="item">
                <img class="carousel-inner img-responsive" src="http://cablehc.com/resource/frontend/images/home/banner03.png" alt="Third slide">
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row clearfix">

            <div class="col-md-12 column">

            </div>
        </div>
    </div>
@stop
