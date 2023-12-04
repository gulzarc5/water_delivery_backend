@extends('web.template.master')

{{-- Content --}}
@section('content')
  <!--====== PREALOADER PART START ======-->    
  <div class="preloader">
    <div class="thecube">
        <div class="cube c1"></div>
        <div class="cube c2"></div>
        <div class="cube c4"></div>
        <div class="cube c3"></div>
    </div>
  </div>    
  <!--====== PREALOADER PART START ======-->

    <!--====== SLIDER PART START ======-->    
    <section id="slider-part-1" class="slider-1">
        <div class="slider-active">
            <div class="single-slider bg_cover d-flex align-items-center" style="background-image: url({{asset('web/images/slider/bg-2.jpg')}})">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider-content text-center">
                                <h2 data-animation="fadeInUp" data-delay="1s">DELIVERING WATER AT YOUR HOME & OFFICE</h2>
                                <a href="tel:60037 37738" data-animation="fadeInUp" data-delay="2s" href="#">
                                    <i class="fa fa-whatsapp pr-2"></i> 
                                    <i class="fa fa-phone pr-2"></i>
                                    60037 37738
                                </a>
                            </div> <!-- slider content -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- single slider -->
            
            {{-- <div class="single-slider bg_cover d-flex align-items-center" style="background-image: url({{asset('web/images/slider/bg-3.jpg')}})">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="slider-content pt-30 text-center">
                                <h2 data-animation="fadeInUp" data-delay="1s">Always want safe and good water for healthy life</h2>
                                <a href="https://api.whatsapp.com/send?phone=+91-6003737738&text" target="_blank" data-animation="fadeInUp" data-delay="2s" href="#"><i class="fa fa-whatsapp pr-2"></i>Book on whatsapp</a>
                            </div> <!-- slider content -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- single slider --> --}}
    </section>    
    <!--====== SLIDER PART ENDS ======-->          

    <!--====== DOWNLOAD APP PART START ======-->   
    <section class="pt-30 pb-20">
        <div class="container">
            <a class="intro-app" target="_blank" href="https://play.google.com/store/apps/details?id=com.pyaas">
                <img src="{{asset('web/images/app_logo.png')}}" />
                <h5>Download our android app and get exciting offer and discount</h5>
            </a>
        </div>  
    </section> 
    <!--====== DOWNLOAD APP PART ENDS ======-->          

    <!--====== PRODUCTS PART START ======-->    
    <section id="products-part" class="pt-30 pb-40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-15">
                        <h2>Our Products</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div> <!-- section-title -->
                </div>
            </div>
            
            <div class="row pro-list">
                <div class="col-lg-5 col-md-6 col-6">
                    <a href="tel:+91 60037 37738" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/product/p1.png')}}" alt="Bisleri_20_Ltr_bottle_pyaas">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Bisleri 20 Ltr bottle</h6>
                            {{-- <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="#"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            </div> --}}
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-5 col-md-6 col-6">
                    <a href="tel:+91 60037 37738" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/product/p2.png')}}" alt="Bailley_20_Ltr_bottle_pyaas">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Bailley 20 Ltr bottle</h6>
                            {{-- <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="#"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            </div> --}}
                        </div>
                    </a>
                </div>

                <div class="col-lg-5 col-md-6 col-6">
                    <a href="tel:+91 60037 37738" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/product/p3.png')}}" alt="Sliver Drop_20_Ltr_bottle_pyaas">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Sliver Drop 20 Ltr bottle</h6>
                            {{-- <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="#"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            </div> --}}
                        </div>
                    </a>
                </div>

                <div class="col-lg-5 col-md-6 col-6">
                    <a href="tel:+91 60037 37738" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/product/p4.png')}}" alt="Hydros_20_Ltr_bottle_pyaas">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Hydros 20 Ltr bottle</h6>
                            {{-- <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="#"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                            </div> --}}
                        </div>
                    </a>
                </div>

                <div class="col-lg-5 col-md-8 col-8 mx-auto">                    
                    <a href="tel:+91 60037 37738" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/product/p5.png')}}" alt="water_dispenser_pyaas">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Water Dispenser 6 Ltr</h6>
                        </div>
                    </a>
                </div>

                {{-- <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <a href="#" class="view-all-btn">View all <i class="fa fa-long-arrow-right"></i></a>
                </div> --}}
            </div>
        </div>
    </section>    
    <!--====== PRODUCTS PART ENDS ======-->   

    <!--====== MEMBERSHIP PART START ======--> 
    {{-- <section id="membership-part" class="membershp-part pyaas-bg pt-70 pb-70">
        <div class="container">
            <div class="row justify-content-center pb-20">
                <div class="col-lg-8">
                    <div class="section-title text-center text-white pb-50">
                        <h2>MEMBERSHIP</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div> <!-- section-title -->
                </div>
            </div>
            <div class="row pb-5">
                <div class="mem-card text-center col-lg-4 pb-3">
                    <div class="membership-cards text-center">
                        <div class="card">
                            <div class="body-card">
                                <h3 class="title" style="color:rgb(190, 161, 37, 1) ;">Gold Plan </h3>
                                <p class="text text-wrap">Membership</p><hr>
                                <p><strong>Duration</strong></p>
                                <p>
                                    <strong class="pyaas-color " style="font-size: 40px;">90</strong>
                                    <small>Days</small>
                                </p><hr>
                                <button href="#" class="member-btn">
                                    View Brands
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mem-card text-center col-lg-4 pb-3">
                    <div class="membership-cards">
                        <div class="card">
                            <div class="body-card">
                                <h3 class="title" style="color:rgb(190, 161, 37, 1) ;">Silver Plan </h3>
                                <p class="text text-wrap">Membership</p><hr>
                                <p><strong>Duration</strong></p>
                                <p>
                                    <strong class="pyaas-color " style="font-size: 40px;">60</strong>
                                    <small>Days</small>
                                </p><hr>
                                <button href="#" class="member-btn">
                                    View Brands
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mem-card text-center col-lg-4 pb-3">
                    <div class="membership-cards">
                        <div class="card">
                            <div class="body-card">
                                <h3 class="title" style="color:rgb(190, 161, 37, 1) ;">Bronze Plan </h3>
                                <p class="text text-wrap">Membership</p><hr>
                                <p><strong>Duration</strong></p>
                                <p>
                                    <strong class="pyaas-color " style="font-size: 40px;">30</strong>
                                    <small>Days</small>
                                </p><hr>
                                <a href="#" class="member-btn">
                                    View Brands
                                </a>
                            </div>
                        </div>
                    </div>                    
                </div> 
            </div>
        </div>
    </section> --}}
    <!--====== MEMBERSHIP PART ENDS ======--> 

    <!--====== TRUSTED CLIENT PART START ======-->    
    <section id="trusted-clients-part" class="bg_cover pt-80 pb-70" style="background-image: url({{asset('web/images/trusted-clients/bg-1.jpg')}})">
        <div class="container">
            <div class="row align-items-end">
                {{-- <div class="col-lg-3 col-md-4">
                    <div class="trusted-clients-logo text-center pt-30">
                        <img src="{{asset('web/images/trusted-clients/tc-logo.png')}}" alt="Logo">
                        <h5>Tipular Oskar</h5>
                        <ul>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <h1>5.0</h1>
                    </div>
                </div> --}}
                <div class="col-lg-8 col-md-12">
                    <div class="trusted-slied owl-carousel pt-30">
                        <div class="trusted-clients-discription  mb-40">
                            <h1 style="font-size: 29px;">PYAAS is your one-stop solution for drinking water needs in Guwahati</h1>
                            <p>PYAAS is Guwahati 1st organized packaged drinking water Distribution Company, We tied up with all leading water manufacturing companies who process  high quality Packaged Drinking Water, such as Bisleri, Sliver Drop, Bailley , Hydros. We also provide normal purified water from reliable sources ISI water plants.</p>
                            <p>Download PYAAS app, and forget about the hassle of calling your local water delivery guy repeatedly. Rather than waiting for hours, you can place your order of packaged 20 Litre can drinking water in just a couple of steps.</p>
                            
                            <div class="delivery-text" style="float: left;width: 80%;">
                                <a href="https://play.google.com/store/apps/details?id=com.pyaas" target="_blank" style="margin: 0">
                                    <img src="{{asset('web/images/playstore.png')}}" style="width:20%">
                                    <b>
                                        <small>GET IT ON</small><br>
                                        Google Play
                                    </b>
                                </a>
                            </div>
                        </div>
                        {{-- <div class="trusted-clients-discription  mb-40">
                            <h1>Trusted From Our Clients</h1>
                            <p>Lorem Ipsum is simply dummy text of the printing the industry's standard dummy text ever since an unknown printer took a galley.</p>
                            <ul>
                                <li><a class="button" href="#">All Clients</a></li>
                                <li><a class="video videi-popup" href="#"><img src="{{asset('web/images/trusted-clients/icon.png')}}" alt="icon">How It Works</a></li>
                            </ul>
                        </div>
                        <div class="trusted-clients-discription  mb-40">
                            <h1>Trusted From Our Clients</h1>
                            <p>Lorem Ipsum is simply dummy text of the printing the industry's standard dummy text ever since an unknown printer took a galley.</p>
                            <ul>
                                <li><a class="button" href="#">All Clients</a></li>
                                <li><a class="video videi-popup" href="#"><img src="{{asset('web/images/trusted-clients/icon.png')}}" alt="icon">How It Works</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <!--====== TRUSTED CLIENT PART ENDS ======-->  

    <!--====== BRAND PART START ======-->    
    <section id="brand-part" class="pt-70 pb-40">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-15">
                        <h2>Our Brand</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div> <!-- section-title -->
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="https://play.google.com/store/apps/details?id=com.pyaas" target="_blank" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-9.png')}}" alt="Silver_Drop_Package_Drinking_Water">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Silver Drop Package Drinking Water</h6>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="https://play.google.com/store/apps/details?id=com.pyaas" target="_blank" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-1.png')}}" alt="Bisleri_Package_Drinking_Water">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Bisleri Package Drinking Water</h6>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="https://play.google.com/store/apps/details?id=com.pyaas" target="_blank" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-2.png')}}" alt="Bailley_Package_Drinking_Water">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Bailley Package Drinking Water</h6>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="https://play.google.com/store/apps/details?id=com.pyaas" target="_blank" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-5.png')}}" alt="Hydros_Package_Drinking_Water">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Hydros Package Drinking Water</h6>
                        </div>
                    </a>
                </div>


                {{-- <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="{{route('web.product.product-list')}}" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-3.png')}}" alt="Products">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Aquafina Mineral Water</h6>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="{{route('web.product.product-list')}}" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-4.png')}}" alt="Products">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Kinley Mineral Water</h6>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="{{route('web.product.product-list')}}" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-6.png')}}" alt="Products">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Qua Mineral Water</h6>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-6 " style="cursor: pointer;">
                    <a href="{{route('web.product.product-list')}}" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-7.png')}}" alt="Products">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Foster's Mineral Water</h6>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-6" style="cursor: pointer;">
                    <a href="{{route('web.product.product-list')}}" class="singel-products mt-30">
                        <div class="products-image">
                            <img src="{{asset('web/images/brand/brand-8.png')}}" alt="Products">
                        </div>
                        <div class="products-contant">
                            <h6 class="products-title">Kingfisher Mineral Water</h6>
                        </div>
                    </a>
                </div> --}}

                {{-- <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <a href="#" class="view-all-btn">View all <i class="fa fa-long-arrow-right"></i></a>
                </div> --}}
            </div>
        </div>
    </section>    
    <!--====== BRAND PART ENDS ======-->

    <!--====== SERVICES PART START ======-->    
    {{-- <section id="services-part" class="pt-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <h2>Why Choose Us ?</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <p>Nunc molestie mi nunc, nec accumsan libero dignissim sit amet. Fusce sit amet tincidunt metus. Nunc eu risus  suscipit massa dapibus blandit. Vivamus ac commodo eros.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="singel-services mt-45 pb-50 line-r">
                        <div class="services-icon">
                            <img src="{{asset('web/images/choose-us/icon-1.png')}}" alt="Icon">
                        </div>
                        <div class="services-cont pt-25 pl-70">
                            <h4>Aliquam congue fermentum</h4>
                            <p>Nam ut pharetra enim, in tincidunt orci. Ut sed neque dolor. Nullam auctor placerat ipsum. In finibus tortor pulvinar pulvinar laoreet. Quisque id nibh non lectus dictum dapibus quis ac urna.</p>
                            <a href="#">Read More <span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="singel-services pt-45 pb-50">
                        <div class="services-icon pt-45">
                            <img src="{{asset('web/images/choose-us/icon-2.png')}}" alt="Icon">
                        </div>
                        <div class="services-cont pt-25 pl-70">
                            <h4>Pellentesque sed dolor</h4>
                            <p>Nam ut pharetra enim, in tincidunt orci. Ut sed neque dolor. Nullam auctor placerat ipsum. In finibus tortor pulvinar pulvinar laoreet. Quisque id nibh non lectus dictum dapibus quis ac urna.</p>
                            <a href="#">Read More <span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="line-b d-none d-lg-block"></div>
                </div>
                <div class="col-lg-6">
                    <div class="singel-services pt-45 line-r">
                        <div class="services-icon pt-45">
                            <img src="{{asset('web/images/choose-us/icon-3.png')}}" alt="Icon">
                        </div>
                        <div class="services-cont pt-25 pl-70">
                            <h4>Proin dictum elementum</h4>
                            <p>Nam ut pharetra enim, in tincidunt orci. Ut sed neque dolor. Nullam auctor placerat ipsum. In finibus tortor pulvinar pulvinar laoreet. Quisque id nibh non lectus dictum dapibus quis ac urna.</p>
                            <a href="#">Read More <span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="singel-services mt-45">
                        <div class="services-icon">
                            <img src="{{asset('web/images/choose-us/icon-4.png')}}" alt="Icon">
                        </div>
                        <div class="services-cont pt-25 pl-70">
                            <h4>Vestibulum iaculis</h4>
                            <p>Nam ut pharetra enim, in tincidunt orci. Ut sed neque dolor. Nullam auctor placerat ipsum. In finibus tortor pulvinar pulvinar laoreet. Quisque id nibh non lectus dictum dapibus quis ac urna.</p>
                            <a href="#">Read More <span><i class="fa fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>     --}}
    <!--====== SERVICES PART ENDS ======-->

    <!--====== CLIENT PART START ======-->    
    {{-- <section id="client-part" class="pt-80 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <img src="{{asset('web/images/client/c.png')}}" alt="icon">
                        <h2>Our Exhort Happy Clients say !</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <p>Nunc molestie mi nunc, nec accumsan libero dignissim sit amet. Fusce sit amet tincidunt metus. Nunc eu risus  suscipit massa dapibus blandit. Vivamus ac commodo eros.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="client-slied owl-carousel">
                    <div class="col-lg-12">
                        <div class="singel-client mt-50">
                            <div class="client-thum">
                                <div class="client-img">
                                    <img src="{{asset('web/images/client/c-1.jpg')}}" alt="Client">
                                </div>
                                <div class="client-head">
                                    <h5>Anil Barua</h5>
                                    <span>Laravel Developer</span>
                                </div>
                            </div>
                            <div class="client-text mt-35">
                                <p>Nullam condimentum varius ipsum at viverra. Donec tortor metus, sollicitudin vitae est id, ullamcorper pretium tortor. Phasellus bibendum augue ac arcu pharetra congue. Proin accumsan elit et elit vehicula, sit amet fringilla.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-client mt-50">
                            <div class="client-thum">
                                <div class="client-img">
                                    <img src="{{asset('web/images/client/c-2.jpg')}}" alt="Client">
                                </div>
                                <div class="client-head">
                                    <h5>Toya Kanti Roy</h5>
                                    <span>Graphic Designer</span>
                                </div>
                            </div>
                            <div class="client-text mt-35">
                                <p>Nullam condimentum varius ipsum at viverra. Donec tortor metus, sollicitudin vitae est id, ullamcorper pretium tortor. Phasellus bibendum augue ac arcu pharetra congue. Proin accumsan elit et elit vehicula, sit amet fringilla.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-client mt-50">
                            <div class="client-thum">
                                <div class="client-img">
                                    <img src="{{asset('web/images/client/c-1.jpg')}}" alt="Client">
                                </div>
                                <div class="client-head">
                                    <h5>Anil Barua</h5>
                                    <span>Laravel Developer</span>
                                </div>
                            </div>
                            <div class="client-text mt-35">
                                <p>Nullam condimentum varius ipsum at viverra. Donec tortor metus, sollicitudin vitae est id, ullamcorper pretium tortor. Phasellus bibendum augue ac arcu pharetra congue. Proin accumsan elit et elit vehicula, sit amet fringilla.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-client mt-50">
                            <div class="client-thum">
                                <div class="client-img">
                                    <img src="{{asset('web/images/client/c-2.jpg')}}" alt="Client">
                                </div>
                                <div class="client-head">
                                    <h5>Toya Kanti Roy</h5>
                                    <span>Graphic Designer</span>
                                </div>
                            </div>
                            <div class="client-text mt-35">
                                <p>Nullam condimentum varius ipsum at viverra. Donec tortor metus, sollicitudin vitae est id, ullamcorper pretium tortor. Phasellus bibendum augue ac arcu pharetra congue. Proin accumsan elit et elit vehicula, sit amet fringilla.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>      --}}
    <!--====== CLIENT PART ENDS ======-->

    <!--====== DELIVERY PART START ======-->    
    <section id="delivery-part" class="bg_cover" data-overlay="8" style="background-image: url(web/images/bg-2.jpg')}})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="delivery-text text-center pb-30">
                        <h2>Download Our Android App From Playstore</h2>
                        <p>Download our app and get exciting offer, membership benefit, Track your order and many more</p>
                        <a href="https://play.google.com/store/apps/details?id=com.pyaas" target="_blank" >
                            <img src="{{asset('web/images/playstore.png')}}" class="">
                            <b>
                                <small>GET IT ON</small><br>
                                Google Play
                            </b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="delivery-image d-none d-lg-flex align-items-end">
            <img src="{{asset('web/images/pyaas-app-screen.png')}}" alt="water_deivery_app_pyaas">
        </div>
    </section>    
    <!--====== DELIVERY PART ENDS ======-->

       
    {{-- <!--====== BLOG PART START ======-->
    
    <section id="blog-part" class="pt-70 pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-15">
                        <h2>Our blog</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-slied owl-carousel">
                    <div class="col-lg-12">
                        <div class="singel-blog mt-30">
                            <div class="blog-thum">
                                <img src="{{asset('web/images/blog/b-1.jpg')}}" alt="Blog">
                                <div class="date text-center">
                                    <h3>22</h3>
                                    <span>Sep 2020</span>
                                </div>
                            </div>
                            <div class="blog-cont pt-25">
                                <a href="{{route('web.blog-detail')}}"><h5>Etiam sit amet justo tincidunt.</h5></a>
                                <p>Nullam condimentum varius ipsum at viverra. Donec tortor metus, sollicitudin vitae est id, ullamcorper pretium tortor. Phasellus.</p>
                                <a href="{{route('web.blog-detail')}}">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-blog mt-30">
                            <div class="blog-thum">
                                <img src="{{asset('web/images/blog/b-2.jpg')}}" alt="Blog">
                                <div class="date text-center">
                                    <h3>22</h3>
                                    <span>Sep 2020</span>
                                </div>
                            </div>
                            <div class="blog-cont pt-25">
                                <a href="{{route('web.blog-detail')}}"><h5>Etiam sit amet justo tincidunt.</h5></a>
                                <p>Nullam condimentum varius ipsum at viverra. Donec tortor metus, sollicitudin vitae est id, ullamcorper pretium tortor. Phasellus.</p>
                                <a href="{{route('web.blog-detail')}}">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="singel-blog mt-30">
                            <div class="blog-thum">
                                <img src="{{asset('web/images/blog/b-3.jpg')}}" alt="Blog">
                                <div class="date text-center">
                                    <h3>22</h3>
                                    <span>Sep 2020</span>
                                </div>
                            </div>
                            <div class="blog-cont pt-25">
                                <a href="{{route('web.blog-detail')}}"><h5>Etiam sit amet justo tincidunt.</h5></a>
                                <p>Nullam condimentum varius ipsum at viverra. Donec tortor metus, sollicitudin vitae est id, ullamcorper pretium tortor. Phasellus.</p>
                                <a href="{{route('web.blog-detail')}}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== BLOG PART ENDS ======--> --}}

    <!--====== Location PART START ======-->   
    <section id="client-part" class="pt-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center">
                        <img src="{{asset('web/images/client/map.png')}}" alt="icon">
                        <h2>Currently Serving in following areas in Guwahati</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="singel-client mt-50 mb-50">
                        <p>Ganeshguri</p><p>Kachari basti</p><p>Christian basti</p><p>Tarun Nagar</p><p>ABC</p><p>Shreenagar</p><p>Zoo Road</p><p>Sundarpur</p><p>Japorigog</p><p>Nayanpur</p><p>Hengrabari</p><p>Dispur</p><p>Supermarket</p><p>Hatigaon</p><p>Wireless</p><p>Kahilipara  </p>
                    </div>
                    {{-- <div class="section-title text-center mt-50">
                        <img src="{{asset('web/images/client/c.png')}}" alt="icon">
                        <h2>Top Search on Google</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="singel-client mt-50">
                        <p>Water Delivery App </p><p>Water Delivery in guwahati</p><p>Package Water delivery</p><p>Bisleri Delivery</p><p>Bisleri 20lts jar</p><p>500ml water bottle delivery in guwahati </p><p>20lts water jar</p><p>Bisleri package water</p><p>1lts water bottle delivery in guwahati </p><p>Fast water delivery in guwahati </p><p>500ml water bottle delivery in guwahati </p><p>20lts water jar</p><p>Bisleri package water</p><p>1lts water bottle delivery in guwahati </p><p>Fast water delivery in guwahati </p>
                    </div>
                    <div class="section-title text-center mt-50">
                        <img src="{{asset('web/images/client/c.png')}}" alt="icon">
                        <h2>Top Search on Keywords</h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="singel-client mt-50">
                        <p>Water Delivery App </p><p>Water Delivery in guwahati</p><p>Package Water delivery</p><p>Bisleri Delivery</p><p>Bisleri 20lts jar</p><p>500ml water bottle delivery in guwahati </p><p>20lts water jar</p><p>Bisleri package water</p><p>1lts water bottle delivery in guwahati </p><p>Fast water delivery in guwahati </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>    
    <!--====== Location PART ENDS ======-->
@endsection

{{-- Script --}}
@section('script')
@endsection