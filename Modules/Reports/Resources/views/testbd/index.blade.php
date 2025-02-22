@extends('layouts.app')

@section('title', 'Reporte Test B&D')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Reporte Test B&D</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:reports.testbd-report :machines="\Modules\Informat\Entities\Machine::all()"/>
    </div>
@endsection