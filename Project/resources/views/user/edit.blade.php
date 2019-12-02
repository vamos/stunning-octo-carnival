@extends('layouts.app')

@section('titel','Uprava Uzivatel')

@section('content')
    <h1 class="text-center">Editace uživatele {{$user->name}}</h1>
    {{-- {{dd($user)}} --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editace') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/users/{{ $user->id}}">
                            @method('PATCH')
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Jméno') }}</label>

                                <div class="col-md-6">
                                    <input id="name" pattern="([^\s][A-zÀ-ž\s]+)" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <input {{ (auth()->user()->role == "admin") ? '' : 'disabled' }} id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ $user->role }}" required autocomplete="role" autofocus>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" pattern="([^\s][0-9]+)"  type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Město') }}</label>

                                <div class="col-md-6">
                                    {{-- <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->city }}" required autocomplete="city" autofocus> --}}
                                    <?php echo "<input id=\"city\" pattern=\"([^\s][A-zÀ-ž\s]+)\" type=\"text\" class=\"form-control @error('city')  @enderror\" name=\"city\" value= \"" . $user->city ."\" required autocomplete=\"city\" autofocus>";  ?>

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Ulice') }}</label>

                                <div class="col-md-6">
                                    <input id="street" pattern="([^\s][A-z0-9À-ž\s]+)" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ $user->street }}" required autocomplete="street" autofocus>

                                    @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mailová adresa') }}</label>

                                <div class="col-md-6">
                                    <input id="email" pattern="([^\s][a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$)" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Heslo') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    <div class="help-block"  style="color:grey">Minimálně 8 znaků</div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Potvrdit heslo') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Uložit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form id="formfield" method="POST" action="/users/{{ $user->id }}">
                            {{-- <div class="form-group row mb-0"> --}}
                                {{-- <div class="col-md-6 offset-md-4"> --}}
                                {{-- <div style="position: absolute; top: 493px; left: 480px "> --}}
                                    {{-- <form method="POST" action="/users/{{ $user->id }}"> --}}
                                        @method('DELETE')
                                        @csrf

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Smazání profilu {{$user->name}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Určite chcete smazat profil?
                                                    </div>
                                                    <div class="modal-footer">
                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Ne</button>
                                                         <button onClick="sub()"  type="button" class="btn btn-danger">Ano</button>
                                                         {{-- <a href="#"  class="btn btn-success success">Submit</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>{{-- konec modal --}}
                                            <button id="submitbtn" class="btn btn-danger" type="button" style="position:relative;top:-52px;left:390px" data-toggle="modal" data-target="#exampleModal">
                                                {{ __('Smazat profil') }}
                                            </button>
                                {{-- </div> --}}
                        </form>
                    </div>{{-- konec card-body --}}
                </div> {{-- konec card --}}
            </div>{{-- konec col --}}
        </div>{{-- konec row --}}
    </div>{{-- konec container --}}
          
          
{{--           
            </div>
        </div>
    </div> --}}
    @endsection
<script>

    function sub(){
        let a = document.getElementById("formfield");
        a.submit();
    }

</script>
