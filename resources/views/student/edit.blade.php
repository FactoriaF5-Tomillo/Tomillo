@extends('layouts.dashboard')

@section('content')
    <student-edit :user='@json($user)'></student-edit>
@endsection
