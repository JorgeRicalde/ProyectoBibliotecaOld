@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Gestión de Prestamos</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Registrar un Nuevo Prestamo</h3>
                        </div>
                        <div class="card-body">
                            <form id="frmPrestamo" class="container-fluid">
                                <div class="form-row">
                                    <x-adminlte-input name="id" id="frm_id" type="number" hidden />
                                    <x-adminlte-input name="lector_id" id="frm_lector_id" type="text" hidden />
                                    <x-adminlte-input name="lector" id="frm_lector" fgroup-class="col-12 col-lg-6" disabled
                                        label="Lector" type="text" placeholder="Lector" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </x-slot>
                                        <x-slot name="appendSlot">
                                            <x-adminlte-button id="btnBuscarLector" theme="outline-success" label="Buscar"
                                                icon="fas fa-search fa-lg" />
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="ejemplar_id" id="frm_ejemplar_id" type="number" hidden />
                                    <x-adminlte-input name="libro" id="frm_libro" fgroup-class="col-12 col-lg-6" disabled
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
                                    <x-adminlte-select2 name="estado_fisico_del_ejemplar_id[]"
                                        id="frm_estado_fisico_del_ejemplar_id" fgroup-class="col-12 col-lg-8"
                                        label="Estado Fisico de la Ejemplar" label-class="text-lightblue" multiple>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="estado_del_prestamo_id" id="frm_estado_del_prestamo_id"
                                        fgroup-class="col-12 col-lg-4" label="Estado del Prestamo"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-input-slider name="dias_de_prestamo" id="frm_dias_de_prestamo"
                                        label="Dias de Prestamo" fgroup-class="col-12 col-lg-4" color="primary"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <x-adminlte-button theme="primary" icon="fas fa-minus" title="Disminuir"
                                                id="btnDisminuir" />
                                        </x-slot>
                                        <x-slot name="appendSlot">
                                            <x-adminlte-button theme="primary" icon="fas fa-plus" title="Incrementar"
                                                id="btnIncrementar" />
                                        </x-slot>
                                    </x-adminlte-input-slider>
                                    <x-adminlte-input name="fecha_prestamo" id="frm_fecha_prestamo" disabled
                                        fgroup-class="col-12 col-lg-4" placeholder="Fecha de Prestamo"
                                        label="Fecha de Prestamo" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="fecha_devolucion" id="frm_fecha_devolucion" disabled
                                        fgroup-class="col-12 col-lg-4" placeholder="Fecha de Devolucion"
                                        label="Fecha de Devolucion" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <div class="form-group col-12">
                                        <label class="text-lightblue"> Opciones </label>
                                        <div class="container-fluid" id="opcionesRegistrarPrestamo">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block " id="btnBuscarReserva"
                                                        type="button" label="Reserva" theme="success"
                                                        icon="fas fa-lg fa-search" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" id="btnRegistrarPrestamo"
                                                        type="button" label="Registrar" theme="primary"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" id="btnLimpiarForm"
                                                        type="button" label="Limpiar" theme="secondary"
                                                        icon="fas fa-lg fa-broom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid d-none" id="opcionesEditarPrestamo">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" id="btnModalSancion"
                                                        type="button" label="Sancion" theme="danger"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" id="btnEditarPrestamo"
                                                        type="button" label="Guardar" theme="success"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" id="btnCancelarEdicion"
                                                        type="button" label="Cancelar" theme="danger"
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
                        $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Lector', 'Libro', 'Estado del Prestamo', 'Fecha de Prestamo', 'Fecha de Devolucion'];
                    @endphp
                    <div class="container-fluid">
                        <x-adminlte-datatable id='tblPrestamos' :heads='$heads' head-theme='dark' striped hoverable beautify
                            bordered compressed with-footer footer-theme='dark' />
                    </div>
                    <x-adminlte-modal id="modalBuscarLector" title="Lectores Habilitados" size="lg" theme="success"
                        icon="fas fa-search fas" v-centered static-backdrop scrollable>
                        <div class="container-fluid">
                            <div class="row">
                                @php
                                    $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Nombres', 'Apellidos', 'Rol'];
                                @endphp
                                <div class="col-12">
                                    <x-adminlte-datatable id='tblLectores' :heads='$heads' head-theme='dark' striped
                                        hoverable beautify bordered compressed with-footer footer-theme='dark' />
                                </div>
                            </div>
                        </div>
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

                    <x-adminlte-modal id="modalRegistrarSancion" title="Registrar Sancion" size="lg" theme="primary"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmRegistrarSancion" class="container-fluid">
                            <div class="form-row">
                                <x-adminlte-input name="id" id="modal_id" type="number" hidden />
                                <x-adminlte-input-date name="fecha_inicio" id="modal_fecha_inicio" class="fecha-picker"
                                    fgroup-class="col-12 col-lg-6" placeholder="Fecha Inicio" label="Fecha Inicio"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-date>
                                <x-adminlte-input-date name="fecha_fin" id="modal_fecha_fin" class="fecha-picker"
                                    fgroup-class="col-12 col-lg-6" placeholder="Fecha Fin" label="Fecha Fin"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input-date>
                                <x-adminlte-select2 name="estado_de_la_sancion_id" id="modal_estado_de_la_sancion_id"
                                    fgroup-class="col-12 col-lg-6" label="Estado de la Sancion"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select2>
                                <x-adminlte-select2 name="tipo_de_sancion_id" id="modal_tipo_de_sancion_id"
                                    fgroup-class="col-12 col-lg-6" label="Tipo de Sancion" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select2>
                                <x-adminlte-input name="lector_id" id="modal_lector_id" type="text" hidden />
                                <x-adminlte-input name="lector" id="modal_lector_nombre" fgroup-class="col-12"
                                    disabled label="Lector" type="text" placeholder="Lector" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="prestamo" id="modal_prestamo" fgroup-class="col-12" disabled
                                    label="Prestamo" type="text" placeholder="Prestamo" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                        </form>
                        <x-slot name="footerSlot">
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="primary" label="Registrar"
                                    id="btnRegistrarSancion" />
                            </div>
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="danger" label="Cerrar"
                                    data-dismiss="modal" />
                            </div>
                        </x-slot>
                    </x-adminlte-modal>

                    <x-adminlte-modal id="modalBuscarReserva" title="Escoja una reserva" size="lg" theme="success"
                        icon="fas fa-search fas" v-centered static-backdrop scrollable>
                        <div class="container-fluid">
                            <div class="row">
                                @php
                                    $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Libro', 'Lector', 'Dias de Prestamo', 'Fecha de Reservacion'];
                                @endphp
                                <div class="col-12">
                                    <x-adminlte-datatable id='tblReservas' :heads='$heads' head-theme='dark' striped
                                        hoverable beautify bordered compressed with-footer footer-theme='dark' />
                                </div>
                            </div>
                        </div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button class="btn-block" theme="danger" label="Cerrar" data-dismiss="modal" />
                        </x-slot>
                    </x-adminlte-modal>

                    <x-adminlte-modal id="modalDetallesPrestamo" title="Datos del Prestamo" size="lg" theme="info"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmDetallesPrestamo" class="container-fluid">
                            <div class="form-row">
                                <x-adminlte-input name="modal_lector" fgroup-class="col-12" disabled label="Lector"
                                    type="text" placeholder="Lector" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_libro" fgroup-class="col-12" disabled label="Libro"
                                    type="text" placeholder="Libro" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_estado_fisico_del_ejemplar" fgroup-class="col-12"
                                    label="Estado del Libro" placeholder="Estado del Libro" label-class="text-lightblue"
                                    disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_estado_del_prestamo" fgroup-class="col-12 col-lg-6 col-lg-4"
                                    label="Estado del Prestamo" placeholder="Estado del Prestamo"
                                    label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_dias_de_prestamo_text"
                                    fgroup-class="col-12 col-lg-6 col-lg-4" label="Dias de Prestamo"
                                    placeholder="Dias de Prestamo" label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-hashtag"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_fecha_prestamo" fgroup-class="col-12 col-lg-6 col-lg-4"
                                    placeholder="Fecha de Prestamo" label="Fecha de Prestamo" label-class="text-lightblue"
                                    disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_fecha_devolucion" fgroup-class="col-12 col-lg-6 col-lg-4"
                                    placeholder="Fecha de Devolucion" label="Fecha de Devolucion"
                                    label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            </div>
                        </form>
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
            registrar: "{{ route('prestamo.store') }}",
            actualizar: "{{ route('prestamo.update', '#') }}",
            datatable: "{{ route('datatable.prestamo.prestamos') }}",
            usuarios: "{{ route('datatable.usuario.habilitados') }}",
            reservaciones: "{{ route('datatable.reservacion.reservaciones') }}",
            sancion: "{{ route('sancion.store') }}",
            libros: "{{ route('select2.libros', '#') }}",
            limpiar: "{{ route('datatable.limpiar') }}",
            ejemplares: "{{ route('datatable.ejemplar.disponibles', '#') }}",
            select2: "{{ route('select2.select2') }}",
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/prestamos.js') }}"></script>
@stop
