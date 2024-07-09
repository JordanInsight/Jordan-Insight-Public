@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/backgrounds/contact-background.png') }}); background-position: center -500px;">
        <div class="container">
            <h2>Contact</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('blog') }}">Home</a></li>
                <li><span>Contact</span></li>
            </ul><!-- /.thm-breadcrumb -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    <section class="contact-info-one">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-info-one__single">
                        <div class="contact-info-one__icon">
                            <i class="tripo-icon-placeholder"></i>
                        </div><!-- /.contact-info-one__icon -->
                        <div class="contact-info-one__content">
                            <p>Zarqa Jordan
                                Zarqa University
                            </p>
                        </div><!-- /.contact-info-one__content -->
                    </div><!-- /.contact-info-one__single -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="contact-info-one__single">
                        <div class="contact-info-one__icon">
                            <i class="tripo-icon-phone-call"></i>
                        </div><!-- /.contact-info-one__icon -->
                        <div class="contact-info-one__content">
                            Mobile: <a href="tel:+962-781-939069">+962 781 939069</a></p>
                        </div><!-- /.contact-info-one__content -->
                    </div><!-- /.contact-info-one__single -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <div class="contact-info-one__single">
                        <div class="contact-info-one__icon">
                            <i class="tripo-icon-message"></i>
                        </div><!-- /.contact-info-one__icon -->
                        <div class="contact-info-one__content">
                            <p><a href="mailto:jordaninsight69@gmail.com">jordaninsight69@gmail.com</a> <br>
                            </p>
                        </div><!-- /.contact-info-one__content -->
                    </div><!-- /.contact-info-one__single -->
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.contact-info-one -->

    <section class="contact-one">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-one__content">
                        <div class="block-title text-left">
                            <p>Contact with us</p>
                            <h3>Have any Question? <br>
                                feel free to contact <br>
                                with us.</h3>
                        </div><!-- /.block-title -->
                        <div class="contact-one__content-text">
                            <p>Jordan Insight cares about providing you with the best experience in discovering the wonders
                                of Jordan. Whether you have questions, need assistance, or want to share feedback, we are
                                here to help.
                            </p>
                        </div><!-- /.contact-one__content-text -->
                    </div><!-- /.contact-one__content -->
                </div><!-- /.col-lg-5 -->
                <div class="col-lg-7">
                    <form action="mailto:jordaninsight69@gmail.com" method="post" enctype="text/plain"
                        class="contact-one__form">
                        <div class="row low-gutters">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="name" placeholder="Your Name">
                                </div><!-- /.input-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="email" name="email" placeholder="Email Address">
                                </div><!-- /.input-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="phone" placeholder="Phone Number">
                                </div><!-- /.input-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="subject" placeholder="Subject">
                                </div><!-- /.input-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-12">
                                <div class="input-group">
                                    <textarea name="message" placeholder="Write Message"></textarea>
                                </div><!-- /.input-group -->
                            </div><!-- /.col-md-12 -->
                            <div class="col-md-12">
                                <div class="input-group">
                                    <button type="submit" class="thm-btn contact-one__btn">Send
                                        message</button><!-- /.thm-btn contact-one__btn -->
                                </div><!-- /.input-group -->
                            </div><!-- /.col-md-12 -->
                        </div><!-- /.row low-gutters -->
                    </form>
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.contact-one -->
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13525.197667251601!2d36.153431176012106!3d32.061149466963975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b6e180ca7b299%3A0xbe2b1f51ef76f510!2sZarqa%20University!5e0!3m2!1sen!2sjo!4v1716920455753!5m2!1sen!2sjo"
        class="google-map__contact" allowfullscreen></iframe>
@endsection
