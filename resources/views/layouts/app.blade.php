<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="Sticky AppHeader">
            <div class="AppHeader-inner">
                <a href="/" aria-label="知乎">
                    <svg viewBox="0 0 200 91" class="Icon ZhihuLogo ZhihuLogo--blue Icon--logo" width="64" height="30" aria-hidden="true" style="height: 30px; width: 64px;">
                        <title></title>
                        <g>
                            <path d="M53.29 80.035l7.32.002 2.41 8.24 13.128-8.24h15.477v-67.98H53.29v67.978zm7.79-60.598h22.756v53.22h-8.73l-8.718 5.473-1.587-5.46-3.72-.012v-53.22zM46.818 43.162h-16.35c.545-8.467.687-16.12.687-22.955h15.987s.615-7.05-2.68-6.97H16.807c1.09-4.1 2.46-8.332 4.1-12.708 0 0-7.523 0-10.085 6.74-1.06 2.78-4.128 13.48-9.592 24.41 1.84-.2 7.927-.37 11.512-6.94.66-1.84.785-2.08 1.605-4.54h9.02c0 3.28-.374 20.9-.526 22.95H6.51c-3.67 0-4.863 7.38-4.863 7.38H22.14C20.765 66.11 13.385 79.24 0 89.62c6.403 1.828 12.784-.29 15.937-3.094 0 0 7.182-6.53 11.12-21.64L43.92 85.18s2.473-8.402-.388-12.496c-2.37-2.788-8.768-10.33-11.496-13.064l-4.57 3.627c1.363-4.368 2.183-8.61 2.46-12.71H49.19s-.027-7.38-2.372-7.38zm128.752-.502c6.51-8.013 14.054-18.302 14.054-18.302s-5.827-4.625-8.556-1.27c-1.874 2.548-11.51 15.063-11.51 15.063l6.012 4.51zm-46.903-18.462c-2.814-2.577-8.096.667-8.096.667s12.35 17.2 12.85 17.953l6.08-4.29s-8.02-11.752-10.83-14.33zM199.99 46.5c-6.18 0-40.908.292-40.953.292v-31.56c1.503 0 3.882-.124 7.14-.376 12.773-.753 21.914-1.25 27.427-1.504 0 0 3.817-8.496-.185-10.45-.96-.37-7.24 1.43-7.24 1.43s-51.63 5.153-72.61 5.64c.5 2.756 2.38 5.336 4.93 6.11 4.16 1.087 7.09.53 15.36.277 7.76-.5 13.65-.76 17.66-.76v31.19h-41.71s.88 6.97 7.97 7.14h33.73v22.16c0 4.364-3.498 6.87-7.65 6.6-4.4.034-8.15-.36-13.027-.566.623 1.24 1.977 4.496 6.035 6.824 3.087 1.502 5.054 2.053 8.13 2.053 9.237 0 14.27-5.4 14.027-14.16V53.93h38.235c3.026 0 2.72-7.432 2.72-7.432z" fill-rule="evenodd">
                            </path>
                        </g>
                    </svg>
                </a>
                <nav class="AppHeader-nav">
                    <a class="AppHeader-navItem" href="/">
                        首页
                    </a>
                    <a class="AppHeader-navItem" href="/question">
                        问题
                    </a>
                    <a class="AppHeader-navItem" href="/topic">
                        话题
                    </a>
                </nav>
                <search-bar></search-bar>
                <div class="AppHeader-userInfo">
                    @guest
                        <div class="AppHeader-profile">
                            <a href="/login" class="Button Button--blue" style="margin-right: 16px;">登录</a>
                            <a href="/register" class="Button Button--primary Button--blue">加入知乎</a>
                        </div>
                    @else
                    <div class="AppHeader-notifications">
                        <el-popover
                            placement="bottom"
                            trigger="click"
                        >
                            <div class="PushNotifications-menu">
                                <div class="PushNotifications-content">
                                    <div class="PushNotifications-header">
                                        <button data-tab="#notification" aria-label="消息" type="button" class="Button PushNotifications-tab Button--plain is_active">
                                            <svg viewBox="0 0 20 15" class="Icon PushNotifications-tabIcon Icon--lastNews" width="20" height="16" aria-hidden="true" style="height: 16px; width: 20px;"><title></title><g><path d="M6.493 6C5.668 6 5 6.666 5 7.5 5 8.328 5.664 9 6.493 9h12.014C19.332 9 20 8.334 20 7.5c0-.828-.664-1.5-1.493-1.5H6.493zm0 6C5.668 12 5 12.666 5 13.5c0 .828.664 1.5 1.493 1.5h12.014c.825 0 1.493-.666 1.493-1.5 0-.828-.664-1.5-1.493-1.5H6.493zM1.5 0C.672 0 0 .666 0 1.5 0 2.328.666 3 1.5 3 2.328 3 3 2.334 3 1.5 3 .672 2.334 0 1.5 0zm0 6C.672 6 0 6.666 0 7.5 0 8.328.666 9 1.5 9 2.328 9 3 8.334 3 7.5 3 6.672 2.334 6 1.5 6zm0 6c-.828 0-1.5.666-1.5 1.5 0 .828.666 1.5 1.5 1.5.828 0 1.5-.666 1.5-1.5 0-.828-.666-1.5-1.5-1.5zM6.493 0C5.668 0 5 .666 5 1.5 5 2.328 5.664 3 6.493 3h12.014C19.332 3 20 2.334 20 1.5c0-.828-.664-1.5-1.493-1.5H6.493z"></path></g></svg>
                                        </button>
                                        <button data-tab="#message" aria-label="用户" type="button" class="Button PushNotifications-tab Button--plain">
                                            <svg viewBox="0 0 24 17" class="Icon PushNotifications-tabIcon Icon--userNews" width="20" height="16" aria-hidden="true" style="height: 16px; width: 20px;"><title></title><g><path d="M9.464 7.705c-.265.46-.59.904-.538 1.315.206 1.603 3.205 1.92 4.087 2.99.643.783.91 1.97.972 3.96.01.32 0 1.03-.946 1.03H1.02c-1 0-1.01-.683-1-.995.068-1.994.318-3.208.976-3.994.886-1.056 4.084-1.345 4.224-3.05.032-.385-.268-.786-.538-1.255C3.182 5.102 2.608 0 7.054 0s3.824 5.25 2.41 7.705zM18.27 8.545c.963.126 2.924-.574 2.924-.574-.664-.68-.815-1.472-1.294-4.586C19.507.27 16.8.3 16.597.3c-.203 0-2.91-.03-3.297 3.084-.485 3.113-.636 3.907-1.3 4.586 0 0 1.96.7 2.923.575l-.003.68c-.494.542-1.79.725-2.376 1.077 2.796.316 2.954 3.696 2.954 6.678 1.475-.002 6.497.02 7.5.02 1.002 0 .996-.674.986-.976-.06-1.8-.28-2.786-.418-3.434-.416-1.976-3.58-1.488-5.292-3.364l-.003-.68z"></path></g></svg>
                                        </button>
                                        <button data-tab="#news" aria-label="赞同和感谢" type="button" class="Button PushNotifications-tab Button--plain">
                                            <div>
                                                <svg viewBox="0 0 20 18" class="Icon PushNotifications-tabIcon Icon--thankNews" width="20" height="16" aria-hidden="true" style="height: 16px; width: 20px;"><title></title><g><path d="M0,5.43706401 C5.73656627e-08,2.50510671 2.2938809,0.094365083 5.20737357,1.60732864e-07 C7.2427157,-0.000505078569 9.0922816,1.19013727 9.9999282,3 C10.8228521,1.24236064 12.6486957,1.60732867e-07 14.6514359,1.60732864e-07 C17.5445125,1.60732867e-07 19.9999282,2.50715387 19.9999282,5.43242499 C19.9999282,13.2399998 11.8420757,18 9.99997552,18 C8.15785253,18 -1.52669543e-07,13.2399998 0,5.43706401 Z"></path></g>
                                                </svg>
                                            </div>
                                        </button>
                                    </div>
                                    <div class="PushNotifications-list" style="display: none;" id="notification">
                                        @foreach(Auth::user()->notifications->where('type', 'App\Notifications\FollowNotification') as $notify)
                                            <div class="PushNotifications-item">
                                                <span>
                                                    你关注的人：
                                                    <span class="PushNotifications-actor">
                                                        <a href="/people/{{$notify['data']['user_id']}}">
                                                            {{($notify['data']['user_name'])}}
                                                        </a>
                                                    </span>
                                                </span>
                                                回答了问题
                                                <span>
                                                    <a href="{{$notify['data']['to_url']}}">
                                                        {{$notify['data']['question']}}
                                                    </a>
                                                </span>
                                            </div>
                                        @endforeach
                                        @foreach($notifications['comment'] as $comment)
                                            <div class="PushNotifications-item">
                                                <span>
                                                    <span class="PushNotifications-actor">
                                                        <a href="/people/{{$comment['data']['user_id']}}">
                                                            {{($comment['data']['user_name'])}}
                                                        </a>
                                                    </span>
                                                </span>
                                                评论了你的{{$comment['data']['type']}}
                                                <span>
                                                    <a href="{{$comment['data']['url']}}">
                                                        {{$comment['data']['title']}}
                                                    </a>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="PushNotifications-list" id="message">
                                        <div class="PushNotifications-followTitle">这些人最近关注了你</div>
                                        @foreach($notifications['follow'] as $follow)
                                        <a class="PushNotifications-item PushNotifications-followItem {{$follow->read_at ? '' : 'PushNotifications-newItem'}}" target="_blank" href="/people/{{$follow['data']['user_id']}}">
                                            <div class="AuthorInfo">
                                                <span class="UserLink AuthorInfo-avatarWrapper">
                                                    <img class="Avatar Avatar--medium AuthorInfo-avatar" width="40" height="40" src="{{$follow['data']['user_avatar']}}" srcset="{{$follow['data']['user_avatar']}} 2x" alt="{{$follow['data']['user_name']}}">
                                                </span>
                                                <div class="AuthorInfo-content">
                                                    <div class="AuthorInfo-head">
                                                        <span class="UserLink AuthorInfo-name">{{$follow['data']['user_name']}}</span>
                                                    </div>
                                                    <div class="AuthorInfo-detail">
                                                        <div class="AuthorInfo-badge">
                                                            <div class="RichText ztext AuthorInfo-badgeText">{{$follow['data']['user_introduction']}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                    <div class="PushNotifications-list" id="news">
                                        @foreach($notifications['likes'] as $like)
                                        <div class="PushNotifications-item">
                                            <span>
                                                <span class="PushNotifications-actor">
                                                    <a href="/people/{{$like->data['user_id']}}">{{$like->data['user_name']}}</a>
                                                </span>
                                            </span>
                                            {{$like->data['like']}}
                                            <span>
                                                <a href="{{$like->data['to_url']}}">{{$like->data['to_name']}}</a>
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="Notifications-footer">
                                        <a href="/settings/notification" type="button" class="Button Button--plain">
                                            <svg viewBox="0 0 20 20" class="Icon Button-icon Icon--setting" width="14" height="16" aria-hidden="true" style="height: 16px; width: 14px;">
                                                <title></title>
                                                <g>
                                                    <path d="M18.868 15.185c-.164.096-.315.137-.452.137-.123 0-1.397-.26-1.617-.233-1.355.013-1.782 1.275-1.836 1.74-.055.454 0 .893.19 1.304.138.29.125.577-.067.85-.863.893-2.165 1.016-2.357 1.016-.123 0-.247-.055-.356-.15-.11-.097-.685-1.14-1.07-1.47-1.303-.954-2.246-.328-2.63 0-.397.33-.67.7-.835 1.126-.07.18-.18.302-.33.37-1.354.426-2.918-.92-3.014-1.056-.082-.11-.123-.22-.123-.356-.014-.138.383-1.276.342-1.688-.342-1.9-1.836-1.687-2.096-1.673-.303.014-.604.068-.92.178-.205.056-.396.03-.588-.054-.888-.462-1.137-2.332-1.11-2.51.055-.315.192-.52.438-.604.425-.164.81-.452 1.15-.85.932-1.262.344-2.25 0-2.634-.34-.356-.725-.645-1.15-.81-.137-.04-.233-.15-.328-.315C-.27 6.07.724 4.95.978 4.733c.255-.22.6-.055.723 0 .426.164.878.22 1.344.15C4.7 4.636 4.784 3.14 4.81 2.908c.015-.247-.11-1.29-.136-1.4-.027-.123-.014-.22.027-.315C5.318.178 7.073 0 7.223 0c.178 0 .33.055.44.178.108.124.63 1.11 1 1.4.398.338 1.582.83 2.588.013.398-.273.96-1.288 1.083-1.412.123-.123.26-.178.384-.178 1.56 0 2.33 1.03 2.438 1.22.083.124.096.248.07.37-.03.152-.33 1.153-.262 1.606.366 1.537 1.384 1.742 1.89 1.783.494.027 1.645-.357 1.81-.344.164.014.315.083.424.206.535.31.85 1.715.905 2.14.027.233-.014.44-.11.562-.11.138-1.165.714-1.48 1.112-.855.982-.342 2.25-.068 2.606.26.37 1.22.905 1.288.96.15.137.26.302.315.494.146 1.413-.89 2.387-1.07 2.47zm-8.905-.535c.644 0 1.246-.123 1.822-.356.575-.248 1.082-.59 1.493-1.016.425-.425.754-.92 1-1.495.247-.562.357-1.18.357-1.81 0-.66-.11-1.262-.356-1.825-.248-.562-.577-1.056-1.002-1.48-.41-.427-.918-.756-1.493-1.003-.576-.233-1.178-.357-1.822-.357-.644 0-1.247.124-1.81.357-.56.247-1.067.576-1.478 1.002-.425.425-.768.92-1 1.48-.247.564-.37 1.167-.37 1.826 0 .644.123 1.248.37 1.81.232.563.575 1.07 1 1.495.424.426.917.768 1.48 1.016.56.233 1.164.356 1.808.356z">
                                                    </path>
                                                </g>
                                            </svg>
                                            设置
                                        </a>
                                        <a href="/notifications" type="button" class="Button Button--plain">查看全部提醒</a>
                                    </div>
                                </div>
                            </div>
                            <button slot="reference" type="button" class="Popover Button PushNotifications-icon Button--plain">
                                <svg viewBox="0 0 20 22" class="Icon Icon--news" width="20" height="20" aria-hidden="true" style="height: 20px; width: 20px;"><title></title><g><path d="M2.502 14.08C3.1 10.64 2 3 8.202 1.62 8.307.697 9.08 0 10 0s1.694.697 1.797 1.62C18 3 16.903 10.64 17.497 14.076c.106 1.102.736 1.855 1.7 2.108.527.142.868.66.793 1.206-.075.546-.542.95-1.09.943H1.1C.55 18.34.084 17.936.01 17.39c-.075-.547.266-1.064.794-1.206.963-.253 1.698-1.137 1.698-2.104zM10 22c-1.417.003-2.602-1.086-2.73-2.51-.004-.062.02-.124.063-.17.043-.045.104-.07.166-.07h5c.063 0 .124.025.167.07.044.046.067.108.063.17-.128 1.424-1.313 2.513-2.73 2.51z"></path></g></svg>
                            </button>
                        </el-popover>
                    </div>
                    <div class="AppHeader-messages">
                        <el-popover
                            placement="bottom"
                            trigger="click"
                        >
                            <div class="PushNotifications-menu">
                                <div class="PushNotifications-content">
                                    <div class="PushNotifications-header">
                                        <button type="button" class="Button PushNotifications-tab Button--plain">我的私信</button>
                                    </div>
                                    <div class="PushNotifications-list">
                                        @foreach(Auth::user()->receiveMessage as $message)
                                            @php($user = \App\User::find($message->from_user_id))
                                            <a class="PushNotifications-item PushNotifications-followItem {{$message->has_reading=='Y' ? '' : 'PushNotifications-newItem'}}" target="_blank" href="/inbox/{{$message->inbox_id}}">
                                                <div class="AuthorInfo">
                                                    <span class="UserLink AuthorInfo-avatarWrapper">
                                                        <img class="Avatar Avatar--medium AuthorInfo-avatar" width="40" height="40" src="{{$user->avatar}}" srcset="{{$user->avatar}} 2x" alt="{{$user->name}}">
                                                    </span>
                                                    <div class="AuthorInfo-content">
                                                        <div class="AuthorInfo-head">
                                                            <span class="UserLink AuthorInfo-name">{{$user->name}}</span>
                                                        </div>
                                                        <div class="AuthorInfo-detail">
                                                            <div class="AuthorInfo-badge">
                                                                <div class="RichText ztext AuthorInfo-badgeText">{{$message->content}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="Notifications-footer">
                                        <button type="button" class="Button Button--plain">
                                            <svg viewBox="0 0 12 12" class="Icon Button-icon Icon--modify" width="14" height="16" aria-hidden="true" style="height: 16px; width: 14px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g>
                                            </svg>
                                            写新私信
                                        </button>
                                        <a href="/inbox" type="button" class="Button Button--plain">查看全部私信</a>
                                    </div>
                                </div>
                            </div>
                            <button slot="reference" type="button" class="Popover Button Messages-icon Button--plain">
                                <svg viewBox="0 0 20 20" class="Icon Icon--message" width="20" height="20" aria-hidden="true" style="height: 20px; width: 20px;"><title></title><g><path d="M9 0C3.394 0 0 4.13 0 8c0 1.654.522 3.763 2.014 5.566.314.292.518.82.454 1.17-.165 1.488-.842 1.905-.842 1.905-.328.332.105.67.588.582 1.112-.2 2.07-.58 3.526-1.122.4-.202.464-.147.78-.078C11.524 17.764 18 14 18 8c0-3.665-3.43-8-9-8z"></path><path d="M19.14 9.628c.758.988.86 2.01.86 3.15 0 1.195-.62 3.11-1.368 3.938-.21.23-.354.467-.308.722.12 1.073.614 1.5.614 1.5.237.24-.188.563-.537.5-.802-.145-1.494-.42-2.545-.81-.29-.146-.336-.106-.563-.057-2.043.712-4.398.476-6.083-.926 5.964-.524 8.726-3.03 9.93-8.016z"></path></g></svg>
                            </button>
                        </el-popover>
                    </div>
                    <div class="AppHeader-profile">
                        <el-popover
                            placement="bottom"
                            trigger="click"
                        >
                            <div class="Menu">
                                <a href="/people/{{Auth::id()}}" type="button" class="Button Menu-item AppHeaderProfileMenu-item Button--plain">
                                    <svg class="Zi Zi--Profile" fill="currentColor" viewBox="0 0 24 24" width="16" height="16"><path d="M15.417 12.923c-.376.653-.837 1.281-.763 1.863.292 2.273 5.562 1.77 6.78 3.048.566.595.566.664.566 4.164-6.611-.07-13.363 0-20 0 .027-3.5 0-3.478.62-4.164 1.303-1.44 6.581-.715 6.78-3.133.045-.545-.38-1.114-.763-1.778C6.511 9.233 5.697 2 12 2s5.422 7.443 3.417 10.923z" fill-rule="evenodd"></path></svg>
                                    我的主页
                                </a>
                                <a href="/settings/profile" type="button" class="Button Menu-item AppHeaderProfileMenu-item Button--plain">
                                    <svg class="Zi Zi--Settings" fill="currentColor" viewBox="0 0 24 24" width="16" height="16"><path d="M20.868 17.185a.896.896 0 0 1-.452.137c-.123 0-1.397-.26-1.617-.233-1.354.014-1.78 1.276-1.835 1.742-.055.453 0 .892.191 1.303a.8.8 0 0 1-.068.851C16.224 21.877 14.922 22 14.73 22a.548.548 0 0 1-.356-.151c-.11-.096-.685-1.138-1.069-1.468-1.304-.955-2.247-.329-2.63 0-.398.33-.672.7-.836 1.125a.632.632 0 0 1-.329.37c-1.354.426-2.918-.919-3.014-1.056a.564.564 0 0 1-.123-.356c-.014-.138.383-1.276.342-1.688-.342-1.9-1.836-1.687-2.096-1.673a3.192 3.192 0 0 0-.918.178.873.873 0 0 1-.59-.055c-.887-.462-1.136-2.332-1.109-2.51.055-.315.192-.521.438-.604.425-.164.809-.452 1.151-.85.931-1.262.343-2.25 0-2.634-.342-.356-.726-.645-1.15-.809-.138-.041-.234-.151-.33-.316-.38-1.434.613-2.552.867-2.77.255-.22.6-.055.723 0 .425.164.877.219 1.343.15C6.7 6.636 6.784 5.141 6.81 4.908c.014-.247-.11-1.29-.137-1.4a.488.488 0 0 1 .027-.315C7.317 2.178 9.071 2 9.222 2a.56.56 0 0 1 .439.178c.11.124.63 1.111 1 1.4.4.338 1.583.83 2.59.013.397-.274.959-1.29 1.082-1.413A.55.55 0 0 1 14.717 2c1.56 0 2.329 1.029 2.438 1.22a.458.458 0 0 1 .069.371c-.028.151-.329 1.152-.26 1.605.365 1.537 1.383 1.742 1.89 1.783.493.028 1.644-.356 1.809-.343a.63.63 0 0 1 .424.206c.535.31.85 1.715.905 2.14.027.233-.014.439-.11.562-.11.138-1.165.714-1.48 1.112-.855.982-.342 2.25-.068 2.606.26.37 1.22.905 1.288.96.15.137.26.302.315.494.146 1.413-.89 2.387-1.069 2.47zm-8.905-.535c.644 0 1.246-.123 1.822-.356a4.576 4.576 0 0 0 1.493-1.016 4.694 4.694 0 0 0 1-1.495c.247-.562.357-1.18.357-1.81 0-.659-.11-1.262-.356-1.825a4.79 4.79 0 0 0-1-1.481 4.542 4.542 0 0 0-1.494-1.002 4.796 4.796 0 0 0-3.631 0 4.627 4.627 0 0 0-1.48 1.002c-.424.425-.767.919-1 1.481a4.479 4.479 0 0 0-.37 1.825c0 .644.124 1.248.37 1.81a4.62 4.62 0 0 0 1 1.495c.425.426.918.768 1.48 1.016a4.677 4.677 0 0 0 1.809.356z" fill-rule="evenodd"></path></svg>
                                    设置
                                </a>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="Button Menu-item AppHeaderProfileMenu-item Button--plain">
                                        <svg class="Zi Zi--Logout" fill="currentColor" viewBox="0 0 24 24" width="16" height="16"><path d="M2 11.999c0-2.756 1.154-5.417 3.167-7.3a1.266 1.266 0 0 1 1.73 1.847 7.396 7.396 0 0 0-2.367 5.453c0 4.119 3.35 7.47 7.47 7.47 4.119 0 7.47-3.351 7.47-7.47a7.41 7.41 0 0 0-2.279-5.37 1.266 1.266 0 0 1 1.76-1.819A9.923 9.923 0 0 1 22 12c0 5.513-4.486 10-10 10s-10-4.487-10-10zm8.699-.482V3.26a1.26 1.26 0 1 1 2.52 0v8.257a1.26 1.26 0 1 1-2.52 0z" fill-rule="evenodd"></path></svg>
                                        退出
                                    </button>
                                </form>
                            </div>
                            <button slot="reference" type="button" class="Popover Button AppHeader-profileEntry Button--plain">
                                <img class="Avatar AppHeader-profileAvatar" width="30" height="30" src="{{Auth::user()->avatar}}" srcset="{{Auth::user()->avatar}} 2x">
                            </button>
                        </el-popover>
                    </div>
                    @endguest
                </div>
            </div>
        </nav>

        @yield('content')

        <modal size="large" ref="questionModal">
            <question-form></question-form>
        </modal>
        <hover-card ref="hoverCard"></hover-card>
        <send-message ref="sendMessage"></send-message>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('.PushNotifications-icon:first').click(function () {
            $.ajax({
                url: '/readMessage',
                type: 'post'
            });
            $(this).find('.PushNotifications-redbot').remove();
        });
        $(document).on('mouseenter', '.UserLink', function (e) {
            setTimeout(() => {
                if($(this).attr('user-id')){
                    const style = {
                        left: $(this).offset().left + 'px',
                        top: $(this).offset().top + $(this).outerHeight(true) + 10 + 'px'
                    };
                    app.$refs.hoverCard.$emit('showHoverCard', {style, id: $(this).attr('user-id')});
                }
            }, 200);
            e.preventDefault();
        });
        $(document).on('mouseout', '.UserLink', function () {
            const timeout = setTimeout(function () {
                app.$refs.hoverCard.$emit('closeHoverCard');
            }, 200);
            app.$refs.hoverCard.timeOut = timeout;
        });
        (function(){
            $($('.is_active[data-tab]').attr('data-tab')).show().siblings('.PushNotifications-list').hide();
            $('[data-tab]').on('click', function () {
                const _this = $(this);
                $(_this.attr('data-tab')).show().siblings('.PushNotifications-list').hide();
                _this.addClass('is_active').siblings('[data-tab]').removeClass('is_active');
            });
        })();
        if($('.GlobalSideBar').length){
            $(window).scroll(function () {
                if($(window).scrollTop() > $('.AppHeader').outerHeight(true)) {
                    $('.GlobalSideBar').css({
                        'width': $('.GlobalSideBar').css('width'),
                        'position': 'fixed',
                        'top': '10px',
                        'left': $('.GlobalSideBar').offset().left + 'px'
                    });
                } else {
                    $('.GlobalSideBar').css({
                        'width': '',
                        'position': '',
                        'top': '',
                        'left': ''
                    });
                }
            });
            $(window).resize(function () {
                $('.GlobalSideBar').css({
                    'position': '',
                    width: ''
                });
                $('.GlobalSideBar').css({
                    position: 'fixed',
                    left: $('.GlobalSideBar').offset().left,
                    'width': $('.GlobalSideBar').css('width')
                });
            });
        }
    </script>

    <!-- input获得焦点 -->
    <script>
    setTimeout(()=>{
        $(document).on('focus', '.Input', function(){
            $(this).parent().addClass('is_focus');
        });
        $(document).on('blur', '.Input', function(){
            $(this).parent().removeClass('is_focus');
        });
    }, 500);
    </script>

    @yield('js')

    @auth
        @foreach($notifications['messages'] as $message)
            <script>
            $.notification({
                color: 'white',
                content: `{{$message['data']['from_user_name']}} 给您发送了私信`,
                autoClose: false
            });
            </script>
        @endforeach
    @endauth

    @if(Session::has('message'))
    <script>
        // color: 颜色 content: 内容
        $.notification({
            color: '{{session('color')}}',
            content: '{{session('message')}}',
            autoClose: {{session('autoClose') ? session('autoClose') : true}}
        });
    </script>
    @endif
</body>

</html>
