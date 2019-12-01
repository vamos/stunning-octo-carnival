<!-- importing layout.blade.php -->
@extends('layouts.app')

{{-- text v zahlavi stranky --}}
@section('title','Polozka')


@section('content')
<div class="container">
    <h1 class="text-center">Všetky položky</h1>
    <div class="row">
        <div class="col-md-6">
            @if (auth()->user())
                @if((auth()->user()->role == "admin") || (auth()->user()->role == "operátor"))                    
                   <button class="btn btn-primary" onclick="location.href='/polozka/create'" style="position:relative;left:120px;top:-25px"><i class="fas fa-plus-square"></i> Nová položka</button>
                @endif
            @endif
                    
            <ul>
            <li class="fa-ul">   
                <table class="table table-striped table-hover col-8" style="margin-bottom:60px;">
                    <th>Předkrm</th>
                        
                    @foreach ($polozka as $value)
                    @if($value->kategoria == 'Předkrm')
                    <tr> 
                    <td>
                        {{-- <a onmousemove="abb({{$value}})" href="/polozka/{{ $value->id }}"> --}}
                            <div onclick="abb({{$value}})" style="color:#3490dc; text-decoration: none; background-color:transparent; cursor:pointer">{{ $value->popis }}</div>
                        {{-- </a> --}}
                    @endif
                    </td>
                    </tr> 
                    @endforeach
                </table>
            </li>

            <li class="fa-ul">   
                <table class="table table-striped table-hover col-8" style="margin-bottom:60px;">
                    <th>Polévky</th>
                        
                    @foreach ($polozka as $value)
                    @if($value->kategoria == 'Polévky')
                    <tr> 
                    <td>
                        <div onclick="abb({{$value}})" style="color:#3490dc; text-decoration: none; background-color:transparent; cursor:pointer">{{ $value->popis }}</div>
                    @endif
                    </td>
                    </tr> 
                    @endforeach
                </table>
                
            </li>

            <li class="fa-ul">   
                    <table class="table table-striped table-hover col-8" style="margin-bottom:60px;">
                        <th>Hlavní jídlo</th>
                            
                        @foreach ($polozka as $value)
                        @if($value->kategoria == 'Hlavní jídlo')
                        <tr> 
                        <td>
                            <div onclick="abb({{$value}})" style="color:#3490dc; text-decoration: none; background-color:transparent; cursor:pointer">{{ $value->popis }}</div>
                        @endif
                        </td>
                        </tr> 
                        @endforeach
                    </table>
                
                </li>

                <li class="fa-ul">   
                    <table class="table table-striped table-hover col-8" style="margin-bottom:60px;">
                        <th>Dezert</th>
                            
                        @foreach ($polozka as $value)
                        @if($value->kategoria == 'Dezert')
                        <tr>
                        <td>
                            <div onclick="abb({{$value}})" style="color:#3490dc; text-decoration: none; background-color:transparent; cursor:pointer">{{ $value->popis }}</div>
                        @endif
                        </td>
                        </tr> 
                        @endforeach
                    </table>
                
                </li>
                
                <li class="fa-ul">   
                    <table class="table table-striped table-hover col-8" style="margin-bottom:60px;">
                        <th>Teplý nápoj</th>
                            
                        @foreach ($polozka as $value)
                        @if($value->kategoria == 'Teplý nápoj')
                        <tr> 
                        <td>
                            <div onclick="abb({{$value}})" style="color:#3490dc; text-decoration: none; background-color:transparent; cursor:pointer">{{ $value->popis }}</div>
                        @endif
                        </td>
                        </tr> 
                        @endforeach
                    </table>
                
                </li>
                
                <li class="fa-ul">   
                    <table class="table table-striped table-hover col-8" style="margin-bottom:60px;">
                        <th>Nealkoholický nápoj</th>
                            
                        @foreach ($polozka as $value)
                        @if($value->kategoria == 'Nealkoholický nápoj')
                        <tr> 
                        <td>
                            <div onclick="abb({{$value}})" style="color:#3490dc; text-decoration: none; background-color:transparent; cursor:pointer">{{ $value->popis }}</div>
                        @endif
                        </td>
                        </tr> 
                        @endforeach
                    </table>
                
                </li>
                
                <li class="fa-ul">   
                    <table class="table table-striped table-hover col-8" style="margin-bottom:100px;">
                        <th>Alkoholický nápoj</th>
                            
                        @foreach ($polozka as $value)
                        @if($value->kategoria == 'Alkoholický nápoj')
                        <tr> 
                        <td>
                            <div onclick="abb({{$value}})" style="color:#3490dc; text-decoration: none; background-color:transparent; cursor:pointer">{{ $value->popis }}</div>
                        @endif
                        </td>
                        </tr> 
                        @endforeach
                    </table>
                
                </li>
                

            </ul>
        </div>
        <div  class="col-md-6" >
            {{-- <ul class="list-group list-group-flush" style="position:fixed;width:inherit;">
                <li class="list-group-item" id="nazev">Název</li>
                <li class="list-group-item" id="typ">Dapibus ac facilisis in</li>
                <li class="list-group-item" id="cena">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul> --}}
            <div class="container" id="sideinfo" style="background:#dee2e6;position:fixed;width:48%;visibility:hidden;">
            <ul  class="list-group list-group-flush" >    
            <li class="list-group-item list-group-item-primary" id="nazev"><h1 id="nazevH1">Položka</h1> <i onClick="hide()" style="position:absolute; top:20px; left: 95%; color:red; cursor:pointer" class="fas fa-times-circle fa-2x closebtn" ></i> </li>
            <li class="list-group-item" style="background:#dee2e6;">
            <div class="row" style="height:300px;background:#dee2e6;">
            <div class="col-md-6" style="padding-right:0px;background:#dee2e6;">
            <ul  class="list-group list-group-flush" id="show_details">
                        {{-- 0 --}}
                        <li class="list-group-item" id="typ">Typ</li>
                        {{-- 1                         --}}
                        <li class="list-group-item" id="cena">Cena </li>
                        {{-- 2                         --}}
                        <li class="list-group-item" id="kategoria">Kategoria</li>
                        {{-- 3                         --}}
                        <li class="list-group-item" id="objem">Objem</li>
                        {{-- 4                         --}}
                        <li class="list-group-item" id="hmotnos">Hmotnosť</li>
                        {{-- 5                         --}}
                        <li class="list-group-item" id="alko">Obsah alko.</li>
            </ul>
            </div>
            <div  class="col-md-4" style="background:#dee2e6;padding:0;margin:0">
                <img id="foodpic" src="" style="width:300px; max-height:240px;padding-left:5px;"/>    
                <form id="formre" action="">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="position:absolute; left:50%; top:250px;">
                        Úprava položky
                    </button>
                </form>
            </div> 
            </div>
            </li>
        </div>
    </div>
</div>
</div>    
@endsection
<script type="text/javascript">
function abb(value){
    console.log(value.popis);
    document.getElementById('sideinfo').style.visibility = "visible";

    document.getElementById('nazevH1').innerHTML = ""+value.popis; 
    document.getElementById('typ').innerHTML = "Typ : "+value.typ; 

    document.getElementById('cena').innerHTML = "Cena : "+value.cena+"&euro;"; 
    document.getElementById('kategoria').innerHTML = "Kategoria : "+value.kategoria; 
    if( (value.kategoria == "Dezert")||(value.kategoria == "Předkrm")||(value.kategoria == "Hlavní jídlo") ){
        document.getElementById('show_details').children[4].style.display = "block";
        document.getElementById('show_details').children[3].style.display = "none";
        document.getElementById('show_details').children[5].style.display = "none";
        
        document.getElementById('hmotnos').innerHTML = "Hmotnosť : "+value.hmotnost+"g"; 
    } else if( (value.kategoria == "Nealkoholický nápoj")||(value.kategoria == "Teplý nápoj")||(value.kategoria == "Alkoholický nápoj") ){     
        document.getElementById('show_details').children[4].style.display = "none";
        document.getElementById('show_details').children[3].style.display = "block";
        document.getElementById('show_details').children[5].style.display = "block";
        
        document.getElementById('objem').innerHTML = "Objem : "+value.objem+"L"; 
        document.getElementById('alko').innerHTML = "Obsah alko. : "+value.alkohol+"%"; 
    }
    var l = '{{ URL::asset('/images') }}';
    var a = "/";
    var b = l.concat(a);
    if(value.obrazok !== null){
    var lol = b.concat(value.obrazok) ;
    } else {

    var lol = b.concat("placeholder.png") ;
    }    
    console.log(lol);
    document.getElementById('foodpic').src = lol;
    var c = '/polozka/';
    var d =  c.concat(value.id);
    var url = d.concat('/edit');
    document.getElementById('formre').action =  url;          
}



function hide() {
    document.getElementById('sideinfo').style.visibility = "hidden";    
}
</script>
    