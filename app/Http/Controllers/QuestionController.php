<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\QuestionRespository;

class QuestionController extends Controller
{
    protected $question;

    public function __construct(QuestionRespository $question)
    {
        $this->question = $question;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->question->index();
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = $this->question->store($request);
        return redirect('/question/'.$question->id)->with(['message'=> '提问成功！', 'color'=> 'green']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return view('question.show', $this->question->show($request, $id) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserQuestion($id)
    {
        $questions = $this->question->getUserQuestion($id);
        return response()->json($questions);
    }

    public function answer(Request $request, $question_id, $answer_id)
    {
        return view('question.answer', $this->question->answer($request, $question_id, $answer_id) );
    }
}
