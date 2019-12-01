@extends('layouts.app')

@section('title','Nabidka Page')


@section('content')
    <h1>Nabídky</h1>
    <ul>
    @foreach ($nabidka as $value)
        <a href="/nabidka/{{ $value->id }}">
        <li>{{ $value }}</li>
    @endforeach
    </ul>
@endsection
