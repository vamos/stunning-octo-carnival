<!-- importing layout.blade.php -->
@extends('layouts.app')

@section('titel','All users')

@section('content')
<div class="container">
    <div class="text-left" >
        <h1 style="margin-left: 75px; margin-bottom:54px;">Seznam uživatelů</h1>
    </div>
    <ul style="margin-bottom:25px">
    <li class="fa-ul">
        <table class="table table-striped table-hover col-8">
        <th>Administrátoři:</th>

            @foreach ($users as $value)
            @if($value->role == 'admin')
            <tr>
            <td>
                        <a href="/users/{{ $value->id }}">
                            {{ $value->name }}
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </li>
    <li class="fa-ul">
      <table class="table table-striped table-hover col-8">
        <th>Operátoři:</th>
        @foreach ($users as $value)
        @if($value->role == 'operátor')
            <tr>
            <td>
                    <a href="/users/{{ $value->id }}">
                        {{ $value->name}}
                    </a>
                @endif
            </td>
            </tr>
        @endforeach
        </table>
    </li>


    <li class="fa-ul">
        <table class="table table-striped table-hover col-8">
        <th>Řidiči:</th>
        @foreach ($users as $value)
            @if($value->role == 'vodič')
            <tr>
            <td>
                <a href="/users/{{ $value->id }}">
                    {{ $value->name }}
                </a>
            @endif
            </tr>
            </td>
        @endforeach
        </table>
    </li>


    <li class="fa-ul">
        <table class="table table-striped table-hover col-8">
        <th>Zákazníci:</th>
        @foreach ($users as $value)
            @if($value->role == 'užívatel')
            <tr>
            <td>
                <a href="/users/{{ $value->id }}">
                    {{ $value->name}}
                </a>
                @endif
            </tr>
            </td>
        @endforeach
        </table>
    </li>

    </ul>
</div>
@endsection
