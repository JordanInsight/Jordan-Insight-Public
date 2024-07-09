@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/destinations/Madaba4.jpg') }});padding:190.5px 0;">
        <div class="container">
            <h2>Amman Destination</h2>
            <h3 style="color:#ffa801">Your Gateway to Jordan's Rich Heritage</h3>
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    <section class="tour-two tour-list destinations-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="destinations-details__content">
                        <h3 class="destinations-details__title">Discover Madaba</h3>
                        <!-- /.destinations-details__title -->
                        <p>
                            Located in the heart of Jordan, it is a city steeped in
                            history, known for its ancient mosaics and vibrant cultural
                            heritage.
                        </p>
                        <p>
                            Madaba is often referred to as the "City of Mosaics" due to
                            its rich tradition of mosaic artistry. The city's mosaic
                            heritage dates back to the Byzantine and Umayyad periods, and
                            many ancient mosaics have been uncovered throughout Madaba and
                            its surroundings. Madaba's mosaic-covered streets, rich
                            history, and cultural diversity make it a must-visit
                            destination for travelers seeking to explore Jordan's ancient
                            heritage and vibrant culture.
                        </p>
                        <div class="row low-gutters destinations-details__gallery">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/madaba7.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/madaba12.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/madaba5.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row low-gutters -->
                        <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating city:</h3>
                        <!-- /.destinations-details__title -->
                        <ul>
                            <li>
                                Welcome to Madaba: Known as the "City of Mosaics," Madaba
                                welcomes you with open arms to explore its treasures.
                            </li>

                            <li>
                                The Madaba Mosaic Map: Our first stop is the famous Greek
                                Orthodox Church of St. George, home to the renowned Madaba
                                Mosaic Map. This ancient mosaic, dating back to the 6th
                                century AD, is a masterpiece of Byzantine art. Let's marvel
                                at this intricate map, depicting the Holy Land with
                                remarkable detail.
                            </li>

                            <li>
                                Archaeological Park: Next, we'll visit the Archaeological
                                Park, where you'll discover a treasure trove of ancient
                                mosaics. As we wander through the park, we'll explore
                                Byzantine churches adorned with beautifully preserved
                                mosaics, each telling its own story of Madaba's rich
                                history.
                            </li>

                            <li>
                                St. John the Baptist Church: Our journey continues to the
                                Church of St. John the Baptist, where you'll be awed by the
                                breathtaking mosaic floors depicting scenes from the life of
                                John the Baptist. These intricate mosaics are a testament to
                                the skill and craftsmanship of Madaba's ancient artisans.
                            </li>

                            <li>
                                Artisan Workshops: Prepare to be enchanted as we visit local
                                artisan workshops, where talented craftsmen carry on the
                                tradition of mosaic artistry. Here, you'll witness the
                                meticulous process of creating mosaics, from selecting
                                colorful tiles to crafting intricate designs.
                            </li>

                            <li>
                                Culinary Exploration: No visit to Madaba is complete without
                                experiencing its delectable cuisine. We'll sample
                                traditional Jordanian dishes at local eateries, savoring the
                                flavors of mezze, falafel, and mouthwatering desserts. Get
                                ready for a culinary adventure!
                            </li>

                            <li>
                                Religious Sites: Madaba is a city of religious significance,
                                home to a diverse array of churches, mosques, and religious
                                landmarks. We'll explore these sacred sites, learning about
                                Madaba's religious heritage and its role in Jordanian
                                society.
                            </li>

                            <li>
                                Local Markets: Our tour wouldn't be complete without a visit
                                to Madaba's vibrant markets. Here, you'll have the chance to
                                browse stalls filled with handmade crafts, souvenirs, and
                                local products. Take home a piece of Madaba's charm as a
                                memento of your visit.
                            </li>

                            <li>
                                Warm Hospitality: Throughout our journey, you'll experience
                                the warmth and hospitality of Madaba's residents. From
                                friendly greetings to genuine smiles, you'll feel welcomed
                                and embraced by the local community.
                            </li>
                        </ul>

                        <p>
                            Madaba is a city steeped in history and alive with artistic
                            expression. We hope you've enjoyed our tour and that Madaba's
                            beauty has left a lasting impression on you. Until next time,
                            farewell from the City of Mosaics!
                        </p>

                        <div class="row low-gutters destinations-details__gallery mb-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/madaba13.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/madaba14.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.row low-gutters -->
                    </div><!-- /.destinations-details__content -->
                </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.tour-two -->
    <div class="google-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27152.042307916618!2d35.777800006656804!3d31.715750525735487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151cacd00bad3bc5%3A0x4d6d5834c1003e2b!2sMadaba!5e0!3m2!1sen!2sjo!4v1715530661524!5m2!1sen!2sjo"
            width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
@endsection
