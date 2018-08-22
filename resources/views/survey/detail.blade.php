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
            <div class="collapsible-header">{{ $question->title }} <a href="/question/{{ $question->id }}/edit" style="float:right;">Edit</a></div>
            <div class="collapsible-body">
              <div class="collapsible-qdetails">
                  {!! Form::open() !!}
                    @if($question->question_type === 'text')
                      {{ Form::text('title')}}
                    @elseif($question->question_type === 'textarea')
                    <div class="row">
                      <div class="input-field col s12">
                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Provide answer</label>
                      </div>
                    </div>
                    @elseif($question->question_type === 'date')
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="datepicker" class="materialize-input js-datepicker">
                        <label for="datepicker">Provide answer</label>
                      </div>
                    </div>
                    @elseif($question->question_type === 'number')
                    <div class="row">
                      <div class="input-field col s12">
                        <input id="number" type="number" class="materialize-input">
                        <label for="number">Provide answer</label>
                      </div>
                    </div>
                    @elseif($question->question_type === 'radio')
                      @foreach($question->option_name as $key=>$value)
                        <p >
                          <input type="radio" id="{{ $key }}" />
                          <label for="{{ $key }}">{{ $value }}</label>
                        </p>
                      @endforeach
                    @elseif($question->question_type === 'select')
                      @foreach($question->option_name as $key=>$value)
                        <select >
                          <option value="{{ $key }}">{{ $value }}</option>
                        </select>
                      @endforeach
                    @elseif($question->question_type === 'checkbox')
                      @foreach($question->option_name as $key=>$value)
                      <p >
                        <label for="{{$key}}">
                          <input type="checkbox" id="{{ $key }}" />
                          <span>{{ $value }}</span>
                        </label>
                        
                      </p>
                      @endforeach
                    @endif
                    
                  {!! Form::close() !!}
              </div>
            </div>
          </li>
          @empty
            <span style="padding:10px;">Nothing to show. Add questions below.</span>
          @endforelse
      </ul>
      <h2 class="flow-text">Add Question</h2>
      <form method="POST" action="{{ $survey->id }}/questions" id="boolean">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="input-field col s12">
            <select class="browser-default" name="question_type" id="question_type">
              <option value="text" disabled selected>Choose your option</option>
              <option value="text">Text</option>
              <option value="number">Number</option>
              <option value="textarea">Textarea</option>
              <option value="checkbox">Checkbox</option>
              <option value="radio">Radio Buttons</option>
              <option value="select">Dropdown</option>
              <option value="date">Date</option>
            </select>
          </div>                
          <div class="input-field col s12">
            <input name="title" id="title" type="text">
            <label for="title">Question</label>
          </div>  
          <div class="row">
            <label><input type="checkbox" value="1" name="is_mandatory"><span>Is mandatory?</span></label>
          </div>
          <!-- this part will be chewed by script in init.js -->
          <span class="form-g"></span>

          <div class="input-field col s12">
          <button class="btn waves-effect waves-light">Submit</button>
          </div>
        </div>
        </form>
    </div>
  </div>
@stop