@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/destinations/Ajloun4.jpg') }});padding:190.5px 0;">
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
                        <h3 class="destinations-details__title">Discover Ajloun</h3>
                        <!-- /.destinations-details__title -->
                        <p>
                            Nestled in the lush green hills of northern Jordan, is a
                            captivating destination renowned for its natural beauty,
                            historical sites, and rich cultural heritage.
                        </p>
                        <p>
                            Ajloun's blend of natural beauty, historical significance, and
                            cultural heritage makes it a must-visit destination for
                            travelers seeking an authentic Jordanian experience. Whether
                            you're exploring ancient castles, hiking through lush forests,
                            or savoring local cuisine, Ajloun offers a glimpse into the
                            soul of Jordan.
                        </p>
                        <div class="row low-gutters destinations-details__gallery">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/Ajloun1.png') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/Ajloun12.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/Ajloun2.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row low-gutters -->
                        <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating city:</h3>
                        <!-- /.destinations-details__title -->
                        <uL>
                            <li>
                                Welcome to Ajloun: Nestled in the rolling green hills of northern Jordan, Ajloun welcomes
                                you with open arms. Known for its lush landscapes and rich history, Ajloun offers a unique
                                blend of natural beauty and cultural heritage.
                            </li>

                            <li>
                                Ajloun Forest Reserve: Our first stop is the Ajloun Forest Reserve, a pristine wilderness
                                that covers much of the region. As we explore the reserve, you'll be surrounded by towering
                                oak and pine trees, breathing in the fresh mountain air. Keep an eye out for native
                                wildlife, including deer, foxes, and a variety of bird species.
                            </li>

                            <li>
                                Ajloun Castle (Qal'at ar-Rabad): Rising majestically above the forested hills is Ajloun
                                Castle, a symbol of the region's rich history. Built in the 12th century by the Ayyubid
                                ruler Salah ad-Din (Saladin), this imposing fortress offers panoramic views of the
                                surrounding countryside. Let's step back in time as we explore its ancient walls, towers,
                                and dungeons.
                            </li>

                            <li>
                                Great Mosque of Ajloun: Nearby, we'll visit the Great Mosque of Ajloun, a beautiful example
                                of Islamic architecture. Dating back to the 12th century, this mosque features intricate
                                geometric designs, ornate arches, and a towering minaret. Take a moment to admire the
                                craftsmanship and learn about the mosque's historical significance.
                            </li>

                            <li>
                                Olive Groves: Ajloun is known for its thriving olive industry, and our next stop takes us
                                through the region's scenic olive groves. Jordanian olive oil is renowned for its quality
                                and flavor, and we'll have the opportunity to learn about the olive cultivation process and
                                sample some delicious local produce.
                            </li>

                            <li>
                                Traditional Crafts: Ajloun is a hub of traditional craftsmanship, and we'll explore local
                                workshops where artisans practice age-old techniques. From pottery and weaving to
                                woodcarving, you'll witness the skill and dedication that goes into creating these intricate
                                works of art.
                            </li>

                            <li>
                                Hiking Trails: For nature lovers and outdoor enthusiasts, Ajloun offers a network of hiking
                                trails that wind through its lush forests and rugged landscapes. We'll embark on a scenic
                                hike, immersing ourselves in the sights and sounds of nature while enjoying breathtaking
                                views of the countryside.
                            </li>

                            <li>
                                Local Cuisine: No visit to Ajloun is complete without savoring its delicious cuisine. We'll
                                stop at a local restaurant to indulge in traditional Jordanian dishes, such as mansaf,
                                makloubeh, and falafel, made with fresh, locally sourced ingredients.
                            </li>

                            <li>
                                Warm Hospitality: Throughout our journey, you'll experience the warm hospitality of the
                                local community. Whether we're chatting with farmers in the olive groves or sharing stories
                                with artisans in their workshops, you'll feel welcomed and embraced by the people of Ajloun.
                            </li>


                        </uL>

                        <p>
                            Ajloun is a hidden gem waiting to be discovered, offering a blend of history, nature, and
                            culture that will leave a lasting impression. We hope you've enjoyed our tour, and We look
                            forward to exploring more of Ajloun's treasures with you in the future!
                        </p>



                        <div class="row low-gutters destinations-details__gallery mb-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/ajloun22.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/ajloun33.jpg') }}" class="img-fluid"
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
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53934.29900224773!2d35.72604914756503!3d32.34156350495959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c87da460049bd%3A0x3fbf8443e03b269a!2sAjloun!5e0!3m2!1sen!2sjo!4v1715530484084!5m2!1sen!2sjo"
            width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
@endsection
