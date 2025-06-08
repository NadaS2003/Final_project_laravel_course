<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::query()->paginate(10);

        return response()->json($tasks);
    }

    public function show($id){
        $task = Task::query()->where('id',$id)->first();

        $json = [
            'status' =>[
                'status' => true,
                'message'=> '',
                'http_code' => 200
            ],

                'data'=> $task

        ];
        return response()->json($json);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $task = Task::query()->create([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);

        $status = false;

        if ($task){
            $status = true;
        }

        $json = [
            'status' =>[
                'status' => $status ,
                'message'=> $status ? 'Added Successfully': 'Failed' ,
                'http_code' => $status ? 201 : 502
            ],
            [
                'data'=> null
            ]
        ];

        return response()->json($json);
    }

    public function update(Request $request ,$id){
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $result = Task::query()->where('id',$id)->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description')
        ]);

        $status = false;

        if ($result){
            $status = true;
        }

        $json = [
            'status' =>[
                'status' => $status ,
                'message'=> $status ? 'Updated Successfully': 'Failed' ,
                'http_code' => $status ? 200 : 502
            ],
            [
                'data'=> null
            ]
        ];
        return response()->json($json);
    }

    public function destroy($id){

        $result = Task::query()->where('id',$id)->delete();

        $status = ($result) ? true : false;

        $json = [
            'status' =>[
                'status' => $status ,
                'message'=> $status ? 'Deleted Successfully': 'Failed' ,
                'http_code' => $status ? 200 : 502
            ],
            [
                'data'=> null
            ]
        ];

        return response()->json($json);

    }
}
