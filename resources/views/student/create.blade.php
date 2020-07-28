@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card-header">Nuevo</div>
        <div class="card-body">
            <form action="{{Route('student.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="surname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nacionalidad</label>
                        <input type="text" name="nationality" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Sexo</label>
                        <input type="text" name="gender" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Curso Actual</label>
                        <input type="text" name="currentcourse" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Crear" class = "btn btn-primary">
                </div>
        </form>
</div>
@endsection
