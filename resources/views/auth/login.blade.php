@extends('layouts.app')

@section('content')
<b-container>
    <b-row align-h="center">
        <b-col cols="8">
            <b-card header="{{ __('Login') }}"
                    header-tag="header">
                <b-alert show>
                    Por favor ingresa tus datos:
                </b-alert>
                <b-row align-h="center">
                    <b-col cols="6">
                        <b-form method="POST" action="{{ route('login') }}">
                            @csrf

                            <b-form-group
                                id="input-group-1"
                                label="{{ __('E-Mail Address') }}"
                                label-for="email"
                                description="We'll never share your email with anyone else.">
                                <b-form-input
                                    type="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    required autocomplete="email" autofocus
                                    placeholder="Enter email">        
                                </b-form-input>
                            </b-form-group>

                            <b-form-group
                                id="input-group-2"
                                label="{{ __('Password') }}"
                                label-for="password">
                                <b-form-input
                                    type="password"
                                    id="password"
                                    value="{{ old('password') }}"
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

                            <b-button type="submit" href="#" variant="primary">
                                {{ __('Login') }}
                            </b-button>
                            <b-button href="{{ route('password.request') }}" variant="link">
                                {{ __('Forgot Your Password?') }}
                            </b-button>                            
                        </b-form>                    
                    </b-col>
                </b-row>
            </b-card>            
        </b-col>
    </b-row>
</b-container>
@endsection

