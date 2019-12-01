<!-- importing layout.blade.php -->
@extends('layouts.app')

@section('title','Vytvorenie Polozky')


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

                            <h1>Vytvořit novou položku <i class="fas fa-hamburger"></i></h1>
                        </div>
                        <div class="card-body">


                            <form method="POST" action="/polozka" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="kategoria">Kategorie</label>
                                        <div class="col-md-6">    
                                            <div>
                                            <select name="kategoria" id="">
                                                <option value="" disabled selected hidden>Kategorie položky</option>
                                                <option value="Polévky">Polévky</option>
                                                <option value="Hlavní jídla">Hlavní jídla</option>
                                                <option value="Dezerty">Dezerty</option>
                                                <option value="Předkrmy">Předkrmy</option>
                                                <option value="Teplé nápoje">Teplé nápoje</option>
                                                <option value="Nealkoholické nápoje">Nealkoholické nápoje</option>
                                                <option value="Alkoholické nápoje">Alkoholické nápoje</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- kategória by bola: Polévky, Hlavné jedlá, Dezerty, Predjedlá, Teplé nápoje, Nealkoholické nápoje, Alkoholické nápoje --}}

                                {{-- A typ by bolo že: vegánske, vegetariánske, normálne, bezlepkové, bezlaktózové...a to by asi aj stačilo --}}


                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="typ">Typ</label>
                                    <div class="col-md-6">
                                    <div>
                                        <select name="typ" id="">
                                            <option value="" disabled selected hidden>Typ položky</option>
                                            <option value="Vegánske">Vegánske</option>
                                            <option value="Vegetariánske">Vegetariánske</option>
                                            <option value="Normální">Normální</option>
                                            <option value="Bezlepkové">Bezlepkové</option>
                                            <option value="Bezlaktózové">Bezlaktózové</option>
                                        </select>
                                    </div>
                                </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="popis">Název</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="text" pattern="([^\s][A-z0-9À-ž\s]+)" name="popis" placeholder="Popis" required value="{{ old('popis') }}">
                                    </div>
                                </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="obrazok">Obrázek</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="file" name="obrazok" placeholder="Obrázek (nepovinný)" value="{{ old('obrazok') }}">
                                    </div>
                                </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="cena">Cena</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="text" pattern="^[0-9\.]+$" name="cena" placeholder="Cena" required value="{{ old('cena') }}">
                                        <div class="help-block" style="color:grey">V eurech (bez "&euro;")</div>
                                    </div>
                                </div>
                                </div>
{{--
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="kategoria">Kategoria</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="text" name="kategoria" placeholder="Kategorie" required value="{{ old('kategoria') }}">
                                    </div>
                                </div>
                                </div>
                                 --}}
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="hmotnost">Hmostnost</label>
                                    <div class="col-md-6">
                                        <div>
                                            <input type="text" pattern="^[0-9\.]+$" name="hmotnost" placeholder="Hmotnost u jídel" required value="{{ old('hmotnost') }}">
                                            <div class="help-block"  style="color:grey">V gramech (bez "g")</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="objem">Objem</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="text" pattern="^[0-9\.]+$" name="objem" placeholder="Objem u nápojů" required value="{{ old('objem') }}">
                                        <div class="help-block"  style="color:grey">V litrech (bez "l")</div>
                                    </div>
                                </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right"for="alkohol">Obsah alkoholu</label>
                                    <div class="col-md-6">
                                    <div>
                                        <input type="text" pattern="^[0-9\.]+$" name="alkohol" placeholder="Obsah alkoholu u nápojů" required value="{{ old('alkohol') }}">
                                        <div class="help-block"  style="color:grey">V procentech (bez "%")</div>
                                    </div>
                                </div>
                                </div>


                                <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                  <div>
                                        <button class="btn btn-primary" type="submit">Vytvoření položky</button>
                                    </div>
                                </div>
                                </div>
                                @include('errors')
                            </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
