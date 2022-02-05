@extends('adminlte::page')

@section('title', 'Dashboard')
@section('plugins.DatatablesExport', true)

@section('content_header')
    <h1 class='m-0 text-white'>Reporte de Sanciones</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Reporte de Sanciones
                                <x-adminlte-button id="btnFiltrar" theme="outline-success" icon="fas fa-search fa-lg" />
                            </h3>
                        </div>
                        <div class="card-body">
                            <form id="frmReporteSancion" class="container-fluid">
                                <div class="form-row">
                                    <x-adminlte-select2 name="filtro" id="frm_filtro" fgroup-class="col-12 col-lg-4"
                                        label="Filtro" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-filter"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="mes_trimestre" id="frm_mes_trimestre"
                                        fgroup-class="col-12 col-lg-4" label="Mes o Trimestre" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-times"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="anyo" id="frm_anyo" fgroup-class="col-12 col-lg-4" label="Año"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-hourglass-end"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @php
                            $heads = ['Lector', 'DNI', 'Telefofono', 'Estado de la Sancion', 'Tipo de Sancion', 'Fecha de Inicio', 'Fecha de Finalizacion'];
                        @endphp
                        <div class="container-fluid">
                            <x-adminlte-datatable id='tblReporteSanciones' :heads='$heads' head-theme='dark' striped
                                hoverable beautify bordered compressed with-footer footer-theme='dark' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const url = {
            mes: "{{ route('datatable.sancion.reportePorAnyoMes') }}",
            trimestre: "{{ route('datatable.sancion.reportePorAnyoTrimestre') }}",
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/reportesanciones.js') }}"></script>
@stop
