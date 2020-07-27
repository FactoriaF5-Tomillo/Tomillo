@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">Nuevo</div>
        <div class="card-body">
            <form action="{{Route('course.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="title" class="form-control" value="{{}}" required>
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de inizialización</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Fecha de finalización</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="Crear" class = "btn btn-primary">
                </div>
        </form>
</div>
@endsection
