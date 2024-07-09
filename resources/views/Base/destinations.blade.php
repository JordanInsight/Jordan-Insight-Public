@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/destinations/destinations-backgorund.jpg') }});">
        <div class="container">
            <h2>Destination</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Destination</span></li>
            </ul><!-- /.thm-breadcrumb -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->


    <section class="destinations-three">
        <div class="container">
            <div class="row">


                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/amds (2).jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsAmman') }}">Amman</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsAmman') }}">Amman</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsAmman') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->


                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/dds.jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsDeadsea') }}">Dead Sea</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsDeadsea') }}">Dead Sea</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsDeadsea') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->



                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/pds (1).jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsPetra') }}">Petra</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsPetra') }}">Petra</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsPetra') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/ajds.png') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsAjloun') }}">Ajloun</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsAjloun') }}">Ajloun</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsAjloun') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/ads (5).jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsAqaba') }}">Aqaba</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsAqaba') }}">Aqaba</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsAqaba') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->


                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/jds (2).jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsJerash') }}">Jerash</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsJerash') }}">Jerash</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsJerash') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->


                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/mds (3).jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsMadaba') }}">Madaba</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsMadaba') }}">Madaba</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsMadaba') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->


                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/wds (5).jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsWadirum') }}">Wadi Rum</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsWadirum') }}">Wadi Rum</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsWadirum') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->


                <div class="col-lg-4 col-md-6">
                    <div class="destinations-three__single">
                        <img src="{{ asset('assets/images/destinations/zds (1).jpg') }}" alt="">
                        <div class="destinations-three__content">
                            <h3><a href="{{ route('destinationsZarqa') }}">Zarqa</a></h3>
                        </div><!-- /.destinations-three__content -->
                        <div class="destinations-three__hover-content">
                            <h3><a href="{{ route('destinationsZarqa') }}">Zarqa</a></h3>
                            <p>Discover More</p>
                            <a href="{{ route('destinationsZarqa') }}" class="destinations-three__link"><i
                                    class="tripo-icon-right-arrow"></i></a>
                        </div><!-- /.destinations-three__hover-content -->
                    </div><!-- /.destinations-three__single -->
                </div><!-- /.col-lg-4 col-md-6 -->




            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.destinations-three -->
@endsection
