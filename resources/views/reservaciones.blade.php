@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Mis Reservaciones</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Registrar una Nueva Reserva</h3>
                        </div>
                        <div class="card-body">
                            <form id="frmReserva" class="container-fluid">
                                <div class="form-row">
                                    <x-adminlte-input name="id" id="frm_id" type="number" hidden />
                                    <x-adminlte-input name="ejemplar_id" id="frm_ejemplar_id" type="number" hidden />
                                    <x-adminlte-input name="libro" id="frm_libro" fgroup-class="col-12 col-xl-8" disabled
                                        label="Libro" type="text" placeholder="Libro" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        </x-slot>
                                        <x-slot name="appendSlot">
                                            <x-adminlte-button id="btnBuscarLibro" theme="outline-success" label="Buscar"
                                                icon="fas fa-search fa-lg" />
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="dias_de_prestamo" id="frm_dias_de_prestamo" type="number"
                                        hidden />
                                    <x-adminlte-input name="dias_de_prestamo_text" id="frm_dias_de_prestamo_text"
                                        fgroup-class="col-12 col-xl-4" label="Dias de Prestamo" disabled
                                        placeholder="Dias de Prestamo" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <x-adminlte-button theme="primary" icon="fas fa-minus" title="Disminuir"
                                                id="btnDisminuir" />
                                        </x-slot>
                                        <x-slot name="appendSlot">
                                            <x-adminlte-button theme="primary" icon="fas fa-plus" title="Incrementar"
                                                id="btnIncrementar" />
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-select2 name="estado_fisico_del_ejemplar_id[]" disabled
                                        id="frm_estado_fisico_del_ejemplar_id" fgroup-class="col-12 col-xl-6"
                                        label="Estado Fisico de la Ejemplar" label-class="text-lightblue" multiple>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <div class="form-group col-12 col-xl-6">
                                        <label class="text-lightblue"> Opciones </label>
                                        <div class="container-fluid" id="opcionesRegistrarReserva">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnRegistrarReserva"
                                                        type="button" label="Registrar" theme="primary"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" type="button" label="Limpiar"
                                                        id="btnLimpiarForm" theme="secondary" icon="fas fa-lg fa-broom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid d-none" id="opcionesEditarReserva">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnEditarReserva"
                                                        type="button" label="Guardar" theme="success"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" type="button" label="Cancelar"
                                                        id="btnCancelarEdicion" theme="danger"
                                                        icon="fas fa-lg fa-times-circle" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    @php
                        $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Libro', 'Dias de Prestamo', 'Fecha de Reservacion'];
                    @endphp
                    <div class="container-fluid">
                        <x-adminlte-datatable id='tblReservas' :heads='$heads' head-theme='dark' striped hoverable beautify
                            bordered compressed with-footer footer-theme='dark' />
                    </div>

                    <x-adminlte-modal id="modalDetallesReserva" title="Datos del Reserva" size="lg" theme="info"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmDetallesReserva" class="container-fluid">
                            <div class="row">
                                <x-adminlte-input name="modal_libro" fgroup-class="col-12" label="Libro"
                                    placeholder="Libro" label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_dias_de_prestamo_text" fgroup-class="col-12 col-xl-6"
                                    label="Dias de Prestamo" placeholder="Dias de Prestamo" label-class="text-lightblue"
                                    disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_fecha_de_reservacion" fgroup-class="col-12 col-xl-6"
                                    label="Fecha de Reservacion" placeholder="Fecha de Reservacion"
                                    label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                        </form>
                        <x-slot name="footerSlot">
                            <x-adminlte-button class="btn-block" theme="danger" label="Cerrar" data-dismiss="modal" />
                        </x-slot>
                    </x-adminlte-modal>

                    <x-adminlte-modal id="modalBuscarEjemplar" title="Ejemplares disponibles" size="lg" theme="success"
                        icon="fas fa-search fas" v-centered static-backdrop scrollable>
                        <div class="container-fluid">
                            <div class="row">
                                <x-adminlte-select2 name="slcLibro" fgroup-class="col-12" label="Libro"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select2>
                                @php
                                    $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Libro', 'Estado'];
                                @endphp
                                <div class="col-12">
                                    <x-adminlte-datatable id='tblEjemplares' :heads='$heads' head-theme='dark' striped
                                        hoverable beautify bordered compressed with-footer footer-theme='dark' />
                                </div>
                            </div>
                        </div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button class="btn-block" theme="danger" label="Cerrar" data-dismiss="modal" />
                        </x-slot>
                    </x-adminlte-modal>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const url = {
            registrar: "{{ route('reservacion.store') }}",
            actualizar: "{{ route('reservacion.update', '#') }}",
            datatable: "{{ route('datatable.reservacion.misReservaciones') }}",
            ejemplares: "{{ route('datatable.ejemplar.disponibles', '#') }}",
            libros: "{{ route('select2.libros', '#') }}",
            limpiar: "{{ route('datatable.limpiar') }}",
            estados_fisicos_de_los_ejemplares: "{{ route('select2.estadosFisicosDeLosEjemplares') }}",
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/reservaciones.js') }}"></script>
@stop
