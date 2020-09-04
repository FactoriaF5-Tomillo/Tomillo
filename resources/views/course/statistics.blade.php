@extends('layouts.dashboard')

@section('content')
<course-statistics :course='@json($course)'></course-statistics>
@endsection
