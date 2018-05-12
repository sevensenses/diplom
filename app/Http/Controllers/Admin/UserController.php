<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

	public function __construct()
    {
        
    }

    public function list(Request $request) {
    	$tableHeaders = ['Имя пользователя','E-mail'];
    	$tableRows = [];
    	foreach(User::all() as $user) {
    		$tableRows[$user->id] = [$user->name,$user->email];
    	}

    	return view('admin.list', [
    		'pagetitle' => 'Список пользователей',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'user',
    		'tableHeaders' => $tableHeaders,
    		'tableRows' => $tableRows,
    	]);
    }

    public function createForm(Request $request) {
    	$fields = [
    		[
    			'name' => 'name',
    			'title' => 'Имя пользователя',
    		],
    		[
    			'name' => 'email',
    			'title' => 'E-mail',
    		],
    		[
    			'name' => 'password',
    			'title' => 'Пароль',
    		],
    	];

    	return view('admin.create', [
    		'pagetitle' => 'Создать пользователя',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'user',
    		'fields' => $fields,
    	]);
    }

    public function create(Request $request) {
    	$this->validate($request, [
    		'name' => 'required|unique:users,name',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required|min:6',
    	]);

    	$request->merge(['password' => bcrypt($request->password)]);
    	$user = User::create($request->all());

    	return redirect()->route('admin.edit', ['model' => 'user', 'id' => $user->id])
    		->with('success', 'Пользователь успешно создан');
    }

    public function editForm(Request $request, $id) {
    	$user = User::findOrFail($id);

    	$fields = [
    		[
    			'name' => 'name',
    			'title' => 'Имя пользователя',
    			'value' => $user->name,
    		],
    		[
    			'name' => 'email',
    			'title' => 'E-mail',
    			'value' => $user->email,
    		],
    		[
    			'name' => 'password',
    			'title' => 'Пароль',
    			'value' => '',
    		],
    		[
    			'type' => 'checkbox',
    			'name' => 'change_password',
    			'title' => 'Сменить пароль?',
    			'value' => 0,
    		]
    	];

    	return view('admin.edit', [
    		'id' => $id,
    		'pagetitle' => 'Редактировать пользователя',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'model' => 'user',
    		'fields' => $fields,
    	]);
    }

    public function edit(Request $request, $id) {
    	$user = User::findOrFail($id);

    	$rules = [
    		'name' => 'required|unique:users,name,' . $id,
    		'email' => 'required|email|unique:users,email,' . $id,
    	];

    	if($request->input('change_password', false)) {
    		$rules['password'] = 'required|min:6';
    		$data = $request->merge(['password' => bcrypt($request->password)])->all();
    	} else {
    		$data = $request->except('password');
    	}

    	$this->validate($request, $rules);

    	$user->fill($data);
    	$user->save();

    	return redirect()->route('admin.edit', ['model' => 'user', 'id' => $id])
    		->with('success', 'Пользователь успешно изменен');
    }

    public function remove(Request $request, $id) {
    	User::destroy($id);

    	return redirect()->back();
    }

    protected function makeBreadCrumbs() {
    	$breadcrumbs = parent::makeBreadCrumbs();

    	$breadcrumbs[] = ['name' => 'Пользователи','url' => route('admin.list', ['model' => 'user'])];

    	return $breadcrumbs;
    }

}