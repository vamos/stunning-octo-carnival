<?php

namespace App\Http\Controllers;

use App\Nabidka;
use App\Polozka;
use Illuminate\Http\Request;

class NabidkaController extends Controller
{
    public function __construct(){
        $this->middleware('operator');
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
        $nabidka = Nabidka::all();
        return view('nabidka.index', compact('nabidka'));
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

        $polozka = Polozka::all();
        // Creates new empty nabidka 
        $nabidka = Nabidka::create();
        return view('nabidka.create', compact('polozka', 'nabidka'));
        

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
     * @param  \App\Nabidka  $nabidka
     * @return \Illuminate\Http\Response
     */
    public function show(Nabidka $nabidka)
    {
        //        
        abort_if((!auth()->check()),403);
        return view('nabidka.show',compact('nabidka'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nabidka  $nabidka
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Nabidka $nabidka)
    {
        //
        abort_if((!auth()->check()),403);
        $polozka = Polozka::all();
        $id = $request->provozna_id;
        return view('nabidka.edit', compact('nabidka','polozka','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nabidka  $nabidka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nabidka $nabidka)
    {
        //
        abort_if((!auth()->check()),403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nabidka  $nabidka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nabidka $nabidka)
    {
        //
        abort_if((!auth()->check()),403);
        $nabidka->delete();
        return redirect('/nabidka');

    }
}
