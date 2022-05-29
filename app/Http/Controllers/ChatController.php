<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $user= User::where('id','!=',auth()->user()->id)->get();
        return view('chat.chat')->with(['users'=>$user]);

    }

    public function event()
    {
       $user = Chat::get();

       $event = event(new ChatEvent($user));
        return $event;
    }

    public function chat_window(Request $request)
    {

        $sent =Chat::where('sender_id',auth()->user()->id)
                    ->where('receive_user_id',$request['user_id'])
                    ->select([
                        'sender_id as s_id',
                        'receive_user_id as r_id',

                        'sent_message',
                        'created_at'
                    ]);


        $receiver =Chat::where('receive_user_id',auth()->user()->id)
                    ->where('sender_id',$request['user_id'])
                    ->select([
                        'sender_id as s_id',
                        'receive_user_id as r_id',
                        'sent_message',

                        'created_at'
                    ]);

        $items = $sent->unionAll($receiver)->orderby('created_at')->get();
        $user_name = User::where('id',$request->user_id)->select(['name','online','updated_at'])->first();

        // return view('chat.chat_window')->with(['sents'=>$sent,'receivers'=>$receive,'receiver_id'=>$request['user_id']]);
        return view('chat.chat_window')->with(['items'=>$items,'receiver_id'=>$request['user_id'],'receiver_name'=>$user_name]);

    }

    public function message_sent(Request $request)
    {


        Chat::create([
            'sender_id'=>auth()->user()->id,
            'sent_message'=>$request['user_message'],
            'receive_user_id'=>$request['receiver_id']
        ]);



        $sent =Chat::where('sender_id',auth()->user()->id)
                ->where('receive_user_id',$request['receiver_id'])
                ->select([
                    'sender_id as s_id',
                    'receive_user_id as r_id',

                    'sent_message',
                    'created_at'
                ])->latest()->first();


            return $sent;


    }
}
