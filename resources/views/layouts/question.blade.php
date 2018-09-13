@extends('layouts.app')

@section('content')
<div class="QuestionHeader">
    <div class="QuestionHeader-content">
        <div class="QuestionHeader-main">
            <div class="QuestionHeader-tags">
                <div class="QuestionHeader-topics">
                    @foreach($question->topic as $topic)
                    <div class="Tag QuestionTopic">
                        <span class="Tag-content">
                            <a href="/topic/{{$topic->id}}" class="TopicLink">{{$topic->name}}</a>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            <h1 class="QuestionHeader-title">{{$question->title}}</h1>
            <div class="QuestionHeader-detail">
                <div class="QuestionRichText QuestionRichText--expandable">
                    <span class="RichText ztext">
                        {!! $question->body !!}
                    </span>
                </div>
            </div>
        </div>
        <div class="QuestionHeader-side">
            <div class="QuestionHeader-follow-status">
                <div class="QuestionFollowStatus">
                    <div class="NumberBoard QuestionFollowStatus-counts NumberBoard--divider">
                        <button type="button" class="Button NumberBoard-item Button--plain">
                            <div class="NumberBoard-itemInner">
                                <div class="NumberBoard-itemName">关注者</div>
                                <strong class="NumberBoard-itemValue" id="question_followers_count" title="{{$question->followers_count}}">{{$question->followers_count}}</strong>
                            </div>
                        </button>
                        <div class="NumberBoard-item">
                            <div class="NumberBoard-itemInner">
                                <div class="NumberBoard-itemName">被浏览</div>
                                <strong class="NumberBoard-itemValue" title="1267288">1,267,288</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="QuestionHeader-footer">
        <div class="QuestionHeader-footer-inner">
            <div class="QuestionHeader-main QuestionHeader-footer-main">
                <div class="QuestionButtonGroup">
                    @guest
                    <a href="/login" class="Button FollowButton Button--primary Button--blue">
                        关注问题
                    </a>
                    <a href="/login" class="Button Button--blue">
                        <svg viewBox="0 0 12 12" class="Icon Button-icon Icon--modify" width="14" height="16" aria-hidden="true" style="height: 16px; width: 14px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                        写回答
                    </a>
                    @else
                        @isFollowed('userQuestion', 'follow_question_id', $question->id)
                            <button id="follow_question_btn" type="button" class="Button FollowButton Button--primary Button--grey">
                                已关注
                            </button>
                        @else
                            <button id="follow_question_btn" type="button" class="Button FollowButton Button--primary Button--blue">
                                关注问题
                            </button>
                        @endisFollowed
                    <button id="answerAddBtn" type="button" class="Button Button--blue">
                        <svg viewBox="0 0 12 12" class="Icon Button-icon Icon--modify" width="14" height="16" aria-hidden="true" style="height: 16px; width: 14px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                        写回答
                    </button>
                    @endguest
                </div>
                <div class="QuestionHeaderActions">
                    <div class="QuestionHeader-Comment">
                        <button @click="$refs.question_comment.$emit('showModal')" type="button" class="Button Button--plain Button--withIcon Button--withLabel">
                            <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Comment Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M10.241 19.313a.97.97 0 0 0-.77.2 7.908 7.908 0 0 1-3.772 1.482.409.409 0 0 1-.38-.637 5.825 5.825 0 0 0 1.11-2.237.605.605 0 0 0-.227-.59A7.935 7.935 0 0 1 3 11.25C3 6.7 7.03 3 12 3s9 3.7 9 8.25-4.373 9.108-10.759 8.063z" fill-rule="evenodd"></path></svg></span>
                            {{$question->comments_count}} 条评论
                        </button>
                    </div>
                    <button type="button" class="Button Button--plain Button--withIcon Button--withLabel"><span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Share Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2.931 7.89c-1.067.24-1.275 1.669-.318 2.207l5.277 2.908 8.168-4.776c.25-.127.477.198.273.39L9.05 14.66l.927 5.953c.18 1.084 1.593 1.376 2.182.456l9.644-15.242c.584-.892-.212-2.029-1.234-1.796L2.93 7.89z" fill-rule="evenodd"></path></svg></span>
                        分享
                    </button>
                    <button type="button" class="Button Button--plain Button--withIcon Button--withLabel">
                        <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Star Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"></path></svg></span>
                        邀请回答
                    </button>
                    <button type="button" class="Button Button--plain Button--withIcon Button--withLabel">
                        <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Report Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M19.947 3.129c-.633.136-3.927.639-5.697.385-3.133-.45-4.776-2.54-9.949-.888-.997.413-1.277 1.038-1.277 2.019L3 20.808c0 .3.101.54.304.718a.97.97 0 0 0 .73.304c.275 0 .519-.102.73-.304.202-.179.304-.418.304-.718v-6.58c4.533-1.235 8.047.668 8.562.864 2.343.893 5.542.008 6.774-.657.397-.178.596-.474.596-.887V3.964c0-.599-.42-.972-1.053-.835z" fill-rule="evenodd"></path></svg></span>
                        举报
                    </button>
                    @ows($question->user->id)
                    <form action="/question/{{$question->id}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="Button QuestionHeader-edit Button--plain">
                            <span style="display: inline-flex; align-items: center;">​<svg fill="currentColor" viewBox="0 0 24 24" width="24" height="24" class="Zi Zi--TrashOutline"><path d="M16.213 18.638h-7.83V8.085H7.021v10.553c0 .751.611 1.362 1.362 1.362h7.83c.75 0 1.361-.61 1.361-1.362V8.085h-1.361v10.553zM15.19 5.362c0-.751-.61-1.362-1.361-1.362h-3.064c-.751 0-1.362.61-1.362 1.362v.68H6.766S6 6 6 6.715c0 .714.766.69.766.69H17.89s.705 0 .705-.688c0-.689-.705-.673-.705-.673h-2.7v-.681zm-1.361.68h-3.064v-.68h3.064v.68zm-3.745 3.064v8.17h1.362v-8.17h-1.362zm3.064 0v8.17h1.362v-8.17h-1.362z" fill-rule="evenodd"></path></svg></span>
                            删除
                        </button>
                    </form>
                    @endows
                </div>
            </div>
        </div>
    </div>
</div>
<modal size="large" ref="question_comment">
    <comments :default-show="true" type="question" :type_id="{{$question->id}}" :count="{{$question->comments_count}}"></comments>
</modal>
<div class="Question-main">
    <div class="Question-mainColumn">
        @auth
            <div style="display: none;" class="QuestionAnswers-statusWrapper">
                <div class="Card QuestionAnswers-answerAdd">
                    <div class="AnswerAdd">
                        <div class="AnswerAdd-header">
                            <div class="AuthorInfo AnswerAdd-info">
                                <span class="UserLink AuthorInfo-avatarWrapper"><img class="Avatar AuthorInfo-avatar" width="38" height="38" src="{{ Auth::user()->avatar }}" srcset="{{ Auth::user()->avatar }} 2x" alt="{{ Auth::user()->name }}"></span>
                                <div class="AuthorInfo-content">
                                    <div class="AuthorInfo-head">
                                        <span class="UserLink AuthorInfo-name">{{ Auth::user()->name }}</span>
                                    </div>
                                    <!-- <div class="AuthorInfo-detail">
                                        <div class="AuthorInfo-badge">
                                            <span class="RichText ztext AnswerAdd-bio">lamp工程师</span>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <form class="AnswerForm" action="/answer" method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">
                            <!-- <div class="AnswerForm-editor AnswerForm-container Input-wrapper Input-wrapper--spread Input-wrapper--large Input-wrapper--noPadding">

                            </div> -->
                            <editable type="answer" show-tool-bar="true"></editable>
                            <div class="Sticky AnswerForm-footer is-bottom">
                                <div class="AnswerForm-footerContent AnswerForm-container">
                                    <div class="AnswerForm-status"></div>
                                    <div class="AnswerForm-footerRight">
                                        <button type="button" class="Button Button--plain">
                                            <svg viewBox="0 0 20 20" class="Icon Icon--setting Icon--left" width="14" height="16" aria-hidden="true" style="height: 16px; width: 14px;"><title></title><g><path d="M18.868 15.185c-.164.096-.315.137-.452.137-.123 0-1.397-.26-1.617-.233-1.355.013-1.782 1.275-1.836 1.74-.055.454 0 .893.19 1.304.138.29.125.577-.067.85-.863.893-2.165 1.016-2.357 1.016-.123 0-.247-.055-.356-.15-.11-.097-.685-1.14-1.07-1.47-1.303-.954-2.246-.328-2.63 0-.397.33-.67.7-.835 1.126-.07.18-.18.302-.33.37-1.354.426-2.918-.92-3.014-1.056-.082-.11-.123-.22-.123-.356-.014-.138.383-1.276.342-1.688-.342-1.9-1.836-1.687-2.096-1.673-.303.014-.604.068-.92.178-.205.056-.396.03-.588-.054-.888-.462-1.137-2.332-1.11-2.51.055-.315.192-.52.438-.604.425-.164.81-.452 1.15-.85.932-1.262.344-2.25 0-2.634-.34-.356-.725-.645-1.15-.81-.137-.04-.233-.15-.328-.315C-.27 6.07.724 4.95.978 4.733c.255-.22.6-.055.723 0 .426.164.878.22 1.344.15C4.7 4.636 4.784 3.14 4.81 2.908c.015-.247-.11-1.29-.136-1.4-.027-.123-.014-.22.027-.315C5.318.178 7.073 0 7.223 0c.178 0 .33.055.44.178.108.124.63 1.11 1 1.4.398.338 1.582.83 2.588.013.398-.273.96-1.288 1.083-1.412.123-.123.26-.178.384-.178 1.56 0 2.33 1.03 2.438 1.22.083.124.096.248.07.37-.03.152-.33 1.153-.262 1.606.366 1.537 1.384 1.742 1.89 1.783.494.027 1.645-.357 1.81-.344.164.014.315.083.424.206.535.31.85 1.715.905 2.14.027.233-.014.44-.11.562-.11.138-1.165.714-1.48 1.112-.855.982-.342 2.25-.068 2.606.26.37 1.22.905 1.288.96.15.137.26.302.315.494.146 1.413-.89 2.387-1.07 2.47zm-8.905-.535c.644 0 1.246-.123 1.822-.356.575-.248 1.082-.59 1.493-1.016.425-.425.754-.92 1-1.495.247-.562.357-1.18.357-1.81 0-.66-.11-1.262-.356-1.825-.248-.562-.577-1.056-1.002-1.48-.41-.427-.918-.756-1.493-1.003-.576-.233-1.178-.357-1.822-.357-.644 0-1.247.124-1.81.357-.56.247-1.067.576-1.478 1.002-.425.425-.768.92-1 1.48-.247.564-.37 1.167-.37 1.826 0 .644.123 1.248.37 1.81.232.563.575 1.07 1 1.495.424.426.917.768 1.48 1.016.56.233 1.164.356 1.808.356z"></path></g></svg>
                                            设置
                                        </button>
                                        <button class="Button AnswerForm-submit Button--primary Button--blue">提交回答</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
        @yield('questionMain')
    </div>
    <div class="Question-sideColumn Question-sideColumn--sticky">
        <div class="Sticky">
            @yield('questionSideBar')
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $('#answerAddBtn, .QuestionAnswers-answerLink').click(function () {
        $('.QuestionAnswers-statusWrapper').toggle();
    });
    $('.QuestionHeaderActions button:last').click(function () {
        if($(this).find('svg').hasClass('is-active')){
            $(this).find('svg').removeClass('is-active').prev().html('阅读全文');
            $('.QuestionRichText').addClass('QuestionRichText--collapsed');
        } else {
            $(this).find('svg').addClass('is-active').prev().html('收起');
            $('.QuestionRichText').removeClass('QuestionRichText--collapsed');
        }
    });
    $('#follow_question_btn').click(function () {
        $.ajax({
            url: '/follow/question',
            type: 'POST',
            data: {
                id: {{$question->id}}
            },
            success: function (data) {
                if (data.attached.length) {
                    $('#follow_question_btn').removeClass('Button--blue').addClass('Button--grey').html('已关注');
                    $('#question_followers_count').html(function(index, html){
                        let count = parseInt(html);
                        $(this).attr('title', ++count);
                        return count;
                    });
                } else {
                    $('#follow_question_btn').removeClass('Button--grey').addClass('Button--blue').html('关注问题');
                    $('#question_followers_count').html(function(index, html){
                        let count = parseInt(html);
                        $(this).attr('title', --count);
                        return count;
                    });
                }
            }
        });
    });
</script>
@yield('javascript')
@endsection
