@extends('main.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1>This is my Header</h1>
                </div>
                <div class="card-body">
                    {{-- @foreach ($members_name as $serial_no => $team_member)
                        <h3>{{ $serial_no +1 }}</h3>
                    Name: {{ $team_member}}
                    @endforeach --}}


                    @foreach ($members_name as $team_member)

                    <div class="alert alert-{{ ($loop->odd == 1) ? 'info':'seccess'}}">
                    <h3>{{ $loop->index +1 }}</h3>
                    Name: {{ $team_member->name}}
                    </div>
                    @endforeach


                </div>
                <h4>This is my body</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
