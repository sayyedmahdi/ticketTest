<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function create(Request $request){
        $validate = Validator::make($request->all() , [
            'title'  => 'required|string',
            'status' => 'nullable|boolean'
        ]);

        if ($validate->passes()){
            Department::create([
                'title'  => $request->title,
            ]);

            return response()->json('created successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function edit(Request $request){
        $validate = Validator::make($request->all() , [
            'id'     => 'required|exists:departments,id|integer',
            'title'  => 'required|string',
        ]);

        if ($validate->passes()){
            $department = Department::where('id' , $request->id)->first();

            $department->title = $request->title;
            $department->save();

            return response()->json('changes saved successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function delete(Request $request){
        $validate = Validator::make($request->all() , [
            'id'     => 'required|exists:departments,id|integer',
        ]);

        if ($validate->passes()){
            Department::where('id' , $request->id)->delete();

            return response()->json('department deleted successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function changeStatus(Request $request){
        $validate = Validator::make($request->all() , [
            'id'     => 'required|exists:departments,id|integer',
            'status' => 'required|boolean'
        ]);

        if ($validate->passes()){
            $department = Department::where('id' , $request->id)->first();

            $department->status = $request->status;
            $department->save();

            return response()->json('changes saved successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function list(){
        $departments = Department::all();

        return response()->json($departments , '200');
    }

    public function tickets($id){
        $department = Department::where('id' , $id)->with('tickets')->first();

        return response()->json($department->tickets , '200');
    }
}
