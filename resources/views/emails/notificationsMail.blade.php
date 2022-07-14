
@component('mail::message')
    <div class="card">
        <div class="card-header bg-dark">
            Email from CBZ
        </div>
        <div class="card-body">
            <p>Your OTP is. {{ $maildata['OTP_data']}}</p>
        </div>
    </div>
@endcomponent
