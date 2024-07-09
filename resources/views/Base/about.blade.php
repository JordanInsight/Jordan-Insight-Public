@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/backgrounds/about-background.png') }}); background-position: center -525px;">
        <div class="container">
            <h2>About</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('blog') }}">Home</a></li>
                <li><span>Meet The Team</span></li>
            </ul><!-- /.thm-breadcrumb -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    <section class="team-one">
        <div class="container">
            <div class="block-title text-center">
                <p>meet the team</p>
                <h3>Dev Team</h3>
            </div><!-- /.block-title -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team-one__single">
                        <div class="team-one__image">
                            <img src="{{ asset('assets/images/gallery/Amo.png') }}" alt="">
                        </div><!-- /.team-one__image -->
                        <div class="team-one__content">
                            <h3>Mohamad Alberqdar</h3>
                            <p class="text-uppercase">Team Member</p>
                            <div class="team-one__social">
                                <a href="https://web.facebook.com/mohamad.alberqdar.58/"><i class="fab fa-facebook-square"></i></a>
                                <a href="https://www.instagram.com/amo.002/?hl=en"><i class="fab fa-instagram"></i></a>
                            </div><!-- /.team-one__social -->
                        </div><!-- /.team-one__content -->
                    </div><!-- /.team-one__single -->
                </div><!-- /.col-lg-4 col-md-6 -->
                <div class="col-lg-3 col-md-6">
                    <div class="team-one__single">
                        <div class="team-one__image">
                            <img src="{{ asset('assets/images/gallery/Adool.png') }}" alt="">
                        </div><!-- /.team-one__image -->
                        <div class="team-one__content">
                            <h3>Mohamad Adel</h3>
                            <p class="text-uppercase">Team Member</p>
                            <div class="team-one__social">
                                <a href="https://web.facebook.com/adol.ammar"><i class="fab fa-facebook-square"></i></a>
                                <a href="https://www.instagram.com/adol_ammar/?hl=en"><i class="fab fa-instagram"></i></a>
                            </div><!-- /.team-one__social -->
                        </div><!-- /.team-one__content -->
                    </div><!-- /.team-one__single -->
                </div><!-- /.col-lg-4 col-md-6 -->
                <div class="col-lg-3 col-md-6">
                    <div class="team-one__single">
                        <div class="team-one__image">
                            <img src="{{ asset('assets/images/gallery/Yazan.png') }}" alt="">
                        </div><!-- /.team-one__image -->
                        <div class="team-one__content">
                            <h3>Yazan Mohammad</h3>
                            <p class="text-uppercase">Team Member</p>
                            <div class="team-one__social">
                                <a href="https://web.facebook.com/profile.php?id=100005136730682"><i class="fab fa-facebook-square"></i></a>
                                <a href="https://www.instagram.com/yazan.b.n/?hl=en"><i class="fab fa-instagram"></i></a>
                            </div><!-- /.team-one__social -->
                        </div><!-- /.team-one__content -->
                    </div><!-- /.team-one__single -->
                </div><!-- /.col-lg-4 col-md-6 -->
                <div class="col-lg-3 col-md-6">
                    <div class="team-one__single">
                        <div class="team-one__image">
                            <img src="{{ asset('assets/images/gallery/Bahaa.png') }}" alt="">
                        </div><!-- /.team-one__image -->
                        <div class="team-one__content">
                            <h3>Bahaa Shaheen </h3>
                            <p class="text-uppercase">Team Member</p>
                            <div class="team-one__social">
                                <a href="https://web.facebook.com/bahaa.shaheen.129"><i
                                        class="fab fa-facebook-square"></i></a>
                                <a href="https://www.instagram.com/mr.b_dednsid/?hl=en"><i class="fab fa-instagram"></i></a>
                            </div><!-- /.team-one__social -->
                        </div><!-- /.team-one__content -->
                    </div><!-- /.team-one__single -->
                </div><!-- /.col-lg-4 col-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.team-one -->
@endsection
