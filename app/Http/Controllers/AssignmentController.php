<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(){
        return view('assignment.index');
    }
    public function create(){
        return view('assignment.create');
    }

}
