<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Category;
use App\QuestionStatus;
use App\Http\Requests\StoreQuestion;
use App\Http\Requests\UpdateQuestion;

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::with(['status','category'])->get();

    	return view('admin.questions.index', [
    		'pagetitle' => 'Список вопросов',
    		'questions' => $questions,
    	]);
    }

    public function new() {
        $questions = Question::with(['status','category'])->new()->get();

        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'questions' => $questions,
        ]);
    }

    public function create() {
        $categories = Category::pluck('name', 'id');
        $statuses = QuestionStatus::pluck('name', 'id');

    	return view('admin.questions.create', [
    		'pagetitle' => 'Создать вопрос',
    		'categories' => $categories,
            'statuses' => $statuses,
    	]);
    }

    public function store(StoreQuestion $request) {
        $questionData = $request->all();

    	$question = new Question($questionData);
        $question->correctStatus();
        $question->save();

    	return redirect()->route('admin.questions.edit', $question->id)
    		->with('success', 'Вопрос успешно создан');
    }

    public function edit(Question $question) {
        $categories = Category::pluck('name', 'id');
        $statuses = QuestionStatus::pluck('name', 'id');

    	return view('admin.questions.edit', [
    		'pagetitle' => 'Редактировать вопрос',
            'question' => $question,
            'categories' => $categories,
            'statuses' => $statuses,
    	]);
    }

    public function update(UpdateQuestion $request, Question $question) {
        $questionData = $request->all();

    	$question->fill($questionData);
        $question->correctStatus();
    	$question->save();

    	return redirect()->route('admin.questions.edit', $question->id)
    		->with('success', 'Вопрос успешно изменен');
    }

    public function destroy($id) {
    	Question::destroy($id);

    	return redirect()->back();
    }

}