<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;
use App\Breadcrumbs\BreadcrumbsManager;

class DashboardController extends Controller
{
    protected $breadcrumbsManager;

    function __construct (BreadcrumbsManager $breadcrumbsManager) {
        $this->breadcrumbsManager = $breadcrumbsManager;

        $this->breadcrumbsManager->push('Панель управления', route('admin.dashboard'));
    }

    public function index() {
    	$questionNewCount = Question::new()->count();
    	
        return view('admin.dashboard', [
            'questionNewCount' => $questionNewCount,
            'breadcrumbs' => $this->breadcrumbsManager->render(),
        ]);
    }

}