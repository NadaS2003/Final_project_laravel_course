<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index(){
        $places = Place::query()->paginate(10);

        return response()->json($places);
    }

    public function show($id){
        $place = Place::query()->where('id',$id)->first();

        $json = [
            'status' =>[
                'status' => true,
                'message'=> '',
                'http_code' => 200
            ],
            'data' => $place
        ];
        return response()->json($json);
    }


    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'location' => 'nullable|string|max:255',
        ]);

        $place = Place::query()->create([
            'name'=>$request->input('name'),
            'location'=>$request->input('location')
        ]);

        $status = false;

        if ($place){
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
            'location' => 'nullable|string|max:255',
        ]);

        $result = Place::query()->where('id',$id)->update([
            'name'=>$request->input('name'),
            'location'=>$request->input('location')
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

        $result = Place::query()->where('id',$id)->delete();

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
