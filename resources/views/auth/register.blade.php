@extends('layouts.app')

@section('content')
<b-container>
    <b-row align-h="center">
        <b-col cols="8">
            <b-card header="{{ __('Register') }}"
                    header-tag="header">
                @if ($errors->any())
                    <b-alert show variant="danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </b-alert>
                @else
                    <b-alert show>
                        Por favor ingresa tus datos:
                    </b-alert>                
                @endif
                <b-row align-h="center">
                    <b-col cols="6">                
                        <b-form method="POST" action="{{ route('register') }}">
                            @csrf
                            <b-form-group
                                label="{{ __('Name') }}"
                                label-for="name"
                                description="Enter your name.">
                                <b-form-input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    required autofocus
                                    placeholder="Enter name">        
                                </b-form-input>
                            </b-form-group>
                            <b-form-group
                                label="{{ __('E-Mail Address') }}"
                                label-for="email"
                                description="We'll never share your email with anyone else.">
                                <b-form-input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    required
                                    placeholder="Enter email">        
                                </b-form-input>
                            </b-form-group>
                            <b-form-group
                                label="{{ __('Password') }}"
                                label-for="password">
                                <b-form-input
                                    type="password"
                                    id="password"
                                    name="password"
                                    required>        
                                </b-form-input>
                            </b-form-group>
                            <b-form-group
                                label="{{ __('Confirm Password') }}"
                                label-for="password-confirm">
                                <b-form-input
                                    type="password"
                                    id="password-confirm"
                                    name="password_confirmation"
                                    required>        
                                </b-form-input>
                            </b-form-group>
                            <b-button type="submit" variant="primary">
                                {{ __('Register') }}
                            </b-button>
                            <b-button href="{{ route('login') }}" variant="link">
                                {{ __('¿Already register?') }}
                            </b-button>                            
                        </b-form> 
                    </b-col>
                </b-row>
            </b-card>            
        </b-col>
    </b-row>
</b-container>                

@endsection
