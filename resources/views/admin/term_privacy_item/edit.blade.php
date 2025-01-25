@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Term and Privacy Item</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('term-privacy-items.update', 1) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Terms of Use</label>
                                    <textarea name="term" class="form-control editor" cols="30" rows="10">{{ $termPrivacyItem->term }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Privacy Policy</label>
                                    <textarea name="privacy" class="form-control editor" cols="30" rows="10">{{ $termPrivacyItem->privacy }}</textarea>
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