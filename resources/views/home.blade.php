@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Dashboard Home
@endsection

@section('content')
<div class="col-xl-12 col-xxl-12">
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-primary">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="fa fa-list-alt"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Catagory</p>
                            <h3 class="text-white">{{ $total_categories }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-info">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="fa fa-users"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Users</p>
                            <h3 class="text-white">{{ $total_user }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-dark">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-calendar-1"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Sale</p>
                            <h3 class="text-white">{{ $order_summeries->where('order_status', 'delivered')->sum('grand_total') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-danger">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-calendar-1"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Due</p>
                            <h3 class="text-white">{{ $order_summeries->where('order_status', '!=' , 'delivered')->sum('grand_total') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-info">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="fa fa-list-alt"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Order</p>
                            <h3 class="text-white">{{ $order_summeries->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-success">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="fa fa-users"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Processing</p>
                            <h3 class="text-white">{{ $order_summeries->where('order_status', 'processing')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-secondary">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-calendar-1"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">On the Way</p>
                            <h3 class="text-white">{{ $order_summeries->where('order_status', 'On the Way')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-warning">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-calendar-1"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Delivered</p>
                            <h3 class="text-white">{{ $order_summeries->where('order_status', 'delivered')->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-6 col-lg-6 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h1>Order Details</h1>
                </div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section('footer_select2')
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        // type: 'pie',
        // type: 'line',
        type: 'bar',
        // type: 'doughnut',
        data: {
            labels: ['Processing', 'On the Way', 'Delivered'],
            datasets: [{
                label: '# Total',
                data: [{{ $order_summeries->where('order_status', 'processing')->count() }}, {{ $order_summeries->where('order_status', 'On the Way')->count() }}, {{ $order_summeries->where('order_status', 'delivered')->count() }}],
                backgroundColor: [
                    'rgba(41, 127, 0, 0.5)',
                    'rgba(102,16,242, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    </script>
@endsection



























{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Dashboard</div>

                <div class="card-body">
                   <h1>{{ auth()->user()->name }}</h1>
                   <p>{{ auth()->user()->email }}</p>

                    {{ __('You are logged in!') }}
                </div>
            </div>

            @if (session('delete_message'))
                    <div class="alert alert-danger">
                        {{ session('delete_message') }}
                    </div>
            @endif

            <table class="table table">
                <thead class="thead-inverse">
                    <tr>
                        <th>Serial No:</th>
                        <th>Team Member</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($teams as $team)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $team->name }}</td>
                            <td>
                                <a href="{{ url('team/member/delete') }}/{{ $team->id }}" class="btn btn-sm btn-danger">Delete</a>
                                <a href="{{ url('team/member/edite') }}/{{ Crypt::encrypt($team->id) }}" class="btn btn-sm btn-info">Edite</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
            </table>
        </div>
    </div>
</div>
@endsection --}}
