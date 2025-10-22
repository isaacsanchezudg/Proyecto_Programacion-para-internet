@extends('layouts.app')

@section('title', 'Mis Tareas')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Mis Tareas</h1>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nueva Tarea</a>
        </div>

        @if($tasks->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Fecha Vencimiento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : 'Sin fecha' }}</td>
                            <td>
                                <span class="badge 
                                    @if($task->status == 'completada') bg-success
                                    @elseif($task->status == 'en_progreso') bg-warning
                                    @else bg-secondary @endif">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                No tienes tareas creadas. <a href="{{ route('tasks.create') }}">Crea tu primera tarea</a>.
            </div>
        @endif
    </div>
</div>
@endsection