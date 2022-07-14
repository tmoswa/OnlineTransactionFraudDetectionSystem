@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;">{{ __('Online Transactions Security Activation') }}</div>
                <div class="alert alert-success">
                    Successfully secured account!!
                  
                  </div>

            @if(session('nodata'))

<div class="alert alert-danger">

  {{ session('nodata') }}

</div>

@endif

@if(session('success'))

<div class="alert alert-success">

  {{ session('success') }}

</div>

@endif


                
            </div>
        </div>
    </div>
</div>
@endsection
