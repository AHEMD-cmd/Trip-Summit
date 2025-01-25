@extends('front.layout.master')

@section('main_content')
{{-- @php
$setting = App\Models\Setting::where('id',1)->first();
@endphp --}}
<div class="page-top" style="background-image: url({{ $setting->banner }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Team Members</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Team Members</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="team pt_70">
    <div class="container">
        <div class="row">
            @foreach($teamMembers as $teamMember)
            <div class="col-lg-3 col-md-6">
                <div class="item pb_50">
                    <div class="photo">
                        <img src="{{ $teamMember->photo }}" alt="{{$teamMember->photo}}" />
                    </div>
                    <div class="text">
                        <h2><a href="{{ route('team-member.show',$teamMember->slug) }}">{{ $teamMember->name }}</a></h2>
                        <div class="designation">{{ $teamMember->designation }}</div>
                        @if($teamMember->facebook != '' || $teamMember->twitter != '' || $teamMember->linkedin != '' || $teamMember->instagram != '')
                        <div class="social">
                            <ul>
                                @if($teamMember->facebook != '')
                                    <li><a href="{{ $teamMember->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if($teamMember->twitter != '')
                                <li><a href="{{ $teamMember->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if($teamMember->linkedin != '')
                                <li><a href="{{ $teamMember->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                @endif
                                @if($teamMember->instagram != '')
                                <li><a href="{{ $teamMember->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="container pb_50">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $teamMembers->links() }}
        </div>
    </div>
</div>
@endsection