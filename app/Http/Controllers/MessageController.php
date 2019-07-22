<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;
use DB;

class MessageController extends Controller
{
    public function index()
    {
    	//return Message::all();

    	$userId = auth()->id();
    	return Message::select(
					'id', 
					//DB::raw('1 as written_by_me'),
					DB::raw("IF(`from_id`=$userId, true, false) as written_by_me"),
					'from_id', 
					'to_id', 
					'content', 
					'created_at'
				)->get();
    }

    public function store(Request $request)
    {
    	$message = new Message();
    	$message->from_id = auth()->id();
    	$message->to_id = $request->to_id;
    	$message->content = $request->content;
    	$saved = $message->save();

    	$data = [];
    	$data['success'] = $saved;
    	return $data;
    }
}
