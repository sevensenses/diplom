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

    public function scopeNew($query) {
    	return $query->where('status_id', QuestionStatus::STATUS_NEW);
    }

    public function scopeHidden($query) {
    	return $query->where('status_id', QuestionStatus::STATUS_HIDDEN);
    }

    public function scopePublished($query) {
    	return $query->where('status_id', QuestionStatus::STATUS_PUBLISHED);
    }

    public function isNew() {
        return $this->status_id == QuestionStatus::STATUS_NEW;
    }

    public function isHidden() {
        return $this->status_id == QuestionStatus::STATUS_HIDDEN;
    }

    public function isPublished() {
        return $this->status_id == QuestionStatus::STATUS_PUBLISHED;
    }

    public function correctStatus() {
        if(empty($this->answer)) {
            $this->status_id = QuestionStatus::STATUS_NEW;
        } elseif(!$this->isHidden()) {
            $this->status_id = QuestionStatus::STATUS_PUBLISHED;
        }
    }
}
