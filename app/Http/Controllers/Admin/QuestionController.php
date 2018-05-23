<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use App\QuestionStatus;

class QuestionController extends Controller
{

    public function index() {
    	return view('admin.questions.index', [
    		'pagetitle' => 'Список вопросов',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'questions' =>  Question::with(['status','category'])->get(),
    	]);
    }

    public function create() {
    	return view('admin.questions.create', [
    		'pagetitle' => 'Создать вопрос',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'categories' => Category::pluck('name', 'id'),
            'statuses' => QuestionStatus::pluck('name', 'id'),
    	]);
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'question' => 'required|min:10',
    		'category_id' => 'required|exists:categories,id',
            'user_name' => 'required|min:3',
            'user_email' => 'required|email',
    		'status_id' => 'required|exists:question_statuses,id',
    	]);

    	if(empty($request->input('answer', null))) {
    		$request->merge(['status_id' => QuestionStatus::STATUS_NEW]);
    	} elseif($request->input('status_id', QuestionStatus::STATUS_NEW) != QuestionStatus::STATUS_HIDDEN) {
    		$request->merge(['status_id' => QuestionStatus::STATUS_PUBLISHED]);
    	}

    	$question = Question::create($request->all());

    	return redirect()->route('admin.questions.edit', $question->id)
    		->with('success', 'Вопрос успешно создан');
    }

    public function edit($id) {
    	return view('admin.questions.edit', [
    		'pagetitle' => 'Редактировать вопрос',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
            'question' => Question::findOrFail($id),
            'categories' => Category::pluck('name', 'id'),
            'statuses' => QuestionStatus::pluck('name', 'id'),
    	]);
    }

    public function update(Request $request, $id) {
    	$question = Question::findOrFail($id);

    	$this->validate($request, [
    		'question' => 'required|min:10',
    		'category_id' => 'required|exists:categories,id',
            'user_name' => 'required|min:3',
            'user_email' => 'required|email',
    		'status_id' => 'required|exists:question_statuses,id',
    	]);

    	if(empty($request->input('answer', null))) {
    		$request->merge(['status_id' => QuestionStatus::STATUS_NEW]);
    	} elseif($request->input('status_id', QuestionStatus::STATUS_NEW) != QuestionStatus::STATUS_HIDDEN) {
    		$request->merge(['status_id' => QuestionStatus::STATUS_PUBLISHED]);
    	}

    	$question->fill($request->all());
    	$question->save();

    	return redirect()->route('admin.questions.edit', $id)
    		->with('success', 'Вопрос успешно изменен');
    }

    public function destroy($id) {
    	Question::destroy($id);

    	return redirect()->back();
    }

    protected function makeBreadCrumbs() {
    	$breadcrumbs = parent::makeBreadCrumbs();

    	$breadcrumbs[] = ['name' => 'Вопросы','url' => route('admin.questions.index')];

    	return $breadcrumbs;
    }

}