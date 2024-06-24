@extends('adminlte::page')

@section('content_header')
    <header-nota-fiscal></header-nota-fiscal>
@stop

@section('content')
    <router-view tipos_pessoa="{{ $tiposPessoa }}"></router-view>
@stop

@section('js')
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection

