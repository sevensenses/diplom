<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Category;
use App\QuestionStatus;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\UpdateQuestion;
use App\Breadcrumbs\BreadcrumbsManager;

class QuestionController extends Controller
{
    protected $breadcrumbsManager;

    function __construct (BreadcrumbsManager $breadcrumbsManager) {
        $this->breadcrumbsManager = $breadcrumbsManager;

        $this->breadcrumbsManager->push('Панель управления', route('admin.dashboard'));
        $this->breadcrumbsManager->push('Вопросы', route('admin.questions.index'));;
    }

    public function index() {
        $questions = Question::with(['status','category'])->get();

    	return view('admin.questions.index', [
    		'pagetitle' => 'Список вопросов',
    		'questions' => $questions,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function new() {
        $questions = Question::with(['status','category'])->new()->get();

        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'questions' => $questions,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
        ]);
    }

    public function create() {
        $this->breadcrumbsManager->push('Создать', route('admin.questions.create'));
        
        $categories = Category::pluck('name', 'id');
        $statuses = QuestionStatus::pluck('name', 'id');

    	return view('admin.questions.create', [
    		'pagetitle' => 'Создать вопрос',
    		'categories' => $categories,
            'statuses' => $statuses,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function store(StoreQuestion $request) {
        $questionData = $request->all();

    	$question = Question::create($questionData);

    	return redirect()->route('admin.questions.edit', $question->id)
    		->with('success', 'Вопрос успешно создан');
    }

    public function edit(Question $question) {
        $this->breadcrumbsManager->push('Редактировать', route('admin.questions.edit', $question));
        
        $categories = Category::pluck('name', 'id');
        $statuses = QuestionStatus::pluck('name', 'id');

    	return view('admin.questions.edit', [
    		'pagetitle' => 'Редактировать вопрос',
            'question' => $question,
            'categories' => $categories,
            'statuses' => $statuses,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function update(UpdateQuestion $request, Question $question) {
        $questionData = $request->all();

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