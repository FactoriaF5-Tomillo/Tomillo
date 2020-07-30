@extends('layouts.dashboard')

@section('content')
<course-add-teacher :course='@json($course)'></course-add-teacher>
@endsection
