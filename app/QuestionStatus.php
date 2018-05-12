<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionStatus extends Model
{
    public const STATUS_NEW = 1;
    public const STATUS_PUBLISHED = 2;
    public const STATUS_HIDDEN = 3;

    protected $fillable = ['name'];

	protected $hidden = ['created_at','updated_at'];

    public function questions() {
    	return $this->hasMany('App\Question');
    }
}
