@extends('layouts.main')

@section('content')

<div class="container-fluid w-100">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align: center;">Transactions</div>

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
        <th>No </th>
<th>Account Number </th>
<th>Description </th>
<th>Amount </th>
<th>Date </th>
<th>Time </th>
<th>Status </th>
<th>IP Address </th>
<th>Location </th>
    </thead>

    @foreach($accountholders as $acc_hol)
<tr>
 <td>{{ ++$i }}</td>
<td>{{$acc_hol->account_number}} </td>
<td>{{$acc_hol->description}} </td>
<td>{{$acc_hol->amount}} </td>
<td>{{$acc_hol->transaction_date}} </td>
<td>{{$acc_hol->transaction_time}} </td>
<td>{{$acc_hol->status}} </td>
<td>{{$acc_hol->ip_address}} </td>
<td><a href="https://maps.google.com/?q={{$acc_hol->latitude}},{{$acc_hol->longitude}}" target="_blank" style="background: darkblue;color: white;">View</a> </td>
</tr>
@endforeach

                   </table>
                   
<script>
    $(function () {
      
        var chart = new Chart(perf_div, {
            type: 'bar',
            data: { 
                labels: ['January', 'February', 'March', 'April', 'May', 'June','July','August','September','October', 'November', 'December'],
                datasets: [{
                          label: "Amount Spent",
                          <?php $january=round($january,0);   $february=round($february,0);    $march=round($march,0);    $april=round($april,0);    $may=round($may,0);    $june=round($june,0);    $july=round($july,0);    $august=round($august,0);    $september=round($september,0);    $october=round($october,0);       $november=round($november,0);     $december=round($december,0);   ?>
                            data: [<?php echo "'$january'" ?>, <?php echo "'$february'" ?>, <?php echo "'$march'" ?>, <?php echo "'$april'" ?>, <?php echo "'$may'" ?>, <?php echo "'$june'" ?>, <?php echo "'$july'" ?>, <?php echo "'$august'" ?>, <?php echo "'$september'" ?>, <?php echo "'$october'" ?>, <?php echo "'$november'" ?>, <?php echo "'$december'" ?>],
                            backgroundColor: 'green',
                }]
            },

            options: {
              fontColor: 'black',
              title: {
          display: true,
          text: '2020 Spending Trends',
          fontColor: 'black',
      },
                responsive: false,
                legend: {
                    position: 'top',
               labels: {
              fontColor: 'black',
              fontSize: 8,
              width: '20px'
              }
                },
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                              beginAtZero: true,
                              
                          }
                    }]
                }
            }

        });

    })
</script>
<center>
<canvas id="perf_div" width="900px" height="300px" style="padding-left:2px; outline: black 1px solid;"></canvas></center>

                </div>
            </div>
        </div>
    </div>
    {!! $accountholders->render() !!}



</div>











@endsection