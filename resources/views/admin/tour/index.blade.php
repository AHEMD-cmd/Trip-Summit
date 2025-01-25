@extends('admin.layout.master')
@section('main_content')
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Tours</h1>
                <div class="ml-auto">
                    <a href="{{ route('tours.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                                                <th>Package Info</th>
                                                <th>Tour Start</th>
                                                <th>Tour End</th>
                                                <th>Booking End</th>
                                                <th>Total Seat</th>
                                                <th>Booking</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tours as $tour)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $tour->package->name }}<br>
                                                        <a href="{{ route('package.show', $tour->package->slug) }}"
                                                            target="_blank">See Detail</a>
                                                    </td>
                                                    <td>{{ $tour->tour_start_date }}</td>
                                                    <td>{{ $tour->tour_end_date }}</td>
                                                    <td>{{ $tour->booking_end_date }}</td>
                                                    <td>
                                                        @if ($tour->total_seat == -1)
                                                            Unlimited
                                                        @else
                                                            {{ $tour->total_seat }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('tours.bookings.index', $tour->id) }}"
                                                            class="btn btn-success btn-sm">Booking Information</a>
                                                    </td>

                                                    <td class="pt_10 pb_10" style="width: 15%">
                                                        <a href="{{ route('tours.edit', $tour->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <!-- Delete Form -->
                                                        <form action="{{ route('tours.destroy', $tour->id) }}"
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
