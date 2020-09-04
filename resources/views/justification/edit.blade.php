@extends('layouts.dashboard')

@section('content')
    <justification-edit :justification='@json($justification)'></justification-edit>
@endsection
