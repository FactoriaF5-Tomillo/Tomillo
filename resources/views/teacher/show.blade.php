@extends('layouts.dashboard')

@section('content')
    <teacher-show :teacher='@json($teacher)'></teacher-show>
@endsection
