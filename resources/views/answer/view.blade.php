@extends('layout')

@section('content')
<h4>{{ $survey->title }}</h4>
@include('answer.list')
@endsection
