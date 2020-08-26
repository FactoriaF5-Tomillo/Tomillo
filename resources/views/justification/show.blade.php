@extends('layouts.dashboard')

@section('content')
    <justification-show :justification='@json($justification)'></justification-show>
@endsection
