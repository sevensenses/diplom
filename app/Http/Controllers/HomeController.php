<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Question;
use App\QuestionStatus;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = $this->getMenu();

        return view('home', [
            'menu' => $menu,
            'categories' => $menu->load(['questions' => function ($query) {
                $query->where('status_id', QuestionStatus::STATUS_PUBLISHED);
            }]),
        ]);
    }

    public function question() 
    {
        $categories = Category::where('active', true)->get();

        return view('question.add', [
            'menu' => $this->getMenu(),
            'categories' => $categories,
        ]);
    }

    public function create(Request $request) {
        $this->validate($request, [
            'question' => 'required|min:10',
            'user_name' => 'required|min:3',
            'user_email' => 'required|email',
            'category_id' => 'required|exists:categories,id',
        ]);

        $question = new Question($request->all());
        $question->status_id = QuestionStatus::STATUS_NEW;
        $question->save();

        return view('question.success', [
            'menu' => $this->getMenu(),
        ]);
    }

    private function getMenu() {
        return Category::where('active', true)
            ->whereHas('questions', function ($query) {
                $query->where('status_id', QuestionStatus::STATUS_PUBLISHED)
                ->whereNotNull('answer');
            })
            ->get();
    }
}
