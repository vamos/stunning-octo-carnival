@extends('layouts.app')

@section('title','Vytvorenie objednavky')

<?php use \App\Polozka; ?>


@section('content')
    {{-- {{dd($request)}} --}}
<div class="container">

    <form action="/objednavka_polozka" method="POST" id="form1">
    <input type="hidden" name="objednavka" value="{{$objednavka}}">
        <div class="row">
        <div class="col-6">
        <h3>Informace:</h3>
            <div class="container">
                <div  class="form-group row">
                <label for="meno" class="col-md-4 col-form-label text-md-right">Jméno</label>
                {{-- <input type="text" name="meno" required value={{ (auth()->user()) ? auth()->user()->name : ""}}> --}}
                    <?php echo "<input id=\"meno\" class=\"col-md-6 form-control\" pattern=\"([^\s][A-zÀ-ž\s]+)\" type=\"text\" name=\"meno\" required " . "value= " .(auth()->user() ? ("'" . (auth()->user()->name) ."'") : "").">";  ?>
                </div>

                <div  class="form-group row">
                <label for="mesto" class="col-md-4 col-form-label text-md-right">Město</label>
                    {{-- <input type="text" name="mesto" required value={{ (auth()->user()) ? auth()->user()->city : ""}}> --}}
                    <?php echo "<input id=\"mesto\" class=\"col-md-6 form-control\" pattern=\"([^\s][A-z0-9À-ž\s]+)\" type=\"text\" name=\"mesto\" required " . "value= " .(auth()->user() ? ("'" . (auth()->user()->city) ."'") : "").">";  ?>
                </div>

                <div  class="form-group row">
                <label for="ulica" class="col-md-4 col-form-label text-md-right">Ulice</label>
                    <?php echo "<input id=\"ulica\" class=\"col-md-6 form-control\" pattern=\"([^\s][A-z0-9À-ž\s]+)\" type=\"text\" name=\"ulica\" required " . "value= " .(auth()->user() ? ("'" . (auth()->user()->street) ."'") : "").">";  ?>
                </div>

                <div  class="form-group row">
                <label for="tel" class="col-md-4 col-form-label text-md-right">Tel.číslo</label>
                    <?php echo "<input id=\"tel\"class=\"col-md-6 form-control\" pattern=\"([^\s][0-9]+)\"  type=\"text\" name=\"tel2\" required " . "value= " .(auth()->user() ? ("'" . (auth()->user()->phone) ."'") : "").">";  ?>
                </div>

                <div  class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                    <?php echo "<input id=\"email\"class=\"col-md-6 form-control\" pattern=\"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$\" type=\"text\" name=\"email2\" required " . "value= " .(auth()->user() ? ("'" . (auth()->user()->email) ."'") : "").">";  ?>
                </div>
            </div>
        @if (!auth()->check())
            <label for="register"><h5>Zaregistrovat</h5></label>
            <input id="reg" type="checkbox" name="register" value="yes" onClick="regi('HELLO')" >
        @endif

        <div id="container" style="display: none;">
            {{-- <form action="">
            @csrf --}}

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Jméno') }}</label>

                <div class="col-md-6">
                    <input id="name" pattern="([^\s][A-z0-9À-ž\s]+)" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="text"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Město') }}</label>

                <div class="col-md-6">
                    <input id="city" pattern="([^\s][A-z0-9À-ž\s]+)" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" autofocus>

                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Ulice') }}</label>

                <div class="col-md-6">
                    <input id="street" pattern="([^\s][A-z0-9À-ž\s]+)" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') }}" autofocus>

                    @error('street')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                <div class="col-md-6">
                    <input id="email2" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Heslo') }}</label>

                <div class="col-md-6">
                    <input id="password" pattern=".{8,}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autofocus>
                    <div class="help-block">Minimálně 8 znaků</div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potvrďte heslo') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" pattern=".{8,}"  type="password" class="form-control" name="password_confirmation" autofocus>
                </div>
            </div>

            {{-- <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Zaregistrovat') }}
                    </button>
                </div>
            </div> --}}
        {{-- </form> --}}

        </div>
    </div>
    <div class="col-4">
        {{-- @method("POST") --}}
        @csrf
        <input  type="hidden" name="objednavka_id" value="{{ $objednavka}}">
        <input  type="hidden" name="provozna_id" value="{{ $provozna_id }}">

        <h3>Položky :</h3>
        <table class="table table-striped table-hover col-mb-6">
            <th>Vybrat</th>
            <th>Položka</th>
            <th>Počet</th>
            @foreach ($request->polozka as $value)
            <tr>
                <div  class="form-group">
                    <label for="" class="checkbox"></label>
                        <td><input checked type="checkbox" id="{{ "check".Polozka::findOrFail($value)->id }}" name="polozka[]"
                            value="{{ Polozka::findOrFail($value)->id }}" onClick="countIn({{ Polozka::findOrFail($value)->id }})"></td>
                            <td>{{ Polozka::findOrFail($value)->popis }}</td>
                            <td><input  type="number" required name="pocet[]" id="{{ "number".Polozka::findOrFail($value)->id }}" min="1" max="99" value="1"></td>

                    </div>
                </tr>
                @endforeach
            </table>
        </div>


    </div>
        <div style="margin-left:50%;margin-right:50%; width:200px">

                <button class="btn btn-primary" type="submit">Vytvořit objednávku</button>
            
        </div>
    </form>
    @include('errors')
</div>
@endsection



<script type="text/javascript">
// function randomIntFromInterval(min, max) { // min and max included
//   return Math.floor(Math.random() * (max - min + 1) + min);
// }

// function upozornenie(){
//     // if(){
//         alert("Objednávka úspešne vytvorená! \n Číslo objednávky: " + randomIntFromInterval(8880000, 8888888));
//     // }
// }

function regi(n){
        // alert('check');
    let checkbox = document.getElementById('reg');
    if(checkbox.checked == true){
        document.getElementById('container').style.display = "initial";
        document.getElementById('name').required = true;
        document.getElementById('phone').required = true;
        document.getElementById('city').required = true;
        document.getElementById('street').required = true;
        document.getElementById('email').required = true;
        document.getElementById('password').required = true;
        document.getElementById('password-confirm').required = true;

        var inputVal = document.getElementById('meno').value;
        document.getElementById('name').value = inputVal;

        inputVal = document.getElementById('mesto').value;
        document.getElementById('city').value = inputVal;

        inputVal = document.getElementById('ulica').value;
        document.getElementById('street').value = inputVal;

        inputVal = document.getElementById('email').value;
        document.getElementById('email2').value = inputVal;

        inputVal = document.getElementById('tel').value;
        document.getElementById('phone').value = inputVal;


        // var inputVal = document.getElementById("meno").value;
        // var inputVal = document.getElementById("meno").value;
        console.log(inputVal);

    }
    if(checkbox.checked == false){
        document.getElementById('container').style.display = "none";
        document.getElementById('name').required = false;
        document.getElementById('phone').required = false;
        document.getElementById('city').required = false;
        document.getElementById('street').required = false;
        document.getElementById('email').required = false;
        document.getElementById('password').required = false;
        document.getElementById('password-confirm').required = false;

    }
}

//Setting the "input type=number"s name if the checkbox of the given polozka was chechked
//if checked, the name is going to be "pocet[]" which means that the choosen value is sotred
function countIn(number){
    let checkbox = document.getElementById('check'+number);
    let num =  document.getElementById('number'+number);
    if(checkbox.checked == false){
            // alert('check'+number);
        num.name = "";
    } else {
        num.name = "pocet[]";
    }
}

function getInputValue(){

// Selecting the input element and get its value

var inputVal = document.getElementById("meno").value;



// Displaying the value

alert(inputVal);

}



</script>
