<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/sign.css') }}" rel="stylesheet">
    <style media="screen">
        .Card {
            padding: 30px 20px;
            font-size: 25px;
            color: #1a1a1a;
        }
        a {
            color: #0084ff;
        }
    </style>
</head>

<body>
    <div class="SignFlowHomepage">
        <div class="SignFlowHomepage-content">
            <div class="Card SignContainer-content">
                注册成功！去邮箱激活吧！<a href="/">去首页</a>
            </div>
        </div>
    </div>
</body>

</html>
