<!-- importing layout.blade.php -->
@extends('layouts.app')

{{-- text v zahlavi stranky --}}
@section('title','Provozna')


@section('content')
<div class="container">
    <h1>Provozovny</h1>

    <ul style="margin-left:5%;margin-right:5%; padding:0;">
    @foreach ($provozna as $value)
       <div class="card" style="width:300px; display:inline-block; margin-bottom:5px">
        <a  href="/provozna/{{ $value->id }}"> <img class="card-img-top" src="{{ ($value->obrazok != null) ? "/images/".$value->obrazok : '/images/placeholder.png'}} " alt="Card image" style="width:100%; height:220px"></a>
        <div class="card-body">
                <h4 class="card-title">{{ $value->oznaceni }}</h4>
            </div>
        </div>
    @endforeach
    </ul>
    @if (auth()->user())
        @if((auth()->user()->role == "admin") || (auth()->user()->role == "operátor"))
        <div class="container">
        <button class="btn btn-primary" style="position:relative; left:440px;width:200px;margin-bottom:50px" onclick="location.href='/provozna/create'">
            Přidat provozovnu
        </button>
        </div>
        @endif
    @endif
</div>
@endsection

{{--
<div class="card" style="width:400px">
        <img class="card-img-top" src="img_avatar1.png" alt="Card image" style="width:100%">
        <div class="card-body">
          <h4 class="card-title">John Doe</h4>
          <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
          <a href="#" class="btn btn-primary">See Profile</a>
        </div>
      </div> --}}
