<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
	protected $fillable = ['title', 'description', 'user_id'];
	protected $dates = ['deleted_at'];
	//preventing the Eloquent Model from using 'surveys' instead of 'survey'
	protected $table = 'survey';

	public function questions() {
		return $this->hasMany(Question::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function answers() {
		return $this->hasMany(Answer::class);
	}
}
