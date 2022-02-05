@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Gestión de Libro</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Registrar un Nuevo Libro</h3>
                        </div>
                        <div class="card-body">
                            <form id="frmLibro" class="container-fluid">
                                <div class="form-row">
                                    <x-adminlte-input name="id" id="frm_id" type="number" hidden />
                                    <x-adminlte-input name="titulo" id="frm_titulo" fgroup-class="col-12 col-lg-6"
                                        label="Titulo" type="text" placeholder="Titulo" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input-date name="anyo_de_lanzamiento" id="frm_anyo_de_lanzamiento"
                                        class="anyo-picker" fgroup-class="col-12 col-lg-3 anyo-lanzamiento"
                                        placeholder="Año de lanzamiento" label="Año de lanzamiento"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-date>
                                    <x-adminlte-input name="cantidad_ejemplares" id="frm_cantidad_ejemplares"
                                        fgroup-class="col-12 col-lg-3 cantidad-ejemplares" label="Cantidad de ejemplares"
                                        placeholder="Cantidad de ejemplares" label-class="text-lightblue" type="number"
                                        min=0 max=200>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-hashtag"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-select2 name="idioma_id" id="frm_idioma_id" fgroup-class="col-12 col-lg-6"
                                        label="Idioma" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-language"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="editorial_id" id="frm_editorial_id"
                                        fgroup-class="col-12 col-lg-6" label="Editorial" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-newspaper"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="autor_id[]" id="frm_autor_id" fgroup-class="col-12 col-lg-12"
                                        label="Autores" label-class="text-lightblue" multiple>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="sub_clasificacion_id[]" id="frm_sub_clasificacion_id"
                                        fgroup-class="col-12 col-lg-12" label="Sub Clasificaciones"
                                        label-class="text-lightblue" multiple>
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-tags"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-input-file name="imagen" id="frm_imagen" fgroup-class="col-12 col-xl-6"
                                        label="Portada" placeholder="Escoja una imagen" label-class="text-lightblue"
                                        legend="Buscar">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-upload"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-file>
                                    <div class="form-group col-12 col-xl-6">
                                        <label class="text-lightblue"> Opciones </label>
                                        <div class="container-fluid" id="opcionesRegistrarLibro">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnRegistrarLibro"
                                                        type="button" label="Registrar" theme="primary"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" type="button" label="Limpiar"
                                                        id="btnLimpiarForm" theme="secondary" icon="fas fa-lg fa-broom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid d-none" id="opcionesEditarLibro">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnEditarLibro"
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
                        $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Titulo', 'Año de Lanzamiento', 'Idioma', 'Editorial', 'Fecha de Registro'];
                    @endphp
                    <x-adminlte-datatable id='tblLibros' :heads='$heads' head-theme='dark' striped hoverable beautify
                        bordered compressed with-footer footer-theme='dark' />

                    <x-adminlte-modal id="modalDetallesLibro" title="Datos del Libro" size="lg" theme="info"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmDetallesLibro" class="container-fluid">
                            <div class="row">
                                <x-adminlte-input name="modal_titulo" fgroup-class="col-12" label="Titulo"
                                    type="text" placeholder="Titulo" label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-textarea name="modal_sub_clasificaciones" rows=2 fgroup-class="col-12"
                                    label="Sub Clasificaciones" placeholder="Sub Clasificaciones"
                                    label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-textarea>
                                <div class="col-12 col-lg-6">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <x-adminlte-textarea name="modal_autores" rows=2 fgroup-class="col-12"
                                                label="Autor" placeholder="Autores" label-class="text-lightblue" disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-textarea>
                                            <x-adminlte-input name="modal_anyo_de_lanzamiento" fgroup-class="col-12"
                                                label="Año de lanzamiento" placeholder="Año de lanzamiento"
                                                label-class="text-lightblue" type="number" min=0 max=2021 disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-hashtag"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="modal_idioma" fgroup-class="col-12"
                                                label="Idioma" type="text" placeholder="Idioma" label-class="text-lightblue"
                                                disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="modal_editorial" fgroup-class="col-12"
                                                label="Editorial" type="text" placeholder="Editorial"
                                                label-class="text-lightblue" disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-book"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="container-fluid d-flex h-100">
                                        <div class="row justify-content-center align-self-center">
                                            <div class="col-12">
                                                <img src="" class="img-fluid rounded" alt="Libro Portada" id="modal_imagen">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            registrar: "{{ route('libro.store') }}",
            actualizar: "{{ route('libro.update', '#') }}",
            datatable: "{{ route('datatable.libros') }}",
            select2: "{{ route('select2.select2') }}",
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/libros.js') }}"> </script>
@stop
