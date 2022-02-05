@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Ejemplares del Libro</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Ejemplares Disponibles
                                @can('ejemplar.store')
                                    <x-adminlte-button label="Añadir" theme="primary" id="btnModalRegistrarEjemplar"
                                        icon="fas fa-plus" />
                                @endcan
                            </h3>
                        </div>
                        <form id="frmInfoLibro" class="card-body">
                            <div class="row justify-content-center">
                                <x-adminlte-input name="id" id="frm_id" type="number" hidden />
                                <div class="col-12 col-xl-4 mb-4 mb-xl-0">
                                    <img class="mx-auto d-block" src="" id="frm_imagen" alt="Libro Portada"
                                        style="width:200px">
                                </div>
                                <div class="col-12 col-xl-6">
                                    <x-adminlte-card theme="primary" theme-mode="full">
                                        <b>Titulo: </b><span id="frm_titulo"></span><br>
                                        <b>Editorial: </b><span id="frm_editorial"></span><br>
                                        <b>Idioma: </b><span id="frm_idioma"></span><br>
                                        <b>Año de lanzamiento: </b><span id="frm_anyo_de_lanzamiento"></span><br>
                                        <b>Autor(es): </b><span id="frm_autores"></span><br>
                                        <b>Sub Clasificacion(es): </b><span id="frm_sub_clasificaciones"></span>
                                    </x-adminlte-card>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr>
                    @php
                        $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Libro', 'Estado', 'Estado Fisico'];
                    @endphp
                    <x-adminlte-datatable id='tblEjemplares' :heads='$heads' head-theme='dark' striped hoverable beautify
                        bordered compressed with-footer footer-theme='dark' />

                    <x-adminlte-modal id="modalEditarEjemplar" title="Editar un Ejemplar" size="lg" theme="success"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmEditarEjemplar" class="container-fluid">
                            <div class="row">
                                <x-adminlte-input name="id" id="modal_id" type="number" hidden />
                                <x-adminlte-select2 name="estado_del_ejemplar_id" id="modal_estado_del_ejemplar_id"
                                    class="states-copie" fgroup-class="col-12" label="Estado ejemplar"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select2>
                                <x-adminlte-select2 name="estado_fisico_del_ejemplar_id[]"
                                    id="modal_estado_fisico_del_ejemplar_id" class="physical-states-copy"
                                    fgroup-class="col-12" label="Estado Fisico" label-class="text-lightblue"
                                    multiple>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select2>
                            </div>
                        </form>
                        <x-slot name="footerSlot">
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="success" label="Guardar"
                                    id="btnEditarEjemplar" />
                            </div>
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="danger" label="Cerrar"
                                    data-dismiss="modal" />
                            </div>
                        </x-slot>
                    </x-adminlte-modal>

                    <x-adminlte-modal id="modalRegistrarEjemplar" title="Añadir un Ejemplar" size="lg" theme="primary"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmRegistrarEjemplar" class="container-fluid">
                            <div class="row">
                                <x-adminlte-input name="libro_id" id="frm_libro_id" type="number" hidden />
                                <x-adminlte-select2 name="estado_del_ejemplar_id" id="frm_estado_del_ejemplar_id"
                                    class="states-copie" fgroup-class="col-12" label="Estado ejemplar"
                                    label-class="text-lightblue">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select2>
                                <x-adminlte-select2 name="estado_fisico_del_ejemplar_id[]"
                                    id="frm_estado_fisico_del_ejemplar_id" class="physical-states-copy"
                                    fgroup-class="col-12" label="Estado Fisico" label-class="text-lightblue"
                                    multiple>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-select2>
                            </div>
                        </form>
                        <x-slot name="footerSlot">
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="primary" label="Registrar"
                                    id="btnRegistrarEjemplar" />
                            </div>
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="danger" label="Cerrar"
                                    data-dismiss="modal" />
                            </div>
                        </x-slot>
                    </x-adminlte-modal>

                    <x-adminlte-modal id="modalRegistrarReserva" title="Registrar Reserva" size="md" theme="primary"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmRegistraReserva" class="container-fluid">
                            <div class="row">
                                <x-adminlte-input name="ejemplar_id" id="frm_ejemplar_id" type="number" hidden />
                                <x-adminlte-input name="dias_de_prestamo" id="frm_dias_de_prestamo" type="number" hidden />
                                <x-adminlte-input name="dias_de_prestamo_text" id="frm_dias_de_prestamo_text"
                                    fgroup-class="col-12" label="Dias de Prestamo" disabled
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
                            </div>
                        </form>
                        <x-slot name="footerSlot">
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="primary" label="Registrar"
                                    id="btnRegistrarReserva" />
                            </div>
                            <div class="col">
                                <x-adminlte-button class="btn-block" theme="danger" label="Cerrar"
                                    data-dismiss="modal" />
                            </div>
                        </x-slot>
                    </x-adminlte-modal>
                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script>
        const permisos = {
            @can('ejemplar.update')
                ejemplar_update: true,
            @else
                ejemplar_update: false,
            @endcan
            @can('reservacion.store')
                reservacion_store: true,
            @else
                reservacion_store: false,
            @endcan
        }
        const url = {
            registrar: "{{ route('ejemplar.store') }}",
            actualizar: "{{ route('ejemplar.update', '#') }}",
            mostrar: "{{ route('libro.show', $titulo_slug) }}",
            datatable: "{{ route('datatable.ejemplar.ejemplares', '#') }}",
            select2: "{{ route('select2.select2') }}",
            reservacion: "{{ route('reservacion.store') }}",
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/ejemplares.js') }}"> </script>
@stop
