@extends('layouts.dashboard')

@section('content')
<course-students :course='@json($course)'></course-students>
@endsection