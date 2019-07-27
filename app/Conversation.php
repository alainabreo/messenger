<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
	//Adjunta a la respuesta en json este dato
	protected $appends = [
        'contact_name',
        'contact_image'
    ];

    public function getContactNameAttribute()
    {
    	//Internamente trae todas las columnas
    	//return $this->contact->name;

    	//Query optimizado para sólo traer la columna name
    	//Con () accedemos al query builder de Laravel
    	return $this->contact()->first('name')->name;
    }

    public function getContactImageAttribute()
    {
        return '/users/' . $this->contact()->first('image')->image;
    }

    public function contact()
    {
    	//Conversations N    1 User (contact)
    	return $this->belongsTo(User::class);
    }
}
