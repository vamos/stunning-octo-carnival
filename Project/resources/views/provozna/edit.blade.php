<!-- importing layout.blade.php -->
@extends('layouts.app')

{{-- text v zahlavi stranky --}}
@section('title','Uprava Provozna')


@section('content')
<div class="container">
        @if(session()->has('message'))
        <div class="alert col-mb-6 alert-warning alert-dismissable" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{ session()->get('message') }}
        </div>
    @endif
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="text-center card-header">
                    <h1>Úprava provozovny {{ $provozna->oznaceni }}</h1>
                </div>
                <div class="card-body">

                    <form method="POST" action="/provozna/{{ $provozna->id }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right"for="ozancenie">Jméno</label>
                        <div class="col-md-6">
                            <input type="text" pattern="([^\s][A-z0-9À-ž\s]+)" name="oznaceni" placeholder="Označení" value="{{ $provozna->oznaceni }}">
                        </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="obrazok">Obrázek</label>
                            <div class="col-md-6">
                                <input type="file" name="obrazok" placeholder="Obrazek" value="{{ $provozna->obrazok }}">
                        </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="adresa">Adresa</label>
                            <div class="col-md-6">
                                <input type="text" pattern="([^\s][A-z0-9À-ž,\s]+)" name="adresa" placeholder="Adresa" value="{{ $provozna->adresa }}">
                                <div class="help-block" style="color:grey">V tvaru <i>ulica, mesto</i></div>

                        </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="od">Otevřeno od</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="od" placeholder="Otevírací hodina" value="{{ $provozna->od }}">
                                <div class="help-block" style="color:grey">V tavru celých hodin napr. <i>14</i></div>

                        </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="do">Otevřeno do</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="do" placeholder="Zavírací hodina" value="{{ $provozna->do }}">
                        </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="uzavierka">Uzávěrka obědnávek</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="uzaverka" placeholder="Hodina uzávěrky" value="{{ $provozna->uzaverka }}">
                        </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="max_den_ploz">Max. denních položek</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="max_den_poloz" placeholder="Maximum položek" value="{{ $provozna->max_den_poloz }}">
                                <div class="help-block" style="color:grey">V tvaru napr. <i>6</i></div>

                        </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button class="btn btn-primary"type="submit">Upravit provozovnu</button>
                        </div>
                        </div>

                        </form>

                        <form id="formfield" method="POST" action="/provozna/{{ $provozna->id }}">
                            @method('DELETE')
                            @csrf
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Smazání provozovny {{$provozna->ozancenie}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    Opravdu chcete smazat provozovnu?
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
                                <button id="submitbtn" class="btn btn-danger" type="button" data-toggle="modal" data-target="#exampleModal" style="position:absolute; top:520px; left:405px;">Smazat provozovnu</button>
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
