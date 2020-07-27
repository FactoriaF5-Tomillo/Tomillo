@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card-header">
            <a href="{{Route('student.create')}}" class="btn btn-primary">Añadir Alumno</a>
        </div>
        <div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                    <td><a href="{{Route('student.show', $student->id)}}">{{$student->name}}</a></td>
                    <td><a href="{{Route('student.edit', $student->id)}}" class="btn btn-success">Modificar</a></td>
                    <td>
                    <form action="{{Route('student.destroy', $student->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Borrar" class = "btn btn-danger">
                    </form>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
    <div class="card-footer">

    </div>
</div>
@endsection
