<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use App\QuestionStatus;

class QuestionController extends Controller
{

	public function __construct()
    {
        
    }

    public function list(Request $request) {
    	$tableHeaders = ['Вопрос','Категория','Статус','Дата создания'];
    	$tableRows = [];

    	$questions = Question::with(['status','category']);

    	if($request->has('status')) {
    		$questions->where('status_id', $request->input('status'));
    	}

    	if($request->has('category')) {
    		$questions->where('category_id', $request->input('category'));
    	}

    	foreach($questions->get() as $question) {
    		$tableRows[$question->id] = [
    			$question->question,
    			$question->category->name,
    			$question->status->name,
    			$question->created_at,
    		];
    	}

    	return view('admin.list', [
    		'pagetitle' => 'Список вопросов',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'question',
    		'tableHeaders' => $tableHeaders,
    		'tableRows' => $tableRows,
    	]);
    }

    public function createForm(Request $request) {
    	$fields = [
    		[
    			'name' => 'question',
    			'title' => 'Вопрос',
    		],
    		[
    			'type' => 'select',
    			'name' => 'category_id',
    			'title' => 'Категория',
    			'values' => Category::pluck('name', 'id'),
    		],
    		[
    			'name' => 'user_name',
    			'title' => 'Имя пользователя',
    		],
    		[
    			'name' => 'user_email',
    			'title' => 'E-mail пользователя',
    		],
    		[
    			'type' => 'select',
    			'name' => 'status_id',
    			'title' => 'Статус',
    			'values' => QuestionStatus::pluck('name', 'id'),
    		],
    		[
    			'type' => 'textarea',
    			'name' => 'answer',
    			'title' => 'Ответ',
    		],
    	];

    	return view('admin.create', [
    		'pagetitle' => 'Создать вопрос',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'question',
    		'fields' => $fields,
    	]);
    }

    public function create(Request $request) {
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

    	return redirect()->route('admin.edit', ['model' => 'question', 'id' => $question->id])
    		->with('success', 'Вопрос успешно создан');
    }

    public function editForm(Request $request, $id) {
    	$question = Question::findOrFail($id);

    	$fields = [
    		[
    			'name' => 'question',
    			'title' => 'Вопрос',
    			'value' => $question->question,
    		],
    		[
    			'type' => 'select',
    			'name' => 'category_id',
    			'title' => 'Категория',
    			'values' => Category::pluck('name', 'id'),
    			'value' => $question->category_id,
    		],
    		[
    			'name' => 'user_name',
    			'title' => 'Имя пользователя',
    			'value' => $question->user_name,
    		],
    		[
    			'name' => 'user_email',
    			'title' => 'E-mail пользователя',
    			'value' => $question->user_email,
    		],
    		[
    			'type' => 'select',
    			'name' => 'status_id',
    			'title' => 'Статус',
    			'values' => QuestionStatus::pluck('name', 'id'),
    			'value' => $question->status_id,
    		],
    		[
    			'type' => 'textarea',
    			'name' => 'answer',
    			'title' => 'Ответ',
    			'value' => $question->answer,
    		],
    	];

    	return view('admin.edit', [
    		'id' => $id,
    		'pagetitle' => 'Редактировать вопрос',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'question',
    		'fields' => $fields,
    	]);
    }

    public function edit(Request $request, $id) {
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

    	return redirect()->route('admin.edit', ['model' => 'question', 'id' => $id])
    		->with('success', 'Вопрос успешно изменен');
    }

    public function remove(Request $request, $id) {
    	Question::destroy($id);

    	return redirect()->back();
    }

    protected function makeBreadCrumbs() {
    	$breadcrumbs = parent::makeBreadCrumbs();

    	$breadcrumbs[] = ['name' => 'Вопросы','url' => route('admin.list', ['model' => 'question'])];

    	return $breadcrumbs;
    }

}