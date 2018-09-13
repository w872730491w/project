<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-touchevents">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/blueTheme.css') }}" rel="stylesheet">
    <style media="screen">
        .login-button{
            float: right;
            margin-top: 7px;
            background: #0084ff;
            border: 1px solid #045bb2;
            height: 30px;
            line-height: 32px;
            color: #fff;
            padding: 0 16px;
            border-radius: 4px;
            cursor: pointer;
            display: inline-block;
        }
        .login-button:hover {
            text-decoration: none;
        }
    </style>
</head>

<body class="zhi">
    <div id="app">
        <div class="zu-top">
            <div class="zg-wrap modal-shifting clearfix">
                <a href="/" class="zu-top-link-logo" id="zh-top-link-logo">知乎</a>
                @auth
                    <div class="top-nav-profile">
                        <a href="/people/{{Auth::id()}}" class="zu-top-nav-userinfo" role="button">
                            <span class="name">{{Auth::user()->name}}</span>
                            <img class="Avatar" src="{{Auth::user()->avatar}}" srcset="{{Auth::user()->avatar}} 2x" alt="{{Auth::user()->name}}">
                        </a>
                        <ul class="top-nav-dropdown">
                                <li>
                                    <a href="/people/{{Auth::id()}}" tabindex="-1">
                                        <i class="zg-icon zg-icon-dd-home"></i>我的主页
                                    </a>
                                </li>
                                <li>
                                    <a href="/inbox" tabindex="-1">
                                        <i class="zg-icon zg-icon-dd-pm"></i>私信
                                    </a>
                                </li>
                                <li>
                                    <a href="/settings" tabindex="-1">
                                        <i class="zg-icon zg-icon-dd-settings"></i>设置
                                    </a>
                                </li>
                                <li>
                                    <a href="/logout" tabindex="-1">
                                        <i class="zg-icon zg-icon-dd-logout"></i>退出
                                    </a>
                                </li>
                            </ul>
                    </div>
                @else
                    <a href="/login" class="login-button">登陆</a>
                @endauth
                <div class="zu-top-search">
                    <form method="GET" action="/search" id="zh-top-search-form" class="zu-top-search-form">
                        <input type="text" class="zu-top-search-input" name="q" autocomplete="off" maxlength="100" placeholder="搜索你感兴趣的内容…">
                        <button type="submit" class="zu-top-search-button">
                            <span class="sprite-global-icon-magnifier-dark"></span>
                        </button>
                    </form>
                </div>
                <div class="zu-top-nav">
                    <ul class="zu-top-nav-ul zg-clear">
                        <li class="zu-top-nav-li" id="zh-top-nav-home">
                            <a class="zu-top-nav-link" href="/">
                                首页
                            </a>
                        </li>
                        <li class="zu-top-nav-li">
                            <a class="zu-top-nav-link" href="/explore">
                                发现
                            </a>
                        </li>
                        <li class="zu-top-nav-li">
                            <a class="zu-top-nav-link" href="/topic">
                                话题
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="zg-wrap zu-main clearfix">
            <div class="zu-main-content">
                <div class="zu-main-content-inner">
                    @yield('content')
                </div>
            </div>
            <div class="zu-main-sidebar">
                @yield('sidebar')
            </div>
        </div>
    </div>

    <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
    <script>
        $('.zm-topic-cat-sub .item .follow:not([href])').click(function () {
            $.ajax({
                url: '/follow/topic',
                type: 'POST',
                data: {
                    id: $(this).attr('data-id')
                },
                success: function () {
                    $(this).find('span').html((index, html) => {
                        if(html.trim() == '关注') {
                            $('.followTopic_count').html((index, html) => {
                                return parseInt(html) + 1;
                            });
                            return '取消关注';
                        } else {
                            $('.followTopic_count').html((index, html) => {
                                return parseInt(html) - 1;
                            });
                            return '关注';
                        }
                    });
                    $(this).toggleClass('zg-follow').toggleClass('zg-unfollow');
                }.bind(this)
            });
        });
    </script>
    @yield('js')
</body>

</html>
