<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketsController extends Controller
{
    public function list(){
        $tickets = Tickets::all();

        return response()->json($tickets , '200');
    }

    public function create(Request $request){
        $validate = Validator::make($request->all() , [
            'title' => 'required|string',
            'post_method' => 'required|string',
            'importance' => 'nullable|string',
            'status' => 'nullable|string',
            'department_id' => 'required|integer|exists:departments,id'
        ]);

        if ($validate->passes()){
            Tickets::create([
                'title' => $request->title,
                'post_method' => $request->post_method,
                'importance' => $request->importance,
                'status'     => $request->status ?? 'pending',
                'department_id' => $request->department_id
            ]);

            return response()->json('ticket created successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all());
        }
    }

    public function changeStatus(Request $request){
        $validate = Validator::make($request->all() , [
            'id'     => 'required|exists:tickets,id|integer',
            'status' => 'required|in:answered, closed , pending , locked , transferred'
        ]);

        if ($validate->passes()){
            $ticket = Tickets::where('id' , $request->id)->first();

            $ticket->status = $request->status;
            $ticket->save();

            return response()->json('changes saved successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all() , '400');
        }
    }

    public function show($id){
        $ticket = Tickets::where('id' , $id)->with('messages')->first();

        return response()->json($ticket , '200');
    }

    public function changeDepartment(Request $request){
        $validate = Validator::make($request->all() , [
            'id' => 'required|integer|exists:tickets,id',
            'department_id' => 'required|integer|exists:departments,id',
        ]);

        if ($validate->passes()){
            $ticket = Tickets::where('id' , $request->id)->first();

            $ticket->department_id = $request->department_id;
            $ticket->save();

            return response()->json('department changed successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all());
        }
    }

    public function userTickets(Request $request){
        $validate = Validator::make($request->all() , [
            'username' => 'required|string'
        ]);

        if ($validate->passes()){
            $tickets = Tickets::with(['messages' => function ($q) use ($request) {
                $q->where('username' , $request->username);
            }])->limit(10)->get();

            return response()->json($tickets , '200');
        }else{
            return response()->json($validate->errors()->all());
        }
    }
}
