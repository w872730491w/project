<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respositories\UserRespository;
use App\User;
use Auth;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRespository $user)
    {
        $this->user = $user;
    }

    public function follow(Request $request, $follow_type)
    {
        $data = $this->user->follow($request, $follow_type);
        return response()->json($data);
    }

    public function vote(Request $request, $vote_type)
    {
        $data = $this->user->vote($request, $vote_type);
        return response()->json($data);
    }

    public function show($user_id)
    {
        $user = $this->user->getUser($user_id);
        return view('people.show', compact('user'));
    }

    public function edit(Request $request, $user_id)
    {
        if(!Auth::check() && $user_id!=Auth::id()){
            return back();
        }

        $user = User::find($user_id);
        return view('people.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $res = $this->user->update($request->all());
        return response()->json($res);
    }

    public function getUserCardInfo(Request $request)
    {
        $user = $this->user->getUserCardInfo($request);
        return response()->json( $user );
    }

    public function getUser($id)
    {
        $user = $this->user->getUser($id);
        return response()->json( $user );
    }

    public function getFollow($type, $id)
    {
        $data = $this->user->getFollow($type, $id);
        return response()->json( $data );
    }
}
