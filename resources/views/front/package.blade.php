@extends('front.layout.master')

@section('main_content')
    <div class="page-top page-top-package" style="background-image: url({{ $package->banner }})">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $package->name }}</h2>
                    <h3><i class="fas fa-plane-departure"></i> {{ $package->destination->name }}</h3>

                    @if ($package->total_score || $package->total_rating)
                        <div class="review">
                            <div class="set">
                                @php
                                    $package_rating = $package->total_score / $package->total_rating;
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $package_rating)
                                        <i class="fas fa-star"></i>
                                    @elseif($i - 0.5 <= $package_rating)
                                        <i class="fas fa-star-half-alt"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span>({{ number_format($package_rating, 1) }} out of 5)</span>
                        </div>
                    @else
                        <div class="review">
                            <div class="set">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                            <span>(No Rating Found)</span>
                        </div>
                    @endif

                    <div class="price">
                        ${{ $package->price }} @if ($package->old_price != '')
                            <del>${{ $package->old_price }}</del>
                        @endif
                    </div>
                    <div class="person">
                        per person
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="package-detail pt_50 pb_50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="main-item mb_50">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tab-1" data-bs-toggle="tab"
                                    data-bs-target="#tab-1-pane" type="button" role="tab" aria-controls="tab-1-pane"
                                    aria-selected="true">Detail</button>
                            </li>

                            @if ($package->packageItineraries->count() > 0)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-2" data-bs-toggle="tab"
                                        data-bs-target="#tab-2-pane" type="button" role="tab"
                                        aria-controls="tab-2-pane" aria-selected="false">Itinerary</button>
                                </li>
                            @endif

                            @if ($package->map != '')
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-3" data-bs-toggle="tab"
                                        data-bs-target="#tab-3-pane" type="button" role="tab"
                                        aria-controls="tab-3-pane" aria-selected="false">Location</button>
                                </li>
                            @endif

                            @if ($package->photos->count() > 0 || $package->videos->count() > 0)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-4" data-bs-toggle="tab"
                                        data-bs-target="#tab-4-pane" type="button" role="tab"
                                        aria-controls="tab-4-pane" aria-selected="false">Gallery</button>
                                </li>
                            @endif

                            @if ($package->faqs->count() > 0)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-5" data-bs-toggle="tab"
                                        data-bs-target="#tab-5-pane" type="button" role="tab"
                                        aria-controls="tab-5-pane" aria-selected="false">FAQ</button>
                                </li>
                            @endif

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-6" data-bs-toggle="tab" data-bs-target="#tab-6-pane"
                                    type="button" role="tab" aria-controls="tab-6-pane"
                                    aria-selected="false">Review</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-7" data-bs-toggle="tab" data-bs-target="#tab-7-pane"
                                    type="button" role="tab" aria-controls="tab-7-pane"
                                    aria-selected="false">Enquiry</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab-8" data-bs-toggle="tab" data-bs-target="#tab-8-pane"
                                    type="button" role="tab" aria-controls="tab-8-pane"
                                    aria-selected="false">Booking</button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="myTabContent">
                            <!-- Detail Tab -->
                            <div class="tab-pane fade show active" id="tab-1-pane" role="tabpanel"
                                aria-labelledby="tab-1" tabindex="0">
                                <h2 class="mt_30">Detail</h2>
                                <p>{!! $package->description !!}</p>

                                @if ($package->includedAmenities->count() > 0)
                                    <h2 class="mt_30">Includes</h2>
                                    <div class="amenity">
                                        <div class="row">
                                            @foreach ($package->includedAmenities as $item)
                                                <div class="col-lg-3 mb_15">
                                                    <i class="fas fa-check"></i> {{ $item->amenity->name }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if ($package->excludedAmenities->count() > 0)
                                    <h2 class="mt_30">Excludes</h2>
                                    <div class="amenity">
                                        <div class="row">
                                            @foreach ($package->excludedAmenities as $item)
                                                <div class="col-lg-3 mb_15">
                                                    <i class="fas fa-times"></i> {{ $item->amenity->name }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Itinerary Tab -->
                            @if ($package->packageItineraries->count() > 0)
                                <div class="tab-pane fade" id="tab-2-pane" role="tabpanel" aria-labelledby="tab-2"
                                    tabindex="0">
                                    <h2 class="mt_30">Itinerary</h2>
                                    <div class="tour-plan">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                @foreach ($package->packageItineraries as $item)
                                                    <tr>
                                                        <td><b>{{ $item->name }}</b></td>
                                                        <td>{!! $item->description !!}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Location Tab -->
                            @if ($package->map != '')
                                <div class="tab-pane fade" id="tab-3-pane" role="tabpanel" aria-labelledby="tab-3"
                                    tabindex="0">
                                    <h2 class="mt_30">Location Map</h2>
                                    <div class="location-map">
                                        {!! $package->map !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Gallery Tab -->
                            @if ($package->photos->count() > 0 || $package->videos->count() > 0)
                                <div class="tab-pane fade" id="tab-4-pane" role="tabpanel" aria-labelledby="tab-4"
                                    tabindex="0">
                                    @if ($package->photos->count() > 0)
                                        <h2 class="mt_30">Photos</h2>
                                        <div class="photo-all">
                                            <div class="row">
                                                @foreach ($package->photos as $item)
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="item">
                                                            <a href="{{ $item->photo }}" class="magnific">
                                                                <img src="{{ $item->photo }}"
                                                                    alt="{{ $item->photo }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if ($package->videos->count() > 0)
                                        <h2 class="mt_30">Videos</h2>
                                        <div class="video-all">
                                            <div class="row">
                                                @foreach ($package->videos as $item)
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="item">
                                                            <a class="video-button"
                                                                href="http://www.youtube.com/watch?v={{ $item->video }}">
                                                                <img src="http://img.youtube.com/vi/{{ $item->video }}/0.jpg"
                                                                    alt="{{ $item->video }}">
                                                                <div class="icon">
                                                                    <i class="far fa-play-circle"></i>
                                                                </div>
                                                                <div class="bg"></div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- FAQ Tab -->
                            @if ($package->faqs->count() > 0)
                                <div class="tab-pane fade" id="tab-5-pane" role="tabpanel" aria-labelledby="tab-5"
                                    tabindex="0">
                                    <h2 class="mt_30">Frequently Asked Questions</h2>
                                    <div class="faq-package">
                                        <div class="accordion" id="accordionExample">
                                            @foreach ($package->faqs as $item)
                                                <div class="accordion-item mb_30">
                                                    <h2 class="accordion-header" id="heading_{{ $loop->iteration }}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse_{{ $loop->iteration }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse_{{ $loop->iteration }}">
                                                            {{ $item->question }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse_{{ $loop->iteration }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="heading_{{ $loop->iteration }}"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            {!! $item->answer !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Review Tab -->
                            <div class="tab-pane fade" id="tab-6-pane" role="tabpanel" aria-labelledby="tab-6"
                                tabindex="0">
                                <div class="review-package">
                                    <h2>Reviews ({{ $package->reviews->count() }})</h2>

                                    @forelse($package->reviews as $item)
                                        <div class="review-package-section">
                                            <div class="review-package-box d-flex justify-content-start">
                                                <div class="left">
                                                    <img src="{{ $item->user->photo ?: asset('uploads/default.png') }}"
                                                        alt="{{ $item->user->name }}">
                                                </div>
                                                <div class="right">
                                                    <div class="name">{{ $item->user->name }}</div>
                                                    <div class="date">{{ $item->created_at->format('Y-m-d') }}</div>
                                                    <div class="review mb-2">
                                                        <div class="set">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $item->rating)
                                                                    <i class="fas fa-star"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="text">{!! $item->comment !!}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="alert alert-danger">No Review Found.</div>
                                    @endforelse

                                    <div class="mt_40"></div>
                                    <h2>Leave Your Review</h2>

                                    @if (Auth::guard('web')->check())
                                        @php
                                            $review_possible = App\Models\Booking::whereIn('tour_id', function (
                                                $query,
                                            ) use ($package) {
                                                $query
                                                    ->select('id')
                                                    ->from('tours')
                                                    ->where('package_id', $package->id);
                                            })
                                                ->where('user_id', Auth::guard('web')->user()->id)
                                                ->where('payment_status', 'Completed')
                                                ->count();

                                        @endphp

                                        @if ($review_possible > 0)
                                            @php
                                                $reviewed =
                                                    App\Models\Review::where('package_id', $package->id)
                                                        ->where('user_id', Auth::guard('web')->user()->id)
                                                        ->count() > 0;
                                            @endphp

                                            @if (!$reviewed)
                                                <form action="{{ route('review.store', $package->id) }}" method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <div class="give-review-auto-select">
                                                            @for ($i = 5; $i >= 1; $i--)
                                                                <input type="radio" id="star{{ $i }}"
                                                                    name="rating" value="{{ $i }}" />
                                                                <label for="star{{ $i }}"
                                                                    title="{{ $i }} stars"><i
                                                                        class="fas fa-star"></i></label>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <textarea class="form-control" rows="3" placeholder="Comment" name="comment"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-danger">You have already given a review.</div>
                                            @endif
                                        @else
                                            <div class="alert alert-danger">You have to book this package to give a review.
                                            </div>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="text-danger text-decoration-underline">Login to Review</a>
                                    @endif
                                </div>
                            </div>

                            <!-- Enquiry Tab -->
                            <div class="tab-pane fade" id="tab-7-pane" role="tabpanel" aria-labelledby="tab-7"
                                tabindex="0">
                                <h2 class="mt_30">Ask Your Question</h2>
                                <div class="enquery-form">
                                    <form action="{{ route('enquery.store', $package->id) }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Full Name"
                                                name="name">
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email Address"
                                                name="email">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Phone Number"
                                                name="phone">
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control h-150" rows="3" placeholder="Message" name="message"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Booking Tab -->
                            <div class="tab-pane fade" id="tab-8-pane" role="tabpanel" aria-labelledby="tab-8"
                                tabindex="0">
                                @if ($package->tours->count() > 0)
                                    <form action="{{ route('payment') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                                        <div class="row">
                                            <div class="col-md-8">
                                                @php $i = 0; @endphp
                                                @foreach ($package->tours as $item)
                                                    @if ($item->booking_end_date < date('Y-m-d'))
                                                        @continue
                                                    @endif
                                                    @php
                                                        $i++;
                                                        $total_booked_seats = App\Models\Booking::where(
                                                            'tour_id',
                                                            $item->id,
                                                        )->sum('total_person');
                                                        $remaining_seats =
                                                            $item->total_seat == -1
                                                                ? 'Unlimited'
                                                                : $item->total_seat - $total_booked_seats;
                                                    @endphp
                                                    <h2 class="mt_30">
                                                        <input type="radio" name="tour_id" value="{{ $item->id }}"
                                                            @if ($i == 1) checked @endif>
                                                        Tour {{ $i }}
                                                    </h2>
                                                    <div class="summary">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td><b>Tour Start Date</b></td>
                                                                    <td>{{ $item->tour_start_date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Tour End Date</b></td>
                                                                    <td>{{ $item->tour_end_date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Booking End Date</b></td>
                                                                    <td class="text-danger">{{ $item->booking_end_date }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Total Seat</b></td>
                                                                    <td>{{ $item->total_seat == -1 ? 'Unlimited' : $item->total_seat }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Booked Seat</b></td>
                                                                    <td>{{ $total_booked_seats }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Remaining Seat</b></td>
                                                                    <td>{{ $remaining_seats }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-md-4">
                                                <h2 class="mt_30">Payment</h2>
                                                <div class="summary">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>
                                                                    
                                                                    <label for=""><b>Number of Persons</b></label>
                                                                    <input type="number" min="1" max="100"
                                                                        name="total_person" class="form-control"
                                                                        value="1" id="numPersons"
                                                                        oninput="calculateTotal()">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for=""><b>Total</b></label>
                                                                    <input type="text" name=""
                                                                        class="form-control" id="totalAmount"
                                                                        value="${{ $package->price }}" disabled>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for=""><b>Select Payment
                                                                            Method</b></label>
                                                                    <select name="payment_method" class="form-select">
                                                                        <option value="PayPal">PayPal</option>
                                                                        <option value="Stripe">Stripe</option>
                                                                        <option value="Cash">Cash</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    @if (Auth::guard('web')->check())
                                                                        <button type="submit" class="btn btn-primary">Pay
                                                                            Now</button>
                                                                    @else
                                                                        <a href="{{ route('login') }}"
                                                                            class="btn btn-primary">Login to Book</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <script>
                                                    function calculateTotal() {
                                                        const ticketPrice = document.getElementById('ticketPrice').value;
                                                        const numPersons = document.getElementById('numPersons').value;
                                                        const totalAmount = ticketPrice * numPersons;
                                                        document.getElementById('totalAmount').value = `$${totalAmount}`;
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div class="alert alert-danger">
                                        No Tour Available.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
