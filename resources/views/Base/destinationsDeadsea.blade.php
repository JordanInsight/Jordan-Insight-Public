@extends('layout.base')
@section('content')
    <section class="page-header" style="background-image: url({{ asset('assets/images/destinations/DeadSea.jpg') }});padding:190.5px 0;">
        <div class="container">
            <h2>Dead Sea Destination</h2>
            <h3 style="color:#ffa801">Experience the Healing Powers of the Dead Sea</h3>
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    <section class="tour-two tour-list destinations-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="destinations-details__content">
                        <h3 class="destinations-details__title">Discover The Dead Sea</h3>
                        <!-- /.destinations-details__title -->
                        <p>The Dead Sea, located in Jordan, is one of the most unique natural wonders on Earth.it offers a
                            unique blend of natural beauty, relaxation, and wellness.</p>
                        The sea is renowned for being the lowest point on Earth's land surface, sitting at around 430 meters
                        (1,410 feet) below sea level. One of the most remarkable features of the Dead Sea is its incredibly
                        high salt content, around 34.2%, which is about ten times higher than that of most oceans. This high
                        salinity makes it impossible for most life forms to survive in its waters, hence the name "Dead"
                        Sea. Due to the high density of salt in the Dead Sea, the water is exceptionally buoyant. Visitors
                        can effortlessly float on the surface of the water, a unique and exhilarating experience. Even those
                        who can't swim find it easy to float, making it a popular destination for people of all ages.</p>
                        <div class="row low-gutters destinations-details__gallery">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/ds (10).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/ds (2).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/ds (11).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row low-gutters -->
                        <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating place:</h3>
                        <!-- /.destinations-details__title -->
                        <uL>
                            <li>
                                Geological Marvel: We're standing at the shores of the Dead Sea, the lowest point on Earth's
                                land surface. The Dead Sea lies at around 430 meters (1,410 feet) below sea level, making it
                                a geological marvel. Take a moment to absorb the surreal feeling of being at the Earth's
                                lowest point.
                            </li>

                            <li>
                                High Salinity: One of the most fascinating features of the Dead Sea is its incredibly high
                                salt content, about 34.2%. Because of this, the water is so dense that it's nearly
                                impossible to sink. Today, you'll have the opportunity to experience the sensation of
                                effortless floating on the Dead Sea's surface.
                            </li>

                            <li>
                                Mineral-Rich Waters: The Dead Sea is renowned for its mineral-rich waters, which are
                                believed to have numerous health benefits. The water contains high concentrations of
                                minerals such as magnesium, potassium, calcium, and bromine, which can be beneficial for
                                skin conditions, joint pain, and more.
                            </li>

                            <li>
                                Mud Therapy: Along the shores of the Dead Sea, you'll find mineral-rich mud that's famous
                                for its therapeutic properties. People have been using this mud for centuries to treat
                                various skin ailments and to promote overall wellness. Today, you'll have the chance to try
                                a rejuvenating mud treatment.
                            </li>

                            <li>
                                Spectacular Scenery: Take a look around, and you'll see the breathtaking scenery that
                                surrounds the Dead Sea. To the west, you have the mountains of Palestine, while to the east,
                                you'll find the rugged landscapes of Jordan's desert. The contrast of the deep blue waters
                                against the barren desert landscape is truly mesmerizing.
                            </li>

                            <li>
                                Adventure and Relaxation: Whether you're seeking adventure or relaxation, the Dead Sea has
                                something for everyone. You can embark on hiking trails in the nearby mountains, explore
                                ancient, or simply unwind and enjoy the tranquility of the sea.
                            </li>

                            <li>
                                Local Culture and Cuisine: As we conclude our tour, We highly recommend indulging in some
                                local cuisine. Jordanian cuisine is renowned for its delicious flavors and variety. Treat
                                yourself to traditional dishes like Mansaf (a savory lamb dish), mezze (assorted
                                appetizers), or a refreshing drink of mint lemonade.
                            </li>

                        </uL>

                        <p>
                            The Dead Sea is not just a destination; it's an experience unlike any other. From floating
                            effortlessly in its mineral-rich waters to exploring the surrounding landscapes, a visit to the
                            Dead Sea promises to be unforgettable.
                        </p>



                        <div class="row low-gutters destinations-details__gallery mb-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/ds (01).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/ds (02).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.row low-gutters -->
                    </div><!-- /.destinations-details__content -->
                </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.tour-two -->

    <div class="google-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4869.661338541947!2d35.581432597667614!3d31.715794418950296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15034a142611c9b3%3A0x1cd35ba4ce8f0a8f!2sDead%20Sea%20Beach!5e0!3m2!1sen!2sjo!4v1715063993341!5m2!1sen!2sjo"
            width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
@endsection
