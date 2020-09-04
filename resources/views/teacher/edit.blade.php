@extends('layouts.dashboard')
@section('content')
<teacher-edit :teacher='@json($user)'></teacher-edit>
@endsection
