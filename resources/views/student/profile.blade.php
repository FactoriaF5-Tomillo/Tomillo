@extends('layouts.profile')

@section('content')
    <student-profile :student='@json($user)'></student-profile>
@endsection