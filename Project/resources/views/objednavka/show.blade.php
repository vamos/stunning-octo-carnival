@extends('layouts.app')

@section('title','Objdenavka c.')

@section('content')
<div class="container">
    <h1 class="text-center">Číslo objednávky {{ $objednavka->id }}</h1>
    <table class="table table-striped  col-mb-6">
        <tr>
            <td><b>Meno</b></td> <td>{{ $objednavka->meno }}</td>
        </tr>
        <tr>
            <td><b>Adresa</b></td> <td>{{ $objednavka->mesto . ", " . $objednavka->ulica }}</td>
        </tr>
        <tr>
        <td><b>Položky:<b>
            <td></td>
            <?php
            $suma = 0;
            for($i=0; $i < count($objednavka->polozka); $i++) {
                echo '<tr class=\"bg-white\">';
                    echo " <td class=\"bg-light text-right\">" . $objednavka->polozka[$i]->popis . "</td><td class=\"bg-light text-center\">počet: ".$objednavka->polozka[$i]->pivot->pocet. "</td>";
                    $suma +=  $objednavka->polozka[$i]->pivot->pocet*$objednavka->polozka[$i]->cena;
                echo "</tr>";
            }
            ?>
        </td>
        </tr>
        <tr>
        <td><b>Celková cena<b></td> <td>{{ $suma }} &euro; </td>
        </tr>
        <tr>
        <td><b>Stav<b></td> <td>{{ $objednavka->stav }}</td>
        </tr>
    </table>

    @if($objednavka->stav == "Nevyřízená")
    <button style="display:block; position: absolute; top:480px; left: 450px" class="btn btn-primary" onclick="location.href='/objednavka/{{ $objednavka->id }}/edit'">
        Úprava objednávky
    </button>
    @endif

    <form id="formfield" method="POST" action="/objednavka/{{ $objednavka->id }}">
        @method('DELETE')
        @csrf
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Smazání objednávky č.{{$objednavka->id}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Určite chcete smazat objednávku?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                    <button onClick="sub()"  type="button" class="btn btn-danger">Ano</button>
                    {{-- <a href="#"  class="btn btn-success success">Submit</a> --}}
                    </div>
                </div>
                </div>
            </div>


        <div>
            @if(auth()->user()->role == "admin")
            <button style="display:block; position: absolute; top:480px; left: 1150px" id="submitbtn" class="btn btn-danger" type="button" data-toggle="modal" data-target="#exampleModal">Smazat objednávku</button>
            @endif
        </div>


    </form>
</div>
@endsection
<script>

    function sub(){
        let a = document.getElementById("formfield");
        a.submit();
    }

</script>
