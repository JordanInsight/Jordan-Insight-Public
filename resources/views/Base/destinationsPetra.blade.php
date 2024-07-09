@extends('layout.base')
@section('content')
    <section class="page-header" style="background-image: url({{ asset('assets/images/destinations/hs4.jpg') }});padding:190.5px 0;">
        <div class="container">
            <h2>Petra Destination</h2>
            <h3 style="color:#ffa801">Where Every Rock Tells a Story</h3>
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    <section class="tour-two tour-list destinations-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="destinations-details__content">
                        <h3 class="destinations-details__title">Discover Petra</h3><!-- /.destinations-details__title -->
                        <p>One of the New Seven Wonders of the World. often called the "Rose City" due to the rose-red color
                            of its sandstone cliffs, is one of the most iconic archaeological sites in the world. Located in
                            southern Jordan, Petra was the capital of the Nabatean Kingdom, a civilization that thrived from
                            around the 4th century BC to the 1st century AD. </p>
                        <p>Petra's history dates back over 2,000 years. The Nabateans, an ancient Arab civilization,
                            established Petra as their capital around the 6th century BC. They developed the city into a
                            major trading hub, benefiting from its strategic location along important trade routes. The city
                            reached its peak during the 1st century AD but eventually declined due to changes in trade
                            routes and political instability.</p>
                        <div class="row low-gutters destinations-details__gallery">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/pt (1).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/pt (5).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/pt (12).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row low-gutters -->
                        <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating place:</h3>
                        <!-- /.destinations-details__title -->
                        <uL>
                            <li>
                                Siq Entrance: Our journey begins with a walk through the Siq, a narrow canyon that serves as
                                the main entrance to Petra. As we wind our way through this natural wonder, marvel at the
                                towering cliffs on either side, some reaching up to 200 meters in height. Keep an eye out
                                for the famous "Indiana Jones" view, where the Siq opens up to reveal the Treasury in the
                                distance.
                            </li>

                            <li>
                                Treasury (Al-Khazneh): As we emerge from the Siq, prepare to be awestruck by the magnificent
                                Treasury, Petra's most iconic monument. Carved into the sandstone cliff face, this grand
                                facade is adorned with intricate carvings and columns. Legend has it that it once housed
                                hidden treasures, hence its name. Take some time to admire its beauty and snap some photos.
                            </li>

                            <li>
                                Street of Facades: Next, we'll stroll along the Street of Facades, where you'll encounter
                                numerous tombs and facades carved into the cliff walls. These elaborate structures were
                                burial sites for the Nabateans, the ancient people who inhabited Petra over 2,000 years ago.
                                Each facade tells a story of craftsmanship and artistic skill.
                            </li>

                            <li>
                                Royal Tombs: Our tour continues with a visit to the Royal Tombs, a series of monumental
                                tombs carved high up on the cliffs. These impressive structures, including the Urn Tomb, the
                                Palace Tomb, and the Corinthian Tomb, served as burial places for Petra's elite. From their
                                lofty vantage points, you'll enjoy sweeping views of the surrounding landscape.
                            </li>

                            <li>
                                The Monastery (Ad Deir): Brace yourself for a hike to one of Petra's most spectacular
                                sights—the Monastery. After ascending a series of steps, you'll be rewarded with the sight
                                of this massive monument, even larger than the Treasury. Admire its intricate facade and
                                take in the panoramic views of the rugged mountains and valleys below.
                            </li>

                            <li>
                                Petra by Night: For a magical experience, consider returning to Petra in the evening for
                                Petra by Night. As the sun sets, the Siq and Treasury are illuminated by thousands of
                                candles, creating a magical atmosphere. Sit back, relax, and enjoy traditional music and
                                storytelling under the starry sky.
                            </li>

                            <li>
                                Local Cuisine: Before we conclude our tour, let's savor some local Jordanian cuisine. Petra
                                offers a variety of dining options, from traditional Bedouin-style restaurants to modern
                                cafes. Indulge in dishes like mansaf (a traditional Jordanian lamb dish), falafel, or
                                freshly baked bread with za'atar.
                            </li>

                        </uL>

                        <p>
                            That concludes our tour of Petra! We hope you've enjoyed exploring this ancient wonder with us.
                            Petra's timeless beauty and rich history make it a truly unforgettable experience. Safe travels!
                        </p>



                        <div class="row low-gutters destinations-details__gallery mb-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/pt (31).jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/The Rock.jpg') }}" class="img-fluid" alt="">
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.row low-gutters -->
                    </div><!-- /.destinations-details__content -->
                </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.tour-two -->

    <div class="google-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13383.752667802526!2d35.47530279919122!3d30.32304279507706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15016930021ab6b1%3A0xe43a697bc3a3e0b9!2sWadi%20Musa!5e0!3m2!1sen!2sjo!4v1715063518381!5m2!1sen!2sjo"
            width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
@endsection
