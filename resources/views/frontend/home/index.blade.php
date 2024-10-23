@extends('layouts.frontend.header')

@section('content')

<div class="section background-dark over-hide">
	
    <div class="hero-center-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-sm-8 parallax-fade-top">
                    <div class="hero-text">Discover your paradise under the Greek sky</div>
                </div>
                <div class="col-12 mt-3 mb-5 parallax-fade-top">
                    <div class="hero-stars">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    
    <div class="slideshow">
        <div class="slide slide--current parallax-top">
            <figure class="slide__figure">
                <div class="slide__figure-inner">
                    <div class="slide__figure-img" style="background-image: url(img/1.jpg)"></div>
                    <div class="slide__figure-reveal"></div>
                </div>
            </figure>
        </div>
        <div class="slide parallax-top">
            <figure class="slide__figure">
                <div class="slide__figure-inner">
                    <div class="slide__figure-img" style="background-image: url(img/2.jpg)"></div>
                    <div class="slide__figure-reveal"></div>
                </div>
            </figure>
        </div>
        <div class="slide parallax-top">
            <figure class="slide__figure">
                <div class="slide__figure-inner">
                    <div class="slide__figure-img" style="background-image: url(img/3.jpg)"></div>
                    <div class="slide__figure-reveal"></div>
                </div>
            </figure>
        </div>
        <!-- revealer -->
        <div class="revealer">
            <div class="revealer__item revealer__item--left"></div>
            <div class="revealer__item revealer__item--right"></div>
        </div>
        <nav class="arrow-nav fade-top">
            <button class="arrow-nav__item arrow-nav__item--prev">
                <svg class="icon icon--nav"><use xlink:href="#icon-nav"></use></svg>
            </button>
            <button class="arrow-nav__item arrow-nav__item--next">
                <svg class="icon icon--nav"><use xlink:href="#icon-nav"></use></svg>
            </button>
        </nav>
        <!-- navigation -->
        <nav class="nav fade-top">
            <button class="nav__button">
                <span class="nav__button-text"></span>
            </button>
            <h2 class="nav__chapter">discover your paradise</h2>
            <div class="toc">
                <a class="toc__item" href="#entry-1">
                    <span class="toc__item-title">discover your paradise</span>
                </a>
                <a class="toc__item" href="#entry-2">
                    <span class="toc__item-title">unpretentious comfort</span>
                </a>
                <a class="toc__item" href="#entry-3">
                    <span class="toc__item-title">azure sea sparkling</span>
                </a>
            </div>
        </nav>
        <!-- little sides -->
        <div class="slideshow__indicator"></div>
        <div class="slideshow__indicator"></div>
    </div>
</div>

<div class="section padding-top-bottom over-hide">
    <div class="container">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <div class="row justify-content-center">
                    <div class="col-10">
                        <div class="subtitle text-center mb-4">hotel Thalia</div>
                        <h2 class="text-center">Here is a tribute to good life!</h2>
                        <p class="text-center mt-5">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
                <div class="img-wrap">
                    <img src="img/rooms.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section background-grey over-hide">
    <div class="container-fluid px-0">
        <div class="row mx-0">
            <div class="col-xl-6 px-0">
                <div class="img-wrap" id="rev-1">
                    <img src="img/room1.jpg" alt="">
                    <div class="text-element-over">private pool suite</div>
                </div>
            </div>
            <div class="col-xl-6 px-0 mt-4 mt-xl-0 align-self-center">
                <div class="row justify-content-center">
                    <div class="col-10 col-xl-8 text-center">
                        <h3 class="text-center">Private pool suite</h3>
                        <p class="text-center mt-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                        <a class="mt-5 btn btn-primary" href="search.html">check availability</a>
                    </div>	
                </div>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col-xl-6 px-0 mt-4 mt-xl-0 pb-5 pb-xl-0 align-self-center">
                <div class="row justify-content-center">
                    <div class="col-10 col-xl-8 text-center">
                        <h3 class="text-center">Sea view suite</h3>
                        <p class="text-center mt-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                        <a class="mt-5 btn btn-primary" href="search.html">check availability</a>
                    </div>	
                </div>
            </div>
            <div class="col-xl-6 px-0 order-first order-xl-last mt-5 mt-xl-0">
                <div class="img-wrap" id="rev-2">
                    <img src="img/room2.jpg" alt="">
                    <div class="text-element-over">sea view suite</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section background-dark over-hide">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <a href="services.html">
                    <div class="img-wrap services-wrap">
                        <img src="img/ser-1.jpg" alt="">
                        <div class="services-text-over">spa salon</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3 pt-4 pt-sm-0">
                <a href="services.html">
                    <div class="img-wrap services-wrap">
                        <img src="img/ser-2.jpg" alt="">
                        <div class="services-text-over">restaurant</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3 pt-4 pt-lg-0">
                <a href="services.html">
                    <div class="img-wrap services-wrap">
                        <img src="img/ser-3.jpg" alt="">
                        <div class="services-text-over">pool</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3 pt-4 pt-lg-0">
                <a href="services.html">
                    <div class="img-wrap services-wrap">
                        <img src="img/ser-4.jpg" alt="">
                        <div class="services-text-over">activities</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="section padding-top-bottom over-hide">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 align-self-center">
                <div class="subtitle with-line text-center mb-4">elegant suites</div>
                <h3 class="text-center padding-bottom-small">Unpretentious luxury</h3>
            </div>
            <div class="section clearfix"></div>
            <div class="col-sm-6 col-lg-4">
                <div class="services-box text-center">
                    <img src="img/1.svg" alt="">
                    <h5 class="mt-2">smoking free</h5>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                    <a class="mt-1 btn btn-primary" href="services.html">read more</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mt-5 mt-sm-0">
                <div class="services-box text-center">
                    <img src="img/2.svg" alt="">
                    <h5 class="mt-2">king beds</h5>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                    <a class="mt-1 btn btn-primary" href="services.html">read more</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mt-5 mt-lg-0">
                <div class="services-box text-center">
                    <img src="img/3.svg" alt="">
                    <h5 class="mt-2">Yacht rental</h5>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                    <a class="mt-1 btn btn-primary" href="services.html">read more</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mt-5">
                <div class="services-box text-center">
                    <img src="img/4.svg" alt="">
                    <h5 class="mt-2">welcome drink</h5>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                    <a class="mt-1 btn btn-primary" href="services.html">read more</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mt-5">
                <div class="services-box text-center">
                    <img src="img/5.svg" alt="">
                    <h5 class="mt-2">swimming pool</h5>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                    <a class="mt-1 btn btn-primary" href="services.html">read more</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mt-5">
                <div class="services-box text-center">
                    <img src="img/6.svg" alt="">
                    <h5 class="mt-2">food included</h5>
                    <p class="mt-3">Sed ut perspiciatis unde omnis iste natus error sit, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                    <a class="mt-1 btn btn-primary" href="services.html">read more</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section padding-top-bottom over-hide background-grey">
		<div class="container">
			<div class="row justify-content-center">
				@foreach ($rooms as $room)

				<div class="col-md-6 mt-4 mt-md-0">
					<div class="room-box background-white">
						<img src="#" alt="">
						<div class="room-box-in">
							<h5 class="">{{$room -> name}}</h5>
							<p class="mt-3">{!!Str::limit($room->description, 200)!!}..</p>
							<a class="mt-1 btn btn-primary" href="/room-details/{{ str_replace(' ', '-', $room->id)}}">book from kes {{$room->price}}</a>
							
						</div>
					</div>
				</div>
				
				@endforeach

			</div>	
		</div>		
	</div>

<div class="section padding-top-bottom-big over-hide">
    <div class="parallax" style="background-image: url('img/5.jpg')"></div>
    <div class="section z-bigger">		
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div id="owl-sep-1" class="owl-carousel owl-theme">								 
                        <div class="item">						
                            <div class="quote-sep">	
                                <h4>"Chilling out on the bed in your hotel room watching television, while wearing your own pajamas, is sometimes the best part of a vacation."</h4>
                                <h6>Jason Salvatore</h6>	
                            </div>											
                        </div>											
                        <div class="item">					
                            <div class="quote-sep">
                                <h4>"Every good day starts off with a cappuccino, and there's no place better to enjoy some frothy caffeine than at the Thalia Hotel."</h4>
                                <h6>Terry Mitchell</h6>	
                            </div>									
                        </div>											
                        <div class="item">					
                            <div class="quote-sep">
                                <h4>"I still enjoy traveling a lot. I mean, it amazes me that I still get excited in hotel rooms just to see what kind of shampoo they've left me."</h4>
                                <h6>Michael Brighton</h6>
                            </div>										
                        </div>								 
                    </div>	
                </div>
            </div>
        </div>					
    </div>
</div>

<div class="section padding-top-bottom background-grey over-hide">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 align-self-center">
                <div class="subtitle with-line text-center mb-4">Excellent restaurant</div>
                <h3 class="text-center padding-bottom-small">Dining &amp; Bars</h3>
            </div>
            <div class="section clearfix"></div>
        </div>
        <div class="row background-white p-0 m-0">
            <div class="col-xl-6 p-0">
                <div class="img-wrap" id="rev-3">
                    <img src="img/rest-1.jpg" alt="">
                </div>
            </div>
            <div class="col-xl-6 p-0 align-self-center">
                <div class="row justify-content-center">
                    <div class="col-9 pt-4 pt-xl-0 pb-5 pb-xl-0 text-center">
                        <h5 class="">beach restaurant</h5>
                        <p class="mt-3">Sed ut perspiciatis unde omnis, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                        <a class="mt-1 btn btn-primary" href="restaurant.html">explore</a>
                    </div>
                </div>	
            </div>
        </div>
        <div class="row background-white p-0 m-0">
            <div class="col-xl-6 p-0 align-self-center">
                <div class="row justify-content-center">
                    <div class="col-9 pt-4 pt-xl-0 pb-5 pb-xl-0 text-center">
                        <h5 class="">pool restaurant</h5>
                        <p class="mt-3">Sed ut perspiciatis unde omnis, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et.</p>
                        <a class="mt-1 btn btn-primary" href="restaurant.html">explore</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 order-first order-xl-last p-0">
                <div class="img-wrap" id="rev-4">
                    <img src="img/rest-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section padding-top z-bigger">
    <div class="container">
        <div class="row justify-content-center padding-bottom-smaller">
            <div class="col-md-8">
                <div class="subtitle with-line text-center mb-4">get in touch</div>
                <h3 class="text-center padding-bottom-small">drop us a line</h3>
            </div>
            <div class="section clearfix"></div>
            <div class="col-md-6 col-lg-4">
                <div class="address">
                    <div class="address-in text-left">
                        <p class="color-black">Address:</p>
                    </div>
                    <div class="address-in text-right">
                        <p>Avenue Str. 328</p>
                    </div>
                </div>
                <div class="address">
                    <div class="address-in text-left">
                        <p class="color-black">City:</p>
                    </div>
                    <div class="address-in text-right">
                        <p>Nairobi</p>
                    </div>
                </div>
                <div class="address">
                    <div class="address-in text-left">
                        <p class="color-black">Check-In:</p>
                    </div>
                    <div class="address-in text-right">
                        <p>07:00 am</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="address">
                    <div class="address-in text-left">
                        <p class="color-black">Phone:</p>
                    </div>
                    <div class="address-in text-right">
                        <p>+254 712660170</p>
                    </div>
                </div>
                <div class="address">
                    <div class="address-in text-left">
                        <p class="color-black">Email:</p>
                    </div>
                    <div class="address-in text-right">
                        <p>info@hotel.com</p>
                    </div>
                </div>
                <div class="address">
                    <div class="address-in text-left">
                        <p class="color-black">Check-Out:</p>
                    </div>
                    <div class="address-in text-right">
                        <p>11:00 am</p>
                    </div>
                </div>
            </div>
            <div class="section clearfix"></div>
            <div class="col-md-8 text-center mt-5" data-scroll-reveal="enter bottom move 50px over 0.7s after 0.2s">
                <p class="mb-0"><em>available at: 8am - 10pm</em></p>
                <h2 class="text-opacity">+254 7126 60170</h2>
            </div>
        </div>
    </div>	
</div>

@endsection