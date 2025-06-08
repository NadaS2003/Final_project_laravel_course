<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function index(){
        $volunteers = Volunteer::query()->paginate(10);
        return response()->json($volunteers);
    }


    public function show($id){
        $volunteer = Volunteer::query()->where('id',$id)->first();

        $json = [
            'status' =>[
                'status' => true,
                'message'=> '',
                'http_code' => 200
            ],

                'data'=>  $volunteer

        ];
        return response()->json($json);
    }


    public function store(Request $request){

        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'phone' => 'required|string|regex:/^[0-9+\-\s()]{7,20}$/',
            'email' => 'required|email|unique:volunteers,email',

        ]);

        $volunteer = Volunteer::query()->create([
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'phone'=>$request->input('phone'),
            'email'=>$request->input('email')
        ]);

        $status = false;

        if ($volunteer){
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

    public function update(Request $request, $id)
    {
        $volunteer = Volunteer::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'phone' => [
                'required',
                'string',
                'regex:/^[0-9+\-\s()]{7,20}$/',
                'unique:volunteers,phone,' . $volunteer->id,
            ],
            'email' => [
                'required',
                'email',
                'unique:volunteers,email,' . $volunteer->id,
            ],
        ]);

        $result = $volunteer->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
        ]);

        return response()->json([
            'status' => [
                'status' => $result,
                'message' => $result ? 'Updated Successfully' : 'Failed',
                'http_code' => $result ? 200 : 502,
            ],
            'data' => null,
        ]);
    }


    public function destroy($id){

        $result = Volunteer::query()->where('id',$id)->delete();

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
