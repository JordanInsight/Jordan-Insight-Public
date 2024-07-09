@extends('layout.base')
@section('content')
    <x-search-box :Categories='$Categories' /> {{-- from the controller to the search-box to the index --}}


    <section class="blog-one">
        <div class="container">
            <div class="block-title text-center">
                <p>Check out Our</p>
                <h3>Most Popular Tours</h3>
            </div><!-- /.block-title -->
            <div class="row" id="tour-list">
                @foreach ($tours as $tour)
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="blog-one__single" style="margin-bottom: 20px;">
                            <div class="blog-one__image">
                                <img src="{{ $tour->image ? asset('uploads/Tour/' . $tour->image) : asset('assets/images/default/post-default.webp') }}"
                                    alt="Image for {{ $tour->tour_name }}">
                                <a href="/tour-details/{{ $tour->id }}" class="image-overlay-link"><i
                                        class="fa fa-long-arrow-alt-right"></i></a>
                            </div><!-- /.blog-one__image -->
                            <div class="blog-one__content">
                                <div class="blog-one__stars">
                                    @if ($tour->rating && $tour->rating > 0)
                                        <div class="testimonials-one__stars" style="justify-content: start;">
                                            <i class="fa fa-star"></i> {{ $tour->rating }}
                                        </div><!-- /.testimonials-one__stars -->
                                    @else
                                        No rating yet
                                    @endif
                                </div>
                                <h3><a href="{{ $tour->website }}">{{ $tour->tour_name }}</a></h3>
                                <p><span style="color: var(--thm-secondary);">$
                                        {{ number_format($tour->budget, 2) }}</span> Per Person
                                </p>
                                <p>{{ $tour->description ?? 'No description available' }}</p>
                                <ul class="list-unstyled blog-one__meta">
                                    <li><a href="#"><i class="far fa-clock"></i> {{ $tour->tour_days_count }}
                                            Days</a></li>
                                    <li><a href="#"><i class="far fa-user-circle"></i>
                                            {{ $tour->number_of_people }}</a></li>
                                    <li><a href="#"><i class="fa fa-tag"></i>
                                            @if ($tour->tourDays->isNotEmpty())
                                                {{ $tour->tourDays->flatMap(function ($day) {
                                                        return $day->dayActivities->map(function ($activity) {
                                                            return $activity->activityCategory ? $activity->activityCategory->category_name : 'Unknown';
                                                        });
                                                    })->unique()->join(', ') }}
                                            @else
                                                No categories available
                                            @endif
                                        </a></li>
                                    <li><a href="#"><i class="far fa-map"></i>
                                            @if ($tour->city)
                                                {{ $tour->city->city_name }}
                                            @else
                                                No city available
                                            @endif
                                        </a></li>
                                </ul><!-- /.list-unstyled blog-one__meta -->
                            </div><!-- /.blog-one__content -->
                        </div><!-- /.blog-one__single -->
                    </div><!-- /.col-lg-4 -->
                @endforeach
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-one -->





    <section class="video-one" style="background-image: url(assets/images/backgrounds/video-bg-1-1.jpg);">
        <div class="container text-center">
            <a href="https://www.youtube.com/watch?v=-Ri2DOnbaoo" class="video-one__btn video-popup"><i
                    class="fa fa-play"></i></a><!-- /.video-one__btn -->
            <p>Love where you're going</p>
            <h3><span>JI</span> is a World Leading <br> Online <span>Tour Booking Platform</span></h3>
        </div><!-- /.container -->
    </section><!-- /.video-one -->

    <section class="destinations-two">
        <div class="container">
            <div class="block-title text-center">
                <p>Checkout featured</p>
                <h3>Top Destinations</h3>
            </div><!-- /.block-title -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="destinations-two__single wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="000ms">
                        <img src="{{ asset('assets/images/destinations/destinations-2-1.jpg') }}" alt="">
                        <h3><a href="destinations-details.html">Amman</a></h3>
                    </div><!-- /.destinations-two__single -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="destinations-two__single wow fadeInUp " data-wow-duration="1500ms" data-wow-delay="100ms">
                        <img src="{{ asset('assets/images/destinations/destinations-2-2.jpg') }}" alt="">
                        <h3><a href="destinations-details.html">Dead Sea</a></h3>
                    </div><!-- /.destinations-two__single -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="destinations-two__single wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <img src="{{ asset('assets/images/destinations/destinations-2-3.jpg') }}" alt="">
                        <h3><a href="destinations-details.html">Petra</a></h3>
                    </div><!-- /.destinations-two__single -->
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.destinations-two -->


    <section class="testimonials-one">
        <div class="container">
            <div class="block-title text-center">
                <p>checkout our</p>
                <h3>Top Tour Reviews</h3>
            </div><!-- /.block-title -->
            <div class="testimonials-one__carousel thm__owl-carousel light-dots owl-carousel owl-theme"
                data-options='{"nav": false, "autoplay": true, "autoplayTimeout": 5000, "smartSpeed": 700, "dots": true, "margin": 30, "loop": true, "responsive": { "0": { "items": 1, "nav": true, "navText": ["Prev", "Next"], "dots": false }, "767": { "items": 1, "nav": true, "navText": ["Prev", "Next"], "dots": false }, "991": { "items": 2 }, "1199": { "items": 2 }, "1200": { "items": 3 } }}'>
                @foreach ($reviews as $review)
                    <div class="item">
                        <div class="testimonials-one__single">
                            <div class="testimonials-one__content">
                                <div class="testimonials-one__stars">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    @for ($i = $review->rating; $i < 5; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div><!-- /.testimonials-one__stars -->
                                <p>{{ $review->content }}</p>
                            </div><!-- /.testimonials-one__content -->
                            <div class="testimonials-one__info">
                                <img src="{{ asset('uploads/users/' . $review->user->profile_picture) }}"
                                    alt="{{ $review->user->name }}">
                                <h3>{{ $review->user->first_name . ' ' . $review->user->last_name }}</h3>
                            </div><!-- /.testimonials-one__info -->
                        </div><!-- /.testimonials-one__single -->
                    </div><!-- /.item -->
                @endforeach
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.testimonials-one -->


    @if (!auth()->check())
        {{-- if the user is not logged in --}}
        <section class="cta-one cta-one__home-two">
            <div class="container">
                <h3>Get Latest Tour Updates by Signing Up</h3>
                <div class="cta-one__button-block">
                    <a href="{{ route('register') }}" class="thm-btn cta-one__btn"> Sign Up
                    </a><!-- /.thm-btn cta-one__btn -->
                </div><!-- /.cta-one__button-block -->
            </div><!-- /.container -->
        </section>
        <!-- changes -->
    @endif

    <section class="blog-one">
        <div class="container">
            <div class="block-title text-center">
                <p>Check out Our</p>
                <h3>Latest Posts & Articles</h3>
            </div><!-- /.block-title -->
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                        <div class="blog-one__single">
                            <div class="blog-one__image">
                                <img src="{{ $post->image ? asset('uploads/post_images/' . $post->image) : asset('assets/images/default/post-default.webp') }}"
                                    alt="Image for {{ $post->title }}">
                                <a href="{{ route('post.details', ['id' => $post->id]) }}"><i
                                        class="fa fa-long-arrow-alt-right"></i></a>
                            </div><!-- /.blog-one__image -->
                            <div class="blog-one__content">
                                <ul class="list-unstyled blog-one__meta">
                                    <li>
                                        <a href="#" class="like-btn" data-post-id="{{ $post->id }}">
                                            <i
                                                class="{{ $post->likes->count() > 0 ? 'fa fa-heart' : 'far fa-heart' }}"></i>
                                            <span class="likes-count">{{ $post->likes_count }}</span> Likes
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="far fa-comments"></i> {{ $post->comments_count }}
                                            Comments</a></li>
                                </ul><!-- /.list-unstyled blog-one__meta -->
                            </div><!-- /.blog-one__content -->
                        </div><!-- /.blog-one__single -->
                    </div><!-- /.col-lg-4 -->
                @endforeach
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-one -->
@endsection
