<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware('notifications')->group(function () {
    // 首页
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/question', 'QuestionController', [
        'names'=> [
            'index'=> 'question', //
            'store'=> 'createQuestion', // 发表问题
            'show'=> 'showQuestion', // 问题详情
            'update'=> 'updateQuestion', // 修改问题
            'destroy'=> 'destroyQuestion' // 删除问题
        ]
    ]);
    Route::resource('/topic', 'TopicController');
    // 答案详情
    Route::get('/question/{question_id}/answer/{answer_id}', 'QuestionController@answer')->name('answer');
    // 个人主页
    Route::get('/people/{user_id}', 'UserController@show');

    Route::get('/people/{user_id}/edit', 'UserController@edit');

    Route::get('/search', 'HomeController@search');
});

// 激活账号
Route::get('/activation', 'EmailController@activation')->name('activation');

// 注册成功
Route::get('/registerSuccess', function () {
    return view('registerSuccess');
});

Route::post('/getQuestionList', 'HomeController@getQuestionList');

// 上传图片
Route::post('/upload/{type}', 'UploadController@uploads');

// 上传视频
Route::post('/uploadVideo/{type}', 'UploadController@uploadVideo');

// 上传头像
Route::post('/uploadAvatar', 'UploadController@uploadAvatar');

// 上传cover图
Route::post('/uploadCover', 'UploadController@uploadCover');

// 上传话题图片
Route::post('/uploadTopicPic', 'UploadController@uploadTopicPic');

// 获取视频封面
Route::post('/getVideoCover/{type}', 'UploadController@getVideoCover');

// 添加答案
Route::post('/answer', 'AnswerController@store');

// 关注
Route::post('/follow/{follow_type}', 'UserController@follow');

Route::post('/vote/{type}', 'UserController@vote');

Route::post('/people/edit', 'UserController@update');

Route::post('/comments', 'CommentController@store');

Route::post('/comments/{type}/{type_id}', 'CommentController@getComments');

Route::post('/getUserCardInfo', 'UserController@getUserCardInfo');

Route::post('/readMessage', 'NotificationController@readMessage');

Route::post('/getNotification/{user_id}', 'NotificationController@getNotification');

Route::post('/getAnswers/{question_id}', 'AnswerController@getAnswers');

Route::post('/getUser/{id}', 'UserController@getUser');

Route::post('/getUserAnswers/{id}', 'AnswerController@getUserAnswers');

Route::post('/getUserQuestion/{id}', 'QuestionController@getUserQuestion');

Route::post('/getFollow/{type}/{id}', 'UserController@getFollow');

Route::post('/getTopicDiscuuss/{id}', 'TopicController@getTopicDiscuuss');

Route::post('/getTopicEssence/{id}', 'TopicController@getTopicEssence');

Route::post('/getTopicAnswer/{id}', 'TopicController@getTopicAnswer');

Route::post('/message', 'MessageController@sendMessage');

Route::get('/inbox', 'InboxController@index');

Route::get('/inbox/{id}', 'InboxController@show');

Route::get('/test/{question_id}/{myQuestion_id}/{limit}/{offset}', function ($question_id,$myQuestion_id,$limit, $offset) {
    function file_exists_S3($url)
    {
        $state = @file_get_contents($url,0,null,0,1);//获取网络资源的字符内容
        if($state){
            $filename = './uploads/answer/'.date("dMYHis").'.jpg';//文件名称生成
            ob_start();//打开输出
            readfile($url);//输出图片文件
            $img = ob_get_contents();//得到浏览器输出
            ob_end_clean();//清除输出并关闭
            $size = strlen($img);//得到图片大小
            $fp2 = @fopen($filename, "a");
            fwrite($fp2, $img);//向当前目录写入图片文件，并重新命名
            fclose($fp2);
            return $filename;
        }
        else{
            return 0;
        }
    }
    $url = 'https://www.zhihu.com/api/v4/questions/'.$question_id.'/answers?include=data%5B%2A%5D.is_normal%2Cadmin_closed_comment%2Creward_info%2Cis_collapsed%2Cannotation_action%2Cannotation_detail%2Ccollapse_reason%2Cis_sticky%2Ccollapsed_by%2Csuggest_edit%2Ccomment_count%2Ccan_comment%2Ccontent%2Ceditable_content%2Cvoteup_count%2Creshipment_settings%2Ccomment_permission%2Ccreated_time%2Cupdated_time%2Creview_info%2Crelevant_info%2Cquestion%2Cexcerpt%2Crelationship.is_authorized%2Cis_author%2Cvoting%2Cis_thanked%2Cis_nothelp%3Bdata%5B%2A%5D.mark_infos%5B%2A%5D.url%3Bdata%5B%2A%5D.author.follower_count%2Cbadge%5B%3F%28type%3Dbest_answerer%29%5D.topics&limit='.$limit.'&offset='.$offset.'&sort_by=default';
    $data = json_decode(file_get_contents($url));
    foreach($data->data as $dataAnswer){
        $body = $dataAnswer->content;
        $reg1 = "/<figure>.*?<img.*?src=\"(.*?)\".*?>.*?<\/figure>/";
        preg_match_all($reg1, $body, $array);
        foreach($array[0] as $k=>$v){
            $str = '';
            $str = '<figure>';
                $filename = substr(file_exists_S3($array[1][$k]), 1);
                $str .= '<img src="'.$filename.'" class="origin_image zh-lightbox-thumb lazy">';
            $str .= '</figure>';
            $body = str_replace($v, $str, $body);
        }

        $answer = App\Answer::create([
            'body'=> $body,
            'user_id'=> 8,
            'question_id'=> $myQuestion_id
        ]);
        $answer->question()->increment('answers_count');
        $answer->user->userQuestion()->sync( $myQuestion_id );
        $answer->user->increment('answers_count');
        return 'success';
    }
});
