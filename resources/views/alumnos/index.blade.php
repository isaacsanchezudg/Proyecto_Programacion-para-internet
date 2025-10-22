@extends('layouts.app')

@section('title', 'Lista de Alumnos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Lista de Alumnos</h1>
            <a href="{{ route('alumnos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Alumno
            </a>
        </div>

        @if($alumnos->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Edad</th>
                            <th>Sexo</th>
                            <th>Carrera</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->codigo }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->correo }}</td>
                            <td>{{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->age }} años</td>
                            <td>
                                <span class="badge {{ $alumno->sexo == 'M' ? 'badge-masculino' : 'badge-femenino' }}">
                                    {{ $alumno->sexo == 'M' ? 'Masculino' : 'Femenino' }}
                                </span>
                            </td>
                            <td>{{ $alumno->carrera }}</td>
                            <td class="table-actions">
                                <a href="{{ route('alumnos.show', $alumno) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('¿Estás seguro de eliminar este alumno?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                <h4>No hay alumnos registrados</h4>
                <p>Comienza agregando el primer alumno al sistema.</p>
                <a href="{{ route('alumnos.create') }}" class="btn btn-primary">Agregar Primer Alumno</a>
            </div>
        @endif
    </div>
</div>
@endsection