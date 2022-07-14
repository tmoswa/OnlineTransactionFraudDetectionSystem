@extends('layouts.main')

@section('content')
<div class="container-fluid w-100">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">Accounts</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button class="btn btn-secondary" onclick="print()">Print</button>
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

                    <table id="myTable" class="table table-stribe">
<thead>
    <tr>
        <td>No. </td>
<td>First Name </td>
<td>Last name </td>
<td>Account Number </td>
<td>Account Type </td>
<td>National ID </td>
<td>Email </td>
<td>Status </td>
<td>Phone Number </td>
<td>Ation </td>
    </tr>
</thead>

<tbody>
    @foreach($accountholders as $acc_hol)
<tr>
 <td id="table_id">{{ ++$i }}</td>
<td>{{$acc_hol->first_name}} </td>
<td>{{$acc_hol->last_name}} </td>
<td>{{$acc_hol->account_number}} </td>
<td>{{$acc_hol->account_type}} </td>
<td>{{$acc_hol->national_id}} </td>
<td>{{$acc_hol->email}} </td>
<td>{{$acc_hol->status}} </td>
<td>{{$acc_hol->phone_number}} </td>
<td>
@if($acc_hol->status=='Blocked')
<a class="btn btn-warning" href="{{ route('activate',$acc_hol->account_number) }}">Activate</a> 
@endif
<a class="btn btn-success" href="{{ route('viewtrans',$acc_hol->account_number) }}">View Transactions</a>
       

</td>
</tr>
@endforeach
</tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
    {!! $accountholders->render() !!}
</div>
@endsection
