@extends('layouts.app')

@section('content')
<div class="App-main">
    <div class="ContentLayout">
        <div class="ContentLayout-mainColumn">
            <div class="Card">
                <div class="TopicCard">
                    <div class="ContentItem TopicCard-content">
                        <div class="ContentItem-main">
                            <div class="ContentItem-image">
                                <img class="ImageAlias TopicCard-image" alt="{{$topic->name}}" src="{{$topic->topic_pic}}">
                            </div>
                            <div class="ContentItem-head">
                                <h2 class="ContentItem-title">
                                    <div class="TopicCard-title">
                                        <h1 class="TopicCard-titleText">{{$topic->name}}</h1>
                                    </div>
                                </h2>
                                <div class="ContentItem-meta">
                                    <div class="TopicCard-description">
                                        <span class="RichText ztext">{{$topic->desc ? $topic->desc : '暂无话题描述' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="TopicCard-actions">
                        <div class="TopicActions">
                            @if(Auth::check() && Auth::user()->userTopic()->where('follow_topic_id', $topic->id)->count())
                            <button type="button" class="Button FollowButton TopicActions-followButton Button--primary Button--grey">
                                已关注
                            </button>
                            @else
                            <button type="button" class="Button FollowButton TopicActions-followButton Button--primary Button--blue">
                                关注话题
                            </button>
                            @endif
                            <a type="button" class="Button TopicActions-link Button--plain Button--withIcon Button--withLabel" href="/topic/{{$topic->id}}/edit">
                                <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Settings Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M20.868 17.185a.896.896 0 0 1-.452.137c-.123 0-1.397-.26-1.617-.233-1.354.014-1.78 1.276-1.835 1.742-.055.453 0 .892.191 1.303a.8.8 0 0 1-.068.851C16.224 21.877 14.922 22 14.73 22a.548.548 0 0 1-.356-.151c-.11-.096-.685-1.138-1.069-1.468-1.304-.955-2.247-.329-2.63 0-.398.33-.672.7-.836 1.125a.632.632 0 0 1-.329.37c-1.354.426-2.918-.919-3.014-1.056a.564.564 0 0 1-.123-.356c-.014-.138.383-1.276.342-1.688-.342-1.9-1.836-1.687-2.096-1.673a3.192 3.192 0 0 0-.918.178.873.873 0 0 1-.59-.055c-.887-.462-1.136-2.332-1.109-2.51.055-.315.192-.521.438-.604.425-.164.809-.452 1.151-.85.931-1.262.343-2.25 0-2.634-.342-.356-.726-.645-1.15-.809-.138-.041-.234-.151-.33-.316-.38-1.434.613-2.552.867-2.77.255-.22.6-.055.723 0 .425.164.877.219 1.343.15C6.7 6.636 6.784 5.141 6.81 4.908c.014-.247-.11-1.29-.137-1.4a.488.488 0 0 1 .027-.315C7.317 2.178 9.071 2 9.222 2a.56.56 0 0 1 .439.178c.11.124.63 1.111 1 1.4.4.338 1.583.83 2.59.013.397-.274.959-1.29 1.082-1.413A.55.55 0 0 1 14.717 2c1.56 0 2.329 1.029 2.438 1.22a.458.458 0 0 1 .069.371c-.028.151-.329 1.152-.26 1.605.365 1.537 1.383 1.742 1.89 1.783.493.028 1.644-.356 1.809-.343a.63.63 0 0 1 .424.206c.535.31.85 1.715.905 2.14.027.233-.014.439-.11.562-.11.138-1.165.714-1.48 1.112-.855.982-.342 2.25-.068 2.606.26.37 1.22.905 1.288.96.15.137.26.302.315.494.146 1.413-.89 2.387-1.069 2.47zm-8.905-.535c.644 0 1.246-.123 1.822-.356a4.576 4.576 0 0 0 1.493-1.016 4.694 4.694 0 0 0 1-1.495c.247-.562.357-1.18.357-1.81 0-.659-.11-1.262-.356-1.825a4.79 4.79 0 0 0-1-1.481 4.542 4.542 0 0 0-1.494-1.002 4.796 4.796 0 0 0-3.631 0 4.627 4.627 0 0 0-1.48 1.002c-.424.425-.767.919-1 1.481a4.479 4.479 0 0 0-.37 1.825c0 .644.124 1.248.37 1.81a4.62 4.62 0 0 0 1 1.495c.425.426.918.768 1.48 1.016a4.677 4.677 0 0 0 1.809.356z" fill-rule="evenodd"></path></svg>
                                </span>
                                管理
                            </a>
                            <a type="button" class="Button TopicActions-link Button--plain Button--withIcon Button--withLabel" href="/topic/19551718/log">
                                <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--List Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M8.493 10h12.014c.83 0 1.493.672 1.493 1.5 0 .834-.668 1.5-1.493 1.5H8.493C7.663 13 7 12.328 7 11.5c0-.834.668-1.5 1.493-1.5zm0 6h12.014c.83 0 1.493.672 1.493 1.5 0 .834-.668 1.5-1.493 1.5H8.493C7.663 19 7 18.328 7 17.5c0-.834.668-1.5 1.493-1.5zM3.5 4C4.334 4 5 4.672 5 5.5 5 6.334 4.328 7 3.5 7 2.666 7 2 6.328 2 5.5 2 4.666 2.672 4 3.5 4zm0 6c.834 0 1.5.672 1.5 1.5 0 .834-.672 1.5-1.5 1.5-.834 0-1.5-.672-1.5-1.5 0-.834.672-1.5 1.5-1.5zm0 6c.834 0 1.5.672 1.5 1.5 0 .834-.672 1.5-1.5 1.5-.834 0-1.5-.672-1.5-1.5 0-.834.672-1.5 1.5-1.5zM8.493 4h12.014C21.337 4 22 4.672 22 5.5c0 .834-.668 1.5-1.493 1.5H8.493C7.663 7 7 6.328 7 5.5 7 4.666 7.668 4 8.493 4z" fill-rule="evenodd"></path></svg></span>
                                日志
                            </a>
                            <a type="button" class="Button TopicActions-link Button--plain Button--withIcon Button--withLabel" href="/topic/19551718/log">
                                <span style="display: inline-flex; align-items: center;">​<svg class="Zi Zi--Share Button-zi" fill="currentColor" viewBox="0 0 24 24" width="1.2em" height="1.2em"><path d="M2.931 7.89c-1.067.24-1.275 1.669-.318 2.207l5.277 2.908 8.168-4.776c.25-.127.477.198.273.39L9.05 14.66l.927 5.953c.18 1.084 1.593 1.376 2.182.456l9.644-15.242c.584-.892-.212-2.029-1.234-1.796L2.93 7.89z" fill-rule="evenodd"></path></svg></span>
                                分享
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <topic :topic_id="{{$topic->id}}"></topic>
        </div>
        <div class="ContentLayout-sideColumn">
            <div class="Card">
                <div class="NumberBoard NumberBoard--divider">
                    <button type="button" class="Button NumberBoard-item TopicNumberBoard-item">
                        <div class="NumberBoard-itemInner">
                            <div class="NumberBoard-itemName">关注者</div>
                            <strong class="NumberBoard-itemValue" title="{{$topic->followers_count}}">{{$topic->followers_count}}</strong>
                        </div>
                    </button>
                    <a class="NumberBoard-item TopicNumberBoard-item" href="/topic/19551718/questions">
                        <div class="NumberBoard-itemInner">
                            <div class="NumberBoard-itemName">问题数</div>
                            <strong class="NumberBoard-itemValue" title="{{$topic->questions_count}}">{{$topic->questions_count}}</strong>
                        </div>
                    </a>
                </div>
            </div>
            <footer class="Footer Card"><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="//liukanshan.zhihu.com/">刘看山</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="/question/19581624">知乎指南</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="/terms">知乎协议</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="/terms/privacy">隐私政策</a><br><a class="Footer-item" target="_blank" href="/app">应用</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://app.mokahr.com/apply/zhihu">工作</a><span class="Footer-dot"></span><button type="button" class="Button OrgCreateButton">申请开通知乎机构号</button><br><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://zhuanlan.zhihu.com/p/28561671">侵权举报</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="http://www.12377.cn">网上有害信息举报专区</a><br><span class="Footer-item">违法和不良信息举报：010-82716601</span><br><a class="Footer-item" target="_blank" href="/jubao">儿童色情信息举报专区</a><br><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://zhstatic.zhihu.com/assets/zhihu/certificates/certificate-ICP.png">电信与服务业务经营许可证</a><br><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://zhstatic.zhihu.com/assets/zhihu/certificates/certificate-1.jpeg">网络文化经营许可证</a><br><a class="Footer-item" target="_blank" href="/contact">联系我们</a><span> © 2018 知乎</span></footer>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.TopicActions-followButton').click(function () {
        $.ajax({
            url: '/follow/topic',
            data: {
                id: {{$topic->id}}
            },
            type: 'POST',
            success: function (data) {
                $(this).html( data.attached.length ? '已关注' : '关注话题' );
                $(this).toggleClass('Button--blue').toggleClass('Button--grey');
            }.bind(this)
        });
    });
</script>
@endsection