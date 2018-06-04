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

    public function scopeWithOnlyPublishedQuestions($query) {
    	return $query->whereHas('questions', function ($query) {
    		return $query->published();
    	});
    }

    public function scopeActive($query) {
        return $query->where('active', true);
    }
}
