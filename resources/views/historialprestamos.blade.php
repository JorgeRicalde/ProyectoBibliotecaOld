@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Historial de Prestamos</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Historial de Prestamos
                                <x-adminlte-button id="btnFiltrar" theme="outline-success" icon="fas fa-search fa-lg" />
                            </h3>
                        </div>
                        <div class="card-body">
                            <form id="frmHistorialPrestamo">
                                <div class="form-row">
                                    <x-adminlte-select2 name="filtro" id="frm_filtro" fgroup-class="col-12 col-lg-4"
                                        label="Filtro" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-filter"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-input-date name="fecha_desde" id="frm_fecha_desde" class="fecha-picker"
                                        fgroup-class="col-12 col-lg-4" placeholder="Desde la Fecha" label="Desde la Fecha"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-date>
                                    <x-adminlte-input-date name="fecha_hasta" id="frm_fecha_hasta" class="fecha-picker"
                                        fgroup-class="col-12 col-lg-4" placeholder="Hasta la Fecha" label="Hasta la Fecha"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-date>
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
            historial: '{{ route('prestamo.misPrestamos') }}'
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/historialprestamos.js') }}"></script>
@stop
