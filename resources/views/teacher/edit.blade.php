@extends('layouts.dashboard')
@section('content')
<teacher-edit :user='@json($user)'></teacher-edit>
@endsection
