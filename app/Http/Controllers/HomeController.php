<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\QuestionRespository;
use App\Respositories\HomeRespository;

class HomeController extends Controller
{
    protected $question;
    protected $home;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QuestionRespository $question, HomeRespository $home)
    {
        $this->question = $question;
        $this->home = $home;
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function search(Request $request)
    {
        return view('search', $this->home->search($request) );   
    }

    public function getQuestionList()
    {
        $questionList = $this->question->getQuestionList();
        return response()->json( $questionList );
    }
}
