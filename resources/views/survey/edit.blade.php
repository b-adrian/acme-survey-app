@extends('layout')

@section('content')
@if($survey->nb_answers == 0) 
  <div>This survey cannot be edited.</div>
@else
  <form method="POST" action="/survey/{{ $survey->id }}/update">
    {{ method_field('PATCH') }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <h2 class="flow-text">Edit Survey</h2>
     <div class="row">
      <div class="input-field col s12">
        <input type="text" name="title" id="title" value="{{ $survey->title }}">
        <label for="title">Question</label>
      </div>
      <div class="input-field col s12">
        <textarea id="description" name="description" class="materialize-textarea">{{ $survey->description }}</textarea>
        <label for="description">Description</label>
      </div>
      <div class="input-field col s12">
      <button class="btn waves-effect waves-light">Update</button>
      </div>
    </div>
  </form>
@endif

@stop