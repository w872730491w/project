@extends('layouts.people')

@section('ProfileHeader')
<div class="ProfileHeader-contentHead">
    <h1 class="ProfileHeader-title">
        <span class="ProfileHeader-name">{{$user->name}}</span>
        @if($user->profile->introduction)
            <span class="RichText ztext ProfileHeader-headline">{{$user->profile->introduction}}</span>
        @endif
    </h1>
</div>
<div class="ProfileHeader-contentBody">
    <div class="ProfileHeader-info">
        <div class="ProfileHeader-infoItem">
            <!-- 所在行业 -->
            @if($user->profile->industry)
                <div class="ProfileHeader-iconWrapper"><svg viewBox="0 0 20 18" class="Icon Icon--company" width="13" height="16" aria-hidden="true" style="height: 16px; width: 13px;"><title></title><g><path d="M15 3.998v-2C14.86.89 13.98 0 13 0H7C5.822 0 5.016.89 5 2v2l-3.02-.002c-1.098 0-1.97.89-1.97 2L0 16c0 1.11.882 2 1.98 2h16.033c1.1 0 1.98-.89 1.987-2V6c-.007-1.113-.884-2.002-1.982-2.002H15zM7 4V2.5s-.004-.5.5-.5h5c.5 0 .5.5.5.5V4H7z"></path></g></svg></div>
                {{$user->profile->industry}}
                <div class="ProfileHeader-divider"></div>
            @endif
            @if($user->profile->career)
                <!-- 职业经历 -->
                {{$user->profile->career}}
            @endif
        </div>
        <div class="ProfileHeader-infoItem">
            @if($user->profile->education)
                <div class="ProfileHeader-iconWrapper"><svg viewBox="0 0 22 16" class="Icon Icon--education" width="16" height="16" aria-hidden="true" style="height: 16px; width: 16px;"><title></title><g><path d="M11 0L0 3.94v.588l4.153 2.73v5.166C4.158 12.758 7.028 16 11 16c3.972 0 6.808-3.116 6.85-3.576l.006-5.163 4.13-2.732.014-.586L11 0z"></path></g></svg></div>
                <!-- 教育经历 -->
                {{$user->profile->education}}
                <div class="ProfileHeader-divider"></div>
            @endif
            @if($user->profile->sex!=='')
                <!-- 性别 -->
                <div class="ProfileHeader-iconWrapper">
                    @if($user->profile->sex)
                    <svg width="14" height="16" viewBox="0 0 14 14" class="Icon Icon--male" aria-hidden="true" style="height: 16px; width: 14px;"><title></title><g><path d="M3.025 10.64c-1.367-1.366-1.367-3.582 0-4.95 1.367-1.366 3.583-1.366 4.95 0 1.367 1.368 1.367 3.584 0 4.95-1.367 1.368-3.583 1.368-4.95 0zm10.122-9.368c-.002-.414-.34-.75-.753-.753L8.322 0c-.413-.002-.746.33-.744.744.002.413.338.75.75.752l2.128.313c-.95.953-1.832 1.828-1.832 1.828-2.14-1.482-5.104-1.27-7.013.64-2.147 2.147-2.147 5.63 0 7.777 2.15 2.148 5.63 2.148 7.78 0 1.908-1.91 2.12-4.873.636-7.016l1.842-1.82.303 2.116c.003.414.34.75.753.753.413.002.746-.332.744-.745l-.52-4.073z" fill-rule="evenodd"></path></g></svg>
                    @else
                    <svg width="14" height="16" viewBox="0 0 12 16" class="Icon Icon--female" aria-hidden="true" style="height: 16px; width: 14px;"><title></title><g><path d="M6 0C2.962 0 .5 2.462.5 5.5c0 2.69 1.932 4.93 4.485 5.407-.003.702.01 1.087.01 1.087H3C1.667 12 1.667 14 3 14s1.996-.006 1.996-.006v1c0 1.346 2.004 1.346 1.998 0-.006-1.346 0-1 0-1S7.658 14 8.997 14c1.34 0 1.34-2-.006-2.006H6.996s-.003-.548-.003-1.083C9.555 10.446 11.5 8.2 11.5 5.5 11.5 2.462 9.038 0 6 0zM2.25 5.55C2.25 3.48 3.93 1.8 6 1.8c2.07 0 3.75 1.68 3.75 3.75C9.75 7.62 8.07 9.3 6 9.3c-2.07 0-3.75-1.68-3.75-3.75z" fill-rule="evenodd"></path></g></svg>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div class="ProfileHeader-detail" style="display: none;">
        @if($user->profile->place)
        <div class="ProfileHeader-detailItem">
            <span class="ProfileHeader-detailLabel">居住地</span>
            <div class="ProfileHeader-detailValue">
                <span>{{$user->profile->place}}</span>
            </div>
        </div>
        @endif
        @if($user->profile->industry)
        <div class="ProfileHeader-detailItem">
            <span class="ProfileHeader-detailLabel">所在行业</span>
            <div class="ProfileHeader-detailValue">
                <span>{{$user->profile->industry}}</span>
            </div>
        </div>
        @endif
        @if($user->profile->career)
        <div class="ProfileHeader-detailItem">
            <span class="ProfileHeader-detailLabel">职业经历</span>
            <div class="ProfileHeader-detailValue">
                <span>{{$user->profile->career}}</span>
            </div>
        </div>
        @endif
        @if($user->profile->education)
        <div class="ProfileHeader-detailItem">
            <span class="ProfileHeader-detailLabel">教育经历</span>
            <div class="ProfileHeader-detailValue">
                <span>{{$user->profile->education}}</span>
            </div>
        </div>
        @endif
        @if($user->profile->describe)
        <div class="ProfileHeader-detailItem">
            <span class="ProfileHeader-detailLabel">描述</span>
            <div class="ProfileHeader-detailValue">
                <span>{{$user->profile->describe}}</span>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="ProfileHeader-contentFooter">
    <button id="profileExpand" area-toggle="false" type="button" class="Button ProfileHeader-expandButton Button--plain">
        <svg viewBox="0 0 10 6" class="Icon ProfileHeader-arrowIcon Icon--arrow" width="10" height="16" aria-hidden="true" style="height: 16px; width: 10px;"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg>
        <span>查看详细资料</span>
    </button>
    @if(Auth::check() && Auth::id() == $user->id)
        <div class="ProfileButtonGroup ProfileHeader-buttons">
            <a href="/people/{{$user->id}}/edit" class="Button Button--blue">编辑个人资料</a>
        </div>
    @endif
</div>
@endsection

@section('ProfileMain')
<div class="Profile-main">
    <div class="Profile-mainColumn">
        <profile :user_id="{{ $user->id }}"></profile>
    </div>
    <div class="Profile-sideColumn">
        <div class="Card">
            <div class="Card-header Profile-sideColumnTitle">
                <div class="Card-headerText">个人成就</div>
            </div>
            <div class="Profile-sideColumnItems">
                <div class="Profile-sideColumnItem">
                    <div class="IconGraf">
                        <div class="IconGraf-iconWrapper"><svg width="16" height="16" viewBox="0 0 16 16" class="Icon IconGraf-icon Icon--commonEdit" aria-hidden="true" style="height: 16px; width: 16px;"><title></title><g><path d="M8 15.5C3.858 15.5.5 12.142.5 8 .5 3.858 3.858.5 8 .5c4.142 0 7.5 3.358 7.5 7.5 0 4.142-3.358 7.5-7.5 7.5zm3.032-11.643c-.22-.214-.574-.208-.79.013L5.1 9.173 6.778 10.8l5.142-5.303c.215-.222.21-.575-.01-.79l-.878-.85zm-6.77 7.107L4 12l1.028-.293.955-.27L4.503 10l-.242.964z" fill-rule="evenodd"></path></g></svg></div>
                        <a class="Profile-sideColumnItemLink" href="/people/sui-bian-212121/logs" target="_blank">
                            参与 6 次公共编辑
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="Card FollowshipCard">
            <div class="NumberBoard FollowshipCard-counts NumberBoard--divider">
                <a type="button" class="Button NumberBoard-item Button--plain" href="/people/sui-bian-212121/following">
                    <div class="NumberBoard-itemInner">
                        <div class="NumberBoard-itemName">关注了</div>
                        <strong class="NumberBoard-itemValue" title="{{$user->follow()->count()}}">{{$user->follow()->count()}}</strong>
                    </div>
                </a>
                <a type="button" class="Button NumberBoard-item Button--plain" href="/people/sui-bian-212121/followers">
                    <div class="NumberBoard-itemInner">
                        <div class="NumberBoard-itemName">关注者</div>
                        <strong class="NumberBoard-itemValue" title="{{$user->followings_count}}">{{$user->followings_count}}</strong>
                    </div>
                </a>
            </div>
        </div>
        <div class="Card">
            <div class="Card-section">
                <div class="Profile-lightList">
                    <a class="Profile-lightItem" style="border: 0;"><span class="Profile-lightItemName">关注的话题</span><span class="Profile-lightItemValue">{{$user->userTopic()->count()}}</span></a>
                    <a class="Profile-lightItem"><span class="Profile-lightItemName">关注的问题</span><span class="Profile-lightItemValue">{{$user->questions_count}}</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    $('#profileExpand').click(function () {
        $('.ProfileHeader-detail').toggle();
        $('.ProfileHeader-info').toggle();
        if($(this).attr('area-toggle')=='true'){
            $(this).find('svg').removeClass('is-active').end().find('span').text('查看详细资料');
            $(this).attr('area-toggle', 'false');
        } else {
            $(this).find('svg').addClass('is-active').end().find('span').text('收起详细资料');
            $(this).attr('area-toggle', 'true');
        }
    });
</script>
@endsection
