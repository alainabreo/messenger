@extends('layouts.app')

@section('content')
<b-container>
    <b-row align-h="center">
        <b-col cols="8">
            <b-card header="{{ __('Login') }}"
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
                    <b-col cols="7">
                        <b-form method="POST" action="{{ route('login') }}">
                            @csrf
                            <b-form-group
                                label="{{ __('E-Mail Address') }}"
                                label-for="email">
                                <b-form-input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    required autofocus
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
                            <b-form-group>                        
                                <b-form-checkbox
                                    id="remember"
                                    name="remember"
                                    {{ old('remember') ? 'checked="true"' : '' }}>
                                    {{ __('Remember Me') }}
                                </b-form-checkbox>
                            </b-form-group>                        
                            <b-button type="submit" variant="primary">
                                {{ __('Login') }}
                            </b-button>
                            <b-button href="{{ route('register') }}" variant="link">
                                {{ __('¿New user?') }}
                            </b-button>
                            <b-button href="{{ route('password.request') }}" variant="link">
                                {{ __('¿Forgot Your Password?') }}
                            </b-button>
                        </b-form>                    
                    </b-col>
                </b-row>
            </b-card>            
        </b-col>
    </b-row>
</b-container>
@endsection

