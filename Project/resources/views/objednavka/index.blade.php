@extends('layouts.app')

@section('title','Objednavka index')

<?php  use \App\User; ?>
@section('content')
<div class="container">
    <h1>Všechny objednávky</h1>
    <table class="table table-striped table-hover ">
        <thead>
        <tr>
        <th>#</th>
        <th>Jméno</th>
        <th>Adresa</th>
        <th>Kontakt</th>
        <th>Suma</th>
        <th>Řidič</th>
        <th>Stav</th>
        <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($objednavka as $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->meno }}</td>

            <td>{{ $value->mesto.", ".$value->ulica }}</td>

            <td>{{ $value->tel.", ".  $value->email}}</td>

                <?php
                $suma = 0;
                for($i=0; $i < count($value->polozka); $i++) {
                    //echo "<td>" . $value->polozka[$i]->popis . " počet: ".$value->polozka[$i]->pivot->pocet. "</td>";
                    $suma +=  $value->polozka[$i]->pivot->pocet*$value->polozka[$i]->cena;
                }
                ?>
            <td>{{ $suma }} &euro;</td>

            <td>
                <?php
                    if($value->vodic_id !== null){
                        $tmp = User::where([['id','=',$value->vodic_id]])->get();
                        echo $tmp[0]->name;
                    }   else {
                        echo "Nepřiřazen";
                    }
                ?>
            </td>
            <td>
                {{$value->stav}}
            </td>
            <td>
                <a href="/objednavka/{{ $value->id }}">
                    <i class="fas fa-ellipsis-h fa-2x"></i>
                </a>
            </td>
        </tr>


    </tbody>
    @endforeach
    </table>
</div>
@endsection
