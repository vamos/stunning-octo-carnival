<!-- importing layout.blade.php -->
@extends('layouts.app')

{{-- text v zahlavi stranky --}}
@section('title','Plan')

<?php use \App\Objednavka; ?>
<?php use \App\User; ?>


@section('content')
<div class="container">
    @if(auth()->user()->role == 'vodič')
      <h1 class="text-center" >Plán řidiče {{ auth()->user()->name }} </h1>
    @else
      <h1 class="text-center">Všechny plány </h1>
    @endif
    <table class="table table-striped table-hover " style="margin-bottom: 50px;">
      <thead>
      <tr>
      <th>#</th>
      <th>Jméno</th>
      <th>Adresa</th>
      <th>Kontakt</th>
      <th>Položky</th>
      <th>Suma</th>
      <th>Řidič</th>
      <th>Stav</th>
      <th>Úprava</th>
      </tr>
      </thead>
      <tbody>
    @foreach ($plan as $value)
    <tr>
          <td>{{ $value->id }}</td>

          <td>{{User::where('id','=',$value->uzivatel_id)->value('name') }}</td>

          {{-- <ul style="list-style: none;"> --}}

          <td>{{ $value->mesto.", ".$value->ulica }}</td>

          <td>{{ $value->tel.", ".  $value->email}}</td>

          <td><div class="tooltip-wrap text-center" tabindex="0">
            <i class="fas fa-shopping-basket fa-lg"></i>
            <div class="tooltip-content">
              <p>
                <?php
                for($i=0; $i < count($value->polozka); $i++) {
                    // echo '<tr class=\"bg-white\">';
                        echo "<span style=color:red;>".$value->polozka[$i]->popis ."</span>\t poč.: ".$value->polozka[$i]->pivot->pocet;
                    // echo "</tr>";
                }
                ?>

              </p>
            </div>
          </div>

          </td>
              {{-- <ol> --}}
              <?php
              $suma = 0;
              for($i=0; $i < count($value->polozka); $i++) {
                  //echo "<td>" . $value->polozka[$i]->popis . " počet: ".$value->polozka[$i]->pivot->pocet. "</td>";
                  $suma +=  $value->polozka[$i]->pivot->pocet*$value->polozka[$i]->cena;
              }
              ?>
              {{-- </ol> --}}
          <td>{{ $suma }} &euro;</td>


          <td>
            @if ((auth()->user()->role == "operátor") || (auth()->user()->role == "admin"))

              <?php
                  $vodici = User::where([['role','=', 'vodic'],['pracoviste_id','=',$value->provozna_id]])->get();
                  $tmp = User::where([['id','=',$value->vodic_id]])->get();
                  // dd($tmp);
                  echo "<select form=\"f". $value->id ."\" name=\"vodic\" id=\"vodic". $value->id ."\">";
                  echo  "<option value=\"". $tmp[0]->id ."\" disabled selected hidden>". $tmp[0]->name ."</option>";
                    foreach ($vodici as $item) {
                      echo "<option value=\"".$item->id."\">".$item->name."</option>";
                    }
                  echo  "</select>";

              ?>

            @else
              <?php
                $tmp = User::where([['id','=',$value->vodic_id]])->get();
                echo $tmp[0]->name;
              ?>
            @endif

          </td>
          <td style="padding-top:5px !important;">
          <label for="stav"></label>
          {{-- onclick="show_button({{ $value->id, $value->stav }} )" --}}
          <select form="f{{  $value->id  }}" name="stav" id="stavv{{ $value->id }}">
                  <option value="{{ $value->stav }}" selected hidden>{{ $value->stav }}</option>
                  <option value="Nevyřízená">Nevyřízená</option>
                  <option value="Na ceste">Na ceste</option>
                  @if ((auth()->user()->role == "operátor") || (auth()->user()->role == "admin"))
                    <option value="Zrušená">Zrušená</option>
                  @endif
                  <option value="Vyřízená">Vyřízená</option>
              </select>
          </td>

          <td>
            <form id="f{{ $value->id }}" action="/stav" method="post">
            @csrf
            <input type="hidden" name="objednavka_id" value="{{ $value->id }}">

            <button class="btn btn-primary badge-pill" id="{{ $value->id }}" type="submit" style="">Uložit</button>
          </form>
          </td>
      </tr>
        @endforeach
      </tbody>
    </table>
</div>


@endsection


<script type="text/javascript">
function show_button(id,state){

  console.log(id);
  var tmp = document.getElementById("stavv"+id);
  var value = tmp.options[tmp.selectedIndex].value;
  var current = "<?php echo "$value->stav" ?>";
  // var id = "a"+"<?php echo $value->id ?>";
  console.log( typeof value);
  state = String(state);
  console.log( typeof state);
  console.log( state, value )
  if( state !== value  ){
    var e = document.getElementById(id);
    e.style.display = '' ;
  }
}
</script>
