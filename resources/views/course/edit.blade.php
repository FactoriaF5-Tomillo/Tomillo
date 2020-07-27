@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">
        Actualizar Datos del Alumno
    </div>
        <div class="card-body">
            <form action="{{Route('course.update', $course->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="title" class="form-control" value="{{$course->title}}" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="description" class="form-control" value="{{$course->description}}" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de inicialización</label>
                        <input type="date" name="start_date" class="form-control" value="{{$course->start_date}}" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de finalización</label>
                        <input type="date" name="end_date" class="form-control" value="{{$course->end_date}}" required>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Actualizar" class = "btn btn-primary">
                </div>
            </form>
</div>
@endsection
