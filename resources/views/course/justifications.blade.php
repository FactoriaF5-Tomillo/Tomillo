@extends('layouts.dashboard')

@section('content')
<course-justifications :justifications='@json($justifications)'></course-justifications>
@endsection