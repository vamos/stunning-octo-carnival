@extends('layouts.app')

@section('title','Nabidka Obsah')


@section('content')
    <h1>Nabidka {{ $nabidka->id }} obsahuje</h1>
    Nápoje :
    <ul>
        @foreach ($nabidka->polozka->where('druh', '=', 'Nápoj') as $value)
            {{ $value->popis }} objem: {{ $value->objem }} L
        @endforeach
    </ul>

    Jedlá :
    <ul>
       @foreach ($nabidka->polozka->where('druh', '=', 'Jedlo') as $value)
            {{ $value->popis }} hmotnost: {{ $value->hmotnost }} g
        @endforeach
    </ul>

@if (auth()->user())
   @if((auth()->user()->role == "admin") || (auth()->user()->role == "operátor"))

    <button onclick="location.href='/nabidka/{{ $nabidka->id }}/edit'">
        Úprava nabídky
    </button>

    <form action="" method="POST" action="/nabidka/{{ $nabidka->id }}">
        @method('DELETE')
        @csrf
        <div>
            <button type="submit">Smazat nabídku</button>
        </div>
    </form>
    @endif
@endif

@endsection
