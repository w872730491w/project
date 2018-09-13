@extends('layouts.blueTheme')

@section('content')
<div class="page-inbox">
    <div class="PageInbox-nav">
        <div class="PageInbox-nav-inner">
            <ul class="PageInbox-nav-tabs">
                <li>最近联系</li>
            </ul>
        </div>
    </div>
    <div class="navigable">
        @foreach($inboxes as $inbox)
            @php($user = $inbox->message->fromUser->id == Auth::id() ? $inbox->message->toUser : $inbox->message->fromUser)
            <div class="zm-pm-item">
                <a class="zm-item-link-avatar50" href="/people/{{$user->id}}">
                    <img class="zm-item-img-avatar50" src="{{$user->avatar}}">
                </a>
                <div class="zm-pm-item-main">
                    {{$inbox->message->fromUser->id == Auth::id() ? '我发送给' : ''}}
                    <a title="{{$user->name}}" class="pm-touser author-link" href="/people/{{$user->id}}">{{$user->name}}</a>
                    ：{{str_limit($inbox->message->content, $limit = 50, $end = '...')}}
                </div>
                <div class="zg-gray zu-pm-item-meta">
                    <span class="zg-gray zg-left">
                        {{$inbox->message->created_at->diffForHumans()}}
                    </span>
                    <a class="zg-link-litblue" href="/inbox/{{$inbox->id}}">查看对话</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
