@extends('layouts.app')

@section('content')
<div class="Search-container">
    <div style="width: 100%;">
        <div class="Card SearchSections">
            <div class="List">
                @foreach($topics as $topic)
                <div class="List-item">
                    <div class="ContentItem">
                        <div class="ContentItem-main">
                            <div class="ContentItem-image">
                                <a class="TopicLink" href="/topic/{{$topic->id}}" target="_blank">
                                    <img class="Avatar Avatar--large TopicLink-avatar" width="60" height="60" src="{{$topic->topic_pic}}" srcset="{{$topic->topic_pic}} 2x" alt="{{$topic->name}}">
                                </a>
                            </div>
                            <div class="ContentItem-head">
                                <h2 class="ContentItem-title">
                                    <a class="TopicLink" href="//www.zhihu.com/topic/20136420" target="_blank">
                                        {{$topic->name}}
                                    </a>
                                    <span class="SearchItem-type">话题</span>
                                </h2>
                                <div class="ContentItem-meta">
                                    <div class="ContentItem-status">
                                        <span class="ContentItem-statusItem Search-statusLink">{{$topic->followers_count}} 关注</span>
                                        <span class="ContentItem-statusItem Search-statusLink">{{$topic->question()->count()}} 问题</span>
                                    </div>
                                </div>
                            </div>
                            <div class="ContentItem-extra">
                                <button type="button" class="Button FollowButton Button--primary Button--blue">关注话题</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @foreach($users as $user)
                <div class="List-item">
                    <div class="ContentItem">
                        <div class="ContentItem-main">
                            <div class="ContentItem-image">
                                <span class="UserLink">
                                    <a class="UserLink-link" target="_blank" href="/people/{{$user->id}}">
                                        <img class="Avatar Avatar--large UserLink-avatar" width="60" height="60" src="{{$user->avatar}}" srcset="{{$user->avatar}} 2x" alt="{{$user->name}}">
                                    </a>
                                </span>
                            </div>
                            <div class="ContentItem-head">
                                <h2 class="ContentItem-title">
                                    <span class="UserLink SearchItem-userTitle">
                                        <a class="UserLink-link" target="_blank" href="/people/{{$user->id}}">
                                            {{$user->name}}
                                        </a>
                                    </span>
                                    <span class="SearchItem-type">用户</span>
                                </h2>
                                <div class="ContentItem-meta">
                                    <div class="RichText ztext SearchItem-meta">{{$user->profile->introduction}}</div>
                                    <div class="ContentItem-status">
                                        <span class="ContentItem-statusItem Search-statusLink">{{$user->answers_count}} 回答</span>
                                        <span class="ContentItem-statusItem Search-statusLink">{{$user->followings_count}} 关注者</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @foreach($questions as $question)
            <question-card :question="{{$question->toJson()}}"></question-card>
        @endforeach
        @if(!count($topics) && !count($questions) && !count($users))
            <div class="Card SearchNoContent-wrapper">
                <div class="SearchNoContent-content">
                    <div class="SearchNoContent-title">没有想要的内容</div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('js')
@if(!count($topics) && !count($questions) && !count($users))
    <script>
        $('.SearchBar-input input').focus();
    </script>
@endif
<script>
    $('.Search-container')
</script>
@endsection
