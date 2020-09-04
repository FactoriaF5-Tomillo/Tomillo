@extends('layouts.dashboard')

@section('content')
<course-edit :course='@json($course)'></course-edit>
@endsection
