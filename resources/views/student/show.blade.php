@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card-header">
            <h1>Datos Del Alumno</h1>
        </div>
        <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Nacionalidad</th>
                    <th scope="col">Email</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Curso Actual</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{$student->name}}</td>
                        <td>{{$student->surname}}</td>
                        <td>{{$student->nationality}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->gender}}</td>
                        <td>{{$student->currentcourse}}</td>
                    </tr>
            </tbody>
        </table>
        <a href="{{Route('student.index')}}" class="btn btn-secondary">Volver</a>
    </div>
</div>
@endsection
