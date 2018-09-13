@extends('layouts.blueTheme')

@section('content')
<div class="QuestionList QuestionHotList">
    <div class="zh-general-list clearfix">
        @foreach($questions as $question)
        <div class="feed-item feed-item-hook question-item">
            <h2 class="question-item-title">
                <a target="_blank" class="question_link" href="/question/{{$question->id}}">
                    {{$question->title}}
                </a>
            </h2>
            <div class="question-item-meta">
                <span class="zg-link-gray-normal meta-item">{{$question->answers_count}} 个回答</span>
                <span class="zg-bull">•</span>
                <span class="zg-link-gray-normal meta-item">{{$question->followers_count}} 人关注</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
