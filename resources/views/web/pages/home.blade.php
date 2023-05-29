@extends('web.layouts.main')

@push('meta')
    @include('web.includes.meta', ['seo' => $seo])
@endpush

@push('styles')

@endpush

@push('scripts')

@endpush

@section('content')
    <!-- home -->
    <section aria-label="home" class="mainbg" id="home">

        <!-- intro -->
        <div class="container">
            <div class="row">
                <div class="overlay-main v-align">
                    <div class="col-md-10 col-xs-11">

                        <h1 class="onStep" data-animation="animbouncefall" data-time="300">PROVIDING COMFORTABLE</h1>
                        <div class="onStep" data-animation="fadeInUp" data-time="600" id="slidertext">
                            <h3 class="main-text">LUXURY RESIDENCE</h3>
                            <h3 class="main-text">LUXURY BEACH</h3>
                            <h3 class="main-text">LUXURY VACATION</h3>
                        </div>

                        <div class="star-content onStep" data-animation="fadeInUp" data-time="900"><i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> Five Star Luxury Hotel</div>

                    </div>
                </div>
            </div>
        </div>
        <!-- intro end -->

    </section>
    <!-- home end -->

    <!-- booking home -->
    <div class="bot-home-text onStep" data-animation="fadeInUp" data-time="1200">
        <div class="container">

            <div id="reservation" class="imgbgres" style="background-image:url(/web/img/bg-res.jpg)">

                <form action="#" id="form1" method="post" name="form1">
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <select class="form-control" id="selectroom">
                                <optgroup label="SELECT ROOM">
                                    <option value="LUXURY SINGLE">LUXURY SINGLE ROOM</option>
                                    <option value="LUXURY DOUBLE">LUXURY DOUBLE ROOM</option>
                                    <option value="PREMIUM LUXURY">PREMIUM LUXURY ROOM</option>
                                    <option value="PREMIUM SUITE">PREMIUM SUITE ROOM</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-md-3 form-group">
                            <div class="input-group">
                                <input type="text" name="date1" id="date1" class="form-control fox1" placeholder="CHECK IN DATE">
                                <div class="input-group-btn">
                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 form-group">
                            <div class="input-group">
                                <input type="text" name="date2" id="date2" class="form-control fox2" placeholder="CHECK OUT DATE">
                                <div class="input-group-btn">
                                    <span class="icon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 form-group">
                            <input id="personbook" name="personbook" placeholder="PERSON" type="text">
                        </div>

                        <div class="col-sm-4 form-group">
                            <input id="namebook" name="namebook" placeholder="NAME" type="text">
                        </div>

                        <div class="col-sm-3 form-group">
                            <input id="emailbook" name="emailbook" placeholder="EMAIL" type="text">
                        </div>

                        <div class="col-sm-3 form-group">
                            <input id="phonebook" name="phonebook" placeholder="PHONE" type="text">
                        </div>

                        <div class="col-sm-12 form-group">
                            <textarea cols="50" id="messagebook" name="message" placeholder="YOUR MESSAGE" rows="2"></textarea>
                        </div>

                        <div class="success-white" id="mail_success">Thank you. Your reservation has been sent.</div>
                        <div class="error-white" id="mail_failed">Error, email not sent</div>
                        <button class="btn-content" id="send">BOOK NOW</button>

                    </div>
                </form>

            </div>

        </div>
    </div>
    <!-- booking home end -->

    <!-- section room -->
    <section class="whitepage">

        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="text-center">
                        <h2>LUXURY ROOMS</h2>
                        <span class="devider-center"></span>
                        <h3>Display Our Room</h3>
                    </div>
                </div>

                <!-- spacer -->
                <div class="space-single"></div>
                <!-- spacer -->

                <div class="with-gutter">

                    <div class="onStep" data-animation="fadeInUp" data-time="300">
                        <div class="col-md-5">
                            <div class="projects-home" style="background-image:url(/web/img/rooms/resto-room.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay v-align">
                                            <div class="content">
                                                <span class="heading">OUR RESTAURANT</span>
                                                <span class="devider-projects"></span>
                                                <span class="subheading">Display Our Room</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="projects-home" style="background-image:url(/web/img/rooms/com-room.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay v-align">
                                            <div class="content">
                                                <h3 class="heading">COMPARTMENT</h3>
                                                <span class="devider-projects"></span>
                                                <p class="subheading">Full Served</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="projects-home" style="background-image:url(/web/img/rooms/rel-room.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay v-align">
                                            <div class="content">
                                                <span class="heading">RELAXING</span>
                                                <span class="devider-projects"></span>
                                                <span class="subheading">Spa & Pool</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="projects-home" style="background-image:url(/web/img/rooms/beach.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay v-align">
                                            <div class="content">
                                                <h3 class="heading">THE BEACH</h3>
                                                <span class="devider-projects"></span>
                                                <p class="subheading">Ocean View</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </section>
    <!-- section room end -->

    <!-- subscribe -->
    <section class="subscribe-section" style="background-image:url(/web/img/subscribe-bg.jpg)">
        <div class="container">
            <div class="row">

                <div class="col-md-6 subwrap-tagline">
                    <h2>
                        THE
                        GREATEST
                        LANDSCAPE
                        HOTEL
                        FOR
                        VACATION
                    </h2>
                </div>

                <div class="col-md-6 subwrap">
                    <h2>Newsletter</h2>
                    <h5>Sign up for Our News!</h5>

                    <div class="space-half">
                    </div>

                    <form action="subscribe.php" id="subscribe" method="post" name="subscribe">
                        <input class="subscribfield subscribeemail" id="subscribeemail" name="subscribeemail" type="text" placeholder="Enter - email">
                        <button class="btn-form" id="submit-2" type="submit">SUBSCRIBE</button>
                    </form>

                    <div class="subscribesuccess">
                        Thank you for fill your email
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- subscribe end -->

    <section class="whitepage">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="text-center">
                        <h2>RECENT POST</h2>
                        <span class="devider-center"></span>
                        <h3>Experience of Guest</h3>
                    </div>
                </div>

                <!-- spacer -->
                <div class="space-double"></div>
                <!-- spacer -->

                <div class="onStep" data-animation="fadeInUp" data-time="300">

                    <div class="owl-carousel" id="owl-post">

                        <div class="item">
                            <div class="recent-post" style="background-image:url(/web/img/recent/img1.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay ">
                                            <div class="content">
                                                <div class="heading">COUPLE OF JOURNEY
                                                    <span class="devider-recent"></span>
                                                </div>
                                                <div class="subheading">3 days vacation</div>
                                                <div class="readmore">Read more <i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="recent-post" style="background-image:url(/web/img/recent/img2.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay ">
                                            <div class="content">
                                                <div class="heading">FAMILY HAPPINESS
                                                    <span class="devider-recent"></span>
                                                </div>
                                                <div class="subheading">7 days vacation</div>
                                                <div class="readmore">Read more <i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="recent-post" style="background-image:url(/web/img/recent/img3.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay ">
                                            <div class="content">
                                                <div class="heading">TRAVELER
                                                    <span class="devider-recent"></span>
                                                </div>
                                                <div class="subheading">2 days vacation</div>
                                                <div class="readmore">Read more <i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="recent-post" style="background-image:url(/web/img/recent/img1.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay ">
                                            <div class="content">
                                                <div class="heading">COUPLE OF JOURNEY
                                                    <span class="devider-recent"></span>
                                                </div>
                                                <div class="subheading">3 days vacation</div>
                                                <div class="readmore">Read more <i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="recent-post" style="background-image:url(/web/img/recent/img2.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay ">
                                            <div class="content">
                                                <div class="heading">FAMILY HAPPINESS
                                                    <span class="devider-recent"></span>
                                                </div>
                                                <div class="subheading">7 days vacation</div>
                                                <div class="readmore">Read more <i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="recent-post" style="background-image:url(/web/img/recent/img3.jpg)">
                                <div class="hovereffect">
                                    <a href="#">
                                        <div class="overlay ">
                                            <div class="content">
                                                <div class="heading">TRAVELER
                                                    <span class="devider-recent"></span>
                                                </div>
                                                <div class="subheading">2 days vacation</div>
                                                <div class="readmore">Read more <i class="fa fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- section about end -->


    <section id="brand" class="brand-page" aria-label="brands" style="background-image:url(/web/img/bg-logo.jpg)">
        <!-- brands-->
        <div class="container">
            <div class="row">

                <div class="owl-carousel" id="owl-brand">

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/1.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/2.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/3.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/4.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/5.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/6.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/1.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/2.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/3.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/4.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/5.png">
                    </div>

                    <div class="item">
                        <img alt="background" src="/web/img/ourclients/6.png">
                    </div>

                </div>

            </div>
        </div>
        <!-- brands end-->
    </section>


    <!-- subfooter -->
    <section aria-label="footer" class="subfooter">
        <div class="container">
            <div class="row">

                <div class="col-md-4 col-xs-12">
                    <div class="logo">
                        <img alt="logo" src="/web/img/logo.png">
                    </div>

                    <p>
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida
                        id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa adipiscing.
                    </p>
                </div>


                <div class="col-md-4 col-xs-12 col-md-offset-1">
                    <h3>
                        CONTACT INFO
                    </h3>

                    <address>
                        <span>129 Park street, New York City, NY 10903</span> <span>PHONE: (+6221) 000 888 999</span> <span>EMAIL : <a href=
                                                                                                                                           "mailto:companyname@gmail.com">companyname@gmail.com</a></span> <span>SITE : <a href="#">www.companyname.com</a></span>
                    </address>
                </div>

                <div class="col-md-3 col-xs-12 pull-right">
                    <h3>
                        PHOTO STREAM
                    </h3>
                    <div id="flickr-photo-stream">
                        <script src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=52617155@N08" type="text/javascript">
                        </script>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- subfooter end -->
@endsection
