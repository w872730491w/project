<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\TopicRespository;

class TopicController extends Controller
{
	protected $topic;

    public function __construct(TopicRespository $topic)
    {
    	$this->topic = $topic;
    }

    public function index()
    {
        return view('topic.index', $this->topic->index() );
    }

    public function show($id)
    {
        $topic = $this->topic->show($id);
        return view('topic.show', compact('topic'));
    }

    public function edit($id)
    {
        $topic = $this->topic->show($id);
        return view('topic.edit', compact('topic'));
    }

    public function update(Request $request, $id)
    {
        $this->topic->update($request, $id);
        return redirect('/topic/'.$id)->with([
            'message' => '修改成功！',
            'color' => 'green'
        ]);
    }

    public function getTopics(Request $request)
    {
    	$topics = $this->topic->getTopics($request);
    	return response()->json($topics);
    }

    public function getTopicDiscuuss($id)
    {
        return response()->json( $this->topic->getTopicDiscuuss($id) );
    }

    public function getTopicEssence($id)
    {
        return response()->json( $this->topic->getTopicEssence($id) );
    }

    public function getTopicAnswer($id)
    {
        return response()->json( $this->topic->getTopicAnswer($id) );
    }
}
