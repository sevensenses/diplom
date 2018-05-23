<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Question;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function makeMenu() {
    	return [
    		[
    			'name' => 'Главная',
    			'url' => route('admin.dashboard'),
    			'icon' => 'fa fa-fw fa-dashboard'
    		],
    		[
    			'name' => 'Пользователи',
    			'url' => route('admin.users.index'),
    			'icon' => 'fa fa-users',
    		],
    		[
    			'name' => 'Категории',
    			'url' => route('admin.categories.index'),
    			'icon' => 'fa fa-folder-open',
    		],
    		[
    			'name' => 'Вопросы',
    			'url' => route('admin.questions.index'),
    			'icon' => 'fa fa-comment',
    		],
    	];
    }

    protected function makeBreadCrumbs() {
    	return [
    		['name' => 'Панель управления', 'url' => route('admin.dashboard')],
    	];
    }

}