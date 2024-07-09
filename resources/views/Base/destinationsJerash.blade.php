@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/destinations/jrsh22.jpg') }});padding:190.5px 0;">
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
                        <h3 class="destinations-details__title">Discover Jerash</h3>
                        <!-- /.destinations-details__title -->
                        <p>
                            Located in northern Jordan, is one of the best-preserved Roman
                            provincial cities in the world and is often referred to as the
                            "Pompeii of the East" due to its remarkable state of
                            preservation.
                        </p>
                        <p>
                            The heart of Jerash is its ancient ruins, which date back to
                            the Roman period. This archaeological site boasts a wealth of
                            well-preserved structures, including temples, theaters,
                            colonnaded streets, and plazas. As you walk through Jerash,
                            you'll feel as though you've been transported back in time to
                            the days of the Roman Empire.
                        </p>
                        <div class="row low-gutters destinations-details__gallery">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/jrsh1.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/jrsh4.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/destinations/jrsh2.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row low-gutters -->
                        <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating city:</h3>
                        <!-- /.destinations-details__title -->
                        <ul>
                            <li>
                                Welcome to Jerash: As we step into Jerash, we are
                                transported back in time to the days of the Roman Empire.
                                Jerash was once known as Gerasa, a thriving city in the
                                Decapolis league, and today, it stands as a testament to its
                                rich history.
                            </li>

                            <li>
                                Hadrian's Arch: Our journey begins with Hadrian's Arch, an
                                imposing structure that once marked the southern entrance to
                                the city. Built to honor Emperor Hadrian's visit in the 2nd
                                century AD, this arch is a symbol of Jerash's importance
                                during the Roman era.
                            </li>

                            <li>
                                Oval Plaza: Walking through the city, we arrive at the Oval
                                Plaza, the bustling heart of ancient Jerash. This grand
                                plaza was a center of public life, where citizens gathered
                                for festivals, markets, and social gatherings. Imagine the
                                vibrant atmosphere as we stroll along its colonnaded
                                streets.
                            </li>

                            <li>
                                Cardo Maximus: The Cardo Maximus, or main street, is another
                                highlight of Jerash. Lined with columns and flanked by shops
                                and markets, it offers a glimpse into daily life in ancient
                                Gerasa. As we walk along the Cardo, notice the intricate
                                details of the stone carvings and the symmetry of the
                                architecture.Rainbow Street: Now, let's explore the trendy
                                Rainbow Street in Jabal Amman. Lined with colorful
                                buildings, cafes, art galleries, and boutique shops, this
                                vibrant street is a favorite among locals and tourists
                                alike. It's the perfect place to soak up the city's artistic
                                and bohemian atmosphere.
                            </li>

                            <li>
                                The Temple of Artemis: One of Jerash's most impressive
                                structures is the Temple of Artemis, dedicated to the
                                goddess of hunting. This majestic temple, with its towering
                                columns and intricate reliefs, reflects the city's religious
                                significance in Roman times.
                            </li>

                            <li>
                                The South Theater: Jerash is home to several well-preserved
                                theaters, and the South Theater is one of the largest and
                                most impressive. With its tiered seating and excellent
                                acoustics, it was the venue for performances and
                                entertainment in ancient times. Let's climb to the top and
                                imagine the cheers of the crowd during a thrilling
                                performance.
                            </li>

                            <li>
                                The North Theater: Nearby, we'll explore the North Theater,
                                another architectural marvel. This smaller theater was used
                                for more intimate performances and gatherings. From its
                                vantage point, we'll enjoy panoramic views of the
                                surrounding landscape.
                            </li>

                            <li>
                                Byzantine Churches: In addition to its Roman ruins, Jerash
                                is home to several Byzantine-era churches. These churches,
                                adorned with beautiful mosaics and frescoes, offer insights
                                into the city's Christian heritage and its transition
                                through the ages.
                            </li>

                            <li>
                                Archaeological Museum: To delve deeper into Jerash's
                                history, we'll visit the Archaeological Museum. Here, you'll
                                discover a fascinating collection of artifacts, including
                                statues, pottery, and jewelry, that provide further insights
                                into life in ancient Gerasa.
                            </li>

                            <li>
                                Modern Jerash: As we conclude our tour, take some time to
                                explore modern Jerash. The city is a vibrant blend of
                                ancient and contemporary culture, with bustling markets,
                                lively cafes, and friendly locals eager to share their
                                heritage.
                            </li>
                        </ul>

                        <p>
                            Jerash is a treasure trove of history and archaeology,
                            offering visitors a glimpse into the grandeur of the Roman
                            Empire and the enduring legacy of Jordan's past. We hope
                            you've enjoyed our journey through this remarkable ancient
                            city.
                        </p>
                        <div class="row low-gutters destinations-details__gallery mb-0">
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/jrsh00.jpg') }}" class="img-fluid"
                                    alt="">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/destinations/jrsh101.jpg') }}" class="img-fluid"
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
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53977.28761746035!2d35.86063399974708!3d32.26936806591786!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151c802ff49ac08d%3A0x876c24b1cbded302!2sJerash!5e0!3m2!1sen!2sjo!4v1715529305085!5m2!1sen!2sjo"
            width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
@endsection
