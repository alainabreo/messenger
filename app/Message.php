<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	//Habilita para que el campo written_by_me
	//definido en MessageController sea boolean en el sql final
	//DB::raw("IF(`from_id`=$userId, true, false) as written_by_me"),
    protected $casts = [
    	'written_by_me' => 'boolean'
    ];
}
