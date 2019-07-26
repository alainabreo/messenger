@extends('layouts.app')

@section('content')
	<messenger-component :user-id="{{ auth()->id() }}">
		
	</messenger-component>
@endsection

@section('scripts')
@endsection