<!-- importing layout.blade.php -->
@extends('layouts.app')

@section('title','Úprava položky')


@section('content')
<div class="container">
    @if(session()->has('message'))
        <div class="alert col-mb-6 alert-warning alert-dismissable text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center card-header">
                        <h1>Úprava položky {{ $polozka->popis }}</h1>
                    </div>
                    <div class="card-body">


                        <form id="form1"  method="POST" action="/polozka/{{ $polozka->id }}" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="kategoria">Kategorie</label>
                                <div class="col-md-6">
                                    <div>
                                        <select name="kategoria" id="">
                                            <option value="{{ $polozka->kategoria }}" selected hidden>{{ $polozka->kategoria  }}</option>
                                            @if (($polozka->kategoria == "Dezert")||($polozka->kategoria == "Polévky")||($polozka->kategoria == "Předkrm")||($polozka->kategoria == "Hlavní jídlo"))
                                            <option value="Polévky">Polévky</option>
                                            <option value="Hlavní jídla">Hlavní jídla</option>
                                            <option value="Dezerty">Dezerty</option>
                                            <option value="Předkrmy">Předkrmy</option>
                                            @else
                                            <option value="Teplé nápoje">Teplé nápoje</option>
                                            <option value="Nealkoholické nápoje">Nealkoholické nápoje</option>
                                            <option value="Alkoholické nápoje">Alkoholické nápoje</option>
                                            @endif

                                    </select>
                                    </div>
                            </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="typ">Typ</label>
                                <div class="col-md-6">
                                <div>
                                    <select name="typ" id="">
                                            <option value="{{ $polozka->typ }}" selected hidden>{{ $polozka->typ  }}</option>
                                            @if ( $polozka->typ != "Ostatní")

                                            <option value="Vegánske">Vegánske</option>
                                            <option value="Vegetariánske">Vegetariánske</option>
                                            <option value="Normální">Normální</option>
                                            <option value="Bezlepkové">Bezlepkové</option>
                                            <option value="Bezlaktózové">Bezlaktózové</option>
                                            @else
                                            <option value="Ostatní">Ostatní</option>
                                            @endif
                                        </select>
                                </div>
                            </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="popis">Název</label>
                                <div class="col-md-6">
                                <div>
                                    <input type="text" pattern="([^\s][A-z0-9À-ž\s]+)" name="popis" placeholder="Popis" required value="{{ $polozka->popis }}">
                                </div>
                            </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="obrazok">Obrázek</label>
                                <div class="col-md-6">
                                <div>
                                    <input type="file" name="obrazok" placeholder="Obrazok">
                                </div>
                            </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="cena">Cena</label>
                                <div class="col-md-6">
                                <div>
                                    <input type="text" name="cena" pattern="^[0-9\.]+$" placeholder="Cena" required value="{{ $polozka->cena }}">
                                    <div class="help-block"  style="color:grey">V eurech (bez "&euro;")</div>
                                </div>
                            </div>
                            </div>

{{--
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="kategoria">Kategorie</label>
                                <div class="col-md-6">
                                <div>
                                    <input type="text" name="kategoria" placeholder="Kategoria" required value="{{ $polozka->kategoria }}">
                                </div>
                            </div>
                            </div> --}}

                            {{-- <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="kategoria">Kategorie</label>
                                <div class="col-md-6">
                                <div><label for="denny_trvaly">Deni/Travalý</label>||($polozka->kategoria == "Polévky")
                                    <input type="text" name="denny_trvaly" placeholder="Deni alebo trvaly" required value="{{ $polozka->denny_trvaly }}">
                                </div>
                            </div>
                            </div> --}}

                            @if( ($polozka->kategoria == "Dezert")||($polozka->kategoria == "Polévky")||($polozka->kategoria == "Předkrm")||($polozka->kategoria == "Hlavní jídlo") )
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"for="hmotnost">Hmostnost</label>
                                <div class="col-md-6">
                                    <div>
                                        <input type="text" pattern="^[0-9\.]+$" name="hmotnost" placeholder="Hmotnost" required value="{{ $polozka->hmotnost }}">
                                        <div class="help-block"  style="color:grey">V gramech (bez "g")</div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(($polozka->kategoria == "Nealkoholický nápoj")||($polozka->kategoria == "Teplý nápoj")||($polozka->kategoria == "Alkoholický nápoj"))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="objem">Objem</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="text" pattern="^[0-9\.]+$" name="objem" placeholder="Objem" required value="{{ $polozka->objem }}">
                                        <div class="help-block"  style="color:grey">V litrech (bez "l")</div>
                                    </div>
                                </div>
                                </div>
                            @endif

                            @if(($polozka->kategoria == "Nealkoholický nápoj")||($polozka->kategoria == "Teplý nápoj")||($polozka->kategoria == "Alkoholický nápoj"))
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="alkohol">Obsah alko.</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="text" pattern="^[0-9\.]+$" name="alkohol" placeholder="Alkohol" required value="{{ $polozka->alkohol }}">
                                        <div class="help-block"  style="color:grey">V procentech (bez "%")</div>
                                    </div>
                                </div>
                                </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                <div>
                                    <button id="myBtn" class="btn btn-primary">Uložit</button>
                                </div>
                                </div>
                            </div>
                            </form>

                            @include('errors')
                            <form id="formfield" method="POST" action="/polozka/{{ $polozka->id }}">
                                @method('DELETE')
                                @csrf
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> --}}
                                        {{-- Launch demo modal --}}
                                    {{-- </button> --}}

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Smazání položky {{$polozka->popis}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Určite chcete smazat tuto položku?
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
                                    <button id="submitbtn" class="btn btn-danger" type="button" data-toggle="modal" data-target="#exampleModal" style="position:relative;top:-52px;left:390px">Zmazanie položky</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endsection
<script>

function sub(){
   let a = document.getElementById("formfield");
   a.submit();
}

</script>
