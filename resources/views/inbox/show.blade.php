@extends('layouts.blueTheme')

@section('content')
<div class="zg-section">
    <a href="/inbox">« 返回</a>
</div>
<div class="zg-section">
    <span class="zg-gray-normal">发私信给 </span>
    <span class="zg-gray-darker">
        {{$inbox->message[0]->fromUser->id == Auth::id() ? $inbox->message[0]->toUser->name : $inbox->message[0]->fromUser->name }}
    </span>
    ：
</div>
<div class="zg-section">
    <form id="MessageForm" action="" method="get">
        <div class="zg-editor-simple-wrap zg-form-text-input">
            <textarea name="content" id="messageInput" class="zg-editor-input zu-seamless-input-origin-element" style="font-weight: normal; height: 22px;"></textarea>
        </div>
        <div class="zm-command">
            <button name="send" class="zg-btn-blue zg-r3px">发送</button>
        </div>
    </form>
</div>
<div id="zh-pm-detail-item-wrap" class="navigable">
    @foreach($inbox->message as $message)
        <div class="zm-pm-item">
            <a class="zm-item-link-avatar50" href="/people/{{$message->fromUser->id}}">
                <img class="zm-item-img-avatar50" src="{{$message->fromUser->avatar}}">
            </a>
            <div class="zm-pm-item-main">
                <a id="pmto-1167809710" class="pm-touser author-link" href="/people/{{$message->fromUser->id}}">
                    {{$message->fromUser->id == Auth::id() ? '我' : $message->fromUser->name }}
                </a>
                ：{{$message->content}}
            </div>
            <div class="zg-gray zu-pm-item-meta clearfix">
                <span class="zg-gray zg-left">
                    {{$message->created_at->diffForHumans()}}
                </span>
                <a class="zg-link-litblue" href="javascript:;" name="reply">回复</a>
                <span class="zg-bull">|</span>
                <a class="zg-link-litblue" href="javascript:;" name="delete">删除</a>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('js')
<script>
    $('#MessageForm').submit(function (e) {
        $.ajax({
            url: '/message',
            type: 'POST',
            data: {
                to_user_id: {{$inbox->message[0]->fromUser->id == Auth::id() ? $inbox->message[0]->toUser->id : $inbox->message[0]->fromUser->id }},
                content: $('#messageInput').val()
            },
            success: function () {
                location.reload();
            }
        });
        return false;
    });
</script>
@endsection
