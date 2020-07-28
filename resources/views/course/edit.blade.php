@extends('layouts.app')

@section('content')
<course-edit :course='@json($course)'></course-edit>
@endsection
