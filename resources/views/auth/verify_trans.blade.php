@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;">{{ __('Activate your Online Transactions Security by entering Your OTP and proceed:') }}</div>
                

            @if(session('nodata'))

<div class="alert alert-danger">

  {{ session('nodata') }}

</div>

@endif
                <div class="card-body">
                    <form method="POST" action="{{route('register_second_otp')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="otp" class="col-md-4 col-form-label text-md-right">{{ __('SMS OTP') }}</label>
                            <input id="amount" type="Hidden" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{$amount}}">
                            <input id="account_number" type="Hidden" class="form-control @error('otp') is-invalid @enderror" name="account_number" value="{{$account_number}}">
                            <input id="latitude" type="Hidden" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{$latitude}}">
                            <input id="longitude" type="Hidden" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{$longitude}}">
                            <input id="description" type="Hidden" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$description}}">
                            <input id="extra" type="Hidden" class="form-control @error('extra') is-invalid @enderror" name="extra" value="{{$extra}}">
                            
                            <div class="col-md-6">
                                <input id="otp" type="text" onkeypress="return isNumberKey(event)" maxlength="10" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus>

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
@if($extra=="Yes")
<div class="form-group row">
<label for="otp" class="col-md-4 col-form-label text-md-right">{{ __('Email Verification') }}</label>
<div class="col-md-6">
    <input id="num1" type="text" onkeypress="return isNumberKey(event)" maxlength="10" class="form-control @error('num1') is-invalid @enderror" name="num1" value="{{ old('otp') }}" required autocomplete="num1" autofocus>

    @error('num1')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
</div>
@endif


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Proceed') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
