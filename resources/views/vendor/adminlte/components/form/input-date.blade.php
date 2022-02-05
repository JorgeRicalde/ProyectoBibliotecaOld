@extends('adminlte::components.form.input-group-component')

@section('input_group_item')

    {{-- Input Date --}}
    <input id="{{ $id }}" name="{{ $name }}" data-target="#{{ $id }}"
        data-toggle="datetimepicker" {{ $attributes->merge(['class' => $makeItemClass()]) }}>

@overwrite
