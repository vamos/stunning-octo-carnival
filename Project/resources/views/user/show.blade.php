@extends('layouts.app')

@section('titel','Informace Uzivatel')

@section('content')
<div class="container">
    <h1 class="text-center">Uživatel {{$user->name}}</h1>
    <table class="text-center table table-striped col-md-6" style="margin-left: 25%;margin-right: 25%;">
        <tr>
            <td><b>Jméno</b></td> <td>{{ $user->name }}</td>

        </tr>
        <tr>
        @php
                switch ($user->role) {
                    case 'admin':
                        echo "<td><b>Role</b></td> <td>administrátor</td>";
                        break;

                    case 'operátor':
                        echo "<td><b>Role</b></td> <td>operátor</td>";
                        break;

                    case 'vodič':
                        echo "<td><b>Role</b></td> <td>ridič</td>";
                        break;
                    case 'užívatel':
                        echo "<td><b>Role</b></td> <td>uživatel</td>";
                    break;
                    
                    default:
                        # code...
                        break;
                }
        @endphp
        </tr>
        <tr>
            <td><b>E-mail</b></td> <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td><b>Telefon</b></td> <td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <td><b>Adresa</b></td> <td>{{ $user->city . ', ' . $user->street }}</td>
        </tr>
    </table>
    @if (auth()->user())
    @if(auth()->user()->role == "admin")
    <button style="margin-left: 50%; margin-right: 50%; width:auto"class="btn btn-danger" onclick="location.href='/users/{{ $user->id }}/edit'">
        Edit
    </button>
    @endif
    @endif
</div>
@endsection
