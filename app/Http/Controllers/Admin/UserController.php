<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController extends Controller
{

    protected $breadcrumbs;

    function __construct () {
        $this->breadcrumbs = collect([
            ['name' => 'Панель управления', 'url' => route('admin.dashboard')],
            ['name' => 'Пользователи','url' => route('admin.users.index')],
        ]);
    }

    public function index() {
        $users = User::all();

    	return view('admin.users.index', [
    		'pagetitle' => 'Список пользователей',
            'breadcrumbs' => $this->breadcrumbs,
    		'users' => $users,
    	]);
    }

    public function create() {
    	return view('admin.users.create', [
    		'pagetitle' => 'Создать пользователя',
            'breadcrumbs' => $this->breadcrumbs,
    	]);
    }

    public function store(StoreUser $request) {
        $userData = $request->all();

    	$userData['password'] = bcrypt($userData['password']);

    	$user = User::create($userData);

    	return redirect()->route('admin.users.edit', $user->id)
    		->with('success', 'Пользователь успешно создан');
    }

    public function edit(User $user) {
    	return view('admin.users.edit', [
    		'user' => $user,
    		'pagetitle' => 'Редактировать пользователя',
            'breadcrumbs' => $this->breadcrumbs,
    	]);
    }

    public function update(UpdateUser $request, User $user) {
    	if($request->input('change_password', false)) {
            $userData = $request->all();
    		$userData['password'] = bcrypt($request->password);
    	} else {
    		$userData = $request->except('password');
    	}

    	$user->fill($userData);
    	$user->save();

    	return redirect()->route('admin.users.edit', $user->id)
    		->with('success', 'Пользователь успешно изменен');
    }

    public function destroy($id) {
    	User::destroy($id);

    	return redirect()->back();
    }

}