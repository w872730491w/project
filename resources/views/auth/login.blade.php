@extends('layouts.sign')

@section('label')
登陆
@endsection

@section('body')
<form class="SignFlow" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="SignFlow-account">
        <div class="SignFlowInput SignFlow-accountInputContainer">
            <div class="SignFlow-accountInput Input-wrapper">
                <input name="email" autocomplete="off" type="email" value="{{ old('email') }}" class="Input" placeholder="邮箱">
            </div>
            <div class="SignFlowInput-errorMask {{$errors->has('email') ? '' : 'SignFlowInput-errorMask--hidden'}} SignFlowInput-requiredErrorMask">
                {{ $errors->has('email') ? $errors->first('email') : '' }}
            </div>
        </div>
    </div>
    <div class="SignFlow-password">
        <div class="SignFlowInput">
            <div class="Input-wrapper">
                <input name="password" id="passInput" type="password" class="Input" placeholder="密码">
            </div>
            <div class="SignFlowInput-errorMask {{$errors->has('password') ? '' : 'SignFlowInput-errorMask--hidden'}} SignFlowInput-requiredErrorMask">
                {{ $errors->has('password') ? $errors->first('password') : '' }}
            </div>
        </div>
        <button tabindex="-1" type="button" class="Button SignFlow-switchPassword Button--plain">
            <svg width="24" height="20" viewBox="0 0 24 24" class="Icon SignFlow-switchPasswordIcon Icon--inconspicuous" aria-hidden="true" style="vertical-align: middle; height: 20px; width: 24px;"><title></title><g><title>Inconspicuous</title><path d="M17.007 11.504c0 .65-.13 1.26-.36 1.83l3 3.073S23 14.136 23 11.504C23 8.008 17.255 4 11.995 4c-1.4 0-2.741.25-3.982.701l2.161 2.16c.57-.23 1.18-.36 1.831-.36a5.004 5.004 0 0 1 5.002 5.003zM2.57 4.342l2.067 2.075C3.499 7.258 1 9.119 1 11.504c0 3.336 5.79 7.503 11.005 7.503 1.55 0 3.031-.3 4.382-.84l.42.42 2.125 2.118s.782.571 1.314 0-.074-1.305-.074-1.305L3.955 3.183s-.76-.742-1.385-.19c-.626.554 0 1.35 0 1.35zm4.963 4.96l1.55 1.552c-.05.21-.08.43-.08.65 0 1.66 1.341 3.001 3.002 3.001.22 0 .44-.03.65-.08l1.551 1.551c-.67.33-1.41.53-2.2.53a5.004 5.004 0 0 1-5.003-5.002c0-.79.2-1.53.53-2.201zm4.312-.78l3.151 3.152.02-.16c0-1.66-1.34-3.001-3.001-3.001l-.17.01z" fill-rule="evenodd"></path></g></svg>
        </button>
    </div>
    <div class="Login-options">
        <label class="form-check-label" for="remember">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> 记住账号
        </label>
        <a href="/password/reset" class="Button Login-cannotLogin Button--plain">忘记密码？</a>
    </div>
    <button type="submit" class="Button SignFlow-submitButton Button--primary Button--blue">登录</button>
</form>
@endsection

@section('footer')
没有帐号？<a href="/register">注册</a>
@endsection
