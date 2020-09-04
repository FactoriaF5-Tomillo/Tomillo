@extends('layouts.dashboard')

@section('content')
    <course-show :course='@json($course)'></course-show>
@endsection
