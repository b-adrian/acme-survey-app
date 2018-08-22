<div class="input-field col s12 qd-subview-container" data-question-id="{{ $question->id }}">
  <select class="browser-default js-question-type" name="question_type">
    @if(!isset($editable))
      <option value="text" disabled selected>Choose your option</option>
    @endif
    <option value="text" {{!isset($editable) && $question->question_type == 'text' ? 'selected' : ''}}>Text</option>
    <option value="number" {{!isset($editable) && $question->question_type == 'number' ? 'selected' : ''}}>Number</option>
    <option value="textarea" {{!isset($editable) && $question->question_type == 'textarea' ? 'selected' : ''}}>Textarea</option>
    <option value="checkbox" {{!isset($editable) && $question->question_type == 'checkbox' ? 'selected' : ''}}>Checkbox</option>
    <option value="radio" {{!isset($editable) && $question->question_type == 'radio' ? 'selected' : ''}}>Radio Buttons</option>
    <option value="select" {{!isset($editable) && $question->question_type == 'select' ? 'selected' : ''}}>Dropdown</option>
    <option value="date" {{!isset($editable) && $question->question_type == 'date' ? 'selected' : ''}}>Date</option>
  </select>
</div>                
<div class="input-field col s12">
  <input name="title" id="title" class="js-title" type="text" value="{{ !isset($editable) ? $question->title : '' }}">
  <label for="title">Question</label>
</div>  
<div class="row">
  <label><input type="checkbox" value="1" class="js-is-mandatory" name="is_mandatory" {{!isset($editable) && $question->is_mandatory == '1' ? 'checked' : ''}}><span>Is mandatory?</span></label>
</div>
<!-- this part will be chewed by script in init.js -->
<span class="form-g">
  @if(!isset($editable) && (in_array($question->question_type, array('select', 'radio', 'checkbox'))))
    @foreach ($question->option_name as $option)
      <div class="input-field col input-g s12">
        <input name="option_name[]" id="option_name[]" type="text" value="{{ $option }}">
        <span style="float:right; cursor:pointer;"class="delete-option">Delete</span>
        <label for="option_name">Options</label>
        <span class="add-option" style="cursor:pointer;">Add Another</span>
      </div>
    @endforeach
  @endif
</span>

@if(!isset($editable))
  <button class="btn waves-effect waves-light js-edit-field">Update field</button>
@endif