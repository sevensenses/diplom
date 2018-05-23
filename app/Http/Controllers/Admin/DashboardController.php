<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Question;

class DashboardController extends Controller
{

    public function index() {
        return view('admin.dashboard', [
            'menu' => collect($this->makeMenu()),
            'breadcrumbs' => collect($this->makeBreadCrumbs()),
            'questionNewCount' => Question::new()->count(),
        ]);
    }

}