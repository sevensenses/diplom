<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use App\QuestionStatus;

class CategoryQuestionController extends Controller
{

    protected $breadcrumbs;

    function __construct () {
        $this->breadcrumbs = collect([
            ['name' => 'Панель управления', 'url' => route('admin.dashboard')],
            ['name' => 'Вопросы','url' => route('admin.questions.index')],
        ]);
    }

    public function index($categoryId) {
        $questions = Question::with(['status','category'])
            ->where('category_id', $categoryId)
            ->get();

    	return view('admin.questions.index', [
    		'pagetitle' => 'Список вопросов',
    		'breadcrumbs' => $this->breadcrumbs,
    		'questions' =>  $questions,
    	]);
    }

    public function new($categoryId) {
        $questions = Question::with(['status','category'])
            ->where('category_id', $categoryId)
            ->new()
            ->get();

        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'breadcrumbs' => $this->breadcrumbs,
            'questions' => $questions,
        ]);
    }

    public function hidden($categoryId) {
        $questions = Question::with(['status','category'])
            ->where('category_id', $categoryId)
            ->hidden()
            ->get();

        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'breadcrumbs' => $this->breadcrumbs,
            'questions' => $questions,
        ]);
    }

    public function published($categoryId) {
        $questions = Question::with(['status','category'])
            ->where('category_id', $categoryId)
            ->published()
            ->get();

        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
            'breadcrumbs' => $this->breadcrumbs,
            'questions' => $questions,
        ]);
    }

}