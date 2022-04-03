<?php

namespace App\Http\Controllers;

use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketMessageController extends Controller
{
    public function create(Request $request){
        $validate = Validator::make($request->all() , [
            'ticket_id' => 'required|integer|exists:tickets,id',
            'text'      => 'required|string',
            'username'  => 'required|string',
            'user_email' => 'required|email',
            'user_phone' => 'required|string'
        ]);

        if ($validate->passes()){
            TicketMessage::create([
                'ticket_id' => $request->ticket_id,
                'content'   => $request->text,
                'username'  => $request->username,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone
            ]);

            return response()->json('message created successfully!' , '200');
        }else{
            return response()->json($validate->errors()->all());
        }
    }
}
