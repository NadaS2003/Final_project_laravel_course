<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(){
        return view('volunteer.index');
    }

    public function create(){
        return view('volunteer.create');
    }

    public function edit($id)
    {
        return view('volunteer.edit', ['id' => $id]);
    }

}
