<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    public function store(Request $request, Survey $survey) 
    {
		$arr = $request->all();
		$arr['user_id'] = Auth::id();
        if($arr['title'] != 'null' && !empty($arr['title'])){
            $survey->questions()->create($arr);
        }		
		return back();
    }

    public function edit(Question $question) 
    {
		return view('question.edit', compact('question'));
    }

    public function update(Request $request, Question $question) 
    {

		$question->update($request->only(['title', 'question_type', 'is_mandatory', 'option_name']));
		echo json_encode(array(
            'title' => $question->title,
            'question_type' => $question->question_type,
            'is_mandatory' => $question->is_mandatory
        ));
    }

}
