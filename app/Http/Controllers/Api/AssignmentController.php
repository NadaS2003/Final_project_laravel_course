<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Place;
use App\Models\Task;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(){

        $assignments = Assignment::query()->with(['volunteer', 'place', 'task'])->paginate(10);

        return response()->json($assignments);

    }
    public function store(Request $request){


        $assignment = $request->validate([
            'volunteer_id' => 'required|exists:volunteers,id',
            'place_id'     => 'required|exists:places,id',
            'task_id'      => 'required|exists:tasks,id',
        ]);


        $result = Assignment::query()->create($assignment);

        $status = false;

        if ($result){
            $status = true;
        }

        $json = [
            'status' =>[
                'status' => $status ,
                'message'=> $status ? 'Assignment has done Successfully': 'Failed' ,
                'http_code' => $status ? 201 : 502
            ],
            [
                'data'=> $assignment ?? null
            ]
        ];

        return response()->json($json);
    }
}
