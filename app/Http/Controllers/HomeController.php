<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tasks = \App\Task::latest()->limit(5)->get(); 
        $adverts = \App\Advert::latest()->limit(5)->get(); 
        $nominateds = \App\Nominated::latest()->limit(5)->get(); 
        $companies = \App\Company::latest()->limit(5)->get(); 

        return view('home', compact( 'tasks', 'adverts', 'nominateds', 'companies' ));
    }
}
