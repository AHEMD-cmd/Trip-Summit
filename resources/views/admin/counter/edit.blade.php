@extends('admin.layout.master')
@section('main_content')
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Edit Counter Item</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('counters-item.update', $counterItem->id) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 1 - Number *</label>
                                                <input type="text" class="form-control" name="item1_number"
                                                    value="{{ $counterItem->item1_number }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 1 - Text *</label>
                                                <input type="text" class="form-control" name="item1_text"
                                                    value="{{ $counterItem->item1_text }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 2 - Number *</label>
                                                <input type="text" class="form-control" name="item2_number"
                                                    value="{{ $counterItem->item2_number }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 2 - Text *</label>
                                                <input type="text" class="form-control" name="item2_text"
                                                    value="{{ $counterItem->item2_text }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 3 - Number *</label>
                                                <input type="text" class="form-control" name="item3_number"
                                                    value="{{ $counterItem->item3_number }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 3 - Text *</label>
                                                <input type="text" class="form-control" name="item3_text"
                                                    value="{{ $counterItem->item3_text }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 4 - Number *</label>
                                                <input type="text" class="form-control" name="item4_number"
                                                    value="{{ $counterItem->item4_number }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Item 4 - Text *</label>
                                                <input type="text" class="form-control" name="item4_text"
                                                    value="{{ $counterItem->item4_text }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="Show" {{ $counterItem->status == 'Show' ? 'selected' : '' }}>
                                                Show</option>
                                            <option value="Hide" {{ $counterItem->status == 'Hide' ? 'selected' : '' }}>
                                                Hide</option>
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
