<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Category;
use App\QuestionStatus;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\UpdateQuestion;

class QuestionController extends Controller
{

    protected $breadcrumbs;

    function __construct () {
        $this->breadcrumbs = collect([
            ['name' => 'Панель управления', 'url' => route('admin.dashboard')],
            ['name' => 'Вопросы','url' => route('admin.questions.index')],
        ]);
    }

    public function index() {
        $questions = Question::with(['status','category'])->get();

    	return view('admin.questions.index', [
    		'pagetitle' => 'Список вопросов',
    		'breadcrumbs' => $this->breadcrumbs,
    		'questions' => $questions,
    	]);
    }

    public function create() {
        $categories = Category::pluck('name', 'id');
        $statuses = QuestionStatus::pluck('name', 'id');

    	return view('admin.questions.create', [
    		'pagetitle' => 'Создать вопрос',
            'breadcrumbs' => $this->breadcrumbs,
    		'categories' => $categories,
            'statuses' => $statuses,
    	]);
    }

    public function store(StoreQuestion $request) {
        $questionData = $request->all();

        // Не уверен как тут реализовать правильнее
        if(empty($questionData['answer'])) {
            // Если ответ не указан, то выставляем статус "новый"
            $questionData['status_id'] = QuestionStatus::STATUS_NEW;
        } elseif($questionData['status_id'] != QuestionStatus::STATUS_HIDDEN) {
            // Если ответ указан, и не выставлен статус "скрытый", то опубликовываем ответ
            $questionData['status_id'] = QuestionStatus::STATUS_PUBLISHED;
        }

    	$question = Question::create($questionData);

    	return redirect()->route('admin.questions.edit', $question->id)
    		->with('success', 'Вопрос успешно создан');
    }

    public function edit(Question $question) {
        $categories = Category::pluck('name', 'id');
        $statuses = QuestionStatus::pluck('name', 'id');

    	return view('admin.questions.edit', [
    		'pagetitle' => 'Редактировать вопрос',
            'breadcrumbs' => $this->breadcrumbs,
            'question' => $question,
            'categories' => $categories,
            'statuses' => $statuses,
    	]);
    }

    public function update(UpdateQuestion $request, Question $question) {
        $questionData = $request->all();

        // Не уверен как тут реализовать правильнее
        if(empty($questionData['answer'])) {
            // Если ответ не указан, то выставляем статус "новый"
            $questionData['status_id'] = QuestionStatus::STATUS_NEW;
        } elseif($questionData['status_id'] != QuestionStatus::STATUS_HIDDEN) {
            // Если ответ указан, и не выставлен статус "скрытый", то опубликовываем ответ
            $questionData['status_id'] = QuestionStatus::STATUS_PUBLISHED;
        }

    	$question->fill($questionData);
    	$question->save();

    	return redirect()->route('admin.questions.edit', $question->id)
    		->with('success', 'Вопрос успешно изменен');
    }

    public function destroy($id) {
    	Question::destroy($id);

    	return redirect()->back();
    }

}