@extends('admin.layout.master')
@section('main_content')
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Packages</h1>
                <div class="ml-auto">
                    <a href="{{ route('packages.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Featured Photo</th>
                                                <th>Name</th>
                                                <th>Gallery</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($packages as $package)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ $package->featured_photo }}" alt=""
                                                            class="w_200">
                                                    </td>
                                                    <td>{{ $package->name }}</td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ route('packages.amenities.index', $package->id) }}"
                                                                class="btn btn-success mb-2">Amenities</a>
                                                            <a href="{{ route('packages.itineraries.index', $package->id) }}"
                                                                class="btn btn-success mb-2">Itinerary</a>
                                                            <a href="{{ route('packages.faqs.index', $package->id) }}"
                                                                class="btn btn-success mb-2">FAQ</a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('packages.photos.index', $package->id) }}"
                                                                class="btn btn-success mb-2">Photo Gallery</a>
                                                            <a href="{{ route('packages.videos.index', $package->id) }}"
                                                                class="btn btn-success mb-2">Video Gallery</a>
                                                        </div>
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <a href="{{ route('packages.edit', $package->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>

                                                        <form action="{{ route('packages.destroy', $package->id) }}"
                                                            method="POST" class="delete-form" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
