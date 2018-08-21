@extends('layout')

@section('content')
  <div class="card">
      <div class="card-content">
      <span class="card-title"> Start taking Survey</span>
      <p>
        <span class="flow-text">{{ $survey->title }}</span> <br/>
      </p>
      <p>  
        {{ $survey->description }}
        <br/>Created by: <a href="">{{ $survey->user->name }}</a>
      </p>
      <div class="divider before-form-el"></div>
          {!! Form::open(array('action'=>array('AnswerController@store', $survey->id))) !!}
          @forelse ($survey->questions as $key=>$question)
            <p class="flow-text">Question {{ $key+1 }} - {{ $question->title }}</p>
                @if($question->question_type === 'text')
                  <div class="input-field col s12">
                    <input id="answer" type="text" name="{{ $question->id }}[answer]" {{ $question->is_mandatory == '1' ? 'required': '' }} >
                    <label for="answer">Answer</label>
                  </div>
                  @elseif($question->question_type === 'date')
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="datepicker" name="{{ $question->id }}[answer]" class="js-datepicker">
                      <label for="datepicker">Answer</label>
                    </div>
                  </div>
                @elseif($question->question_type === 'textarea')
                  <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea" name="{{ $question->id }}[answer]" {{ $question->is_mandatory == '1' ? 'required': '' }}></textarea>
                    <label for="textarea1">Textarea</label>
                  </div>
                @elseif($question->question_type === 'radio')
                  @foreach($question->option_name as $key=>$value)
                    <p >
                      <label>
                      <input class="browser-default" value="{{ $value }}" name="{{ $question->id }}[answer]" type="radio" id="{{ $key }}" />
                      <span>{{ $value }}</span>
                      </label>
                    </p>
                  @endforeach
                @elseif($question->question_type === 'select')
                  
                    <select class="browser-default" name="{{ $question->id }}[answer]" >
                      @foreach($question->option_name as $key=>$value)
                        <option value="{{ $value }}">{{ $value }}</option>
                      @endforeach
                    </select>
                  
                @elseif($question->question_type === 'checkbox')
                  @foreach($question->option_name as $key=>$value)
                  <p >
                    <input type="checkbox" id="checkboxes{{ $key }}" value="{{ $value }}" name="{{ $question->id }}[answer]" />
                    <label for="checkboxes{{$key}}">{{ $value }}</label>
                  </p>
                  @endforeach
                @endif 
              <div class="divider after-form-el"></div>
          @empty
            <span class='flow-text center-align'>Nothing to show</span>
          @endforelse
        <button class="btn waves-effect waves-light">Submit Survey</button>
        {!! Form::close() !!}
    </div>
  </div>
@stop