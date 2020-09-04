@extends('layouts.dashboard')

@section('content')
<course-teachers :course='@json($course)'></course-teachers>
@endsection