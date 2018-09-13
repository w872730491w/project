@extends('layouts.app')

@section('content')
<div class="App-main">
    <div class="ContentLayout">
        <div class="ContentLayout-mainColumn">
            <div class="Card">
                <form action="/topic/{{$topic->id}}" method="post">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="TopicCard">
                        <div class="ContentItem TopicCard-content">
                            <div class="ContentItem-main">
                                <div class="ContentItem-image Popover" style="cursor: pointer;">
                                    <img class="ImageAlias TopicCard-image" alt="{{$topic->name}}" src="{{$topic->topic_pic}}">
                                    <div style="width: 100px;height: 100px;" class="Mask UserAvatarEditor-mask Mask-hidden">
                                        <div class="Mask-mask Mask-mask--black UserAvatarEditor-maskInner"></div>
                                        <div class="Mask-content">
                                            <svg fill="currentColor" viewBox="0 0 24 24" width="36" height="36" class="Zi Zi--Camera UserAvatarEditor-cameraIcon"><path d="M20.094 6S22 6 22 8v10.017S22 20 19 20H4.036S2 20 2 18V7.967S2 6 4 6h3s1-2 2-2h6c1 0 2 2 2 2h3.094zM12 16a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7zm0 1.5a5 5 0 1 0-.001-10.001A5 5 0 0 0 12 17.5zm7.5-8a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" fill-rule="evenodd"></path></svg>
                                            <div class="UserAvatarEditor-maskInnerText">
                                                修改话题头像
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input id="TopicPicInput" type="file" accept="image/png,image/jpeg" style="display: none;">
                                <div class="ContentItem-head">
                                    <h2 class="ContentItem-title">
                                        <div class="TopicCard-title">
                                            <h1 class="TopicCard-titleText">
                                                {{$topic->name}}
                                            </h1>
                                        </div>
                                    </h2>
                                    <div class="ContentItem-meta">
                                        <div class="TopicCard-description">
                                            <div class="Input-wrapper Input-wrapper--spread Input-wrapper--large">
                                                <textarea style="min-height: 150px;" name="desc" placeholder="对话题的描述......" class="Input">{{$topic->desc}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="TopicCard-actions">
                            <div class="TopicActions">
                                <button class="Button TopicActions-followButton Button--primary Button--blue">
                                    保存
                                </button>
                                <a href="/topic/{{$topic->id}}" class="Button TopicActions-followButton Button--primary">
                                    取消
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
    $('.ContentItem-image.Popover').hover(function () {
        $(this).find('.Mask').removeClass('Mask-hidden');
    }, function () {
        $(this).find('.Mask').addClass('Mask-hidden');
    });
    $('.ContentItem-image.Popover').click(function (e) {
        $('#TopicPicInput').click();
        e.stopPropagation();
    });
    $('#TopicPicInput').change(function () {
        const formData = new FormData();
        formData.append('img', this.files[0]);
        formData.append('id', {{$topic->id}});
        $.ajax({
            url: '/uploadTopicPic',
            type: 'post',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) {
                $('.ImageAlias.TopicCard-image').attr('srcset', data + ' 2x').attr('src', data);
            }.bind(this)
        });
    });
</script>
@endsection
