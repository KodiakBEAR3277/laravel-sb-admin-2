<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $widget = [
            'users' => \App\Models\User::count(),
            'students' => \App\Models\Students\Students::count(),
            // Placeholder for teachers count until you implement the Teachers model
            'teachers' => 0,
        ];

        return view('home', compact('widget'));
    }
}
