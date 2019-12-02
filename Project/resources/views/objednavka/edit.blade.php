@extends('layouts.app')

@section('title','Uprava Objednavka')

<?php use \App\Nabidka; ?>
<?php use \App\Provozna; ?>
<?php use \App\Polozka; ?>
<?php use \App\Objednavka_Polozka; ?>


@section('content')
<div class="container">
    <h1 class="text-center">Číslo objednávky {{ $objednavka->id }}</h1>
    <form action="/objednavka_polozka" method="POST">
        @method('PATCH')
        @csrf
        <input type="hidden" name="objednavka_id" value="{{ $objednavka->id }}">
        <table class="table table-striped  col-mb-6">
                <tr>
                    <td><b>Jméno</b></td>
                    <td><?php echo "<input type=\"text\" pattern=\"([^\s][A-z0-9À-ž\s]+)\" name=\"meno\" required " . "value= " ."'". $objednavka->meno ."' >";  ?> </td>
                </tr>
                <tr>
                    <td><b>Město</b></td>
                    <td><?php echo "<input type=\"text\" pattern=\"([^\s][A-z0-9À-ž\s]+)\" name=\"mesto\" required " . "value= " ."'". $objednavka->mesto ."' >";  ?> </td>
                </tr>
                <tr>
                    <td><b>Ulice</b></td>
                    <td><?php echo "<input type=\"text\" pattern=\"([^\s][A-z0-9À-ž\s]+)\" name=\"ulica\" required " . "value= " ."'". $objednavka->ulica ."' >";  ?> </td>
                </tr>

                <tr>
                    <td><b>Položky:<b>
                        <td></td>
                        @foreach (Nabidka::find(Provozna::find($objednavka->provozna_id)->nabidka_id)->polozka as $value)
                               <tr>
                                <div>
                                    <label for="" class="checkbox"></label>
                                    @if(Objednavka_Polozka::where([['objednavka_id','=',$objednavka->id],['polozka_id','=',$value->id]])->exists())
                                    <td class="bg-light text-right"><input  checked id="{{ "check".$value->id }}" onClick="countIn({{ $value->id }})" type="checkbox" name="polozka[]" value="{{ $value->id }}">
                                            {{ $value->popis }}</td>

                                    <td class="bg-light text-right"><input type="number" name="pocet[]" id="{{ "number".$value->id }}" min="1" max="99" value="{{Objednavka_Polozka::where([['objednavka_id','=',$objednavka->id],['polozka_id','=',$value->id]])->value("pocet")}}">
                                    </td>
                                    @endif
                                </div>
                                </tr>
                        @endforeach

                </tr>
                <tr>
                    <td><b>Stav<b></td>
                    <td>
                        @if (auth()->user())
                        @if((auth()->user()->role == "admin") || (auth()->user()->role == "operátor"))
                        {{-- Ma to byt takto alebo inak ??? Napr tlacitko --}}

                            <select name="stav" >
                                <option value="" disabled selected hidden>{{ $objednavka->stav }}</option>
                                <option value="Nevybavený">Nevyřízená</option>
                                <option value="Naceste">Na ceste</option>
                                <option value="Zreušený">Zrušená</option>
                                <option value="Vybavený">Vyřízená</option>
                            </select>

                        @endif
                        @endif
                    </td>
                </tr>
        </table>
        <div>
            <button class="btn btn-primary" type="submit">Uložit úpravu</button>
        </div>

    </form>
    @include('errors')
</div>
@endsection
<script type="text/javascript">
    //Setting the "input type=number"s name if the checkbox of the given polozka was chechked
    //if checked, the name is going to be "pocet[]" which means that the choosen value is sotred
    function countIn(number){
        let checkbox = document.getElementById('check'+number);
        let num =  document.getElementById('number'+number);
        if(checkbox.checked == false){
            //  alert('check'+number);
            num.name = "";
        }
    }
    </script>
