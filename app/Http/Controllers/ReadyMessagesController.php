<?php

namespace App\Http\Controllers;

use App\Models\readyMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReadyMessagesController extends Controller
{
    public function create(Request $request){
        $validate = Validator::make($request->all() , [
            'title'   => 'required|string',
            'text'    => 'required|string',
        ]);

        if ($validate->passes()){
            readyMessages::create([
                'title'   => $request->title,
                'content' => $request->text,
            ]);

            return response()->json('created successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function show($id){
        $rMessage = readyMessages::where('id' , $id)->first();

        return response()->json($rMessage , '200');
    }

    public function edit(Request $request){
        $validate = Validator::make($request->all() , [
            'id'      => 'required|exists:ready_messages,id|integer',
            'title'   => 'required|string',
            'text'    => 'required|string',
        ]);

        if ($validate->passes()){
            $rMessage = readyMessages::where('id' , $request->id)->first();

            $rMessage->title = $request->title;
            $rMessage->content = $request->text;
            $rMessage->save();

            return response()->json('changes saved successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function delete(Request $request){
        $validate = Validator::make($request->all() , [
            'id'     => 'required|exists:ready_messages,id|integer',
        ]);

        if ($validate->passes()){
            readyMessages::where('id' , $request->id)->delete();

            return response()->json('item deleted successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function changeStatus(Request $request){
        $validate = Validator::make($request->all() , [
            'id'     => 'required|exists:ready_messages,id|integer',
            'status' => 'required|boolean'
        ]);

        if ($validate->passes()){
            $rMessage = readyMessages::where('id' , $request->id)->first();

            $rMessage->status = $request->status;
            $rMessage->save();

            return response()->json('changes saved successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function list(){
        $rMessages = readyMessages::all();

        return response()->json($rMessages , '200');
    }
}
