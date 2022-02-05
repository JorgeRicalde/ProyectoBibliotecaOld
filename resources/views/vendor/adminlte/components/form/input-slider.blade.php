@extends('adminlte::components.form.input-group-component')

@section('input_group_item')

    {{-- Input Slider --}}
    <input id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => $makeItemClass()]) }}>

@overwrite

@push('css')
    <style type="text/css">
        {{-- Setup plugin color --}} @isset($color) #{{ $config['id'] }} .slider-handle {
                background: {{ $color }};
            }

            #{{ $config['id'] }} .slider-selection {
                background: {{ $color }};
                opacity: 0.5;
            }

            #{{ $config['id'] }} .slider-tick.in-selection {
                background: {{ $color }};
                opacity: 0.9;
            }

            @endisset {{-- Set flex property when using addons slots --}} @if (isset($appendSlot) || isset($prependSlot))#{{ $config['id'] }} {
                flex: 1 1 0;
                align-self: center;
                @isset($appendSlot) margin-right: 5px;
                    @endisset @isset($prependSlot) margin-left: 5px;
                @endisset
            }

            @endif

        </style>
    @endpush

    @once
        @push('css')
            <style type="text/css">
                .adminlte-invalid-islgroup .slider-track,
                .adminlte-invalid-islgroup>.input-group-prepend>*,
                .adminlte-invalid-islgroup>.input-group-append>* {
                    box-shadow: 0 .25rem 0.5rem rgba(255, 0, 0, .25);
                }

                .adminlte-invalid-islgroup .slider-vertical {
                    margin-bottom: 1rem;
                }

            </style>
        @endpush
    @endonce
