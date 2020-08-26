@extends('layouts.dashboard')

@section('content')
<div>
    <div class="page-title">
        <h1>Añadir justificante</h1>
    </div>
    <form class="form" action="{{Route('justification.uploadFile')}}" method="post" enctype="multipart/form-data"> <!-- enctype para subir el logo -->
        @csrf
        <div class="form-group">
            <label>Descripción</label>
            <textarea type="text" name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group" >
            <label>Adjunta documento:</label><br>
            <input class="" type="file" name="file">
        </div>
        <div class="form-submit">
            <a href="/home" class="list-actions">&#8592; Volver</a>
            <button class="btn primary-button" type="submit">Subir</button>
        </div>
    </form>
</div>
    <!-- <justification-create></justification-create> -->
@endsection



