
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="card-title">Edite team Member</h4>
                </div>
                <div class="card-body">

                    @if (session('success_message'))
                    <div class="alert alert-success">
                        {{ session('success_message') }}
                    </div>
                    @endif

                    <form action="{{ url('/team/member/update') }}/{{ $team_info->id }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Team Member Name</label>
                            <input type="text" class="form-control" name="team_member_name" value="{{ $team_info->name }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Add team Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection();
