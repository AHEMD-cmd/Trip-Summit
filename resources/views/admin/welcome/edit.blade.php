@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Welcome Item</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('welcome-item.update',$welcomeItem->id) }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="form-label">Existing Photo</label>
                                            <div><img src="{{ $welcomeItem->photo }}" alt="" class="w_300"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Change Photo</label>
                                            <div><input type="file" name="photo"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Existing Video</label>
                                            <iframe class="iframe1" width="560" height="315" src="https://www.youtube.com/embed/{{ $welcomeItem->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Video (YouTube Id) *</label>
                                            <input type="text" class="form-control" name="video" value="{{ $welcomeItem->video }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Heading *</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $welcomeItem->heading }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control editor" cols="30" rows="10">{{ $welcomeItem->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Button Text</label>
                                    <input type="text" class="form-control" name="button_text" value="{{ $welcomeItem->button_text }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Button Link</label>
                                    <input type="text" class="form-control" name="button_link" value="{{ $welcomeItem->button_link }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="Show" {{ $welcomeItem->status == 'Show' ? 'selected' : '' }}>Show</option>
                                        <option value="Hide" {{ $welcomeItem->status == 'Hide' ? 'selected' : '' }}>Hide</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection