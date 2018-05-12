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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index(Request $request) {
    	return view('admin.dashboard', [
    		'menu' => collect($this->makeMenu()),
    		'breadcrumbs' => collect($this->makeBreadCrumbs()),
    		'questionNewCount' => Question::whereNull('answer')->count(),
    	]);
    }

    public function list(Request $request) {

    }

    public function createForm(Request $request) {
    	
    }

    public function create(Request $request) {
    	
    }

    public function editForm(Request $request, $id) {
    	
    }

    public function edit(Request $request, $id) {
    	
    }

    public function remove(Request $request, $id) {
    	
    }

    protected function makeMenu() {
    	return [
    		[
    			'name' => 'Главная',
    			'url' => route('admin.dashboard'),
    			'icon' => 'fa fa-fw fa-dashboard'
    		],
    		[
    			'name' => 'Пользователи',
    			'url' => route('admin.list', ['model' => 'user']),
    			'icon' => 'fa fa-users',
    		],
    		[
    			'name' => 'Категории',
    			'url' => route('admin.list', ['model' => 'category']),
    			'icon' => 'fa fa-folder-open',
    		],
    		[
    			'name' => 'Вопросы',
    			'url' => route('admin.list', ['model' => 'question']),
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