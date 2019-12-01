<!-- importing layout.blade.php -->
@extends('layouts.app')

{{-- text v zahlavi stranky --}}
@section('title','Polozka')


@section('content')
    <h1>Položka {{ $polozka->id }} :</h1>
    <ul>
        <li>Názov: {{ $polozka->popis }}</li>
        <li>Druh: {{ $polozka->druh}}</li>
        <li>Typ: {{ $polozka->typ}}</li>
        @if ( $polozka->obrazok !== NULL ) 
            <img src="{{url('images/'.$polozka->obrazok)}}" alt="Image" style="width:50px"/>
        @endif
        <li>Cena: {{ $polozka->cena}} </li>
        <li>Kategoria: {{ $polozka->kategoria}}</li>
        <li>Dení/Trvalý: {{ $polozka->denny_trvaly}}</li>
        <li>Objem: {{ $polozka->objem}} L</li>
        <li>Hmotnosť: {{ $polozka->hmotnost}} g</li>
        <li>Obsah alko.: {{ $polozka->alkohol}} %</li>
        
    </ul>
@if (auth()->user())
  @if((auth()->user()->role == "admin") || (auth()->user()->role == "operátor"))       
 
    <button class="btn btn-primary" onclick="location.href='/polozka/{{ $polozka->id }}/edit'">
      Úprava položky
    </button>
  @endif
@endif
@endsection