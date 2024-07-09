@extends('layout.base')

@section('content')
    <section class="page-header"
        style="background-image: url('{{ asset('assets/images/backgrounds/page-header-contact.png') }}');">
        <div class="container">
            <h2>Tour Details</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Tours</span></li>
            </ul><!-- /.thm-breadcrumb -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    @php
        // Step 1: Parse the original dates
        $start_date = DateTime::createFromFormat('Y-m-d', $tour->start_date);
        $end_date = DateTime::createFromFormat('Y-m-d', $tour->end_date);
        // Convert dates to timestamps
        $start_timestamp = $start_date->getTimestamp();
        $end_timestamp = $end_date->getTimestamp();

        // Calculate the difference in seconds
        $diff_seconds = abs($end_timestamp - $start_timestamp);

        // Convert seconds to days
        $duration = $diff_seconds / (60 * 60 * 24);
    @endphp
    <style>
        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            color: #ddd;
            font-size: 2em;
            padding: 0;
            cursor: pointer;
            font-family: FontAwesome;
        }

        .rating label:before {
            content: "\f005";
            /* FontAwesome star icon */
        }

        .rating input:checked~label {
            color: #ffd700;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: #ffd700;
        }

        .fa-star {
            color: #ddd;
            /* Default star color */
        }

        .fa-star.active {
            color: #ffd700;
            /* Active star color */
        }

        .rating input:checked+label:hover,
        .rating input:checked+label:hover~label,
        .rating input:checked~label:hover,
        .rating input:checked~label:hover~label {
            color: #ffed85;
        }

        .hotel-slider {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            /* Center the items horizontally */
            padding: 20px;
            /* Add padding to the container */
        }

        .hotel-item {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 400px;
            /* Set a fixed height for each card */
            width: 300px;
            /* Set a fixed width for each card */
            margin: 10px;
            /* Add margin to ensure space between cards */
            position: relative;
            /* Needed for positioning the overlay link */
        }

        .hotel-image-container {
            overflow: hidden;
            flex: 1;
            position: relative;
            /* Needed for positioning the overlay link */
        }

        .hotel-image img {
            width: 100%;
            /* Ensure the image fills the container */
            height: 200px;
            /* Set a fixed height for the image */
            object-fit: cover;
            /* Ensures the image covers the area without distortion */
            display: block;
        }

        .image-overlay-link {
            position: absolute;
            top: 20%;
            left: 85%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .image-overlay-link:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .hotel-info {
            padding: 10px 20px;
            /* Adjusted padding to reduce space */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .hotel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .hotel-header-left {
            display: flex;
            flex-direction: column;
        }

        .hotel-rating {
            color: #f39c12;
            margin-bottom: 5px;
        }

        .hotel-rating i {
            margin-right: 2px;
        }

        .hotel-meta {
            margin-top: 10px;
            /* Adjusted margin to reduce space */
        }

        .hotel-meta li {
            display: flex;
            align-items: center;
            color: #777;
            font-size: 0.9em;
        }

        .hotel-meta li i {
            margin-right: 5px;
        }

        .hotel-title,
        .hotel-title a {
            font-family: var(--thm-font);
            color: var(--thm-black);
        }

        .hotel-city,
        .hotel-city a {
            font-family: var(--thm-font);
            color: var(--thm-black);
        }

        .activity-description {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .activity-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
    <section class="tour-two tour-list tour-details-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tour-details__content">
                        <div class="tour-two__top">
                            <div class="tour-two__top-left">
                                <h3>{{ $tour->tour_name }}</h3>
                                <div class="tour-one__stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($tour->rating))
                                            <i class="fa fa-star"></i>
                                        @elseif ($i == ceil($tour->rating) && $tour->rating - floor($tour->rating) > 0)
                                            <i class="fa fa-star-half-alt"></i>
                                        @else
                                            <i class="fa fa-star inactive"></i>
                                        @endif
                                    @endfor
                                    {{ $tour->rating }} Reviews
                                </div><!-- /.tour-one__stars -->
                            </div><!-- /.tour-two__top-left -->
                            <div class="tour-two__right">
                                <p><span>${{ $tour->budget }}</span> <br> Per Person</p>
                            </div><!-- /.tour-two__right -->
                        </div><!-- /.tour-two__top -->
                        <ul class="tour-one__meta list-unstyled">
                            <li><a href="#"><i class="far fa-clock"></i>2 days</a></li>
                            {{-- <li><a href="#"><i
                                        class="far fa-user-circle"></i>{{ $tour->number_of_people }}</a></li> --}}
                            <li><a href="#"><i class="far fa-bookmark"></i>
                                    @php
                                        $uniqueActivities = collect($daysActivities)->unique('activity_type');
                                    @endphp
                                    @foreach ($uniqueActivities as $activity)
                                        {{ $activity->activity_type }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </a></li>
                            <li><a href="#"><i class="far fa-map"></i>
                                    @foreach ($citiesName as $city)
                                        {{ $city }}
                                    @endforeach
                                </a></li>
                        </ul><!-- /.tour-one__meta -->
                        <br>

                        @if ($hotels->isNotEmpty())
                            <h3 class="tour-details__title">Places to stay</h3><!-- /.tour-details__title -->
                            <div class="hotel-slider">
                                @foreach ($hotels as $hotel)
                                    <div class="hotel-item">
                                        <div class="hotel-image-container">
                                            <div class="hotel-image">
                                                <img src="{{ $hotel->image ? asset('uploads/Hotel/' . $hotel->image) : asset('assets/images/default/hotel-default.webp') }}"
                                                    alt="" width="200px">
                                                <a href="{{ $hotel->website }}" class="image-overlay-link"><i
                                                        class="fa fa-long-arrow-alt-right"></i></a>
                                            </div>
                                        </div>
                                        <div class="hotel-info">
                                            <div class="hotel-header">
                                                <div class="hotel-header-left">
                                                    <div class="hotel-rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= floor($hotel->rating))
                                                                <i class="fa fa-star"></i>
                                                            @elseif ($i == ceil($hotel->rating) && $hotel->rating - floor($hotel->rating) > 0)
                                                                <i class="fa fa-star-half-alt"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                        {{ $hotel->rating }} stars
                                                    </div>
                                                    <h3 class="hotel-title"><a
                                                            href="{{ $hotel->website }}">{{ Str::limit($hotel->hotel_name, 20) }}</a>
                                                    </h3>
                                                </div>
                                            </div>


                                            <ul class="hotel-one__meta list-unstyled">
                                                <li><a href="hotel-details.html"><i class="far fa-map"></i>
                                                        {{ $hotel->location->city->city_name }}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif



                        {{-- <div class="tour-details__spacer"></div><!-- /.tour-details__spacer --> --}}
                        <h3 class="tour-details__title">Tour Plan</h3><!-- /.tour-details__title -->

                        <div class="tour-details__plan">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($toursDays as $index => $tourDay)
                                <div class="tour-details__plan-single">
                                    <div class="tour-details__plan-count">
                                        {{ sprintf('%02d', $index + 1) }}
                                    </div>
                                    <div class="tour-details__plan-content">
                                        <h3>Day {{ $index + 1 }} </h3>
                                        <ul class="list-unstyled">

                                            @for ($j = 0; $j < $tourDay->day_activities_count; $j++, $i++)
                                                @if ($activities[$i] instanceof \App\Models\Restaurant)
                                                    @switch($i)
                                                        @case(0)
                                                            <div class="activity-description">
                                                                <div class="activity-title">Start your day at Habibah Sweets</div>
                                                                <p>
                                                                    Enjoy traditional Middle Eastern pastries, especially their
                                                                    famous Kunafa. A perfect start to your culinary journey.
                                                                </p>
                                                            </div>
                                                        @break

                                                        @case(1)
                                                            <div class="activity-description">
                                                                <div class="activity-title">Lunch at Sufra Restaurant</div>
                                                                <p>
                                                                    Experience traditional Jordanian home-cooked meals in a
                                                                    historic setting. Must-try dishes include Mansaf and Maqluba.
                                                                </p>
                                                            </div>
                                                        @break

                                                        @case(2)
                                                            <div class="activity-description">
                                                                <div class="activity-title">Dinner at Hashem Restaurant</div>
                                                                <p>
                                                                    Enjoy simple yet delicious fare like falafel, hummus, and
                                                                    ful at this legendary spot in downtown Amman.
                                                                </p>
                                                            </div>
                                                        @break

                                                        @default
                                                            <div class="activity-description">
                                                                <div class="activity-title">Explore Amman's Culinary Scene</div>
                                                                <p>
                                                                    Discover the rich flavors and traditions of Jordanian
                                                                    cuisine at one of Amman's wonderful restaurants.
                                                                </p>
                                                            </div>
                                                    @endswitch
                                                @elseif ($activities[$i] instanceof \App\Models\HistoricalSite)
                                                    @switch($i)
                                                        @case(0)
                                                            <div class="activity-description">
                                                                <div class="activity-title">Visit the Roman Theater</div>
                                                                <p>
                                                                    A magnificent ancient amphitheater in the heart of Amman,
                                                                    offering a glimpse into Roman architectural grandeur.
                                                                </p>
                                                            </div>
                                                        @break

                                                        @case(1)
                                                            <div class="activity-description">
                                                                <div class="activity-title">Explore the Citadel</div>
                                                                <p>
                                                                    Discover the ruins of the Temple of Hercules, the Umayyad
                                                                    Palace, and the Byzantine Church with stunning panoramic
                                                                    views.
                                                                </p>
                                                            </div>
                                                        @break

                                                        @default
                                                            <div class="activity-description">
                                                                <div class="activity-title">Discover Amman's Historical Sites</div>
                                                                <p>
                                                                    Each site offers a unique glimpse into the city's rich past
                                                                    and cultural heritage.
                                                                </p>
                                                            </div>
                                                    @endswitch
                                                @elseif ($activities[$i] instanceof \App\Models\Activity)
                                                    @switch($activities[$i]->activity_name)
                                                        @case('The Jordanian Kitchen')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Royal Automobile Museum')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Children\'s Museum')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('The Jordan Museum')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Jordan Archaeological Museum')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Royal Tank Museum')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Amman Panorama Art Gallery')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Darat al Funun')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Old Signs Of Amman')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Scuba Diving')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Glass-Bottom Boat')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Saraya Aqaba Waterpark')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('City Beach')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Camping and Hiking Adventure')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Wadi Al Mujib Adventures')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Hot Air Balloon Flight')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Ad-Deir Trail')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Al Khubtha Trail')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Dead Sea Museum')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Zara Cliff Walking Trail')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @case('Dead Sea Mud Bath')
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                        @break

                                                        @default
                                                            <div class="activity-description">
                                                                <div class="activity-title">{{ $activities[$i]->activity_name }}
                                                                </div>
                                                                <p>{{ $activities[$i]->description }}</p>
                                                                <a href="{{ $activities[$i]->website }}" target="_blank">Visit
                                                                    Website</a>
                                                            </div>
                                                    @endswitch
                                                @endif
                                            @endfor

                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div><!-- /.tour-details__plan -->

                        <div class="tour-details__spacer"></div><!-- /.tour-details__spacer -->
                        <h3 class="tour-details__title">Tour Location</h3><!-- /.tour-details__title -->
                        <iframe src="{{ $tour->city->crs }}" class="google-map__contact google-map__tour-details"
                            allowfullscreen></iframe>

                        <br>
                        @if ($tour->created_by == 'user')
                            <h3 class="tour-details__title">Tour Created By</h3><!-- /.tour-details__title -->
                            <div class="tour-details__review-comment">
                                <div class="tour-details__review-comment-single">
                                    <div class="tour-details__review-comment-top">
                                        <img src="{{ $tour->user->user_pfp ? asset('uploads/user_profile_pictures/' . $tour->user->user_pfp) : asset('assets/images/default/user-default-picture.png') }}"
                                            alt="{{ $tour->user->first_name }} {{ $tour->user->last_name }}"
                                            width="100px" />
                                        <h3>{{ $tour->user->first_name . ' ' . $tour->user->last_name }}</h3>
                                        <p>{{ $tour->created_at->format('d M, Y') }}</p>
                                    </div><!-- /.tour-details__review-comment-top -->
                                </div><!-- /.tour-details__review-comment-single -->
                            </div><!-- /.tour-details__review-comment -->
                        @endif
                        <br>

                        <h3 class="tour-details__title">Reviews</h3><!-- /.tour-details__title -->
                        @foreach ($reviews as $review)
                            <div class="tour-details__review-comment-content">
                                <div class="tour-details__review-comment-top">
                                    <img src="{{ $review->user->user_pfp ? asset('uploads/user_profile_pictures/' . $review->user->user_pfp) : asset('assets/images/default/user-default-picture.png') }}"
                                        alt="{{ $tour->user->first_name }} {{ $tour->user->last_name }}"
                                        width="100px" />
                                    <h3>{{ $tour->user->first_name . ' ' . $tour->user->last_name }}</h3>
                                    <p>{{ $review->created_at->format('d M, Y') }}</p>
                                </div><!-- /.tour-details__review-comment-top -->
                                <p>{{ $review->content }}</p>
                            </div><!-- /.tour-details__review-comment-content -->
                            <div class="tour-details__review-form-stars">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><span>Rate</span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($review->rating))
                                                    <i class="fa fa-star active"></i>
                                                @elseif ($i == ceil($review->rating) && $review->rating - floor($review->rating) > 0)
                                                    <i class="fa fa-star-half-alt active"></i>
                                                @else
                                                    <i class="fa fa-star"></i>
                                                @endif
                                            @endfor
                                        </p>
                                    </div><!-- /.col-md-4 -->
                                </div><!-- /.row -->
                            </div><!-- /.tour-details__review-form-stars -->
                        @endforeach
                        @auth
                            <h3 class="tour-details__title">Write a Review</h3><!-- /.tour-details__title -->
                            <div class="tour-details__review-form">

                                <form action="javascript:void(0);" method="POST" class="contact-one__form">
                                    @csrf
                                    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                    <div class="tour-details__review-form-stars">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rating"
                                                        value="5" /><label for="star5" title="5 stars"></label>
                                                    <input type="radio" id="star4" name="rating"
                                                        value="4" /><label for="star4" title="4 stars"></label>
                                                    <input type="radio" id="star3" name="rating"
                                                        value="3" /><label for="star3" title="3 stars"></label>
                                                    <input type="radio" id="star2" name="rating"
                                                        value="2" /><label for="star2" title="2 stars"></label>
                                                    <input type="radio" id="star1" name="rating"
                                                        value="1" /><label for="star1" title="1 star"></label>
                                                </div>
                                            </div><!-- /.col-md-4 -->
                                        </div><!-- /.row -->
                                    </div><!-- /.tour-details__review-form-stars -->
                                    <div class="row low-gutters">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <textarea name="content" placeholder="Write Message"></textarea>
                                            </div><!-- /.input-group -->
                                        </div><!-- /.col-md-12 -->
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <button type="submit" class="thm-btn contact-one__btn">Submit a
                                                    review</button>
                                                <!-- /.thm-btn contact-one__btn -->
                                            </div><!-- /.input-group -->
                                        </div><!-- /.col-md-12 -->
                                    </div><!-- /.row low-gutters -->
                                </form>

                            </div><!-- /.tour-details__review-form -->
                        </div><!-- /.tour-details__content -->

                    </div><!-- /.col-lg-8 -->
                    @if ($tour->created_by != 'user')
                        <div class="col-lg-4">
                            <div class="tour-sidebar">
                                <div class="tour-sidebar__search tour-sidebar__single">
                                    <h3>Book This Tour</h3>
                                    <form action="{{ route('tour.checkout') }}" method="GET"
                                        class="tour-sidebar__search-form">
                                        <input type="hidden" name="tour_id" value="{{ $tour->id }}">
                                        <div class="input-group">
                                            <input type="text" placeholder="Phone" id="phone" name="phone"
                                                required>
                                        </div><!-- /.input-group -->
                                        <div class="input-group">
                                            <input type="email" placeholder="Email" id="email" name="email"
                                                required>
                                        </div><!-- /.input-group -->
                                        <div class="input-group">
                                            <button type="submit" class="thm-btn" onclick="return validateEmail()">Book
                                                Now</button>
                                        </div><!-- /.input-group -->
                                        <div class="errMessage"></div>
                                    </form>
                                </div><!-- /.tour-sidebar__search -->
                            </div><!-- /.tour-sidebar -->
                        </div><!-- /.col-lg-4 -->
                    @endif
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.tour-two -->
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.contact-one__form').on('submit', function(e) {
                // e.preventDefault(); // Prevent the default form submission

                var formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: "{{ route('review.store') }}", // URL to the store route
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // CSRF token for security
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        location.reload();
                        // Reset the form
                        $('.contact-one__form')[0].reset();
                        // Optionally, reset the star rating
                        $('.rating input').prop('checked', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);

                    }
                });
            });
        });
    </script>
@endsection
<script>
   function validateEmail() {
        var inputEmail = document.getElementById('email').value;
        var userEmail =
        "{{ auth()->check() ? auth()->user()->email : '' }}"; // Check if a user is logged in and get the email if available
        var errMessageDiv = document.querySelector('.errMessage');

        if (!userEmail) {
            errMessageDiv.innerHTML =
                '<p style="color: red;">You are not logged in. Please log in to validate your email.</p>';
            return false;
        }

        if (inputEmail !== userEmail) {
            errMessageDiv.innerHTML = '<p style="color: red;">Please write the email you logged in with.</p>';
            return false;
        }

        errMessageDiv.innerHTML = ''; // Clear the error message if the email is valid
        return true;
    }
</script>
