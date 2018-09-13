@extends('layouts.app')

@section('content')
<div class="App-main">
    <div class="ProfileHeader">
        <div class="Card">
            <div class="ProfileHeader-userCover">
                <div class="UserCoverEditor">
                    <div>
                        @ows($user->id)
                        <button type="button" class="Button UserCoverEditor-simpleEditButton DynamicColorButton DynamicColorButton--dark">
                            <svg viewBox="0 0 20 16" class="Icon Icon--camera Icon--left" width="14" height="16" aria-hidden="true" style="height: 16px; width: 14px;"><title></title><g><path d="M18.094 2H15s-1-2-2-2H7C6 0 5 2 5 2H2C0 2 0 3.967 0 3.967V14c0 2 2.036 2 2.036 2H17c3 0 3-1.983 3-1.983V4c0-2-1.906-2-1.906-2zM10 12c-1.933 0-3.5-1.567-3.5-3.5S8.067 5 10 5s3.5 1.567 3.5 3.5S11.933 12 10 12zm0 1.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm7.5-8c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="evenodd"></path></g></svg>
                            编辑封面图片
                        </button>
                        @endows
                        @if($user->profile->cover)
                            <div class="UserCover">
                                <img class="UserCover-image" src="{{ $user->profile->cover }}" alt="用户封面">
                            </div>
                            @else
                            <div class="UserCover UserCover--colorBlock"></div>
                        @endif
                    </div>
                    <input type="file" id="userCoverInput" accept="image/png,image/jpeg" style="display: none;">
                </div>
            </div>
            <div class="ProfileHeader-wrapper">
                <div class="ProfileHeader-main">
                    <div class="UserAvatarEditor ProfileHeader-avatar" style="top: -74px;">
                        <div class="UserAvatar">
                            <img class="Avatar Avatar--large UserAvatar-inner" width="160" height="160" src="{{$user->avatar}}" srcset="{{$user->avatar}} 2x">
                        </div>
                        @ows($user->id)
                        <div class="Mask UserAvatarEditor-mask Mask-hidden">
                            <div class="Mask-mask Mask-mask--black UserAvatarEditor-maskInner"></div>
                            <div class="Mask-content">
                                <svg class="Zi Zi--Camera UserAvatarEditor-cameraIcon" fill="currentColor" viewBox="0 0 24 24" width="36" height="36"><path d="M20.094 6S22 6 22 8v10.017S22 20 19 20H4.036S2 20 2 18V7.967S2 6 4 6h3s1-2 2-2h6c1 0 2 2 2 2h3.094zM12 16a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7zm0 1.5a5 5 0 1 0-.001-10.001A5 5 0 0 0 12 17.5zm7.5-8a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" fill-rule="evenodd"></path></svg>
                                <div class="UserAvatarEditor-maskInnerText">修改我的头像</div>
                            </div>
                        </div>
                        @endows
                    </div>
                    <input id="userAvatarInput" type="file" accept="image/png,image/jpeg" style="display: none;">
                    <div class="ProfileHeader-content">
                        @yield('ProfileHeader')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('ProfileMain')
</div>
@endsection

@section('js')
    @ows($user->id)
        <script type="text/javascript">
            $('.UserCoverEditor-simpleEditButton').click(function () {
                $('#userCoverInput').click();
            });
            $('.UserAvatarEditor').hover(function(){
                $('.UserAvatarEditor-mask').removeClass('Mask-hidden');
            },function(){
                $('.UserAvatarEditor-mask').addClass('Mask-hidden');
            }).click(function(e){
                $('#userAvatarInput').trigger('click');
            });

            $('#userAvatarInput').change(function () {
                const formData = new FormData();
                formData.append('img', this.files[0]);
                $.ajax({
                    url: '/uploadAvatar',
                    type: 'post',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (src) {
                        $(this).prev().find('.Avatar').attr('srcset', src + ' 2x').attr('src', src);
                    }.bind(this)
                });
            });
            $('#userCoverInput').change(function () {
                const formData = new FormData();
                formData.append('img', this.files[0]);
                $.ajax({
                    url: '/uploadCover',
                    type: 'post',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (src) {
                        const userCover = $('.UserCoverEditor .UserCover');
                        userCover.removeClass('UserCover--colorBlock');
                        if(userCover.find('img').length) {
                            userCover.find('img').attr('src', src);
                        } else {
                            userCover.append('<img class="UserCover-image" src="' + src + '" alt="用户封面">')
                        }
                    }.bind(this)
                });
            });
        </script>
    @endows
    @yield('javascript')
@endsection
