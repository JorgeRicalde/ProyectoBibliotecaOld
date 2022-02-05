@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Busqueda de Libro</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Buscar Libro</h3>
                        </div>
                        <div class="card-body">
                            <form id="frmBuscarLibro" class="container-fluid">
                                <div class="form-row">
                                    <x-adminlte-select2 name="filtro" id="frm_filtro" fgroup-class="col-12 col-lg-3"
                                        label="Filtro" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-filter"></i>
                                            </div>
                                        </x-slot>
                                        <option value="1">Tituto</option>
                                        <option value="2">Autor</option>
                                        <option value="3">Sub Clasificaciones</option>
                                    </x-adminlte-select2>
                                    <x-adminlte-input name="buscar" id="frm_buscar" fgroup-class="col-12 col-lg-9"
                                        label="Buscar" type="search" placeholder="Buscar..." label-class="text-lightblue">
                                        <x-slot name="appendSlot">
                                            <x-adminlte-button id="btnBuscarLibro" theme="outline-success"
                                                icon="fas fa-search fa-lg" />
                                        </x-slot>
                                    </x-adminlte-input>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>

                    <div class="row" id="resultados">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const url = {
            buscar: "{{ route('libro.search') }}",
            ver: "{{ route('libro.ejemplares', '#') }}"
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/buscarlibro.js') }}"> </script>
@stop
