@extends('layouts.dashboard')

@section('content')
    <teacher-show :teacher='@json($user)'></teacher-show>
@endsection
