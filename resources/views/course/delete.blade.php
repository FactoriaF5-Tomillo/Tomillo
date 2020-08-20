@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card-header">Nuevo</div>
        <div class="card-body">
            <form action="{{Route('course.destroy')}}" method="POST">
                @csrf
                @method('delete')

            </div>
                <div class="card-footer">
                <input type="submit" value="Crear" class = "btn primary-button">
            </div>
        </form>
</div>
@endsection
