<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::orderBy('id', 'desc')->paginate(5);
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user=$request->isMethod('PUT') ? User::findOrFail($request->id):new User;
        $user->id=$request->input('id');
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        if(null!==$request->input('password'))
        {
            $user->password=$request->bcrypt(input('password'));
        }

        if($user->save())
        {return new UserResource($user);}
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        if($user->delete())
        {return new UserResource($user);}
    }
}
