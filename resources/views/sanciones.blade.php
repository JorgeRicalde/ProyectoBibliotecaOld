@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Gestión de Sanciones</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Registrar una Nueva Sancion</h3>
                        </div>
                        <div class="card-body">
                            <form id="frmSancion" class="container-fluid">
                                <div class="form-row">
                                    <x-adminlte-input name="id" id="frm_id" type="number" hidden />
                                    <x-adminlte-input name="prestamo" id="frm_prestamo" fgroup-class="col-12 col-xl-9"
                                        disabled label="Prestamo" type="text" placeholder="Prestamo"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        </x-slot>
                                        <x-slot name="appendSlot">
                                            <x-adminlte-button name="btnBuscar" id="btnBuscarPrestamo"
                                                theme="outline-success" label="Buscar" icon="fas fa-search fa-lg" />
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-select2 name="estado_de_la_sancion_id" id="frm_estado_de_la_sancion_id"
                                        fgroup-class="col-12 col-lg-6 col-xl-3" label="Estado de la Sancion"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-input-date name="fecha_inicio" id="frm_fecha_inicio" class="fecha-picker"
                                        fgroup-class="col-12 col-lg-6 col-xl-4" placeholder="Fecha Inicio"
                                        label="Fecha Inicio" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-date>
                                    <x-adminlte-input-date name="fecha_fin" id="frm_fecha_fin" class="fecha-picker"
                                        fgroup-class="col-12 col-lg-6 col-xl-4" placeholder="Fecha Fin" label="Fecha Fin"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-date>
                                    <x-adminlte-select2 name="tipo_de_sancion_id" id="frm_tipo_de_sancion_id"
                                        fgroup-class="col-12 col-lg-6 col-xl-4" label="Tipo de Sancion"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-input name="lector_id" id="frm_lector_id" type="text" hidden />
                                    <x-adminlte-input name="lector" id="frm_lector" fgroup-class="col-12 col-xl-6" disabled
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
                                    <div class="form-group col-12 col-xl-6">
                                        <label class="text-lightblue"> Opciones </label>
                                        <div class="container-fluid" id="opcionesRegistrarSancion">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnRegistrarSancion"
                                                        type="button" label="Registrar" theme="primary"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" type="button" label="Limpiar"
                                                        id="btnLimpiarForm" theme="secondary" icon="fas fa-lg fa-broom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid d-none" id="opcionesEditarSancion">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnEditarSancion"
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
                        $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Lector', 'Libro', 'Estado de la Sancion', 'Tipo de Sancion', 'Fecha Inicio', 'Fecha Fin'];
                    @endphp
                    <div class="container-fluid">
                        <x-adminlte-datatable id='tblSanciones' :heads='$heads' head-theme='dark' striped hoverable beautify
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
                    <x-adminlte-modal id="modalBuscarPrestamo" title="Prestamos sin sancion" size="lg" theme="success"
                        icon="fas fa-search fas" v-centered static-backdrop scrollable>
                        <div class="container-fluid">
                            <div class="row">
                                @php
                                    $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Fecha de Prestamo', 'Libro', 'Lector'];
                                @endphp
                                <div class="col-12">
                                    <x-adminlte-datatable id='tblPrestamos' :heads='$heads' head-theme='dark' striped
                                        hoverable beautify bordered compressed with-footer footer-theme='dark' />
                                </div>
                            </div>
                        </div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button class="btn-block" theme="danger" label="Cerrar" data-dismiss="modal" />
                        </x-slot>
                    </x-adminlte-modal>
                    <x-adminlte-modal id="modalDetallesSancion" title="Datos de la Sancion" size="lg" theme="info"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmDetallesSancion" class="container-fluid">
                            <div class="form-row">
                                <x-adminlte-input name="modal_prestamo" fgroup-class="col-12" disabled
                                    label="Prestamo" type="text" placeholder="Prestamo" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_estado_de_la_sancion" fgroup-class="col-12 col-lg-6" disabled
                                    label="Estado de la Sancion" type="text" placeholder="Estado de la Sancion"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_tipo_de_sancion" fgroup-class="col-12 col-lg-6" disabled
                                    label="Tipo de Sancion" type="text" placeholder="Tipo de Sancion"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_fecha_inicio" fgroup-class="col-12 col-lg-6" disabled
                                    label="Fecha Inicio" type="text" placeholder="Fecha Inicio"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_fecha_fin" fgroup-class="col-12 col-lg-6" disabled
                                    label="Fecha Fin" type="text" placeholder="Fecha Fin" label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_lector" fgroup-class="col-12" disabled label="Lector"
                                    type="text" placeholder="Lector" label-class="text-lightblue">
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
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        const url = {
            registrar: "{{ route('sancion.store') }}",
            actualizar: "{{ route('sancion.update', '#') }}",
            datatable: "{{ route('datatable.sancion.sanciones') }}",
            usuarios: "{{ route('datatable.usuario.habilitados') }}",
            prestamos: "{{ route('datatable.prestamo.sinSancion') }}",
            select2: "{{ route('select2.select2') }}",
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/sanciones.js') }}"></script>
@stop
