<?php

namespace App\Http\Controllers;
use File;
use App\Provozna;
use App\Nabidka;
use Illuminate\Http\Request;

class ProvoznaController extends Controller
{    
    public function __construct(){
        $this->middleware('operator')->except(['show','index']);
        // $this->middleware('operator')->except(['show','index']);
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $provozna = Provozna::all();
        return view('provozna.index', compact('provozna'));

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

        return view('provozna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if((!auth()->check()),403);

        try {
            request()->validate([
                'oznaceni' => ['required','min:1','max:100','unique:provozna']]);
    
        } catch (\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->with('message', 'Prosím vyberte iné jmeno pre provoznu!');
        }
        $validated = request()->validate([
        //'oznaceni' => 'required|min:1|max:100',
        'adresa' => 'required|min:1|max:100',
        'od' => 'required|integer|min:0',
        'do' => 'required|integer|min:0',
        'uzaverka' => 'required|integer|min:0',
        'max_den_poloz' => 'required|integer|min:0'
        ]);   



        $nabidka = Nabidka::create();
        $new = Provozna::create($validated);
        //$new->store();

        if($request->file('obrazok') !== NULL)
        {
            $this->imageUploadPost($request);
            Provozna::where('id','=',$new->id)->update(['obrazok' => $request->file('obrazok')->getClientOriginalName()]);
        } else {
            $new->update(['obrazok'=>'placeholder.png']);
        }   
        

        $new->update(['nabidka_id'=>$nabidka->id]);

        return redirect('/provozna');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provozna  $provozna
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Provozna $provozna)
    {
        $tmp_kat = array('vsetky');
        $tmp_typ = array('vsetky');

        if($request->has('predkrmy')){
            array_push($tmp_kat, 'Předkrm');
        }
        if($request->has('polevky')){
            array_push($tmp_kat, 'Polévka');
        }
        if($request->has('hlavni_jidlo')){
            array_push($tmp_kat, 'Hlavní jídlo');
        }
        if($request->has('prilohy')){
            array_push($tmp_kat, 'Příloha');
        }
        if($request->has('dezerty')){
            array_push($tmp_kat, 'Dezert');
        }
        if($request->has('teple_napoje')){
            array_push($tmp_kat, 'Teplý nápoj');
        }
        if($request->has('nealkoholicke_napoje')){
            array_push($tmp_kat, 'Nealkoholický nápoj');
        }
        if($request->has('alkoholicke_napoje')){
            array_push($tmp_kat, 'Alkoholický nápoj');
        }
        if($request->has('bezlepkove')){
            array_push($tmp_typ, 'Bezlepkové');
        }
        if($request->has('bezlaktozove')){
            array_push($tmp_typ, 'Bezlaktózové');
        }
        if($request->has('veganske')){
            array_push($tmp_typ, 'Vegánske');
        }
        if($request->has('vegetarianske')){
            array_push($tmp_typ, 'Vegetariánske');
        }
        if($request->has('ostatni')){
            array_push($tmp_typ, 'Ostatní');
        }
        
        if(count($tmp_kat) > 1){
            array_shift($tmp_kat);
        }

        if(count($tmp_typ) > 1){
            array_shift($tmp_typ);
        }

        return view('provozna.show', compact('provozna','tmp_kat','tmp_typ'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provozna  $provozna
     * @return \Illuminate\Http\Response
     */
    public function edit(Provozna $provozna)
    {
        //
        abort_if((!auth()->check()),403);
        return view('provozna.edit', compact('provozna'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provozna  $provozna
     * @return \Illuminate\Http\Response
     */
    public function update(Provozna $provozna, Request $request)
    {
        //
        abort_if((!auth()->check()),403);
        // dd($request);
        // try {
        //     request()->validate([
        //         'oznaceni' => ['required','min:1','max:100','unique:provozna']]);
    
        // } catch (\Illuminate\Validation\ValidationException $e){
        //     return redirect()->back()->with('message', 'Prosím vyberte iné jmeno pre provoznu!');
        // }
        $provozna->update(request()->validate(
            ['oznaceni' =>'required|min:1|max:100',
            'adresa' =>'required|min:1|max:100',
            'od' =>'required|integer|min:0',
            'do' =>'required|integer|min:0',
            'uzaverka' =>'required|integer|min:0',
            'max_den_poloz' =>'required|integer|min:0']));
        // dd(request());    
        if (($provozna->obrazok !== 'placeholder.png') && ($request->file('obrazok') !== NULL))
        {
            File::delete(public_path('images'),'images/'.$provozna->obrazok);
            $this->imageUploadPost($request);   
            $provozna->update(['obrazok' => $request->file('obrazok')->getClientOriginalName()]);    
        }    
        if(($provozna->obrazok === 'placeholder.png') && ($request->file('obrazok') !== NULL))    
        {
            $this->imageUploadPost($request);   
            $provozna->update(['obrazok' => $request->file('obrazok')->getClientOriginalName()]);    
        } 
        Provozna::find($provozna->id)->update(['updated_at' => now()]);


        return redirect('/provozna/'.$provozna->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provozna  $provozna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provozna $provozna)
    {
        //

        abort_if((!auth()->check()),403);
        $provozna->delete();
        return redirect('/provozna');

    }
}
