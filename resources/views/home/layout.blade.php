<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>


    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>
<body>
<div class="header">
    <div class="header-box max-width">
        <div class="logo"><div class="log-img"><img src="{{ asset('img/ic_logo.png') }}" alt=""></div><div class="log-text">一个不看学历的招聘网站</div></div>
        <div class="nav_login">
            <div class="navigation">
                <ul>
                    <li><a href="">首页</a></li>
                    <li class="current"><a href="">职位</a></li>
                    <li><a href="">就业资讯</a></li>
                    <li><a href="">联系我们</a></li>
                </ul>
            </div>
            <div class="login">
                <div class="login-img"><img src="{{ asset('img/ic_WeChat.png') }}" alt=""></div>
                <div class="login-text"><a href="">微信登录</a></div></div>
        </div>


    </div>

</div>

@yield('content')
<div class="footer">
    <div class="footer-box max-width">
        © 区域聘  2018
    </div>
</div>
</body>
</html>