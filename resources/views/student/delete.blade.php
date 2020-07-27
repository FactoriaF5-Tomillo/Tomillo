@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">Nuevo</div>
        <div class="card-body">
            <form action="{{Route('book.destroy')}}" method="POST">
                @csrf
                @method('delete')
            
            </div>
                <div class="card-footer">
                <input type="submit" value="Crear" class = "btn btn-primary">
            </div>
        </form>
</div>
@endsection