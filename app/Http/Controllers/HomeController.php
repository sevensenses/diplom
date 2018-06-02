<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use App\QuestionStatus;
use App\Http\Requests\StoreNewQuestion;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Category::active()->has('publishedQuestions')->get();

        return view('home', [
            'menu' => $menu,
            'categories' => $menu->load(['questions' => function ($query) {
                $query->where('status_id', QuestionStatus::STATUS_PUBLISHED);
            }]),
        ]);
    }

    public function question() 
    {
        $menu = Category::active()->has('publishedQuestions')->get();
        $categories = Category::active()->get();

        return view('question.add', [
            'menu' => $menu,
            'categories' => $categories,
        ]);
    }

    public function create(StoreNewQuestion $request) {
        $menu = Category::active()->has('publishedQuestions')->get();

        $question = new Question($request->all());
        $question->status_id = QuestionStatus::STATUS_NEW;
        $question->save();

        return view('question.success', [
            'menu' => $menu,
        ]);
    }
}
