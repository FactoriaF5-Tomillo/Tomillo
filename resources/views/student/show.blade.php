@extends('layouts.dashboard')

@section('content')
<student-show :student='@json($student)'></student-show>
@endsection
