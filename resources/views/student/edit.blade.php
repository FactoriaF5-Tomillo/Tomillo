@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">
        Actualizar Datos del Alumno
    </div>
    <div class="card-body">
        <form action="{{Route('student.update', $student->id)}}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{$student->name}}" required>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="surname" class="form-control" value="{{$student->surname}}" required>
                </div>
                <div class="form-group">
                    <label>Nacionalidad</label>
                    <input type="text" name="nationality" class="form-control" value="{{$student->nationality}}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{$student->email}}" required>
                </div>
                <div class="form-group">
                    <label>Sexo</label>
                    <input type="text" name="gender" class="form-control" value="{{$student->gender}}" required>
                </div>
                <div class="form-group">
                    <label>Curso Actual</label>
                    <input type="text" name="currentcourse" class="form-control" value="{{$student->currentcourse}}" required>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" value="Actualizar" class = "btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection
