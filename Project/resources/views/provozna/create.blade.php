<!-- importing layout.blade.php -->
@extends('layouts.app')

@section('title','Nova Provozna')


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
                        <h1>Vytvoření nové provozovny <i class="fas fa-store"></i></h1>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="/provozna" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="ozancenie">Název</label>
                            <div class="col-md-6">
                                <input type="text" pattern="([^\s][A-z0-9À-ž\s]+)" name="oznaceni" placeholder="Označení" required value="{{ old('oznaceni') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="obrazok">Obrázek</label>
                            <div class="col-md-6">
                            <div>
                                <input type="file" name="obrazok" placeholder="Obrázek (nepovinný)" value="">
                            </div>
                        </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="adresa">Adresa</label>
                            <div class="col-md-6">
                                <input type="text" pattern="([^\s][A-z0-9À-ž,\s]+)" name="adresa" placeholder="Adresa" required value="{{ old('adresa') }}">
                                <div class="help-block" style="color:grey">V tvaru <i>ulica, mesto</i></div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="od">Otevřeno od</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="od" placeholder="Otevírací hodina" required value="{{ old('od') }}">
                                <div class="help-block" style="color:grey">V tavru celých hodin napr. <i>14</i></div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="do">Otevřeno do</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="do" placeholder="Zavírací hodina" required value="{{ old('do') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="uzavierka">Uzávěrka obědnávek</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="uzaverka" placeholder="Hodina uzávěrky" required value="{{ old('uzaverka') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"for="max_den_ploz">Max. denních položek</label>
                            <div class="col-md-6">
                                <input type="text" pattern="^[0-9]*$" name="max_den_poloz" placeholder="Maximum položek" required value="{{ old('max_den_poloz') }}">
                                <div class="help-block" style="color:grey">V tvaru napr. <i>6</i></div>

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary" type="submit">Vytvořit provozovnu</button>
                            </div>
                        </div>
                        @include('errors')
                    </form>
                    </div>
                </div>
    </div>
</div>
@endsection
