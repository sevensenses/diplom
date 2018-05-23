<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use App\QuestionStatus;

class CategoryQuestionController extends Controller
{

    public function index($categoryId) {
    	return view('admin.questions.index', [
    		'pagetitle' => 'Список вопросов',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'questions' =>  Question::with(['status','category'])->where('category_id', $categoryId)->get(),
    	]);
    }

    public function new($categoryId) {
        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'menu' => collect($this->makeMenu()),
            'breadcrumbs' => collect($this->makeBreadCrumbs()),
            'questions' =>  Question::with(['status','category'])->where('category_id', $categoryId)->new()->get(),
        ]);
    }

    public function hidden($categoryId) {
        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'menu' => collect($this->makeMenu()),
            'breadcrumbs' => collect($this->makeBreadCrumbs()),
            'questions' =>  Question::with(['status','category'])->where('category_id', $categoryId)->hidden()->get(),
        ]);
    }

    public function published($categoryId) {
        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'menu' => collect($this->makeMenu()),
            'breadcrumbs' => collect($this->makeBreadCrumbs()),
            'questions' =>  Question::with(['status','category'])->where('category_id', $categoryId)->published()->get(),
        ]);
    }

    protected function makeBreadCrumbs() {
    	$breadcrumbs = parent::makeBreadCrumbs();

    	$breadcrumbs[] = ['name' => 'Вопросы','url' => route('admin.questions.index')];

    	return $breadcrumbs;
    }

}