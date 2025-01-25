@extends('admin.layout.master')
@section('main_content')
    @include('admin.layout.nav')
    @include('admin.layout.sidebar')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <h1>Booking Information</h1>
                <div class="ml-auto">
                    <a href="{{ route('tours.index') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to
                        Previous</a>
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
                                                <th>Invoice No</th>
                                                <th>User Info</th>
                                                <th>Total Persons</th>
                                                <th>Paid Amount</th>
                                                <th>Payment Method</th>
                                                <th>Payment Status</th>
                                                <th>Show Invoice</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tour->bookings as $booking)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        {{ $booking->invoice_no }}
                                                    </td>
                                                    <td>
                                                        <strong>Name:</strong> {{ $booking->user->name }}<br>
                                                        <strong>Email:</strong> {{ $booking->user->email }}<br>
                                                        <strong>Phone:</strong> {{ $booking->user->phone }}
                                                    </td>
                                                    <td>{{ $booking->total_person }}</td>
                                                    <td>{{ $booking->paid_amount }}</td>
                                                    <td>{{ $booking->payment_method }}</td>
                                                    <td>
                                                        @if ($booking->payment_status == 'Completed')
                                                            <span class="badge bg-success">Completed</span>
                                                        @else
                                                            <span class="badge bg-danger">Pending</span>
                                                            <br>
                                                            <br>
                                                            <form
                                                                action="{{ route('tours.bookings.update', [$tour->id, $booking->id]) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="btn btn-primary btn-sm">Approve It</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('tours.bookings.show', [$tour->id, $booking->id]) }}"
                                                            class="badge bg-primary text-decoration-none"
                                                            target="_blank">Show Invoice</a>
                                                    </td>
                                                    <td class="pt_10 pb_10">
                                                        <form
                                                            action="{{ route('tours.bookings.destroy', [$tour->id, $booking->id]) }}"
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
