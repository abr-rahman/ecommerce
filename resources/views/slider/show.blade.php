@extends('layouts.dashboard_master')

@section('dashboard_bar')
    Show Slider
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h4 class="text-white">Slider Details</h4>
                </div>
              <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $slider->slider_name}}</td>
                        </tr>
                        <tr>
                            <td>Created By</td>
                            <td>
                                {{ App\Models\User::find($slider->created_by)->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>
                                    {{ $slider->created_at->format('d/m/Y h:i:s A') }}
                                @if ( $slider->created_at->diffinseconds() < 60 )
                                    <div class="badge bg-dark text-white btn btn-tumblr">Just Naw</div>
                                @else
                                    <div class="badge text-white btn-tumblr">{{  $slider->created_at->diffforhumans() }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Last Updated By</td>
                            <td>
                                @if ($slider->updated_by)
                                    {{ App\Models\User::find($slider->updated_by)->name }}
                                @else
                                    <span class="badge btn-primary text-white">No Updated</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Last Updated At</td>
                            <td>
                                @if ($slider->updated_at)

                                        @if ( $slider->updated_at->diffinseconds() < 60 )
                                            <div class="badge-sm bg-dark text-info">Just Naw</div>
                                        @else
                                        <span class="badge badge-dark">{{ $slider->updated_at->diffforhumans() }}</span>
                                        @endif
                                @else
                                    <span class="badge badge-info">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ url()->previous() }}" class="btn btn-tumblr">Back</a>
                    </div>
                </div>
              </div>
            </div>

        </div>
    </div>

@endsection

