<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Objednavka;
use App\Provozna;
use App\User;
use App\Objednavka_Polozka;
use Illuminate\Http\Request;

class ObjednavkaController extends Controller
{

    public function __construct(){
        $this->middleware('operator')->except(['show','edit','create','index','plan','stav','show_status']);
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

        $objednavka = null;
        if( (auth()->user()->role == 'operátor') || (auth()->user()->role == 'admin') )
        {
            $objednavka = Objednavka::all();
        } else {
            $objednavka = Objednavka::where('uzivatel_id','=',auth()->user()->id)->get();
        }   
        return view('objednavka.index',compact('objednavka'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        // abort_if((!auth()->check()),403);

        try {
            request()->validate([
                'polozka' => ['required','min:1']]);
    
        } catch (\Illuminate\Validation\ValidationException $e){
            return redirect()->back()->with('message', 'Prosím vyberte aspoň jednu položku!');
        }
       // $request->validate([
        //    'polozka' => ['required','min:1'] ]);

        // dd($request);    

        // if(auth()->check()){
        //     $objednavka = Objednavka::create(['provozna_id' => $request->provozna_id,'uzivatel_id' => auth()->user()->id
        //     ,'operator_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','operátor'] ])->value('id'),
        //     'vodic_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','vodič'] ])->value('id') 
        //     ]);
    
        // } else {
        //     $objednavka = Objednavka::create(['provozna_id' => $request->provozna_id,'operator_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','operátor'] ])->value('id'),
        //     'vodic_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','vodič'] ])->value('id') ]);
        // }
        $nabidka_id = Provozna::findOrFail($request->provozna_id)->nabidka_id;
        $provozna_id = $request->provozna_id;
        $objednavka = null;
        return view('objednavka.create',compact('objednavka', 'nabidka_id','provozna_id','request'));
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
     * @param  \App\Objednavka  $objednavka
     * @return \Illuminate\Http\Response
     */
    public function show(Objednavka $objednavka)
    {
        //
        abort_if((!auth()->check()),403);
        if( (auth()->user()->role != 'operátor') && (auth()->user()->role != 'admin') )
        {
            abort_if($objednavka->uzivatel_id != auth()->id(),403);
        }
        return view('objednavka.show',compact('objednavka'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objednavka  $objednavka
     * @return \Illuminate\Http\Response
     */
    public function edit(Objednavka $objednavka)
    {
        //
        abort_if((!auth()->check()),403);
        if( (auth()->user()->role != 'operátor') && (auth()->user()->role != 'admin') )
        {
            abort_if($objednavka->uzivatel_id != auth()->id(),403);
        }
        return view('objednavka.edit',compact('objednavka'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objednavka  $objednavka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objednavka $objednavka)
    {
        //
        abort_if((!auth()->check()),403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objednavka  $objednavka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objednavka $objednavka)
    {
        //
        abort_if((!auth()->check()),403);
        $objednavka->delete();
        return redirect('/objednavka');
    }



    public function plan(Request $request)
    {
        //
        abort_if(!(auth()->check()),403);
        $plan;
        if( (auth()->user()->role == 'vodič') )
        {
         $plan = Objednavka::where([['vodic_id', '=' , auth()->user()->id],['stav','!=','Vyřízená'],['stav','!=','Zrušená']])->get();
        } else if( (auth()->user()->role == 'užívatel') ){
            abort(403);
        }
        else{
            $plan = Objednavka::all();
        }    
        return view('objednavka.plan',compact('request','plan'));
    }

    public function stav(Request $request, Objednavka $objednavka){
        abort_if(!(auth()->check()),403);
        abort_if((auth()->user()->role == "užívatel"),403);
        // dd($request);
        if($request->has('vodic')){
            if($request->vodic)
                Objednavka::where('id','=',$request->objednavka_id)->update(['updated_at'=> now(), 'vodic_id' => $request->vodic]);
        } 
        if($request->has('stav')){
            // dd($request->vodic, $request->stav);
            if($request->stav)
                 Objednavka::where('id','=',$request->objednavka_id)->update(['updated_at'=> now(), 'stav' => $request->stav]);
        }
        return back();
    }

    public function show_status(Request $request){
        $record = Objednavka::where('id', '=', $request->objednavka_id)->get();

        if($record->count()){
            $message = 'Stav objednávky '.$request->objednavka_id.': '.$record[0]->stav;
        } else {
            $message = 'Objednávka s číslem '.$request->objednavka_id.' nebyla nalezena v systému.';
        }
        
        return redirect()->back()->with('message', $message);
    }

}
