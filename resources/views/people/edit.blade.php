@extends('layouts.people')

@section('ProfileHeader')
<div class="ProfileHeader-contentHead">
    <h1 class="ProfileHeader-title">
        <span class="ProfileHeader-name">{{Auth::user()->name}}</span>
    </h1>
    <div class="ProfileHeader-expandActions ProfileEdit-expandActions">
        <a type="button" class="Button Button--plain" href="/people/{{$user->id}}">
            返回我的主页
            <svg viewBox="0 0 10 6" class="Icon ProfileEdit-arrowIcon Icon--arrow" width="10" height="16" aria-hidden="true" style="height: 16px; width: 10px;"><title></title><g><path d="M8.716.217L5.002 4 1.285.218C.99-.072.514-.072.22.218c-.294.29-.294.76 0 1.052l4.25 4.512c.292.29.77.29 1.063 0L9.78 1.27c.293-.29.293-.76 0-1.052-.295-.29-.77-.29-1.063 0z"></path></g></svg>
        </a>
    </div>
</div>
<div class="ProfileEdit-fields">
    <form class="Field">
        <h3 class="Field-label">性别</h3>
        <div class="Field-content">
            <div class="content">
                <span class="Field-text">
                    {{$user->profile->sex=='' ? '未知' : ''}}
                    {{$user->profile->sex==1 ? '男' : '' }}
                    {{$user->profile->sex==0 ? '女' : '' }}
                </span>
                <button type="button" class="Button ModifyButton Field-modify Field-modify-hidden Button--link">
                    <svg viewBox="0 0 12 12" class="Icon ModifyButton-icon Icon--modify" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                    修改
                </button>
            </div>
            <div class="input-group">
                <input type="radio" name="sex" value="1"> 男
                <input type="radio" name="sex" value="0" style="margin-left: 30px;"> 女
                <div class="ButtonGroup">
                    <button type="submit" class="Button Button--primary Button--blue">保存</button>
                    <button type="button" class="Button Button--grey">取消</button>
                </div>
            </div>
        </div>
    </form>
    <form class="Field">
        <h3 class="Field-label">一句话介绍</h3>
        <div class="Field-content">
            <div class="content">
                <span class="Field-text">{{$user->profile->introduction ? $user->profile->introduction : '无'}}</span>
                <button type="button" class="Button ModifyButton Field-modify Field-modify-hidden Button--link">
                    <svg viewBox="0 0 12 12" class="Icon ModifyButton-icon Icon--modify" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                    修改
                </button>
            </div>
            <div class="input-group">
                <div class="HeadlineField-input Input-wrapper">
                    <input maxlength="40" class="Input" name="introduction" value="{{$user->profile->introduction}}">
                </div>
                <div class="HeadlineField-actions">
                    <div class="ButtonGroup HeadlineField-buttonGroup">
                        <button type="submit" class="Button Button--primary Button--blue">保存</button>
                        <button type="button" class="Button Button--grey">取消</button>
                    </div>
                    <span class="MaxLength"></span>
                </div>
            </div>
        </div>
    </form>
    <form class="Field">
        <h3 class="Field-label">居住地</h3>
        <div class="Field-content">
            <div class="content">
                <span class="Field-text"> {{$user->profile->place ? $user->profile->place : '无'}}</span>
                <button type="button" class="Button ModifyButton Field-modify Field-modify-hidden Button--link">
                    <svg viewBox="0 0 12 12" class="Icon ModifyButton-icon Icon--modify" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                    修改
                </button>
            </div>
            <div class="input-group">
                <div class="HeadlineField-input Input-wrapper">
                    <input class="Input" name="place" value="{{$user->profile->place}}">
                </div>
                <div class="HeadlineField-actions">
                    <div class="ButtonGroup HeadlineField-buttonGroup">
                        <button type="submit" class="Button Button--primary Button--blue">保存</button>
                        <button type="button" class="Button Button--grey">取消</button>
                    </div>
                    <span class="MaxLength"></span>
                </div>
            </div>
        </div>
    </form>
    <form class="Field">
        <h3 class="Field-label">所在行业</h3>
        <div class="Field-content">
            <div class="content">
                <span class="Field-text"> {{$user->profile->industry ? $user->profile->industry : '无'}}</span>
                <button type="button" class="Button ModifyButton Field-modify Field-modify-hidden Button--link">
                    <svg viewBox="0 0 12 12" class="Icon ModifyButton-icon Icon--modify" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                    修改
                </button>
            </div>
            <div class="input-group">
                <div class="HeadlineField-input Input-wrapper">
                    <input class="Input" name="industry" value="{{$user->profile->industry}}">
                </div>
                <div class="HeadlineField-actions">
                    <div class="ButtonGroup HeadlineField-buttonGroup">
                        <button type="submit" class="Button Button--primary Button--blue">保存</button>
                        <button type="button" class="Button Button--grey">取消</button>
                    </div>
                    <span class="MaxLength"></span>
                </div>
            </div>
        </div>
    </form>
    <form class="Field">
        <h3 class="Field-label">职业经历</h3>
        <div class="Field-content">
            <div class="content">
                <span class="Field-text"> {{$user->profile->career ? $user->profile->career : '无'}}</span>
                <button type="button" class="Button ModifyButton Field-modify Field-modify-hidden Button--link">
                    <svg viewBox="0 0 12 12" class="Icon ModifyButton-icon Icon--modify" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                    修改
                </button>
            </div>
            <div class="input-group">
                <div class="HeadlineField-input Input-wrapper">
                    <input class="Input" name="career" value="{{$user->profile->career}}">
                </div>
                <div class="HeadlineField-actions">
                    <div class="ButtonGroup HeadlineField-buttonGroup">
                        <button type="submit" class="Button Button--primary Button--blue">保存</button>
                        <button type="button" class="Button Button--grey">取消</button>
                    </div>
                    <span class="MaxLength"></span>
                </div>
            </div>
        </div>
    </form>
    <form class="Field">
        <h3 class="Field-label">教育经历</h3>
        <div class="Field-content">
            <div class="content">
                <span class="Field-text"> {{$user->profile->education ? $user->profile->education : '无'}}</span>
                <button type="button" class="Button ModifyButton Field-modify Field-modify-hidden Button--link">
                    <svg viewBox="0 0 12 12" class="Icon ModifyButton-icon Icon--modify" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                    修改
                </button>
            </div>
            <div class="input-group">
                <div class="HeadlineField-input Input-wrapper">
                    <input class="Input" name="education" value="{{$user->profile->education}}">
                </div>
                <div class="HeadlineField-actions">
                    <div class="ButtonGroup HeadlineField-buttonGroup">
                        <button type="submit" class="Button Button--primary Button--blue">保存</button>
                        <button type="button" class="Button Button--grey">取消</button>
                    </div>
                    <span class="MaxLength"></span>
                </div>
            </div>
        </div>
    </form>
    <form class="Field">
        <h3 class="Field-label">个人简介</h3>
        <div class="Field-content">
            <div class="content">
                <span class="Field-text"> {{$user->profile->describe ? $user->profile->describe : '无'}}</span>
                <button type="button" class="Button ModifyButton Field-modify Field-modify-hidden Button--link">
                    <svg viewBox="0 0 12 12" class="Icon ModifyButton-icon Icon--modify" width="12" height="16" aria-hidden="true" style="height: 16px; width: 12px;"><title></title><g><path d="M.423 10.32L0 12l1.667-.474 1.55-.44-2.4-2.33-.394 1.564zM10.153.233c-.327-.318-.85-.31-1.17.018l-.793.817 2.49 2.414.792-.814c.318-.328.312-.852-.017-1.17l-1.3-1.263zM3.84 10.536L1.35 8.122l6.265-6.46 2.49 2.414-6.265 6.46z" fill-rule="evenodd"></path></g></svg>
                    修改
                </button>
            </div>
            <div class="input-group">
                <textarea maxlength="500" name="describe" rows="3" class="DescriptionField-input TextArea">{{$user->profile->describe}}</textarea>
                <div class="HeadlineField-actions">
                    <div class="ButtonGroup HeadlineField-buttonGroup">
                        <button type="submit" class="Button Button--primary Button--blue">保存</button>
                        <button type="button" class="Button Button--grey">取消</button>
                    </div>
                    <span class="MaxLength"></span>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('javascript')
    <script>
        $('.input-group').hide();
        $('.Field').hover(function () {
            $(this).find('.ModifyButton').removeClass('Field-modify-hidden');
        }, function () {
            $(this).find('.ModifyButton').addClass('Field-modify-hidden');
        });
        $('.ModifyButton').click(function () {
            $(this).parent().toggle().next().toggle();
        });
        $('.ButtonGroup .Button--grey').click(function () {
            $(this).parents('.input-group').toggle().prev().toggle();
        });
        $('.Field').submit(function () {
            const data = $(this).serialize();
            $.ajax({
                url: '/people/edit',
                type: "post",
                data,
                success: function (res) {
                    if (res) {
                        $(this).find('.content').toggle().next().toggle();
                        if(!$(this).find('[type="radio"]').length){
                            const val = $(this).find('.Input').val() ? $(this).find('.Input').val() : $(this).find('textarea').val() ;
                            $(this).find('.Field-text').html(val);
                        } else {
                            const val = $(this).find('input:checked').val()==1 ? '男' : '女' ;
                            $(this).find('.Field-text').html( val );
                        }
                    }
                }.bind(this)
            });
            return false;
        });
    </script>
@endsection
