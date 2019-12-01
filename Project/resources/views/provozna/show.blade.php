<!-- importing layout.blade.php -->
@extends('layouts.app')

{{-- text v zahlavi stranky --}}
@section('title','Ukazka Provozna')

<?php use \App\Nabidka; ?>
<?php use \App\Nabidka_Polozka; ?>

@section('content')
{{--
    @can('update', $provozna)
        <a href="/update"></a>
    @endcan --}}


<div class="container">
    <div class="row">
        <div class="col-6">
            <h1> {{ $provozna->oznaceni }}</h1>

            @if(session()->has('message'))
                <div class="alert col-mb-6 alert-warning alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    {{ session()->get('message') }}
                </div>
            @endif

            <br><h3 style="display: inline-block;">Obsah nabídky : </h3>
            <ul>
                @php
                    $kat_jidla = array("Polévka", "Předkrm", "Hlavní jídlo", "Příloha", "Dezert");
                    $kat_piti = array("Teplý nápoj", "Nealkoholický nápoj", "Alkoholický nápoj");
                @endphp
                
                <form action="#" method="GET" id="formfield">
                    @csrf
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#filterModal">Filtrovat</button>

                    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5>Filtrovat položky</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 style="margin-top:1rem">Kategorie</h5>
                                    <label><input type="checkbox" name="predkrmy" value="1">Předkrmy</label>
                                    <label><input type="checkbox" name="polevky" value="1">Polévky</label>
                                    <label><input type="checkbox" name="hlavni_jidlo" value="1">Hlavní jídlo</label>
                                    <label><input type="checkbox" name="prilohy" value="1">Přílohy</label>
                                    <label><input type="checkbox" name="dezerty" value="1">Dezerty</label>
                                    <label><input type="checkbox" name="teple_napoje" value="1">Teplé nápoje</label>
                                    <label><input type="checkbox" name="nealkoholicke_napoje" value="1">Nealkoholické nápoje</label>
                                    <label><input type="checkbox" name="alkoholicke_napoje" value="1">Alkoholické nápoje</label>
                                    <br>

                                    <h5 style="margin-top:1rem">Typ</h5>
                                    <label><input type="checkbox" name="bezlepkove" value="1">Bezlepkové</label>
                                    <label><input type="checkbox" name="bezlaktozove" value="1">Bezlaktózové</label>
                                    <label><input type="checkbox" name="veganske" value="1">Vegánske</label>
                                    <label><input type="checkbox" name="vegetarianske" value="1">Vegeteriánske</label>
                                    <label><input type="checkbox" name="ostatni" value="1">Ostatní</label>
                                </div>
                                <div class="modal-footer">
                                    <button onClick="sub()" type="submit" class="btn btn-primary">Filtrovat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @if (auth()->user())
                    @if((auth()->user()->role == "admin") || (auth()->user()->role == "operátor"))
                        <form action="/nabidka/{{ $provozna->nabidka_id }}/edit" method="GET">
                            <input type="hidden" name="provozna_id" value="{{ $provozna->id}}">
                            <button type="submit" class="btn btn-danger ">
                            Upravit nabídku
                        </button>
                        </form>
                    @endif
                @endif

                {{-- @endif --}}
                <form  action="/objednavka/create" method="POST">
                    @csrf
                    @if($tmp_kat[0] == 'vsetky' and $tmp_typ[0] == 'vsetky')
                        <h4>Denní nabídka</h4>
                        <label for="table11" style="margin-bottom: 0rem;">Pokrmy</label>
                        <table name="table11" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                    @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Denni")
                                        @if(in_array($value->kategoria, $kat_jidla))
                                            <tr>
                                            <label for="" class="checkbox"></label>
                                            <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                            <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link " id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                            <td>{{$value->hmotnost}}g</td>
                                            <td>{{$value->typ}}</td>
                                            <td>{{$value->cena}}€</td>
                                        </tr>
                                        @endif
                                    @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table12" style="margin-bottom: 0rem;">Nápoje</label>
                        <table name="table12" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Objem</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Denni")
                                            @if(in_array($value->kategoria, $kat_piti))
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->objem}}l</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <h4>Trvalá nabídka</h4>
                        <label for="table21" style="margin-bottom: 0rem;">Předkrmy</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Předkrm')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table21" style="margin-bottom: 0rem;">Polévky</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Polévka')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table21" style="margin-bottom: 0rem;">Hlavní jídla</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Hlavní jídlo')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table21" style="margin-bottom: 0rem;">Přílohy</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Příloha')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table21" style="margin-bottom: 0rem;">Dezerty</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Dezert')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table21" style="margin-bottom: 0rem;">Teplé nápoje</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Objem</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Teplý nápoj')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->objem}}l</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table21" style="margin-bottom: 0rem;">Nealkoholické nápoje</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Objem</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Nealkoholický nápoj')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->objem}}l</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                        <label for="table21" style="margin-bottom: 0rem;">Alkoholické nápoje</label>
                        <table name="table21" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Objem</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @foreach (Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                    <div>
                                        @if( (Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ == "Trvalý")
                                            @if( $value->kategoria == 'Alkoholický nápoj')
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->objem}}l</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </table>

                    @elseif ($tmp_kat[0] != 'vsetky')
                        <h5>Jídla</h5>
                        <label for="table_filtered" style="margin-bottom: 0rem;"></label>
                        <table name="table_filtered" class="table table-striped table-hover col-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Kategorie</th>
                            <th>D/T</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @for( $i = 0; $i < count($tmp_kat); $i++)
                                    @foreach(Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                        <div>
                                        @if($tmp_typ[0] == 'vsetky')
                                            @if($value->kategoria == $tmp_kat[$i] and in_array($value->kategoria, $kat_jidla))
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->kategoria}}</td>
                                                    <td>{{(Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ}}</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @else
                                            @if($value->kategoria == $tmp_kat[$i] and in_array($value->kategoria, $kat_jidla) and in_array($value->typ, $tmp_typ))
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->kategoria}}</td>
                                                    <td>{{(Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ}}</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @endif
                                        </div>
                                    @endforeach
                                @endfor
                            @endif
                        </table>

                        <h5>Nápoje</h5>
                        <label for="table_filtered" style="margin-bottom: 0rem;"></label>
                        <table name="table_filtered" class="table table-striped table-hover col-mb-6 text-center" style="table-layout: auto; width: 100%">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Objem</th>
                            <th>Kategorie</th>
                            <th>D/T</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @for( $i = 0; $i < count($tmp_kat); $i++)
                                    @foreach(Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                        <div>
                                        @if($tmp_typ[0] == 'vsetky')
                                            @if($value->kategoria == $tmp_kat[$i] and in_array($value->kategoria, $kat_piti))
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->objem}}l</td>
                                                    <td>{{$value->kategoria}}</td>
                                                    <td>{{(Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        @else

                                        @endif
                                        </div>
                                    @endforeach
                                @endfor
                            @endif
                        </table>
                    @else
                        <h5>Jídla</h5>
                        <label for="table_filtered" style="margin-bottom: 0rem;"></label>
                        <table name="table_filtered" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Hmotnost</th>
                            <th>Kategorie</th>
                            <th>D/T</th>
                            <th>Speciální typ</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @for( $i = 0; $i < count($kat_jidla); $i++)
                                    @foreach(Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                        <div>
                                            @if(in_array($value->typ, $tmp_typ) and $value->kategoria == $kat_jidla[$i])
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->hmotnost}}g</td>
                                                    <td>{{$value->kategoria}}</td>
                                                    <td>{{(Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ}}</td>
                                                    <td>{{$value->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        </div>
                                    @endforeach
                                @endfor
                            @endif
                        </table>

                        <h5>Nápoje</h5>
                        <label for="table_filtered" style="margin-bottom: 0rem;"></label>
                        <table name="table_filtered" class="table table-striped table-hover col-mb-6 text-center">
                            <th>Vybrat</th>
                            <th>Položka</th>
                            <th>Objem</th>
                            <th>Kategorie</th>
                            <th>D/T</th>
                            <th>Cena</th>
                            @if(Nabidka::find($provozna->nabidka_id))
                                @for( $i = 0; $i < count($kat_piti); $i++)
                                    @foreach(Nabidka::findOrFail($provozna->nabidka_id)->polozka as $value)
                                        <div>
                                            @if(in_array($value->typ, $tmp_typ) and $value->kategoria == $kat_piti[$i])
                                                <tr>
                                                    <label for="" class="checkbox"></label>
                                                    <td><input type="checkbox" id="{{ "check".$value->id }}" name="polozka[]" value="{{ $value->id }}"></td>
                                                    <td><button type="button" style="padding-top:0px;padding-bottom:0px;" class=" btn btn-link" id="pop" data-toggle="popover" data-trigger="hover" title="Informace" data-html="true" data-content="Typ: {{$value->typ}} <br /> Kategorie: {{$value->kategoria}} <br />">{{ $value->popis }}</button></td>
                                                    <td>{{$value->objem}}l</td>
                                                    <td>{{$value->kategoria}}</td>
                                                    <td>{{(Nabidka_Polozka::where([['nabidka_id','=',$provozna->nabidka_id],['polozka_id','=',$value->id]])->get())[0]->typ}}</td>
                                                    <td>{{$value->cena}}€</td>
                                                </tr>
                                            @endif
                                        </div>
                                    @endforeach
                                @endfor
                            @endif
                        </table>
                    @endif

                    <input type="hidden" name="provozna_id" value="{{ $provozna->id }}">
                    @if(Nabidka_Polozka::where([['nabidka_id', '=', $provozna->nabidka_id]])->first())
                        <button class="btn btn-primary" type="submit" id="btn_objednat" value="{{ $provozna->uzaverka }}" style="margin-bottom:50px" >Vytvořit objednávku</button>
                    @endif
                </form>
            </ul>

        </div>

        <div class="col-4" style="margin-bottom:150px;">

            <img class="col-15 thumbnail" id="obrazok" src="{{asset('/images/'.$provozna->obrazok)}}" alt="menza" style="width:100%; margin-left:50px"/>
            <div id="popis">
                <ul class="list-group col-10" style="margin-bottom:50px; margin-left:50px;">
                    <li class="list-group-item">Název: {{ $provozna->oznaceni }}</li>
                    <li class="list-group-item">Adresa: {{ $provozna->adresa}}</li>
                    <li class="list-group-item">Otevřeno od: {{ $provozna->od}}:00</li>
                    <li class="list-group-item">Otevřeno do: {{ $provozna->do}}:00 </li>
                    <li class="list-group-item">Uzávěrka objednávek: {{ $provozna->uzaverka}}:00</li>
                </ul>
                @if (auth()->user())
                    @if((auth()->user()->role == "admin") || (auth()->user()->role == "operátor"))
                        <button class="btn btn-danger " style="margin-bottom:50px" onclick="location.href='/provozna/{{ $provozna->id }}/edit'">
                            Úprava provozny
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

{{-- @if ($provozna->nabidka())
    @foreach ($provozna->nabidka as $item)
        <li>  Nabidka: {{ $item }}</li>
    @endforeach
@endif --}}
{{-- {{ dd(auth()->user()->role) }} --}}



@endsection

<script type="text/javascript">

window.onload = function() {
    let cas = document.getElementById('btn_objednat').value;
    let date = new Date();
    let hour = date.getHours();

    if(hour >= cas){
        alert("Objednavky uzavreté!");
        document.getElementById('btn_objednat').disabled = true;
        // $('#pop').popover();
    }
    //enable all poppovers on the page!
    $(function () {
    $('[data-toggle="popover"]').popover()
    })
}

function sub(){
    let a = document.getElementById("formfield");
    a.submit();
}
</script>
