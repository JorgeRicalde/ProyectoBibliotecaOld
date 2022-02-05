@extends('adminlte::master')

@php($dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home'))

@if (config('adminlte.use_route_url', false))
    @php($dashboard_url = $dashboard_url ? route($dashboard_url) : '')
@else
    @php($dashboard_url = $dashboard_url ? url($dashboard_url) : '')
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body'){{ ($auth_type ?? 'login') . '-page dark-mode' }}@stop
@section('body')
    <div class="container card px-xl-5 py-xl-5" style="background-color: rgba(52, 58, 64, 0.8)">
        <div class="row ">
            <div class="col-12 col-md-6 align-self-center">
                <div class="d-none d-md-flex ">
                    <img src="../img/libros-biblioteca-620x413.jpg" class="img-fluid img-thumbnail">
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <div class="{{ $auth_type ?? 'login' }}-box ">
                    {{-- Logo --}}
                    <div class=" {{ $auth_type ?? 'login' }}-logo ">
                        <a href="{{ $dashboard_url }}" class="badge badge-light text-dark">
                            <img src="{{ asset(config('adminlte.logo_img')) }}" height="50">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                    </div>

                    {{-- Card Box --}}
                    <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}">

                        {{-- Card Header --}}
                        @hasSection('auth_header')
                            <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                                <h3 class="card-title float-none text-center">
                                    @yield('auth_header')
                                </h3>
                            </div>
                        @endif

                        {{-- Card Body --}}
                        <div
                            class="card-body {{ $auth_type ?? 'login' }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                            @yield('auth_body')
                        </div>

                        {{-- Card Footer --}}
                        @hasSection('auth_footer')
                            <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                                @yield('auth_footer')
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@stop


@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
