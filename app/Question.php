<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = ['question','answer','category_id','user_email','user_name','status_id'];

	protected $hidden = ['created_at','updated_at'];

    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function status() {
    	return $this->belongsTo('App\QuestionStatus');
    }
}
