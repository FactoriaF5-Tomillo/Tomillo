@extends('layouts.dashboard')

@section('content')
    <student-show :student='@json($user)'></student-show>
@endsection
