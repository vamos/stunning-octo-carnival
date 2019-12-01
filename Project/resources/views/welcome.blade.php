<!-- importing layout.blade.php -->
@extends('layouts.app')
{{-- @extends('layout') --}}

@section('title','Welcome page')
<style>
    img {
        width: 80%;
        margin-top: 2rem;
    }
</style>

@section('content')
    {{--<h1 style="margin-left: 20px">My first IIS site</h1>--}}

    <div class="container">
        @if(session()->has('message'))
            <div class="alert col-mb-6 alert-warning alert-dismissable" role="alert" style="min-width:10%; display: inline-block; overflow:hidden;">
                <button type="button" class="close" data-dismiss="alert" style="margin-left:5px"><span>&times;</span></button>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <img src="{{url('images/welcome.jpg')}}" alt="Best of day">
            </div>
            <div class="col-md-6">
                <h1>O nás</h1>
                <p style="margin-bottom: 3rem">Jsme společnost, která připravuje a roznáší jídlo až k vám do domu!<br> Jsme tým mladých lídí,
                    který baví práce mimo kancelář.</p>
                <p style="color:darkred; background-color:navajowhite; text-align:center;">Jedná se pouze o školní projekt, informace a kontakty jsou vymyšlené.</p>
                <h3  style="margin-top: 3rem">Sleduj svoji objednávku</h3>

                <form action="/show_status" method="POST">
                    @csrf
                        {{--<label for="id_objednavky" style="margin-right: 1rem">Číslo objednávky: </label>--}}
                    <div class="input-group mb-3"  style="width: 25rem">
                        <input type="text" class="form-control" name="objednavka_id" placeholder="Číslo objednávky" aria-label="Číslo objednávky" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Zjistit stav</button>
                        </div>
                    </div>
                        {{--<input type="text" name="id_objednavky">
                        <button class="btn btn-info" type="submit" style="margin-left: 1rem; position: relative; top: -1px">Zjistit</button>--}}
                </form>
            </div>
            <div class="col-md-3">
                <h2 style="font-size: 20px; margin-top: 2rem">Ústředna</h2>
                <p style="font-size: 12px; margin-top: 1rem">
                    <i class="fas fa-phone-alt" style="color:#696969; margin-right: 1rem"></i>+420777888999<br>
                    <i class="fas fa-at" style="color:#696969; margin-right: 1rem"></i>xteams00@vutbr.cz<br>
                    <i class="fas fa-map-marker-alt" style="color:#696969; margin-right: 1.15rem"></i>Božetěchova 2<br>
                    <i class="fas fa-city" style="color:#696969; margin-right: 0.85rem"></i>612 66 Brno</p>
            </div>
        </div>
    </div>

@endsection
