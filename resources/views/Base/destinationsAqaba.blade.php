@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/destinations/aq14.jpg') }});padding:190.5px 0;">
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
                        <h3 class="destinations-details__title">Discover Aqaba</h3>
                        <!-- /.destinations-details__title -->
                        <p>
                            Located in the southernmost part of Jordan, is a coastal city
                            known for its stunning Red Sea beaches, vibrant marine life,
                            and rich history.
                        </p>
                        <p>
                            Aqaba is situated on the northeastern tip of the Red Sea,
                            Aqaba's underwater world is teeming with colorful coral reefs,
                            exotic fish, and other marine creatures. Diving and snorkeling
                            in the Red Sea allow visitors to explore stunning underwater
                            landscapes, including coral gardens, submerged wrecks, and
                            vibrant marine ecosystems.
                        </p>
                        <div class="row low-gutters destinations-details__gallery">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/aq99.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/aq5.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/aq55.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row low-gutters -->
                        <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating city:</h3>
                        <!-- /.destinations-details__title -->
                        <ul>
                            <li>
                                Red Sea Magic: Aqaba is renowned for its stunning Red Sea
                                coastline, offering some of the most breathtaking underwater
                                scenery in the world. The warm, crystal-clear waters teem
                                with vibrant coral reefs and exotic marine life, making it a
                                paradise for snorkelers and divers alike.
                            </li>

                            <li>
                                Snorkeling and Diving: Our first stop is the vibrant
                                underwater world of the Red Sea. Whether you're a seasoned
                                diver or a first-time snorkeler, Aqaba's coral reefs are a
                                sight to behold. Dive beneath the waves to discover a
                                kaleidoscope of colors, from delicate corals to schools of
                                tropical fish darting through the water.
                            </li>

                            <li>
                                Aqaba Marine Park: As we explore the underwater wonders,
                                we'll visit the Aqaba Marine Park, a protected area that
                                encompasses some of the city's most pristine reefs. Here,
                                conservation efforts ensure that marine life thrives,
                                offering an unforgettable experience for visitors while
                                preserving the fragile ecosystem.
                            </li>

                            <li>
                                History and Heritage: Aqaba's history stretches back
                                thousands of years, and our next stop takes us to witness
                                its ancient charm. We'll visit Aqaba Fort, a 16th-century
                                Ottoman fortress perched on a hill overlooking the city and
                                the Red Sea. From its ramparts, we'll enjoy panoramic views
                                and learn about the fort's role in Aqaba's history.
                            </li>

                            <li>
                                Shopping and Souvenirs: No visit to Aqaba is complete
                                without a stroll through its bustling markets. We'll explore
                                the souks, where you can haggle for spices, handicrafts, and
                                traditional Jordanian souvenirs. Don't forget to pick up
                                some locally made Dead Sea skincare products—they make for
                                excellent gifts!
                            </li>

                            <li>
                                Relaxation and Leisure: After a day of exploration, it's
                                time to unwind and soak up the sun. Aqaba boasts a range of
                                luxury resorts and beaches where you can lounge in style.
                                Whether you prefer a beachside cabana or a pampering spa
                                treatment, Aqaba offers plenty of options for relaxation and
                                rejuvenation.
                            </li>

                            <li>
                                Adventure Awaits: For the thrill-seekers among us, Aqaba
                                offers a host of adrenaline-pumping activities. From
                                parasailing high above the sea to jet skiing across its
                                turquoise waters, there's no shortage of excitement here.
                                And for those who prefer to stay on land, a desert safari or
                                ATV tour through the surrounding desert landscapes awaits.
                            </li>

                            <li>
                                Sunset Cruise: As the day draws to a close, we'll embark on
                                a sunset cruise along the coast. With the sun dipping below
                                the horizon and the sky painted in hues of orange and pink,
                                it's a magical moment to cherish.
                            </li>
                        </ul>

                        <p>
                            Aqaba truly offers something for everyone, from its natural
                            wonders to its rich history and vibrant culture. We hope
                            you've enjoyed our tour, and We can't wait for you to
                            experience the beauty of Aqaba firsthand!
                        </p>



                        <div class="row low-gutters destinations-details__gallery mb-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/aq0.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/aq00.jpg') }}" class="img-fluid"
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
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d66533.54845282836!2d34.967362400923825!3d29.528529022368645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15007039ff2efa81%3A0x595faa556d2e6acc!2sAqaba!5e0!3m2!1sen!2sjo!4v1715195720177!5m2!1sen!2sjo"
            width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
@endsection
