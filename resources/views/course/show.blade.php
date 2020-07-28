@extends('layouts.app')

@section('content')
<course-show :course='@json($course)'></course-show>
@endsection
