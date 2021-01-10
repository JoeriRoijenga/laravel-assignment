@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Two Factor Authentication') }}</div>

                <div class="card-body">                    
                    <div class="pb-5">
                        {!! auth()->user()->TwoFactorQrCodeSvg() !!}
                    </div>
                    
                    <div>
                        <h1>Recovery Codes:</h1>
                        <ul>
                            @foreach(json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                <li>{{$code}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection