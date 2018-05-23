<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function index() {
    	return view('admin.users.index', [
    		'pagetitle' => 'Список пользователей',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'users' => User::all(),
    	]);
    }

    public function create() {
    	return view('admin.users.create', [
    		'pagetitle' => 'Создать пользователя',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    	]);
    }

    public function store(Request $request) {
    	$this->validate($request, [
    		'name' => 'required|unique:users,name',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required|min:6',
    	]);

    	$request->merge(['password' => bcrypt($request->password)]);
    	$user = User::create($request->all());

    	return redirect()->route('admin.users.edit', $user->id)
    		->with('success', 'Пользователь успешно создан');
    }

    public function edit($id) {
    	return view('admin.users.edit', [
    		'user' => User::findOrFail($id),
    		'pagetitle' => 'Редактировать пользователя',
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    	]);
    }

    public function update(Request $request, $id) {
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

    	return redirect()->route('admin.users.edit', $id)
    		->with('success', 'Пользователь успешно изменен');
    }

    public function destroy($id) {
    	User::destroy($id);

    	return redirect()->back();
    }

    protected function makeBreadCrumbs() {
    	$breadcrumbs = parent::makeBreadCrumbs();

    	$breadcrumbs[] = ['name' => 'Пользователи','url' => route('admin.users.index')];

    	return $breadcrumbs;
    }

}