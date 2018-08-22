@extends('layout')

@section('content')
  <div class="card">
      <div class="card-content">
      <span class="card-title"> {{ $survey->title }}</span>
      <p>
        {{ $survey->description }}
      </p>
      <br/>
      <a href='view/{{$survey->id}}'>Take Survey</a> |
      @if($survey->nb_answers == 0) 
        <a href="{{$survey->id}}/edit">Edit Survey</a> |
      @endif 
      <a href="/survey/answers/{{$survey->id}}">View Answers</a> 
      @if($survey->nb_answers == 0) 
        <a href="#doDelete" class="right modal-trigger red-text">Delete Survey</a>
      @endif 
      <div id="doDelete" class="modal bottom-sheet">
        <div class="modal-content">
          <div class="container">
            <div class="row">
              <h4>Are you sure?</h4>
              <p>Do you wish to delete this survey called "{{ $survey->title }}"?</p>
              <div class="modal-footer">
                <a href="/survey/{{ $survey->id }}/delete" class=" modal-action waves-effect waves-light btn-flat red-text">Yep yep!</a>
                <a class=" modal-action modal-close waves-effect waves-light green white-text btn">No, stop!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="divider before-form-el"></div>
      <p class="flow-text center-align">Questions</p>
      <ul class="collapsible" data-collapsible="expandable">
          @forelse ($survey->questions as $question)
          <li style="box-shadow:none;">
            <div class="collapsible-header" data-question-id="{{ $question->id }}"><span>{{$question->is_mandatory == '1' ? '*' : ''}}</span><span class="js-title-edit editable-text title-edit">{{ $question->title }}</span><span class="js-field-edit editable-text field-edit"> ({{ ucfirst($question->question_type) }})</span></div>
            @if($survey->nb_answers == 0) 
            <div class="collapsible-body">
              @include('survey.qdetails', ['question' => $question])
            </div>
            @endif 
            
          </li>
          @empty
            <span style="padding:10px;">Nothing to show. Add questions below.</span>
          @endforelse
      </ul>
      @if($survey->nb_answers == 0)
      <h2 class="flow-text">Add Question</h2>
      <form method="POST" action="{{ $survey->id }}/questions" id="boolean">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          @include('survey.qdetails', ['editable' => '0'])

          <div class="input-field col s12">
          <button class="btn waves-effect waves-light">Submit</button>
          </div>
        </div>
      </form>
      @else
        @include('answer.list')
      @endif
    </div>
  </div>
@stop