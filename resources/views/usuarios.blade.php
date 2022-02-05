@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Gestión de Usuarios</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="card">
                        <div class="card-header text-center">
                            <h3 class='m-0 text-white' id="frmTitulo">Registrar un Nuevo Usuario</h3>
                        </div>
                        <div class="card-body">
                            <form id="frmUsuario" class="container-fluid">
                                <div class="form-row">
                                    <x-adminlte-input name="id" id="frm_id" type="number" hidden />
                                    <x-adminlte-input name="name" id="frm_name" fgroup-class="col-12 col-lg-6 col-xl-4"
                                        label="Nombres" type="text" placeholder="Nombres" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-spell-check"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="last_name" id="frm_last_name"
                                        fgroup-class="col-12 col-lg-6 col-xl-4" label="Apellidos" type="text"
                                        placeholder="Apellidos" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-spell-check"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="celular" id="frm_celular"
                                        fgroup-class="col-12 col-lg-6 col-xl-4" label="Celular" type="number"
                                        placeholder="Celular" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="email" id="frm_email" fgroup-class="col-12 col-lg-6 col-xl-4"
                                        label="Correo" type="email" placeholder="Correo" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="password" id="frm_password"
                                        fgroup-class="col-12 col-lg-4 col-xl-4" label="Contraseña" type="password"
                                        placeholder="Contraseña" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-key"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-input name="dni" id="frm_dni" fgroup-class="col-12 col-lg-4 col-xl-4"
                                        min="0" label="DNI" type="number" placeholder="DNI" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-id-card"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input>
                                    <x-adminlte-select2 name="genero_id" id="frm_genero_id"
                                        fgroup-class="col-12 col-lg-4 col-xl-4" label="Genero" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-venus-mars"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="estado_del_usuario_id" id="frm_estado_del_usuario_id"
                                        fgroup-class="col-12 col-lg-6 col-xl-4" label="Estado del Usuario"
                                        label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-select2 name="role_id" id="frm_role_id"
                                        fgroup-class="col-12 col-lg-6 col-xl-4" label="Rol" label-class="text-lightblue">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-user-tag"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-select2>
                                    <x-adminlte-input-file name="imagen" id="frm_imagen" fgroup-class="col-12 col-xl-6"
                                        label="Foto" placeholder="Escoja una imagen" label-class="text-lightblue"
                                        legend="Buscar">
                                        <x-slot name="prependSlot">
                                            <div class="input-group-text bg-lightblue">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        </x-slot>
                                    </x-adminlte-input-file>
                                    <div class="form-group col-12 col-xl-6">
                                        <label class="text-lightblue"> Opciones </label>
                                        <div class="container-fluid" id="opcionesRegistrarUsuario">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnRegistrarUsuario"
                                                        type="button" label="Registrar" theme="primary"
                                                        icon="fas fa-lg fa-save" />
                                                </div>
                                                <div class="col">
                                                    <x-adminlte-button class="ml-1 btn-block" type="button" label="Limpiar"
                                                        id="btnLimpiarForm" theme="secondary" icon="fas fa-lg fa-broom" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid d-none" id="opcionesEditarUsuario">
                                            <div class="input-group row">
                                                <div class="col">
                                                    <x-adminlte-button class="mr-1 btn-block" id="btnEditarUsuario"
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
                        $heads = [['label' => 'Acciones', 'no-export' => true, 'width' => 5], 'Nombres', 'Apellidos', 'Estado de Usuario', 'Rol', 'DNI', 'Fecha de Registro'];
                    @endphp
                    <div class="container-fluid">
                        <x-adminlte-datatable id='tblUsuarios' :heads='$heads' head-theme='dark' striped hoverable beautify
                            bordered compressed with-footer footer-theme='dark' />
                    </div>

                    <x-adminlte-modal id="modalDetallesUsuario" title="Datos del Usuario" size="lg" theme="info"
                        icon="fas fa-bell" v-centered static-backdrop scrollable>
                        <form id="frmDetallesUsuario" class="container-fluid">
                            <div class="row">
                                <x-adminlte-input name="modal_name" fgroup-class="col-12 col-xl-6" label="Nombres"
                                    type="text" placeholder="Nombres" label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="modal_last_name" fgroup-class="col-12 col-xl-6" label="Apellidos"
                                    type="text" placeholder="Apellidos" label-class="text-lightblue" disabled>
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-lightblue">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <div class="col-12 col-lg-6">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <x-adminlte-input name="modal_email" fgroup-class="col-12 col-xl-12"
                                                label="Correo" type="text" placeholder="Correo" label-class="text-lightblue"
                                                disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="modal_celular" fgroup-class="col-12 col-xl-6"
                                                label="Celular" type="text" placeholder="Celular"
                                                label-class="text-lightblue" disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-hashtag"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="modal_dni" fgroup-class="col-12 col-xl-6" label="DNI"
                                                type="text" placeholder="DNI" label-class="text-lightblue" disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-hashtag"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="modal_estado_del_usuario" fgroup-class="col-12 col-xl-6"
                                                label="Estado del Usuario" type="text" label-class="text-lightblue"
                                                disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="modal_genero" fgroup-class="col-12 col-xl-6"
                                                label="Genero" type="text" label-class="text-lightblue" disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                </x-slot>
                                            </x-adminlte-input>
                                            <x-adminlte-input name="modal_rol" fgroup-class="col-12 col-xl-12" label="Rol"
                                                type="text" label-class="text-lightblue" disabled>
                                                <x-slot name="prependSlot">
                                                    <div class="input-group-text bg-lightblue">
                                                        <i class="fas fa-user"></i>
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
                                                <img src="" class="img-fluid rounded" alt="Foto Usuario" id="modal_imagen">
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
            registrar: "{{ route('usuario.store') }}",
            actualizar: "{{ route('usuario.update', '#') }}",
            datatable: "{{ route('datatable.usuario.usuarios') }}",
            select2: "{{ route('select2.select2') }}",
        }
    </script>
    <script src="{{ asset('js/configuracion.js') }}"></script>
    <script src="{{ asset('js/usuarios.js') }}"></script>
@stop
