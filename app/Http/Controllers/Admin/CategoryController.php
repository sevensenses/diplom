<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\QuestionStatus;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Breadcrumbs\BreadcrumbsManager;

class CategoryController extends Controller
{
    protected $breadcrumbsManager;

    function __construct (BreadcrumbsManager $breadcrumbsManager) {
        $this->breadcrumbsManager = $breadcrumbsManager;

        $this->breadcrumbsManager->push('Панель управления', route('admin.dashboard'));
        $this->breadcrumbsManager->push('Категории', route('admin.categories.index'));
    }

    public function index() {
        // $categories = Category::with(['questions'])->get()->map(function ($category) {
        //     $category->questions_count = $category->questions->count();

        //     $category->new_questions_count = $category->questions->filter(function ($question) {
        //         return $question->isNew();
        //     })->count();

        //     $category->hidden_questions_count = $category->questions->filter(function ($question) {
        //         return $question->isHidden();
        //     })->count();

        //     return $category;
        // });

        $categories = Category::withCount([
            'questions',
            'questions as new_questions_count' => function ($query) {
                $query->new();
            },
            'questions as hidden_questions_count' => function ($query) {
                $query->hidden();
            },
        ])->get();

    	return view('admin.categories.index', [
    		'pagetitle' => 'Список категорий',
            'categories' => $categories,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function create() {
        $this->breadcrumbsManager->push('Создать', route('admin.categories.create'));

    	return view('admin.categories.create', [
    		'pagetitle' => 'Создать категорию',
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function store(StoreCategory $request) {
    	$category = Category::create($request->all());

    	return redirect()->route('admin.categories.edit', $category->id)
    		->with('success', 'Категория успешно создана');
    }

    public function edit(Category $category) {
        $this->breadcrumbsManager->push('Редактировать', route('admin.categories.edit', $category));

    	return view('admin.categories.edit', [
    		'pagetitle' => 'Редактировать Категорию',
    		'category' => $category,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function update(UpdateCategory $request, Category $category) {
    	$category->fill($request->all());
    	$category->save();

    	return redirect()->route('admin.categories.edit', $category)
    		->with('success', 'Категория успешно изменена');
    }

    public function destroy($id) {
    	Category::destroy($id);

    	return redirect()->back();
    }

}