@extends('layouts.blueTheme')

@section('content')
    <div class="zm-topic-cat-title">
        @auth
        <a class="zg-link-gray zg-right">
            <span>已关注 <span class="followTopic_count">{{Auth::user()->userTopic()->count()}}</span> 个话题</span>
        </a>
        @endauth
        <h2>
            <i class="zg-icon zg-icon-topic-square"></i>话题广场
        </h2>
    </div>
    <div class="zm-topic-cat-sub">
        @foreach($topics as $topic)
        <div class="item">
            <div class="blk">
                <a target="_blank" href="/topic/{{$topic->id}}">
                    <img src="{{$topic->topic_pic}}" alt="{{$topic->name}}">
                    <strong>{{$topic->name}}</strong>
                </a>
                <p>{{$topic->desc ? $topic->desc : '暂无描述' }}</p>
                <a {{Auth::check() ?'':'href="/login"'}} data-id="{{$topic->id}}" class="follow meta-item {{$topic->is_follow ?'zg-unfollow':'zg-follow'}}">
                    <i class="z-icon-follow"></i>
                    <span>{{$topic->is_follow ? '取消关注' : '关注'}}</span>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection

@section('sidebar')
    <div class="zm-side-section explore-side-section">
        <div class="zm-side-section-inner">
            <div class="section-title">
                <h3>热门话题</h3>
            </div>
            <ul class="list hot-topics">
                @foreach($hotTopics as $topic)
                <li class="clearfix">
                    <a target="_blank" class="avatar-link" href="/topic/{{$topic->id}}">
                        <img src="{{$topic->topic_pic}}" alt="{{$topic->name}}" class="avatar 40">
                    </a>
                    <div class="content">
                        <a href="/topic/{{$topic->id}}" target="_blank">{{$topic->name}}</a>
                        <div class="meta">
                            <span>{{$topic->followers_count}} 人关注</span>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
