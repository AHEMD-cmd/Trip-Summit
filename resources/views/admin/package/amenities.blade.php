@extends('admin.layout.master')
@section('main_content')
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Amenities of {{ $package->name }}</h1>
                <div class="ml-auto">
                    <a href="{{ route('packages.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> back to
                        previous</a>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">


                                <h4>Includes</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Amenity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($packageAmenitiesInclude as $packageAmenity)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $packageAmenity->amenity->name }}
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('packages.amenities.destroy', ['package' => $package->id, 'amenity' => $packageAmenity->id]) }}"
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



                                <h4>Excludes</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Amenity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($packageAmenitiesExclude as $packageAmenity)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $packageAmenity->amenity->name }}
                                                    </td>
                                                    <td>
                                                        <form
                                                            action="{{ route('packages.amenities.destroy', ['package' => $package->id, 'amenity' => $packageAmenity->id]) }}"
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
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('packages.amenities.store', $package->id) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Amenity *</label>
                                        <select name="amenity_id" class="form-select">
                                            @foreach ($amenities as $amenity)
                                                <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select name="type" class="form-select">
                                            <option value="Include">Include</option>
                                            <option value="Exclude">Exclude</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"></label>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
