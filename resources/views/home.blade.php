@extends('adminlte::page')

{{-- @section('title', 'AdminLTE') --}}

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')

    <!-- let people make clients -->
    <passport-clients></passport-clients>

    <!-- list of clients people have authorized to access our account -->
    <passport-authorized-clients></passport-authorized-clients>

    <!-- make it simple to generate a token right in the UI to play with -->
    <passport-personal-access-tokens></passport-personal-access-tokens>

    {{-- <example-component teste="Bem vindo ao Gestor NFE"></example-component> --}}

@stop
