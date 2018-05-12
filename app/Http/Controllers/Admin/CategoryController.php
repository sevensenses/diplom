<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Category;
use App\QuestionStatus;

class CategoryController extends Controller
{

	public function __construct()
    {
        
    }

    public function list(Request $request) {
    	$tableHeaders = ['Название','Новых вопросов','Скрытых вопросов','Всего вопросов'];
    	$tableRows = [];
    	foreach(Category::with('questions')->get() as $category) {
    		$tableRows[$category->id] = [
    			$category->name,

    			\Html::link(
    				route('admin.list', [
    					'model' => 'question', 
    					'category' => $category->id, 
    					'status' => QuestionStatus::STATUS_NEW
    				]), 
    				$category->questions
    					->where('status_id', QuestionStatus::STATUS_NEW)
    					->count()
    			),

    			\Html::link(
    				route('admin.list', [
    					'model' => 'question', 
    					'category' => $category->id, 
    					'status' => QuestionStatus::STATUS_HIDDEN
    				]), 
    				$category->questions
    					->where('status_id', QuestionStatus::STATUS_HIDDEN)
    					->count()
    			),

    			\Html::link(
    				route('admin.list', [
    					'model' => 'question', 
    					'category' => $category->id
    				]), 
    				$category->questions->count()
    			),
    		];
    	}

    	return view('admin.list', [
    		'pagetitle' => 'Список категорий',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'category',
    		'tableHeaders' => $tableHeaders,
    		'tableRows' => $tableRows,
    	]);
    }

    public function createForm(Request $request) {
    	$fields = [
    		[
    			'name' => 'name',
    			'title' => 'Название',
    		],
    		[
    			'type' => 'checkbox',
    			'name' => 'active',
    			'title' => 'Включена?',
    		],
    	];

    	return view('admin.create', [
    		'pagetitle' => 'Создать категорию',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'category',
    		'fields' => $fields,
    	]);
    }

    public function create(Request $request) {
    	$this->validate($request, [
    		'name' => 'required|unique:categories,name',
    		'active' => 'in:0,1',
    	]);

    	$category = Category::create($request->all());

    	return redirect()->route('admin.edit', ['model' => 'category', 'id' => $category->id])
    		->with('success', 'Категория успешно создана');
    }

    public function editForm(Request $request, $id) {
    	$category = Category::findOrFail($id);

    	$fields = [
    		[
    			'name' => 'name',
    			'title' => 'Название',
    			'value' => $category->name,
    		],
    		[
    			'type' => 'checkbox',
    			'name' => 'active',
    			'title' => 'Включена?',
    			'value' => $category->active,
    		]
    	];

    	return view('admin.edit', [
    		'id' => $id,
    		'pagetitle' => 'Редактировать Категорию',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'category',
    		'fields' => $fields,
    	]);
    }

    public function edit(Request $request, $id) {
    	$category = Category::findOrFail($id);

    	$this->validate($request, [
    		'name' => 'required|unique:categories,name,' . $id,
    		'active' => 'in:0,1',
    	]);

    	$category->fill($request->all());
    	$category->save();

    	return redirect()->route('admin.edit', ['model' => 'category', 'id' => $id])
    		->with('success', 'Категория успешно изменена');
    }

    public function remove(Request $request, $id) {
    	Category::destroy($id);

    	return redirect()->back();
    }

    protected function makeBreadCrumbs() {
    	$breadcrumbs = parent::makeBreadCrumbs();

    	$breadcrumbs[] = ['name' => 'Категории','url' => route('admin.list', ['model' => 'category'])];

    	return $breadcrumbs;
    }

}