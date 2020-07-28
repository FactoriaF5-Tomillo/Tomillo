@extends('layouts.app')

@section('content')
<teacher-show :teacher='@json($teacher)'></teacher-show>
@endsection
