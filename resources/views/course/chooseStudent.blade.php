@extends('layouts.dashboard')

@section('content')
<choose-student :course='@json($course)'></choose-student>
@endsection
