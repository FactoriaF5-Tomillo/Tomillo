@extends('layouts.dashboard')

@section('content')
    <student-edit :student='@json($student)'></student-edit>
@endsection
