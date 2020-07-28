@extends('layouts.dashboard')
@section('content')
<teacher-edit :teacher='@json($teacher)'></teacher-edit>
@endsection
