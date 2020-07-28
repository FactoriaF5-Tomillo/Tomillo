@extends('layouts.app')

@section('content')
    <student-show :student='@json($student)'></student-show>
@endsection
