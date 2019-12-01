<?php

namespace App\Http\Controllers;

use App\Nabidka_Polozka;
use App\Nabidka;
use App\Provozna;
use Illuminate\Http\Request;

class NabidkaPolozkaController extends Controller
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
//        abort_if((!auth()->check()),403);
        return abort('404');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        abort_if((!auth()->check()),403);
        return abort('404');    

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
        request()->validate([
            'polozka' => ['required','min:1']
        ]);
        $polozky = $request->input('polozka');
        foreach ($polozky as $polozka) {
            Nabidka_Polozka::create([
                'nabidka_id' => $request->nabidka_id,
                'polozka_id' => $polozka
            ]);
        }
        return redirect('/nabidka');    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nabidka_Polozka  $nabidka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function show(Nabidka_Polozka $nabidka_Polozka)
    {
        //
        // abort_if((!auth()->check()),403);
        return abort('404');    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nabidka_Polozka  $nabidka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function edit(Nabidka_Polozka $nabidka_Polozka)
    {
        //
        // abort_if((!auth()->check()),403);
        return abort('404');    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nabidka_Polozka  $nabidka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nabidka_Polozka $nabidka_Polozka)
    {
        //
        // dd($request);
        abort_if((!auth()->check()),403);
        //Search for polozky which were alredy connected with nabidka
        $actualny_polozky = $nabidka_Polozka->select('polozka_id')->where('nabidka_id','=',$request->nabidka_id)->pluck('polozka_id');
        
        // request()->validate([
        //     'polozka' => ['required','min:1'],
        //     'typ' => ['required','min:1']
        // ]);
        try {
            request()->validate([
                'polozka' => ['required','min:1'],
                'typ' => ['required','min:1']]);
    
        } catch (\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->with('message', 'Prosím vyberte aspoň jednu položku!');
        }
        $nove_polozky = [];
        $polozky = $request->input('polozka');
        $typ = $request->input('typ');
        $max = Provozna::where([['id','=',$request->nabidka_id]])->get('max_den_poloz');
        $tmp = 0;
        // dd($max[0]->max_den_poloz);
        foreach($typ as $index => $item) {
            if($item == "Denni")
                $tmp++;
        }

        if($max[0]->max_den_poloz < $tmp)
        {
            return redirect()->back()->with('message', 'Maximálny počet dennej položky je '.$max[0]->max_den_poloz.' !');
        }    
        //Searching for nabidka polozka pair, if doesn't exists we create it
        foreach ($polozky as $index => $polozka) {
            if( Nabidka_Polozka::where(['nabidka_id' => $request->nabidka_id, 'polozka_id' => $polozka])->exists() )
            {   
                Nabidka_Polozka::where(['nabidka_id' => $request->nabidka_id, 'polozka_id' => $polozka])->update(['updated_at' => now(), 'typ'=>$typ[$index]]);
                // dd($t[0]->alternative_id);
                // $t[0]->update(['updated_at' => now(), 'typ'=>$typ[$index]]);
                $nove_polozky[] = $polozka ;
            } else{
                $tmp = Nabidka_Polozka::firstOrNew(['nabidka_id' => $request->nabidka_id, 'polozka_id' => $polozka, 'typ'=>$typ[$index]]);
                $nove_polozky[] = $tmp->polozka_id ;
                $tmp->save();
            }
        }
        //Deleting the nabidka polozka pairs wich we don't need anymore
        Nabidka_Polozka::select('alternative_id')->where('nabidka_id','=', $request->nabidka_id)->whereNotIn('polozka_id',$nove_polozky)->delete();
        Nabidka::select($request->nabidka_id)->update(['updated_at' => now()]);
        return redirect('/provozna/'.$request->provozna_id);    

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nabidka_Polozka  $nabidka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nabidka_Polozka $nabidka_Polozka)
    {
        //
        //abort_if((!auth()->check()),403);
        return abort('404');    

    }
}
