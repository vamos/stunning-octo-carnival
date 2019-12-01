<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('admin')->except(['show','edit','destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if((!auth()->check()),403);

        $users = User::all();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort_if((!auth()->check()),403);

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
        abort_if((!auth()->check()),403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        abort_if((!auth()->check()),403);
        
        if(auth()->user()->role != "admin"){
            abort_if($user->id != auth()->id(),403);
        }    
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        abort_if((!auth()->check()),403);

        if(auth()->user()->role != "admin"){
            abort_if($user->id != auth()->id(),403);
        }    
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        // dd($request);
        $user->update(request()->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'], //, 'unique:users'],
        'phone' => ['required','string','max:15'],
        'city' => ['required','string','min:1'],
        'street'=> ['required','string','min:1'],
        ]));
         
        if(($request->password !== NULL) && ($request->password_confirmation !== NULL))    
        {
            $tmp = $request->validate(['password' => ['required', 'string', 'min:8', 'confirmed']]);

            $polozka->update(['password' => bcryp($tmp)]);    
        } 
        if( strcmp($request->email,$user->email) != 0  )
        {
            $tmp = $request->validate(['email' => ['unique:users', 'required', 'string', 'email']]);

            $polozka->update(['email' => $tmp]);    
        }
        if(auth()->user()->role == "admin")
            return redirect('/users');
        else     
            return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        //  dd($user);
        abort_if((!auth()->check()),403);
        $user->destroy($user->id);
        return redirect('/');

    }
}
