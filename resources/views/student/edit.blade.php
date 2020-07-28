@extends('layouts.app')

@section('content')
    <student-edit :student='@json($student)'></student-edit>
@endsection
