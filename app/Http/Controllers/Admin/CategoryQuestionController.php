<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;
use App\Category;
use App\QuestionStatus;

class CategoryQuestionController extends Controller
{
    protected $breadcrumbsManager;

    function __construct (BreadcrumbsManager $breadcrumbsManager) {
        $this->breadcrumbsManager = $breadcrumbsManager;

        $this->breadcrumbsManager->push('Панель управления', route('admin.dashboard'));
        $this->breadcrumbsManager->push('Категории', route('admin.categories.index'));
    }
    
    public function index($categoryId) {
        $questions = Question::with(['status','category'])
            ->where('category_id', $categoryId)
            ->get();

    	return view('admin.questions.index', [
    		'pagetitle' => 'Список вопросов',
    		'questions' =>  $questions,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function new($categoryId) {
        $questions = Question::with(['status','category'])
            ->where('category_id', $categoryId)
            ->new()
            ->get();

        return view('admin.questions.index', [
            'pagetitle' => 'Список вопросов',
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
            'questions' => $questions,
        ]);
    }

}