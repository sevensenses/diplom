<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;

class DashboardController extends Controller
{
    public function index() {
    	$questionNewCount = Question::new()->count();
    	
        return view('admin.dashboard', [
            'questionNewCount' => $questionNewCount,
        ]);
    }

}