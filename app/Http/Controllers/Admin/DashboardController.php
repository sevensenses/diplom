<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;

class DashboardController extends Controller
{

    protected $breadcrumbs;

    function __construct () {
        $this->breadcrumbs = collect([
            ['name' => 'Панель управления', 'url' => route('admin.dashboard')],
        ]);
    }

    public function index() {
    	$questionNewCount = Question::new()->count();
    	
        return view('admin.dashboard', [
            'breadcrumbs' => $this->breadcrumbs,
            'questionNewCount' => $questionNewCount,
        ]);
    }

}