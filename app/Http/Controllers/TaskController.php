<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        return view('task.index');
    }

    public function create(){
        return view('task.create');
    }

    public function edit($id)
    {
        return view('task.edit', ['id' => $id]);
    }

}
