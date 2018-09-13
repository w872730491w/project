@extends('layouts.question')

@section('questionMain')
    @if($question->answers_count > 3)
    <div class="Card">
        <a class="QuestionMainAction" href="/question/{{$question->id}}">
            查看全部 {{ $question->answers_count }} 个回答
        </a>
    </div>
    @endif
    <div class="Card AnswerCard">
        <div class="QuestionAnswer-content">
            <div class="ContentItem AnswerItem">
                <div class="ContentItem-meta">
                    <div class="AuthorInfo AnswerItem-authorInfo AnswerItem-authorInfo--related">
                        <div user-id="{{ $question->answer[0]->user->id }}" class="UserLink AuthorInfo-avatarWrapper">
                            <a class="UserLink-link" target="_blank" href="/people/{{$question->answer[0]->user->id}}">
                                <img class="Avatar AuthorInfo-avatar" width="38" height="38" src="{{$question->answer[0]->user->avatar}}" srcset="{{$question->answer[0]->user->avatar}} 2x" alt="{{$question->answer[0]->user->name}}">
                            </a>
                        </div>
                        <div class="AuthorInfo-content">
                            <div class="AuthorInfo-head">
                                <span user-id="{{ $question->answer[0]->user->id }}" class="UserLink AuthorInfo-name">
                                    <a class="UserLink-link" target="_blank" href="/people/{{$question->answer[0]->user->id}}">
                                        {{$question->answer[0]->user->name}}
                                    </a>
                                </span>
                            </div>
                            <div class="AuthorInfo-detail">
                                <div class="AuthorInfo-badge">
                                    <div class="RichText ztext AuthorInfo-badgeText"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($question->answer[0]->votes_count)
                    <div class="AnswerItem-extraInfo">
                        <span class="Voters">
                            <button type="button" class="Button Button--plain">{{$question->answer[0]->votes_count}} 人赞同了该回答</button>
                        </span>
                    </div>
                    @endif
                </div>
                <div class="RichContent RichContent--unescapable">
                    <div class="RichContent-inner">
                        <span class="RichText ztext CopyrightRichText-richText">
                            {!! $question->answer[0]->body !!}
                        </span>
                    </div>
                    <div class="ContentItem-time">
                        <a target="_blank" href="/question/{{$question->id}}/answer/{{$question->answer[0]->id}}">
                            <el-tooltip content="发布于 {{$question->answer[0]->created_at}}" placement="top">
                                <span>编辑于 {{$question->answer[0]->updated_at}}</span>
                            </el-tooltip>
                        </a>
                    </div>
                    <!-- <button type="button" class="Button ContentItem-rightButton Button--plain">展开阅读全文<svg viewBox="0 0 10 6" class="Icon ContentItem-arrowIcon Icon--arrow" width="10" height="16" aria-hidden="true" style="height: 16px; width: 10px;"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg></button> -->
                    <div class="ContentItem-actions RichContent-actions">
                        <span>
                            <button answer-id="{{$question->answer[0]->id}}" {{Auth::check() && $question->answer[0]->user_id == Auth::id() ? 'disabled' :'' }}  aria-label="赞同" type="button" class="Button VoteButton VoteButton--up {{$question->answer[0]->is_vote ? 'is-active' : '' }}">
                                <span style="display: inline-flex; align-items: center;">
                                    ​<svg class="Zi Zi--TriangleUp VoteButton-TriangleUp" fill="currentColor" viewBox="0 0 24 24" width="10" height="10"><path d="M2 18.242c0-.326.088-.532.237-.896l7.98-13.203C10.572 3.57 11.086 3 12 3c.915 0 1.429.571 1.784 1.143l7.98 13.203c.15.364.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H3.955c-1.08 0-1.955-.517-1.955-1.9z" fill-rule="evenodd"></path></svg>
                                </span>
                                <span class="text">赞同</span>
                                <span class="count">{{$question->answer[0]->votes_count ? $question->answer[0]->votes_count : ''}}</span>
                            </button>
                        </span>
                        <button answer-id="{{$question->answer[0]->id}}" type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel ShowComment">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Comment Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd"></path></svg>
                            </span>
                            {{ $question->answer[0]->comments_count ? $question->answer[0]->comments_count.'条评论' : '添加评论' }}
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Share Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2.931 7.89c-1.067.24-1.275 1.669-.318 2.207l5.277 2.908 8.168-4.776c.25-.127.477.198.273.39L9.05 14.66l.927 5.953c.18 1.084 1.593 1.376 2.182.456l9.644-15.242c.584-.892-.212-2.029-1.234-1.796L2.93 7.89z" fill-rule="evenodd"></path></svg>
                            </span>
                            分享
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Star Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"></path></svg>
                            </span>
                            收藏
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">
                                ​<svg class="Zi Zi--Heart Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2 8.437C2 5.505 4.294 3.094 7.207 3 9.243 3 11.092 4.19 12 6c.823-1.758 2.649-3 4.651-3C19.545 3 22 5.507 22 8.432 22 16.24 13.842 21 12 21 10.158 21 2 16.24 2 8.437z" fill-rule="evenodd"></path></svg>
                            </span>
                            感谢
                        </button>
                    </div>
                    <comments type="answer" :type_id="{{$question->answer[0]->id}}" ref="comment{{$question->answer[0]->id}}" :count="{{$question->answer[0]->comments_count}}"></comments>
                </div>
            </div>
        </div>
    </div>
    @if($question->answers_count > 1)
    <div class="Card MoreAnswers">
        <div class="List">
            <div class="List-header">
                <h4 class="List-headerText">更多回答</h4>
            </div>
            @foreach($answers as $answer)
            <div class="List-item">
                <div class="ContentItem AnswerItem">
                    <div class="ContentItem-meta">
                        <div class="AuthorInfo AnswerItem-authorInfo AnswerItem-authorInfo--related">
                            <div user-id="{{ $answer->user->id }}" class="UserLink AuthorInfo-avatarWrapper">
                                <a class="UserLink-link" target="_blank" href="/people/{{$answer->user->id}}">
                                    <img class="Avatar AuthorInfo-avatar" width="38" height="38" src="{{$answer->user->avatar}}" srcset="{{$answer->user->avatar}} 2x" alt="{{$answer->user->name}}">
                                </a>
                            </div>
                            <div class="AuthorInfo-content">
                                <div class="AuthorInfo-head">
                                    <span user-id="{{ $question->answer[0]->user->id }}" class="UserLink AuthorInfo-name">
                                        <a class="UserLink-link" target="_blank" href="/people/{{$answer->user->id}}">
                                            {{$answer->user->name}}
                                        </a>
                                    </span>
                                </div>
                                <div class="AuthorInfo-detail">
                                    <div class="AuthorInfo-badge">
                                        <div class="RichText ztext AuthorInfo-badgeText"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($answer->votes_count)
                        <div class="AnswerItem-extraInfo">
                            <span class="Voters">
                                <button type="button" class="Button Button--plain">{{$answer->votes_count}} 人赞同了该回答</button>
                            </span>
                        </div>
                        @endif
                    </div>
                    <div class="RichContent RichContent--unescapable">
                        <div class="RichContent-inner">
                            <span class="RichText ztext CopyrightRichText-richText">
                                {!! $answer->body !!}
                            </span>
                        </div>
                        <div class="ContentItem-time">
                            <a target="_blank" href="/question/{{$question->id}}/answer/{{$answer->id}}">
                                <el-tooltip content="发布于 {{$answer->created_at}}" placement="top">
                                    <span>编辑于 {{$answer->updated_at}}</span>
                                </el-tooltip>
                            </a>
                        </div>
                        <!-- <button type="button" class="Button ContentItem-rightButton Button--plain">展开阅读全文<svg viewBox="0 0 10 6" class="Icon ContentItem-arrowIcon Icon--arrow" width="10" height="16" aria-hidden="true" style="height: 16px; width: 10px;"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg></button> -->
                    </div>
                    <div class="ContentItem-actions RichContent-actions">
                        <span>
                            <button answer-id="{{$answer->id}}" {{Auth::check() && $answer->user_id == Auth::id() ? 'disabled' :'' }}  aria-label="赞同" type="button" class="Button VoteButton VoteButton--up {{$answer->is_vote ? 'is-active' : '' }}">
                                <span style="display: inline-flex; align-items: center;">
                                    ​<svg class="Zi Zi--TriangleUp VoteButton-TriangleUp" fill="currentColor" viewBox="0 0 24 24" width="10" height="10"><path d="M2 18.242c0-.326.088-.532.237-.896l7.98-13.203C10.572 3.57 11.086 3 12 3c.915 0 1.429.571 1.784 1.143l7.98 13.203c.15.364.236.57.236.896 0 1.386-.875 1.9-1.955 1.9H3.955c-1.08 0-1.955-.517-1.955-1.9z" fill-rule="evenodd"></path></svg>
                                </span>
                                <span class="text">赞同</span>
                                <span class="count">{{$answer->votes_count ? $answer->votes_count : ''}}</span>
                            </button>
                        </span>
                        <button answer-id="{{$answer->id}}" type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel ShowComment">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Comment Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd"></path></svg>
                            </span>
                            {{ $answer->comments_count ? $answer->comments_count.'条评论' : '添加评论' }}
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Share Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2.931 7.89c-1.067.24-1.275 1.669-.318 2.207l5.277 2.908 8.168-4.776c.25-.127.477.198.273.39L9.05 14.66l.927 5.953c.18 1.084 1.593 1.376 2.182.456l9.644-15.242c.584-.892-.212-2.029-1.234-1.796L2.93 7.89z" fill-rule="evenodd"></path></svg>
                            </span>
                            分享
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​
                                <svg class="Zi Zi--Star Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"></path></svg>
                            </span>
                            收藏
                        </button>
                        <button type="button" class="Button ContentItem-action Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">
                                ​<svg class="Zi Zi--Heart Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2 8.437C2 5.505 4.294 3.094 7.207 3 9.243 3 11.092 4.19 12 6c.823-1.758 2.649-3 4.651-3C19.545 3 22 5.507 22 8.432 22 16.24 13.842 21 12 21 10.158 21 2 16.24 2 8.437z" fill-rule="evenodd"></path></svg>
                            </span>
                            感谢
                        </button>
                    </div>
                    <comments type="answer" :type_id="{{$answer->id}}" ref="comment{{$answer->id}}" :count="{{$answer->comments_count}}"></comments>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if($question->answers_count > 3)
    <div class="Card">
        <a class="QuestionMainAction" href="/question/{{$question->id}}">
            查看全部 {{ $question->answers_count }} 个回答
        </a>
    </div>
    @endif
@endsection

@section('questionSideBar')
<div class="Card AnswerAuthor">
    <div class="Card-header AnswerAuthor-title">
        <div class="Card-headerText">关于作者</div>
    </div>
    <div class="Card-section">
        <div class="AnswerAuthor-user">
            <div class="AnswerAuthor-user-avatar">
                <a class="UserLink-link" target="_blank" href="/people/{{$question->answer[0]->user->id}}">
                    <img class="Avatar Avatar--large UserLink-avatar" width="60" height="60" src="{{$question->answer[0]->user->avatar}}" srcset="{{$question->answer[0]->user->avatar}} 2x" alt="{{$question->answer[0]->user->name}}">
                </a>
            </div>
            <div class="AnswerAuthor-user-content">
                <div class="AnswerAuthor-user-name">
                    <a class="UserLink-link" target="_blank" href="/people/{{$question->answer[0]->user->id}}">
                        {{$question->answer[0]->user->name}}
                    </a>
                </div>
                <div class="AnswerAuthor-user-headline">
                    <div class="RichText ztext"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="Card-section">
        <div class="AnswerAuthor-counts">
            <div class="NumberBoard">
                <a type="button" class="Button NumberBoard-item Button--plain" href="/people/{{$question->answer[0]->user->id}}/answers">
                    <div class="NumberBoard-itemInner">
                        <div class="NumberBoard-itemName">回答</div>
                        <strong class="NumberBoard-itemValue" title="{{$question->answer[0]->user->answers_count}}">
                            {{$question->answer[0]->user->answers_count}}
                        </strong>
                    </div>
                </a>
                <a type="button" class="Button NumberBoard-item Button--plain" href="/people/{{$question->answer[0]->user->id}}/answers">
                    <div class="NumberBoard-itemInner">
                        <div class="NumberBoard-itemName">文章</div>
                        <strong class="NumberBoard-itemValue" title="9">9</strong>
                    </div>
                </a>
                <a type="button" id="followed" class="Button NumberBoard-item Button--plain" href="/people/{{$question->answer[0]->user->id}}/answers">
                    <div class="NumberBoard-itemInner">
                        <div class="NumberBoard-itemName">关注者</div>
                        <strong class="NumberBoard-itemValue" title="{{$question->answer[0]->user->followings_count}}">
                            {{$question->answer[0]->user->followings_count}}
                        </strong>
                    </div>
                </a>
            </div>
        </div>
        @ows($question->answer[0]->user->id)
        @else
        <div class="MemberButtonGroup AnswerAuthor-buttons">
            @isFollowed('follow', 'followed_user_id', $question->answer[0]->user->id)
            <button type="button" class="Button FollowButton Button--primary Button--grey">
                已关注
            </button>
            @else
                <button type="button" class="Button FollowButton Button--primary Button--blue">
                    <span style="display: inline-flex; align-items: center;">
                        ​<svg class="Zi Zi--Plus FollowButton-icon" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M13.491 10.488s-.012-5.387 0-5.998c-.037-1.987-3.035-1.987-2.997 0-.038 1.912 0 5.998 0 5.998H4.499c-1.999.01-1.999 3.009 0 3.009s5.995-.01 5.995-.01v5.999c0 2.019 3.006 2.019 2.997 0-.01-2.019 0-5.998 0-5.998s3.996.009 6.004.009c2.008 0 2.008-3-.01-3.009h-5.994z" fill-rule="evenodd"></path></svg>
                    </span>
                    关注他
                </button>
            @endif
            <button type="button" class="Button Button--grey Button--withIcon Button--withLabel">
                <span style="display: inline-flex; align-items: center;">​
                    <svg class="Zi Zi--Comments Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M11 2c5.571 0 9 4.335 9 8 0 6-6.475 9.764-11.481 8.022-.315-.07-.379-.124-.78.078-1.455.54-2.413.921-3.525 1.122-.483.087-.916-.25-.588-.581 0 0 .677-.417.842-1.904.064-.351-.14-.879-.454-1.171A8.833 8.833 0 0 1 2 10c0-3.87 3.394-8 9-8zm10.14 9.628c.758.988.86 2.009.86 3.15 0 1.195-.619 3.11-1.368 3.938-.209.23-.354.467-.308.722.12 1.073.614 1.501.614 1.501.237.239-.188.562-.537.5-.803-.146-1.495-.42-2.546-.811-.29-.146-.336-.106-.563-.057-2.043.711-4.398.475-6.083-.927 5.965-.524 8.727-3.03 9.93-8.016z" fill-rule="evenodd"></path>
                    </svg>
                </span>
                发私信
            </button>
        </div>
        @endows
    </div>
</div>
@endsection

@section('javascript')
    <script>
        $('.Card-section .FollowButton').click(function () {
            if ($(this).hasClass('Button--blue')) {
                $(this).removeClass('Button--blue').addClass('Button--grey').html('已关注');
            } else {
                $(this).removeClass('Button--grey').addClass('Button--blue').html(`<span style="display: inline-flex; align-items: center;">
                    ​<svg fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em" class="Zi Zi--Plus FollowButton-icon"><path d="M13.491 10.488s-.012-5.387 0-5.998c-.037-1.987-3.035-1.987-2.997 0-.038 1.912 0 5.998 0 5.998H4.499c-1.999.01-1.999 3.009 0 3.009s5.995-.01 5.995-.01v5.999c0 2.019 3.006 2.019 2.997 0-.01-2.019 0-5.998 0-5.998s3.996.009 6.004.009c2.008 0 2.008-3-.01-3.009h-5.994z" fill-rule="evenodd"></path></svg>
                    </span> 关注他`);
            }
            $.ajax({
                url: '/follow/user',
                type: "post",
                data: {
                    id: {{$question->answer[0]->user->id}}
                },
                success: function (data) {
                    $('#followed').find('.NumberBoard-itemValue').html(function (index, html) {
                        if(data.attached.length) {
                            return parseInt(html)+1;
                        } else {
                            return parseInt(html)-1;
                        }
                    });
                }
            });
        });
        $('.VoteButton').click(function () {
            $.ajax({
                url: '/vote/answer',
                type: 'POST',
                data: {
                    id: $(this).attr('answer-id')
                },
                success: function (data) {
                    if(data.attached.length){
                        $(this).addClass('is-active').find('.text').html('已赞同').end().find('.count').html((index, html)=>parseInt(html)+1);
                    } else {
                        $(this).removeClass('is-active').find('.text').html('赞同').end().find('.count').html((index, html)=>parseInt(html)-1);
                    }
                }.bind(this)
            });
        });
        $('.ShowComment').click(function () {
            app.$refs['comment'+$(this).attr('answer-id')].$emit('showComment');
        });
    </script>
@endsection
