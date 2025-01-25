@extends('front.layout.master')

@section('main_content')
    @php
        $setting = App\Models\Setting::where('id', 1)->first();
    @endphp
    <div class="page-top" style="background-image: url({{ $setting->banner }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $teamMember->name }}</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('team-members.index') }}">Team Members</a></li>
                            <li class="breadcrumb-item active">{{ $teamMember->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="team-single pt_70 pb_70 bg_f3f3f3">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="photo">
                        <img src="{{ $teamMember->photo }}" alt="{{ $teamMember->photo }}">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Name</td>
                                <td>{{ $teamMember->name }}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{ $teamMember->designation }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $teamMember->address }}</td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td>{{ $teamMember->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $teamMember->phone }}</td>
                            </tr>
                            @if (
                                $teamMember->facebook != '' ||
                                    $teamMember->twitter != '' ||
                                    $teamMember->linkedin != '' ||
                                    $teamMember->instagram != '')
                                <tr>
                                    <td>Social Media</td>
                                    <td>
                                        <ul>
                                            @if ($teamMember->facebook != '')
                                                <li><a href="{{ $teamMember->facebook }}" target="_blank"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                            @endif
                                            @if ($teamMember->twitter != '')
                                                <li><a href="{{ $teamMember->twitter }}" target="_blank"><i
                                                            class="fab fa-twitter"></i></a></li>
                                            @endif
                                            @if ($teamMember->linkedin != '')
                                                <li><a href="{{ $teamMember->linkedin }}" target="_blank"><i
                                                            class="fab fa-linkedin-in"></i></a></li>
                                            @endif
                                            @if ($teamMember->instagram != '')
                                                <li><a href="{{ $teamMember->instagram }}" target="_blank"><i
                                                            class="fab fa-instagram"></i></a></li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>

                <div class="col-md-12 mt_30">
                    <h4>Biography</h4>
                    <div class="description">
                        {!! $teamMember->biography !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
