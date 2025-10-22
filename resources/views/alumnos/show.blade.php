@extends('layouts.app')

@section('title', 'Detalle del Alumno')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Detalle del Alumno</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Código:</div>
                    <div class="col-md-8">{{ $alumno->codigo }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Nombre:</div>
                    <div class="col-md-8">{{ $alumno->nombre }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Correo:</div>
                    <div class="col-md-8">{{ $alumno->correo }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Fecha de Nacimiento:</div>
                    <div class="col-md-8">{{ $alumno->fecha_nacimiento->format('d/m/Y') }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Edad:</div>
                    <div class="col-md-8">{{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->age }} años</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Sexo:</div>
                    <div class="col-md-8">
                        <span class="badge {{ $alumno->sexo == 'M' ? 'badge-masculino' : 'badge-femenino' }}">
                            {{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Carrera:</div>
                    <div class="col-md-8">{{ $alumno->carrera }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Fecha de Registro:</div>
                    <div class="col-md-8">{{ $alumno->created_at->format('d/m/Y H:i') }}</div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-warning me-md-2">Editar</a>
                    <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                            onclick="return confirm('¿Estás seguro de eliminar este alumno?')">
                            Eliminar
                        </button>
                    </form>
                    <a href="{{ route('alumnos.index') }}" class="btn btn-secondary ms-md-2">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection