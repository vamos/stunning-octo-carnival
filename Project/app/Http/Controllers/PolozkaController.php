<?php

namespace App\Http\Controllers;
use File;

use App\Polozka;
use Illuminate\Http\Request;
use App\Traits\uploadOne;
class PolozkaController extends Controller
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
        // dd(asset('img/favicon.ico'));
        $polozka = Polozka::all();
        return view('polozka.index',compact('polozka'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // dd(auth()->user());
        abort_if((!auth()->check()),403);

        return view('polozka.create');

    }

    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'obrazok' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imgfile = $request->file('obrazok');
        
        if ($imgfile !== null) {
            $filenameWithExt = $imgfile->getClientOriginalName();
            //$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //$extension = $imgfile->getClientOriginalExtension();
            //$fileNameToStore= $filename.'_'.time().'.'.$extension;
            // dd($filenameWithExt); 
            $imgfile->move(public_path('images'), $filenameWithExt);
        }
        

        // $request->obrazok->move(public_path('images'), $imageName);
        return back()
            ->with('success','You have successfully upload image.');
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
        try {
            request()->validate([
                'popis' => ['required','min:1','max:200','unique:polozka']]);
    
        } catch (\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->with('message', 'Prosím vyberte iné jmeno pre položku! Položka už existuje! ');
        }
        $validated = request()->validate([
            // 'druh' => 'required|min:1|max:100',
            'typ' => 'required|min:1|max:100',
            'popis' => 'required|min:1|max:200',
            'cena' => 'required|numeric|between:0,99999999.99',
            'kategoria' => 'required|min:1|max:100',
            //'denny_trvaly' => 'required|min:1|max:200',
            'objem' => 'required|numeric|between:0,99999999.99',
            'hmotnost' => 'required|numeric|between:0,99999999.99',
            'alkohol' => 'required|numeric|between:0,99999999.99',
            ]);
        // if(session()->has('message') === NULL){ 
            // dd($request);
            Polozka::create($validated);   
            if($request->file('obrazok') !== NULL)
            {
                $this->imageUploadPost($request);
                Polozka::where('popis','=',$request->popis)->update(['obrazok' => $request->file('obrazok')->getClientOriginalName()]);
            }    
        // }
        return redirect('/polozka');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Polozka  $polozka
     * @return \Illuminate\Http\Response
     */
    public function show(Polozka $polozka)
    {
        //
        //abort_if((!auth()->check()),403);
        return view('polozka.show',compact('polozka'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Polozka  $polozka
     * @return \Illuminate\Http\Response
     */
    public function edit(Polozka $polozka)
    {
        //
        abort_if((!auth()->check()),403);
        return view('polozka.edit',compact('polozka'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Polozka  $polozka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Polozka $polozka)
    {
        //
        abort_if((!auth()->check()),403);
        try {
            request()->validate([
                'popis' => ['required','min:1','max:200','unique:polozka']]);
    
        } catch (\Illuminate\Validation\ValidationException $e){
            if($polozka->popis != $request->popis)
                return redirect()->back()->with('message', 'Prosím vyberte iné jmeno pre položku! Položka už existuje!');
        }
        // dd($request);
        if(($polozka->kategoria == "Nealkoholický nápoj")||($polozka->kategoria == "Teplý nápoj")||($polozka->kategoria == "Alkoholický nápoj")){
            $polozka->update(request()->validate([
                'typ' => 'required|min:1|max:100',
                'popis' => 'required|min:1|max:200',
                'cena' => 'required|numeric|between:0,99999999.99',
                'kategoria' => 'required|min:1|max:100',
                //'denny_trvaly' => 'required|min:1|max:200',
                'objem' => 'required|numeric|between:0,99999999.99',
                //'hmotnost' => 'required|numeric|between:0,99999999.99',
                'alkohol' => 'required|numeric|between:0,99999999.99']));
        } else {
            $polozka->update(request()->validate([
                'typ' => 'required|min:1|max:100',
                'popis' => 'required|min:1|max:200',
                'cena' => 'required|numeric|between:0,99999999.99',
                'kategoria' => 'required|min:1|max:100',
                //'denny_trvaly' => 'required|min:1|max:200',
                //'objem' => 'required|numeric|between:0,99999999.99',
                'hmotnost' => 'required|numeric|between:0,99999999.99',
                //'alkohol' => 'required|numeric|between:0,99999999.99'
                ]));
        }
         
        // dd($request);
        if (($polozka->obrazok !== 'placeholder.png') && ($request->file('obrazok') !== NULL))
        {
            File::delete(public_path('images'),'images/'.$polozka->obrazok);
            //$polozka->update(['obrazok' => NULL]);    
            $this->imageUploadPost($request);   
            $polozka->update(['obrazok' => $request->file('obrazok')->getClientOriginalName()]);    
        }    
        if(($polozka->obrazok === 'placeholder.png') && ($request->file('obrazok') !== NULL))    
        {
            $this->imageUploadPost($request);   
            $polozka->update(['obrazok' => $request->file('obrazok')->getClientOriginalName()]);    
        } 
        Polozka::find($polozka->id)->update(['updated_at' => now()]);
        return redirect('/polozka'); //->with('alert','Update!');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Polozka  $polozka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polozka $polozka)
    {
        //
        abort_if((!auth()->check()),403);
        $polozka->destroy($polozka->id);
        return redirect('/polozka');

    }
}
