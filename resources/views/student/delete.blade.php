@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">Nuevo</div>
        <div class="card-body">
            <form action="{{Route('book.destroy')}}" method="POST">
                @csrf
                @method('delete')

            </form>
    </div>
</div>
@endsection
