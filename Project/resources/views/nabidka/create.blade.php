@extends('layouts.app')

@section('title','Vytvorenie Nabidka')

{{-- TOO DOOOO !!!!! --}}
{{-- Spojit nabidku a polozku v tabulke nabidka_polozka --}}
{{-- Presmerpovat po submit na dobru stranku kotra vytvori spojenie
medzi polozka a nabidka
--}}

@section('content')
    <h1>Vytvoření nové nabídky</h1>
    <form action="/nabidka_polozka" method="POST">
    @csrf
    <input type="hidden" name="nabidka_id" value="{{ $nabidka->id }}">
    @foreach ($polozka as $value)
        <div>
            <label for="" class="checkbox">
            <input type="checkbox" name="polozka[]" value="{{ $value->id }}">
                {{ $value->popis }}
            </label>

        </div>
            @endforeach


    <div>
        <button type="submit">Vytvoření nabídky</button>
    </div>

     </form>
     @include('errors')
@endsection
