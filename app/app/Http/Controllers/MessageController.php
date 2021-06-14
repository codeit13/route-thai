<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(Request $request){
        $messages = Message::where(function($query) use ($request) {
                            $query->where('from_user', $request->from_user)->where('to_user', $request->to_user);
                        })->orWhere(function ($query) use ($request) {
                            $query->where('from_user', $request->to_user)->where('to_user', $request->from_user);
                        })->get();

        $current_user = auth()->user()->id;
        
        $chat_body = view('front.sell.chat_body',compact('messages','current_user'))->render();
        return response()->json(['success'=>true,'chat_body'=>$chat_body]);
    }

    public function store(Request $request){
        Message::create($request->except('_token'));
        $messages = Message::where(function($query) use ($request) {
                            $query->where('from_user', $request->from_user)->where('to_user', $request->to_user);
                        })->orWhere(function ($query) use ($request) {
                            $query->where('from_user', $request->to_user)->where('to_user', $request->from_user);
                        })->get();

        $current_user = auth()->user()->id;
        
        $chat_body = view('front.sell.chat_body',compact('messages','current_user'))->render();
        return response()->json(['success'=>true,'chat_body'=>$chat_body]);
    }
}
