@extends('front.layout.master')

@section('main_content')
@php
$setting = App\Models\Setting::where('id',1)->first();
@endphp
<div class="page-top" style="background-image: url({{ $setting->banner }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog</h2>
                <div class="breadcrumb-container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog pt_70">
    <div class="container">
        <div class="row">

            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="item pb_70">
                    <div class="photo">
                        <img src="{{ $post->photo }}" alt="{{$post->photo}}">
                    </div>
                    <div class="text">
                        <h2>
                            <a href="{{ route('post.show',$post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <div class="short-des">
                            <p>
                                {!! $post->short_description !!}
                            </p>
                        </div>
                        <div class="button-style-2 mt_20">
                            <a href="{{ route('post.show',$post->slug) }}">Read More</a>
                        </div>
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
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection