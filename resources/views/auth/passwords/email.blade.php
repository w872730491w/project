@extends('layouts.sign')

@section('label')
<div>
    重置密码
</div>
@endsection

@section('body')
<form class="SignFlow" method="POST" action="{{ route('password.email') }}">
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
    <button type="submit" class="Button SignFlow-submitButton Button--primary Button--blue">发生邮件</button>
</form>
@endsection

@section('footer')
没有帐号？<a href="/register">注册</a>
@endsection
