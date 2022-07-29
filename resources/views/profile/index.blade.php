@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Profile
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo">
                        <img src="{{ asset('upload/cover_photo') }}/{{ auth()->user()->cover_photo }}" class="img-fluid" alt="not found">
                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        <img src="{{ asset('upload/profile_photo') }}/{{ auth()->user()->profile_photo }}" class="img-fluid rounded-circle" alt="not found">
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0"> {{ auth()->user()->name }} </h4>
                            <p>Name</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">{{ auth()->user()->email }} </h4>
                            <p>Email</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">
                                @if ( auth()->user()->phone_number)
                                    {{ auth()->user()->phone_number }}
                                @else
                                    N/A
                                @endif
                            </h4>
                            <p>Phone Number</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">
                                @if (auth()->user()->address)
                                {{ auth()->user()->address }}
                                @else
                                    N/A
                                @endif

                            </h4>
                            <p>Adderss</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="pt-3">
                    <div class="settings-form">
                        <h4 class="text-primary">Account Setting</h4>

                            @if ( session('status' ))
                                <div class="alert alert-success">
                                    {{ session('status' )}}
                                </div>
                            @endif
                            <form action="{{ route('change.name') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ auth()->user()->name }}" placeholder="" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Phone Number (01xxxxxxxxx)</label>
                                            <input type="text" value="{{ auth()->user()->phone_number }}" placeholder="" class="form-control" name="phone_number">
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" value="{{ auth()->user()->address }}" placeholder="" class="form-control" name="address">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Profile Picture</label>
                                            <input type="file" value="" placeholder="" class="form-control" name="profile_photo">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Cover Photo</label>
                                            <input type="file" value="" placeholder="" class="form-control" name="cover_photo">
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-info btn-sm" type="submit">Change</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="pt-3">
                    <div class="settings-form">
                        <h4 class="text-primary">Change Password</h4>

                            @if ( session('change_password' ))
                                <div class="alert alert-success">
                                    {{ session('change_password' )}}
                                </div>
                            @endif
                            <form action="{{ route('change.password') }}" method="post">
                                @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Current Password</label>
                                    <input type="password" placeholder="Password" class="form-control" name="current_password">
                                @error('current_password_err')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>New Password</label>
                                    <input type="password" placeholder="New Password" class="form-control" name="password">
                                @error('password')
                                   <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                 @enderror
                                </div>

                            </div>

                            <button class="btn btn-primary btn-sm" type="submit">Password Change</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection



