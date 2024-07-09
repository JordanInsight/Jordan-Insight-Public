@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/destinations/WadiRum.jpg') }});padding:190.5px 0;">
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
                        <h3 class="destinations-details__title">Discover Wadi Rum</h3>
                        <!-- /.destinations-details__title -->
                        <p>
                            Discover the Magic of Wadi Rum: Jordan's Desert Jewel, often
                            referred to as the Valley of the Moon, is a breathtaking
                            desert landscape located in southern Jordan.
                        </p>
                        <p>
                            Wadi Rum is renowned for its mesmerizing desert scenery
                            characterized by towering sandstone mountains, vast red sand
                            dunes, and sweeping desert plains. The landscape is like
                            something out of a dream, with its surreal beauty captivating
                            visitors from around the world, Wadi Rum's otherworldly
                            landscape has served as a backdrop for numerous films.
                        </p>
                        <div class="row low-gutters destinations-details__gallery">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/wdr3.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/wdr1.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/wdr2.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row low-gutters -->
                        <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating city:</h3>
                        <!-- /.destinations-details__title -->
                        <ul>
                            <li>
                                Spectacular Desert Scenery: As we venture into Wadi Rum,
                                prepare to be enchanted by its breathtaking desert scenery.
                                Towering sandstone mountains rise majestically from the
                                desert floor, creating a landscape of otherworldly beauty.
                                The vibrant hues of red, orange, and gold paint the
                                landscape, changing with the shifting sunlight.
                            </li>

                            <li>
                                Bedouin Culture and Heritage: Wadi Rum has been home to
                                Bedouin tribes for centuries, and their rich cultural
                                heritage is deeply ingrained in the desert's identity. As we
                                explore, you'll have the chance to meet local Bedouin guides
                                who will share their knowledge of the desert, its
                                traditions, and its history.
                            </li>

                            <li>
                                Jeep Safari Adventure: Our journey through Wadi Rum begins
                                with an exhilarating jeep safari. Board our rugged 4x4 and
                                hold on as we traverse the desert terrain, weaving between
                                sand dunes and towering rock formations. Our expert Bedouin
                                guide will lead the way, taking us to hidden gems and
                                panoramic viewpoints.
                            </li>

                            <li>
                                Ancient Rock Formations: Wadi Rum is home to an array of
                                fascinating rock formations, sculpted by the elements over
                                millions of years. Keep an eye out for natural arches,
                                towering cliffs, and ancient rock inscriptions left behind
                                by ancient civilizations. We'll stop to explore these
                                geological wonders up close, marveling at their sheer beauty
                                and intricate details.
                            </li>

                            <li>
                                Camel Trekking: For a more leisurely experience, we'll
                                embark on a camel trek through the desert. Mounting our
                                trusty camels, we'll journey through the vast expanse of
                                Wadi Rum, following ancient Bedouin trails and soaking in
                                the tranquility of the desert. It's a serene and timeless
                                way to experience the beauty of Wadi Rum.
                            </li>

                            <li>
                                Bedouin Hospitality: As the sun begins to set, we'll make
                                our way to a traditional Bedouin camp, where warm
                                hospitality awaits. Here, we'll be welcomed with open arms
                                and treated to a delicious Bedouin feast cooked over an open
                                fire. As the night falls, we'll gather around the campfire,
                                sipping sweet Bedouin tea and sharing stories under the
                                starlit sky.
                            </li>

                            <li>
                                Stargazing: Wadi Rum is renowned for its clear night skies,
                                offering unparalleled stargazing opportunities. As we settle
                                in for the night, look up and be amazed by the millions of
                                stars twinkling overhead. The silence of the desert and the
                                brilliance of the stars create a magical atmosphere that is
                                truly unforgettable.
                            </li>
                            <li>
                                Sunrise Serenity: Before we bid farewell to Wadi Rum, we'll
                                rise early to witness the sunrise over the desert. As the
                                first light of dawn bathes the landscape in golden hues,
                                you'll be treated to a breathtaking spectacle that marks the
                                beginning of a new day in the Valley of the Moon.
                            </li>
                        </ul>

                        <p>
                            Wadi Rum is a place of wonder and beauty, where the spirit of
                            adventure and the tranquility of the desert come together in
                            perfect harmony. We hope you've enjoyed our journey through
                            this extraordinary landscape. Until next time, farewell from
                            Wadi Rum!
                        </p>

                        <div class="row low-gutters destinations-details__gallery mb-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/wdr (6).jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/wdr (8).jpg') }}" class="img-fluid"
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
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111036.33457512558!2d35.331740481724985!3d29.577935912504902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x150093197cf86e5f%3A0x4c72561f84c1abbc!2sWadi%20Rum!5e0!3m2!1sen!2sjo!4v1715202921970!5m2!1sen!2sjo"
            width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
@endsection
