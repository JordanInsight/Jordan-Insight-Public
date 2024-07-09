<footer class="site-footer">
    <div class="site-footer__bg"
        style="background-image: url({{ asset('assets/images/backgrounds/footer-bg-1-1.jpg') }});"></div>
    <!-- /.site-footer__bg -->
    <div class="container">
        <div class="row">
            <div class="footer-widget__column footer-widget__about">
                <a href="{{ route('base') }}" class="footer-widget__logo"><img
                        src="{{ asset('assets/images/logo-dark.png') }}" width="200" alt=""></a>
                <p>Jordan Insight is a premium platform for tours, travels, trips, adventures and a wide range of other
                    tour agencies.</p>
            </div><!-- /.footer-widget__column -->
            <div class="footer-widget__column footer-widget__links">
                <h3 class="footer-widget__title">Company</h3><!-- /.footer-widget__title -->
                <ul class="footer-widget__links-list list-unstyled">
                    <li><a href="{{ route('blog') }}">Community Blog</a></li>
                    <br>
                    <li><a href="{{route('about')}}">Meet the Team</a></li>
                </ul><!-- /.footer-widget__links-list list-unstyled -->
            </div><!-- /.footer-widget__column -->
            <div class="footer-widget__column footer-widget__links">
                <h3 class="footer-widget__title">Links</h3><!-- /.footer-widget__title -->
                <ul class="footer-widget__links-list list-unstyled">
                    <li><a href="{{ route('destinations') }}">Destinations</a></li>
                    <br>
                    <li><a href="{{ route('tour-standard.index') }}">Tours</a></li>
                </ul><!-- /.footer-widget__links-list list-unstyled -->
            </div><!-- /.footer-widget__column -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</footer><!-- /.site-footer -->

<div class="site-footer__bottom">
    <div class="container">

    </div><!-- /.container -->
</div><!-- /.site-footer__bottom -->
