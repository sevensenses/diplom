<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Category;
use App\QuestionStatus;

class CategoryController extends Controller
{

    public function index() {
    	return view('admin.categories.index', [
    		'pagetitle' => 'Список категорий',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
            'categories' => Category::withCount(['newQuestions', 'hiddenQuestions', 'questions'])->get(),
    	]);
    }

    public function create() {
    	return view('admin.categories.create', [
    		'pagetitle' => 'Создать категорию',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    	]);
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'name' => 'required|unique:categories,name',
    		'active' => 'in:0,1',
    	]);

    	$category = Category::create($request->all());

    	return redirect()->route('admin.categories.edit', $category->id)
    		->with('success', 'Категория успешно создана');
    }

    public function edit($id) {
    	return view('admin.categories.edit', [
    		'pagetitle' => 'Редактировать Категорию',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'category' => Category::findOrFail($id),
    	]);
    }

    public function update(Request $request, $id) {
    	$category = Category::findOrFail($id);

    	$this->validate($request, [
    		'name' => 'required|unique:categories,name,' . $id,
    		'active' => 'in:0,1',
    	]);

    	$category->fill($request->all());
    	$category->save();

    	return redirect()->route('admin.categories.edit', $id)
    		->with('success', 'Категория успешно изменена');
    }

    public function destroy($id) {
    	Category::destroy($id);

    	return redirect()->back();
    }

    protected function makeBreadCrumbs() {
    	$breadcrumbs = parent::makeBreadCrumbs();

    	$breadcrumbs[] = ['name' => 'Категории','url' => route('admin.categories.index')];

    	return $breadcrumbs;
    }

}