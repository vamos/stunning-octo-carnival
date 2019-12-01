<?php

namespace App\Http\Controllers;

use App\Objednavka_Polozka;
use \App\Objednavka;
use Illuminate\Http\Request;
use App\User;
use Auth;

class ObjednavkaPolozkaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // if($request->has("register")){
        //     return redirect('/register');    
        // } 
        // else {
        //     return redirect('/');     
        // }
        $novo_zaregistrovany = null;    
        if($request->email){
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone' => ['required','string'],
                'city' => ['required','string','min:1'],
                'street'=> ['required','string','min:1'],
            ]);
            $novo_zaregistrovany = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'street' => $request->street,
                'password' => bcrypt($request->password),
            ]);
        }    

        request()->validate([
            'polozka' => ['required','min:1'],
            'pocet' => ['required','min:1'],
            'mesto' => ['required','min:1'],
            'ulica'=> ['required','min:1'],
            'tel2' => ['required','numeric','min:1'],
            'email2' => ['required', 'string', 'max:255'],
        ]);

        
        if(auth()->check()){
            $objednavka = Objednavka::create(['provozna_id' => $request->provozna_id,'uzivatel_id' => auth()->user()->id
            ,'operator_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','operátor'] ])->value('id'),
            'vodic_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','vodič'] ])->value('id') 
            ]);
    
        } else {
            $objednavka = Objednavka::create(['provozna_id' => $request->provozna_id,'operator_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','operátor'] ])->value('id'),
            'vodic_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','vodič'] ])->value('id') ]);
        }


        $polozky = $request->input('polozka');
        $pocet = $request->input('pocet');
        foreach ($polozky as $index => $polozka) {
            Objednavka_Polozka::create([
                'objednavka_id' => $objednavka->id,
                'polozka_id' => $polozka,
                'pocet' => $pocet[$index]
            ]);
        }
        // dd($request);    

        $tmp = Objednavka::findOrFail($objednavka->id)->update(['mesto' => $request->mesto,'ulica' => $request->ulica,'meno' => $request->meno,'tel' => $request->tel2, 'email' => $request->email2]);
     
        if($novo_zaregistrovany){
            Objednavka::findOrFail($request->objednavka_id)->update(['uzivatel_id' => $novo_zaregistrovany->id,
            'operator_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','operátor'] ])->value('id'),
            'vodic_id' => User::where([['pracoviste_id','=',$request->provozna_id], ['role','=','vodič'] ])->value('id')
            ]);
            Auth::login($novo_zaregistrovany);
        }
     
        return redirect('/')->with('message', "Objednávka úspešne vytvorená! \n Číslo objednávky: $objednavka->id");
        // return redirect('/');     

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Objednavka_Polozka  $objednavka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function show(Objednavka_Polozka $objednavka_Polozka)
    {
        //
        return abort('404');    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Objednavka_Polozka  $objednavka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function edit(Objednavka_Polozka $objednavka_Polozka)
    {
        //
        return abort('404');    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Objednavka_Polozka  $objednavka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objednavka_Polozka $objednavka_Polozka)
    {
        //
        // Najdeme tie polozky kotre boli doteraz spojene s danou nabidkou
        $actualny_polozky = $objednavka_Polozka->select('polozka_id')->where('objednavka_id','=',$request->objednavka_id)->pluck('polozka_id');
        // dd($request);

        // request()->validate([
        //     'polozka' => ['required','min:1',]
        // ]);
        $nove_polozky = [];
        if($request->input("polozka"))
        {
            $polozky = $request->input('polozka');
            $pocet = $request->input('pocet');
            // dd($request);    
            foreach ($polozky as $index => $polozka) {
                $tmp = Objednavka_Polozka::firstOrNew(['objednavka_id' => $request->objednavka_id, 'polozka_id' => $polozka]);
                $nove_polozky[] = $tmp->polozka_id ;
                $tmp->pocet = intval($pocet[$index]);
                //  dd($pocet[$index]); 
                $tmp->save();
            }
        }
        //  dd($nove_polozky);    
        Objednavka_Polozka::select('id')->where('objednavka_id','=', $request->objednavka_id)->whereNotIn('polozka_id',$nove_polozky)->delete();
        OBjednavka::findOrFail($request->objednavka_id)->update(['mesto' => $request->mesto, 'ulica' => $request->ulica ,'updated_at' => now()]);

        if(!$request->input("polozka")){
            OBjednavka::findOrFail($request->objednavka_id)->delete();
        }
        return redirect('/objednavka');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Objednavka_Polozka  $objednavka_Polozka
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objednavka_Polozka $objednavka_Polozka)
    {
        //
        return abort('404');    

    }
}
