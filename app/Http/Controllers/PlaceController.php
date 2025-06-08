<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(){
        return view('place.index');
    }

    public function create(){
        return view('place.create');
    }

    public function edit($id)
    {
        return view('place.edit', ['id' => $id]);
    }

}
