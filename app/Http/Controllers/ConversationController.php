<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Conversation;

class ConversationController extends Controller
{
    public function index()
    {
    	//return Conversation::all();
    	//return Conversation::where('user_id', auth()->id)->get();
    	return Conversation::where('user_id', auth()->user()->id)
    			->get([
    				'id',
    				'contact_id',
    				'has_blocked',
    				'listen_notifications',
    				'last_message',
    				'last_time'
    			]);
    			// contact_name viaja en json desde el modelo Conversation
    }
}
