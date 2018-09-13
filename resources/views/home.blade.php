@extends('layouts.app')

@section('content')
<div class="Topstory-container">
    <div class="Topstory-mainColumn">
        <div class="Card">
            <div class="TopstoryHeader">
                <div class="TopstoryHeader-nav">
                    <button @click="showQuestionModal" type="button" class="Button TopstoryHeader-navItem Button--plain">
                        <svg width="16" height="16" viewBox="0 0 17 17" xmlns="http://www.w3.org/2000/svg" class="Icon Icon--question" aria-hidden="true" style="height: 16px; width: 16px;"><title></title><g><g transform="translate(-3 -3)" fill="#8590A6" fill-rule="evenodd"><path d="M3.833 6.356c0-1.66 1.334-3.007 2.993-3.007h9.348c1.653 0 2.993 1.338 2.993 3.006v8.498c0 1.66-1.266 3.467-2.812 4.03l-1.09.396c-2.08.757-5.447.76-7.53 0l-1.09-.396c-1.553-.565-2.812-2.363-2.812-4.03V6.356zm1.643.67v7.492c0 1.1.84 2.314 1.873 2.697l2.277.844c1.035.383 2.712.383 3.746 0l2.278-.845c1.036-.384 1.874-1.59 1.874-2.697V7.026c0-1.1-.897-2.003-2.003-2.003H7.48c-1.118 0-2.004.897-2.004 2.003z"></path><path d="M13.012 11.46l-.422.29c-.232.177-.433.53-.433.53s-.08.134-.11.398v.16h-1.63v-.24c.02-.555.11-.86.343-1.13.364-.422 1.168-.935 1.202-.956.114-.086.212-.184.284-.288.17-.23.244-.412.244-.59 0-.25-.074-.478-.22-.682-.143-.197-.41-.296-.798-.296-.385 0-.648.12-.806.368-.162.254-.243.523-.243.796l-.005.23-1.656-.003.003-.23c.043-1.007.406-1.732 1.078-2.155.424-.27 1.113-.396 1.657-.406.873.01 1.39.193 1.923.575.54.387.815.965.815 1.72 0 .422-.135.82-.4 1.18-.14.193-.442.434-.826.73z"></path><ellipse cx="11.226" cy="14.791" rx="1.095" ry="1.116"></ellipse></g></g>
                        </svg>
                        提问
                    </button>
                    <a href="/question" target="_blank" title="回答" class="TopstoryHeader-navItem">
                        <svg width="16" height="16" viewBox="0 0 17 18" xmlns="http://www.w3.org/2000/svg" class="Icon Icon--paper" aria-hidden="true" style="height: 16px; width: 16px;"><title></title><g><g fill="#8590A6" fill-rule="evenodd">     <path d="M.833 4.35c0-2.21 1.79-4 4.01-4h7.315c2.214 0 4.01 1.79 4.01 4v8.743c0 2.21-1.79 4-4.01 4H4.842c-2.214 0-4.01-1.792-4.01-4V4.35zm1.643-.32v9.383c0 1.106.897 2.006 2.003 2.006h8.04c1.118 0 2.004-.9 2.004-2.007V4.03c0-1.107-.897-2.007-2.003-2.007H4.48c-1.118 0-2.004.898-2.004 2.006z"></path><path d="M4.667 4.814h7.666v1.674H4.667V4.814zm0 2.79h7.666V9.28H4.667V7.604zm0 2.79h4.928v1.676H4.667v-1.675z"></path></g></g>
                        </svg>
                        回答
                    </a>
                    <a href="/zhuanlan.zhihu.com/write" target="_blank" rel="noopener noreferrer" title="写文章" class="TopstoryHeader-navItem TopstoryHeader-navItemArticle">
                        <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" class="Icon Icon--write" aria-hidden="true" style="height: 16px; width: 16px;"><title></title><g><g fill="none" fill-rule="evenodd"><path d="M9.595 2.023H4.842c-2.22 0-4.01 1.793-4.01 4.005v7.62c0 2.21 1.796 4.003 4.01 4.003h7.316c2.22 0 4.01-1.792 4.01-4.003v-7.11.51L14.523 8.72v4.253c0 1.66-1.336 3.004-3.01 3.004h-6.03c-1.66 0-3.008-1.338-3.008-3.004V6.7c0-1.657 1.336-3.002 3.01-3.002h2.467L9.595 2.03v-.007z" fill="#8590A6"></path>     <path d="M6.372 11.08c-.185-.915.2-2.238.85-2.888l6.616-6.616c.565-.565 1.472-.567 2.038 0 .56.56.56 1.477 0 2.038L9.258 10.23c-.652.65-1.975 1.034-2.888.85z" stroke="#8590A6" stroke-width="1.5"></path><path fill="#8590A6" d="M13.04 2.088l2.324 2.324-.987.986-2.323-2.324z"></path></g></g></svg>
                        写文章
                    </a>
                    <button type="button" class="Button TopstoryHeader-navItem Button--plain" data-za-detail-view-path-module="ToolBar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="TopstoryHeader-pinIcon"><title></title><g><path d="M12.63 2.02V0h1.35v2.02H16v1.35h-2.02V5.4h-1.35V3.36H10.6V2.02h2.03zm-.17 4.9h1.7v4.76c0 1.5-.17 2.05-.46 2.6-.3.55-.73.98-1.28 1.27-.54.3-1.1.45-2.6.45h-5.5c-1.5 0-2.05-.16-2.6-.45-.55-.3-.98-.72-1.27-1.27-.3-.55-.45-1.1-.45-2.6v-5.5c0-1.5.16-2.06.45-2.6.3-.55.72-.98 1.27-1.28.55-.3 1.1-.45 2.6-.45H9.1v1.7H4.3c-1.12 0-1.46.05-1.8.24-.26.1-.45.3-.58.55-.2.35-.26.7-.26 1.8v5.5c0 1.13.07 1.47.26 1.8.13.27.32.46.58.6.34.18.68.25 1.8.25h5.5c1.12 0 1.46-.06 1.8-.25.27-.13.46-.32.6-.58.18-.34.24-.68.24-1.8V6.9zM8.6 6.7c.7-.16 1.45.06 1.98.6.83.83.83 2.2 0 3.04l-.03.03c-.84.85-2.2.85-3.04 0l-1.92-2c-.25-.24-.64-.24-.88 0l-.04.04c-.25.28-.25.7 0 .95.15.16.37.22.57.17.4-.1.82.18.9.58.1.4-.16.82-.57.9-.7.17-1.46-.04-1.98-.58-.83-.85-.83-2.2 0-3.06l.03-.02c.86-.85 2.2-.85 3.05 0L8.6 9.3c.24.25.63.25.87 0l.03-.02c.25-.26.25-.67 0-.93-.16-.15-.37-.2-.58-.17-.4.1-.8-.16-.9-.57-.1-.4.16-.8.57-.9z"></path></g>
                        </svg>
                        写想法
                    </button>
                </div>
                <a class="TopstoryHeader-rightItem" href="/draft" target="_blank" title="草稿">草稿 (1)</a>
            </div>
        </div>
        <div class="TopstoryMain">
            <question-list></question-list>
        </div>
    </div>
    <div class="GlobalSideBar">
        <div class="Sticky">
            <div class="Card">
                <ul class="GlobalSideBar-categoryList">
                    <li class="GlobalSideBar-categoryItem">
                        <a href="/lives" target="_blank" title="Live" type="button" class="Button Button--plain" style="color: rgb(255, 207, 0);">
                            <span class="GlobalSideBar-categoryIcon">
                                <svg class="Zi Zi--Live" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M13.693 10.354l1.634-7.542c.195-.901-.16-1.083-.798-.39l-9.18 9.97c-.638.693-.377 1.254.582 1.254h5.376l-1.634 7.542c-.195.901.16 1.083.798.39l9.18-9.97c.638-.693.377-1.254-.582-1.254h-5.376z"></path>
                                </svg>
                            </span>
                            <span class="GlobalSideBar-categoryLabel">Live</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-categoryItem">
                        <a href="/pub/" target="_blank" title="书店" type="button" class="Button Button--plain" style="color: rgb(67, 212, 128);">
                            <span class="GlobalSideBar-categoryIcon">
                                <svg class="Zi Zi--Ebook" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M16 17.649V2.931a.921.921 0 0 0-.045-.283.943.943 0 0 0-1.182-.604L4.655 5.235A.932.932 0 0 0 4 6.122v14.947c0 .514.421.931.941.931H19.06c.52 0 .941-.417.941-.93V7.292a.936.936 0 0 0-.941-.931h-.773v12.834a.934.934 0 0 1-.83.924L6.464 21.416c-.02.002 2.94-.958 8.883-2.881a.932.932 0 0 0 .653-.886z" fill-rule="evenodd"></path></svg>
                            </span>
                            <span class="GlobalSideBar-categoryLabel">书店</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-categoryItem">
                        <a href="/roundtable" target="_blank" title="圆桌" type="button" class="Button Button--plain" style="color: rgb(0, 132, 255);">
                            <span class="GlobalSideBar-categoryIcon">
                                <svg class="Zi Zi--Org" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                    <path d="M10.786 8.41a8.938 8.938 0 0 0-3.968-2.528c-.305-1.719.814-3.337 2.442-3.741 1.221-.405 2.646.101 3.46 1.011 1.045 1.38.915 3.64.814 4.348-.102 1.315-1.221 3.034-1.323 3.135-.305-.809-.814-1.517-1.425-2.225zm-2.442 2.832c-1.526.202-3.052 1.01-4.171 2.123-1.12-.404-1.934-1.314-2.137-2.427-.316-2.427 1.526-3.64 2.849-3.842 1.628-.371 2.849.505 4.07 1.415 1.146 1.012 2.035 2.63 2.035 2.73-.916-.202-1.832-.1-2.646 0zm4.986.303c.509-.607.931-1.586 1.12-2.225.318-1.039.61-3.134.203-4.651 1.323-1.011 3.154-1.011 4.477.303 1.235 1.146 1.017 2.933.814 3.438-.663 1.581-1.933 2.326-3.256 2.832-1.221.404-3.256.303-3.358.303zm-2.645 1.011c-.51.607-.916 1.416-1.221 2.326-.407 1.314-.643 3.06-.102 4.55-1.323 1.011-3.256 1.011-4.477-.202-1.198-1.124-1.018-2.932-.814-3.438.599-1.605 1.933-2.326 3.256-2.831.916-.304 3.256-.405 3.358-.405zm9.259-1.82c1.017.404 1.933 1.315 2.035 2.427.233 2.57-1.526 3.64-2.849 3.842-1.526 0-2.85-.505-4.07-1.415-1.018-.81-2.035-2.528-2.035-2.63.916.203 1.831.102 2.645 0 1.628-.404 3.053-1.112 4.274-2.224zm-6.716 4.854c1.065 1.08 2.442 2.022 4.07 2.528.306 1.719-.814 3.235-2.442 3.741-1.22.405-2.645-.101-3.46-1.011-1.1-1.481-1.017-3.54-.915-4.247.102-1.315 1.221-3.034 1.323-3.135.305.708.721 1.44 1.424 2.124z"></path></svg>
                            </span>
                            <span class="GlobalSideBar-categoryLabel">圆桌</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-categoryItem">
                        <a href="//zhuanlan.zhihu.com" target="_blank" title="专栏" type="button" class="Button Button--plain" style="color: rgb(15, 136, 235);">
                            <span class="GlobalSideBar-categoryIcon">
                                <svg class="Zi Zi--Edit" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M4.076 16.966a4.19 4.19 0 0 1 1.05-1.76l8.568-8.569a.524.524 0 0 1 .741 0l2.928 2.927a.524.524 0 0 1 0 .74l-8.568 8.57c-.49.49-1.096.852-1.761 1.051l-3.528 1.058a.394.394 0 0 1-.49-.488l1.06-3.53zM20.558 4.83c.59.59.59 1.546 0 2.136l-1.693 1.692a.503.503 0 0 1-.712 0l-2.812-2.812a.504.504 0 0 1 0-.712l1.693-1.693a1.51 1.51 0 0 1 2.135 0l1.389 1.389z"></path></svg>
                            </span>
                            <span class="GlobalSideBar-categoryLabel">专栏</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-categoryItem">
                        <a href="/zhi" target="_blank" title="付费咨询" type="button" class="Button Button--plain" style="color: rgb(84, 120, 240);">
                            <span class="GlobalSideBar-categoryIcon">
                                <svg class="Zi Zi--Infinity" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path d="M11.267 10.188h-2.69a.26.26 0 0 0-.261.26v.508c0 .149.117.26.262.26h2.896v1.54H8.578a.26.26 0 0 0-.262.259v.508c0 .15.117.26.262.26h2.896v2.31c0 .139.119.257.265.257h.522a.258.258 0 0 0 .265-.257v-2.31h2.896a.26.26 0 0 0 .262-.26v-.508a.257.257 0 0 0-.262-.26h-2.896v-1.54h2.896a.26.26 0 0 0 .262-.26v-.507a.257.257 0 0 0-.262-.26h-2.69l2.51-2.636a.26.26 0 0 0-.004-.366l-.423-.413a.253.253 0 0 0-.36.01L12 9.418 9.545 6.784a.248.248 0 0 0-.36-.011l-.423.413a.264.264 0 0 0-.004.366l2.509 2.636zM12 19.973c-1.101 0-2.16-.15-3.152-.43-.532.18-5.27 2.177-4.743 1.179.527-.998 1.58-2.746.806-3.25C3.11 15.936 2 13.822 2 11.486 2 6.8 6.477 3 12 3s10 3.8 10 8.487-4.477 8.486-10 8.486z"></path></svg>
                            </span>
                            <span class="GlobalSideBar-categoryLabel">付费咨询</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="Card">
                <ul class="GlobalSideBar-navList">
                    <li class="GlobalSideBar-navItem GlobalSideBar-starItem">
                        <a href="/collections" target="_blank" type="button" class="Button GlobalSideBar-navLink Button--plain">
                            <svg class="Zi Zi--Star GlobalSideBar-navIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><path d="M5.515 19.64l.918-5.355-3.89-3.792c-.926-.902-.639-1.784.64-1.97L8.56 7.74l2.404-4.871c.572-1.16 1.5-1.16 2.072 0L15.44 7.74l5.377.782c1.28.186 1.566 1.068.64 1.97l-3.89 3.793.918 5.354c.219 1.274-.532 1.82-1.676 1.218L12 18.33l-4.808 2.528c-1.145.602-1.896.056-1.677-1.218z" fill-rule="evenodd"></path></svg><span class="GlobalSideBar-navText">我的收藏</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-navItem GlobalSideBar-questionListItem">
                        <a target="_blank" type="button" class="Button GlobalSideBar-navLink Button--plain" href="/people/sui-bian-212121/following/questions">
                            <svg class="Zi Zi--HelpBubble GlobalSideBar-navIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><path d="M5.74 4h12.52c.961 0 1.74.775 1.74 1.73V16.27c0 .955-.779 1.73-1.74 1.73h-3.825l-1.658 2.044a1 1 0 0 1-1.554 0l-1.658-2.044H5.74C4.78 18 4 17.224 4 16.27V5.73C4 4.775 4.778 4 5.74 4zM12 16a.976.976 0 0 0 .705-.287.951.951 0 0 0 .295-.712.954.954 0 0 0-.295-.714A.976.976 0 0 0 12 14a.962.962 0 0 0-.705.295A.961.961 0 0 0 11 15c0 .284.098.522.295.713A.975.975 0 0 0 12 16zm1.278-4.924a36.81 36.81 0 0 0 1.023-.975c.19-.193.354-.422.492-.688.138-.266.207-.575.207-.928 0-.448-.12-.864-.363-1.246a2.517 2.517 0 0 0-1.029-.906C13.164 6.111 12.652 6 12.072 6c-.624 0-1.17.133-1.638.399-.468.265-.824.6-1.068 1.005-.244.405-.366.804-.366 1.2 0 .19.077.368.231.531a.747.747 0 0 0 .567.246c.38 0 .638-.234.774-.703.144-.449.32-.788.528-1.019.208-.23.532-.345.972-.345.376 0 .683.114.921.342.238.229.357.51.357.841 0 .17-.039.328-.117.473a1.782 1.782 0 0 1-.288.396c-.114.118-.3.294-.555.526a9.71 9.71 0 0 0-.696.688c-.172.194-.31.418-.414.673a2.391 2.391 0 0 0-.156.906c0 .278.071.488.213.63a.716.716 0 0 0 .525.211c.4 0 .638-.216.714-.648.044-.203.077-.345.099-.426.022-.081.053-.162.093-.243.04-.081.101-.17.183-.268.082-.098.191-.21.327-.34z" fill-rule="evenodd"></path>
                            </svg>
                            <span class="GlobalSideBar-navText">我关注的问题</span>
                            <!-- <span class="GlobalSideBar-navNumber">3</span> -->
                        </a>
                    </li>
                    <li class="GlobalSideBar-navItem GlobalSideBar-inviteItem">
                        <a href="/question/invited" target="_blank" type="button" class="Button GlobalSideBar-navLink Button--plain">
                            <svg class="Zi Zi--Invite GlobalSideBar-navIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18">
                                <path d="M4 10V8a1 1 0 1 1 2 0v2h2a1 1 0 0 1 0 2H6v2a1 1 0 0 1-2 0v-2H2a1 1 0 0 1 0-2h2zm10.455 2c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm-7 6c0-2.66 4.845-4 7.272-4C17.155 14 22 15.34 22 18v1.375c0 .345-.28.625-.625.625H8.08a.625.625 0 0 1-.625-.625V18z" fill-rule="evenodd"></path>
                            </svg>
                            <span class="GlobalSideBar-navText">我的邀请</span>
                            <!-- <span class="GlobalSideBar-navNumber">17</span> -->
                        </a>
                    </li>
                    <li class="GlobalSideBar-navItem GlobalSideBar-couponItem">
                        <a href="/coupon" target="_blank" type="button" class="Button GlobalSideBar-navLink Button--plain">
                            <svg class="Zi Zi--Coupon GlobalSideBar-navIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><path d="M21.515 10.131c-1.1.567-1.471.996-1.471 1.869s.388 1.348 1.471 1.869c.356.26.485.429.485.934v2.803c0 .766-.647 1.394-1.471 1.394H3.47C2.663 19 2 18.387 2 17.606v-2.803c0-.26.08-.674.517-.934.615-.2 1.456-.613 1.456-1.869 0-.965-.793-1.578-1.472-1.869-.452-.23-.485-.52-.485-.934V6.394C2.016 5.628 2.663 5 3.487 5H20.53C21.337 5 22 5.613 22 6.394v2.803c0 .398 0 .628-.485.934zM10.5 12c0 .834.672 1.5 1.5 1.5.834 0 1.5-.672 1.5-1.5 0-.834-.672-1.5-1.5-1.5-.834 0-1.5.672-1.5 1.5zm5 0c0 .834.672 1.5 1.5 1.5.834 0 1.5-.672 1.5-1.5 0-.834-.672-1.5-1.5-1.5-.834 0-1.5.672-1.5 1.5zm-10 0c0 .834.672 1.5 1.5 1.5.834 0 1.5-.672 1.5-1.5 0-.834-.672-1.5-1.5-1.5-.834 0-1.5.672-1.5 1.5z"></path>
                            </svg>
                            <span class="GlobalSideBar-navText">我的礼券</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-navItem GlobalSideBar-serviceItem">
                        <a href="/community" target="_blank" type="button" class="Button GlobalSideBar-navLink Button--plain">
                            <svg class="Zi Zi--Community GlobalSideBar-navIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><path d="M5.74 4h12.52c.961 0 1.74.775 1.74 1.73V16.27c0 .955-.779 1.73-1.74 1.73h-3.825l-1.658 2.044a1 1 0 0 1-1.554 0l-1.658-2.044H5.74C4.78 18 4 17.224 4 16.27V5.73C4 4.775 4.778 4 5.74 4zM7 8.98c0 .554.449.996 1.003.996h4.994A.992.992 0 0 0 14 8.981a.997.997 0 0 0-1.003-.995H8.003A.992.992 0 0 0 7 8.98zm0 4c0 .554.446.996.995.996h8.01a.993.993 0 0 0 .995-.995.993.993 0 0 0-.995-.995h-8.01A.993.993 0 0 0 7 12.98z" fill-rule="evenodd"></path></svg>
                            <span class="GlobalSideBar-navText">社区服务中心</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-navItem GlobalSideBar-copyrightItem">
                        <a href="/copyright" target="_blank" type="button" class="Button GlobalSideBar-navLink Button--plain">
                            <svg class="Zi Zi--Copyright GlobalSideBar-navIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><path d="M16.517 15.815a5.871 5.871 0 0 1-4.481 2.078 5.865 5.865 0 0 1-5.859-5.857 5.865 5.865 0 0 1 5.859-5.859c1.63 0 3.204.7 4.319 1.919.085.093.24.432.209.797a1.086 1.086 0 0 1-.436.779c-.248.193-.516.29-.797.29-.402 0-.7-.198-.814-.314A3.473 3.473 0 0 0 12 8.575a3.464 3.464 0 0 0-3.46 3.461 3.464 3.464 0 0 0 3.46 3.46 3.63 3.63 0 0 0 2.654-1.181c.136-.152.458-.306.806-.306.274 0 .542.095.773.274.35.269.45.588.473.809.032.308-.072.585-.188.723m4.686-7.699C20.67 6.883 19.96 5.82 19.07 4.929c-.891-.89-1.954-1.601-3.188-2.133A9.728 9.728 0 0 0 12 2a9.733 9.733 0 0 0-3.883.796c-1.234.532-2.297 1.243-3.186 2.133-.891.891-1.602 1.954-2.134 3.187A9.713 9.713 0 0 0 2 12a9.752 9.752 0 0 0 .797 3.883c.531 1.233 1.242 2.296 2.134 3.186.89.891 1.953 1.602 3.186 2.134A9.725 9.725 0 0 0 12 22a9.72 9.72 0 0 0 3.883-.797c1.233-.532 2.296-1.243 3.188-2.134.89-.89 1.601-1.953 2.132-3.186A9.73 9.73 0 0 0 22 12a9.69 9.69 0 0 0-.797-3.884" fill-rule="evenodd"></path>
                            </svg>
                            <span class="GlobalSideBar-navText">版权服务中心</span>
                        </a>
                    </li>
                    <li class="GlobalSideBar-navItem GlobalSideBar-publicEditItem">
                        <a href="/watch" target="_blank" type="button" class="Button GlobalSideBar-navLink Button--plain">
                            <svg class="Zi Zi--EditRounded GlobalSideBar-navIcon" fill="currentColor" viewBox="0 0 24 24" width="18" height="18"><path d="M16.886 3A4.114 4.114 0 0 1 21 7.114v9.772A4.114 4.114 0 0 1 16.886 21H7.114A4.114 4.114 0 0 1 3 16.886V7.114A4.114 4.114 0 0 1 7.114 3h9.772zM7.542 14.793l-.595 1.985a.22.22 0 0 0 .275.275l1.984-.595a2.36 2.36 0 0 0 .991-.592l4.82-4.82a.295.295 0 0 0 0-.416L13.37 8.983a.295.295 0 0 0-.417 0l-4.82 4.82c-.275.277-.478.617-.59.99zm9.272-6.826l-.781-.78a.849.849 0 0 0-1.202 0l-.952.951c-.11.11-.11.29 0 .4l1.582 1.583a.283.283 0 0 0 .4 0l.953-.952a.85.85 0 0 0 0-1.202z"></path>
                            </svg>
                            <span class="GlobalSideBar-navText">公共编辑动态</span>
                        </a>
                    </li>
                </ul>
            </div>
            <footer class="Footer Card"><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="//liukanshan.zhihu.com/">刘看山</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="/question/19581624">知乎指南</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="/terms">知乎协议</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="/terms/privacy">隐私政策</a><br><a class="Footer-item" target="_blank" href="/app">应用</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://app.mokahr.com/apply/zhihu">工作</a><span class="Footer-dot"></span><button type="button" class="Button OrgCreateButton">申请开通知乎机构号</button><br><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://zhuanlan.zhihu.com/p/28561671">侵权举报</a><span class="Footer-dot"></span><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="http://www.12377.cn">网上有害信息举报专区</a><br><span class="Footer-item">违法和不良信息举报：010-82716601</span><br><a class="Footer-item" target="_blank" href="/jubao">儿童色情信息举报专区</a><br><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://zhstatic.zhihu.com/assets/zhihu/certificates/certificate-ICP.png">电信与服务业务经营许可证</a><br><a class="Footer-item" target="_blank" rel="noopener noreferrer" href="https://zhstatic.zhihu.com/assets/zhihu/certificates/certificate-1.jpeg">网络文化经营许可证</a><br><a class="Footer-item" target="_blank" href="/contact">联系我们</a><span> © 2018 知乎</span></footer>
        </div>
    </div>
</div>
@endsection
