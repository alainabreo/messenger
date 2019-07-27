<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
    	return view('profile');
    }

    public function update(Request $request)
    {
    	//dd($request->all());

    	$user = auth()->user();
    	$user->name = $request->name;
    	if ($request->password) {
    		$user->password = bcrypt($request->password);
    	}

    	if ($request->image) {
	    	$file = $request->image;
	    	$path = public_path('/users');
	    	$fileName = time() . '.' . $file->getClientOriginalExtension();
	    	if ($file) {
	    		$moved = $file->move($path, $fileName);
	    		if ($moved) {
				    $user->image = $fileName;
	    		}
	    	}
	    }

	    $user->save();
    	return back();
    }
}
