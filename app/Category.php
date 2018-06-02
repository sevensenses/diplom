<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name','active'];

	protected $hidden = ['created_at','updated_at'];

    public function questions() {
    	return $this->hasMany('App\Question');
    }

    public function newQuestions() {
    	return $this->hasMany('App\Question')->new();
    }

    public function hiddenQuestions() {
    	return $this->hasMany('App\Question')->hidden();
    }

    public function publishedQuestions() {
    	return $this->hasMany('App\Question')->published();
    }

    public function scopeActive($query) {
        return $query->where('active', true);
    }
}
