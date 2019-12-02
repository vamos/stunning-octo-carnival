<!-- importing layout.blade.php -->
@extends('layouts.app')

{{-- text v zahlavi stranky --}}
@section('title','Uprava Nabidka')

<?php use \App\Nabidka;
use \App\Nabidka_Polozka;
?>

@section('content')
<div class="container">
    <h1 class="text-center">Úprava nabídky</h1>
<div class="row">
<div class="col-6" style="margin-left:25%;margin-right:25%;">
    @if(session()->has('message'))
    <div class="alert col-mb-6 alert-warning alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        {{ session()->get('message') }}
    </div>
    @endif
    <form action="/nabidka_polozka" method="POST">
    @method('PATCH')
    @csrf
    <input type="hidden" name="nabidka_id" value="{{ $nabidka->id }}">
    <input type="hidden" name="provozna_id" value="{{ $id }}">
        <table class="table table-striped table-hover col-mb-6">
        <th>Vybrat</th>
        <th>Položka</th>
        <th>Denni/Trvalý</th>

        @foreach ($polozka as $value)
            <div>
                <tr>
                <label for="" class="checkbox">
                <td><input onClick="regi({{ $value->id }})" id="{{ $value->id }}" {{Nabidka_Polozka::where([['nabidka_id','=',$nabidka->id],['polozka_id','=',$value->id]])->exists()? 'checked' : ''}}
                 type="checkbox" name="polozka[]" value="{{ $value->id }}"></td>
                    <td>{{ $value->popis }}</td>
                <td>
                    <select {{Nabidka_Polozka::where([['nabidka_id','=',$nabidka->id],['polozka_id','=',$value->id]])->exists()? 'name=typ[]' : 'disabled'}} id="sel{{ $value->id }}">
                    <?php
                    if(Nabidka_Polozka::where([['nabidka_id','=',$nabidka->id],['polozka_id','=',$value->id]])->exists())
                    {
                        $tmp = Nabidka_Polozka::where([['nabidka_id','=',$nabidka->id],['polozka_id','=',$value->id]])->get();
                        $t = $tmp[0];
                        echo "<option value=\"$t->typ\" selected hidden>$t->typ</option>";
                    }   else {
                        echo "<option value=\"Trvalý\" selected hidden>Trvalý</option>";
                    }
                    ?>
                    <option value="Denni">Denni</option>
                    <option value="Trvalý">Trvalý</option>
                    </select>
                </td>
                </label>
                </tr>
            </div>
        @endforeach
        </table>

    <div>
        <button class="btn btn-danger" type="submit" style="margin-bottom:50px">Úprava nabídky</button>
    </div>

     </form>
    </div>
</div>
     @include('errors')
@endsection

<script type="text/javascript">
function regi(n){
    //  alert('check');
    let checkbox = document.getElementById(n);
    if(checkbox.checked == true){
        document.getElementById('sel'+n).disabled=false;
        document.getElementById('sel'+n).name = "typ[]";
    }
    if(checkbox.checked == false){
        document.getElementById('sel'+n).name = "";
        document.getElementById('sel'+n).disabled=true;

    }

function enab(n){
    // alert('checkbox');
    console.log('dd');
    let checkbox = document.getElementById(n);
    if(checkbox.checked == true){
        document.getElementById('sel'+n).disabled=false;
    }
    if(checkbox.checked == false){
        document.getElementById('sel'+n).disabled=true;
    }

}


}
</script>
