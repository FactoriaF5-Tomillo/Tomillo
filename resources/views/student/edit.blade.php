@extends('layouts.dashboard')

@section('content')
    <student-edit :student='@json($user)'></student-edit>
@endsection
