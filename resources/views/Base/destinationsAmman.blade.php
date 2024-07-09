@extends('layout.base')
@section('content')
<section class="page-header" style="background-image: url({{ asset('assets/images/destinations/Amman.jpg') }});padding:190.5px 0;">
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
                    <h3 class="destinations-details__title">Discover Amman</h3><!-- /.destinations-details__title -->
                    <p>The capital city of Jordan, is a vibrant and bustling metropolis with a rich history dating back several millennia.</p>
                    <p>Amman is one of the oldest continuously inhabited cities in the world, with evidence of settlements dating back to the Neolithic period. It was known in ancient times as Philadelphia, one of the cities of the Decapolis, and later became a key city in the Roman, Byzantine, and Islamic periods. The city's historic sites include the Roman Theatre, the Citadel, and various Roman and Byzantine ruins.</p>
                    <div class="row low-gutters destinations-details__gallery">
                        <div class="col-md-4">
                            <img src="{{ asset('assets/images/destinations/a111.jpg') }}" class="img-fluid" alt="">
                        </div><!-- /.col-md-4 -->
                        <div class="col-md-4">
                            <img src="{{ asset('assets/images/destinations/a22.jpg') }}" class="img-fluid" alt="">
                        </div><!-- /.col-md-4 -->
                        <div class="col-md-4">
                            <img src="{{ asset('assets/images/destinations/a999.jpg') }}" class="img-fluid" alt="">
                        </div><!-- /.col-md-4 -->
                    </div><!-- /.row low-gutters -->
                    <h3 class="destinations-details__subtitle">Let's take you on a tour of this fascinating city:</h3><!-- /.destinations-details__title -->
                    <uL>
                        <li>
                         Roman Theatre: Our first stop is the Roman Theatre, a magnificent relic of ancient Philadelphia. Carved into the hillside, this well-preserved theater dates back to the 2nd century AD and could once seat up to 6,000 spectators. From the top, you can enjoy panoramic views of downtown Amman.
                        </li>

                        <li>
                         Citadel (Jabal al-Qal'a): Next, we'll head to the Citadel, located on the highest hill in Amman. Here, you'll find traces of Amman's long history, including the Temple of Hercules, the Umayyad Palace, and the Archaeological Museum, which houses artifacts spanning thousands of years.		 
                        </li>
                         
                        <li>
                         King Abdullah I Mosque: Our tour continues with a visit to the King Abdullah I Mosque, one of the most iconic landmarks in Amman. This majestic mosque, with its distinctive blue dome and towering minarets, is a masterpiece of modern Islamic architecture. Visitors are welcome to admire its beauty from the outside.					 
                        </li>
                         
                        <li>
                         Rainbow Street: Now, let's explore the trendy Rainbow Street in Jabal Amman. Lined with colorful buildings, cafes, art galleries, and boutique shops, this vibrant street is a favorite among locals and tourists alike. It's the perfect place to soak up the city's artistic and bohemian atmosphere.	 
                        </li>
                         
                        <li>
                         Souk Jara: For a taste of authentic Jordanian culture, we'll wander through Souk Jara, a lively open-air market in Jabal Amman. Here, you can browse stalls selling handicrafts, traditional clothing, spices, and souvenirs. Don't forget to sample some delicious street food like falafel, shawarma, and kunafa.
                        </li>
                        
                        <li>
                         Amman Citadel Viewpoint: Before we wrap up our tour, let's head to a lesser-known spot for a breathtaking view of the city. Just behind the Citadel, there's a viewpoint where you can capture stunning panoramic shots of Amman's skyline as the sun sets over the city.
                        </li>
                        
                        <li>
                         Dinner at Hashem Restaurant: No visit to Amman is complete without trying Jordanian cuisine, and Hashem Restaurant is the perfect place for it. This iconic eatery in downtown Amman has been serving up delicious falafel, hummus, and fresh juices for decades. It's a favorite among locals and visitors alike.
                        </li>
                                                        
                    </uL>
                    
                    <p>
                     That concludes our tour of Amman! We hope you've enjoyed exploring this vibrantcity with us. Whether you're interested in history, culture, or simply soaking up the bustling atmosphere, Amman has something to offer everyone.  		
                    </p>
                         
                
                    
                    <div class="row low-gutters destinations-details__gallery mb-0">
                        <div class="col-md-6">
                            <img src="{{ asset('assets/images/destinations/a000.jpg') }}" class="img-fluid" alt="">
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6">
                            <img src="{{ asset('assets/images/destinations/a101.jpg') }}" class="img-fluid" alt="">
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row low-gutters -->
                </div><!-- /.destinations-details__content -->
            </div><!-- /.col-lg-8 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.tour-two -->
<div  class="google-map">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252158.76034052478!2d35.759075801916076!3d31.942897401791665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151b5fb85d7981af%3A0x631c30c0f8dc65e8!2sAmman!5e0!3m2!1sen!2sjo!4v1715062936408!5m2!1sen!2sjo" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>

@endsection
