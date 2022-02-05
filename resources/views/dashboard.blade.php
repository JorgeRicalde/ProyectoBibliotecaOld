@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class='m-0 text-white'>Dashboard</h1>
@stop

@section('content')
    <div class='row'>
        <div class='col-12'>
            <div class='card'>
                <div class='card-body'>
                    <div class="row">
                        @can('usuario.index')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Usuarios" text="Administrar los Usuarios"
                                    icon="fas fa-user-plus text-light" theme="primary" url="{{ route('usuario.index') }}"
                                    url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('libro.index')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Libro" text="Administrar los Libro" icon="fas fa-book text-light"
                                    theme="primary" url="{{ route('libro.index') }}" url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('prestamo.index')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Prestamos" text="Administrar los Prestamos"
                                    icon="fas fa-tasks text-light" theme="primary" url="{{ route('prestamo.index') }}"
                                    url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('sancion.index')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Sanciones" text="Administrar los Sanciones"
                                    icon="fas fa-user-slash text-light" theme="primary" url="{{ route('sancion.index') }}"
                                    url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('libro.buscar')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Buscar Libros" text="Buscar Libros de la Biblioteca"
                                    icon="fas fa-search text-light" theme="primary" url="{{ route('libro.buscar') }}"
                                    url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('reservacion.index')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Mis Reservas" text="Realizar Reservas y Ver mi Historial"
                                    icon="fas fa-business-time text-light" theme="primary"
                                    url="{{ route('reservacion.index') }}" url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('prestamo.reporte')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Reporte de Prestamo"
                                    text="Ver todos los Prestamos por año y Trimestre" icon="fas fa-fw fa-table text-light"
                                    theme="primary" url="{{ route('prestamo.reporte') }}" url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('sancion.reporte')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Reporte de Sanciones" text="Ver las sanciones por año y Trimestre"
                                    icon="fas fa-fw fa-table text-light" theme="primary" url="{{ route('sancion.reporte') }}"
                                    url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('sancion.historial')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Mis Sanciones" text="Ver mi historial de sanciones"
                                    icon="fas fa-history text-light" theme="primary" url="{{ route('sancion.historial') }}"
                                    url-text="Ir a la pagina " />
                            </div>
                        @endcan
                        @can('prestamo.historial')
                            <div class="col-12 col-lg-6">
                                <x-adminlte-small-box title="Mis Prestamos" text="Ver mi historial de prestamos"
                                    icon="fas fa-history text-light" theme="primary" url="{{ route('prestamo.historial') }}"
                                    url-text="Ir a la pagina " />
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/configuracion.js') }}"></script>
@stop
