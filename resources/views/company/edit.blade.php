@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Company') }}</div>

                <div class="card-body">
                    <form id="user-edit-form" method="POST" action="{{ url('/company/update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        
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
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Current Logo') }}</label>
                            
                            <div class="col-md-6">
                                <img src="{{ url('storage/' . $company->path_to_logo) }}" alt="" class="img-thumbnail float-left" style="width:100px; height:100px;">
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('New Logo') }}</label>
                            
                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ $company->path_to_logo }}" autofocus>
                
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