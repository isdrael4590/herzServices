@extends('layouts.app')

@section('title', 'Reporte Descargas')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Reporte Descargas</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:reports.discharge-report />
    </div>
@endsection