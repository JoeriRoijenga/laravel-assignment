@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Company') }}</div>

                <div class="card-body">
                    <form id="user-edit-form" method="POST" action="{{ url('/company/update') }}">
                        @csrf
                        @method('GET')
                        
                        <input id="id" type="hidden" name="id" value="{{$company->company_id}}">

                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="company_name" type="company_name" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('name') ?? $company->company_name }}" required autofocus>

                                @error('company_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                            <div class="col-md-6">
                                <input id="logo" type="logo" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') ?? $company->path_to_logo }}" required autofocus>

                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="name" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') ?? $company->city }}" required autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip" class="col-md-4 col-form-label text-md-right">{{ __('Zip') }}</label>

                            <div class="col-md-6">
                                <input id="zip" type="name" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ old('zip') ?? $company->zip }}" required autofocus>

                                @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="street" class="form-control @error('street') is-invalid @enderror" name="street" value="{{ old('street') ?? $company->street }}" required autofocus>

                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="housenumber" class="col-md-4 col-form-label text-md-right">{{ __('House Number') }}</label>

                            <div class="col-md-6">
                                <input id="housenumber" type="housenumber" class="form-control @error('housenumber') is-invalid @enderror" name="housenumber" value="{{ old('housenumber') ?? $company->housenumber }}" required autofocus>

                                @error('housenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>    
                    </form>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" form="user-edit-form" class="btn btn-primary">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection