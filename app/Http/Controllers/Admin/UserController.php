<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Breadcrumbs\BreadcrumbsManager;

class UserController extends Controller
{
    protected $breadcrumbsManager;

    function __construct (BreadcrumbsManager $breadcrumbsManager) {
        $this->breadcrumbsManager = $breadcrumbsManager;

        $this->breadcrumbsManager->push('Панель управления', route('admin.dashboard'));
        $this->breadcrumbsManager->push('Пользователи', route('admin.users.index'));
    }

    public function index() {
        $users = User::all();

    	return view('admin.users.index', [
    		'pagetitle' => 'Список пользователей',
    		'users' => $users,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
    	]);
    }

    public function create() {
        $this->breadcrumbsManager->push('Создать', route('admin.users.create'));

    	return view('admin.users.create', [
    		'pagetitle' => 'Создать пользователя',
            'breadcrumbs' => $this->breadcrumbsManager->render(),
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
        $this->breadcrumbsManager->push('Редактировать', route('admin.users.edit', $user));
        
    	return view('admin.users.edit', [
    		'user' => $user,
    		'pagetitle' => 'Редактировать пользователя',
            'breadcrumbs' => $this->breadcrumbsManager->render(),
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