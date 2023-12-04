@extends('web.template.master')

{{-- Content --}}
@section('content')
    <!--====== PAGE BANNER PART START ======-->
    <section id="page-banner" class="pt-70 pb-0">
        <div class="banner-inner" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-banner-content text-right">
                            <a href="">Home</a>
                            <h3>Bisleri Miniral Water 20 LTs</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== PRODUCTS DETAILS PART START ======-->
    <section id="products-details-part" class="pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="products-viwe mt-30">
                        <div class="singel-slied">
                            <img src="web/images/product/pd-1.jpg" alt="Products">
                        </div>
                        <div class="singel-slied">
                            <img src="web/images/product/pd-2.jpg" alt="Products">
                        </div>
                        <div class="singel-slied">
                            <img src="web/images/product/pd-3.jpg" alt="Products">
                        </div>
                        <div class="singel-slied">
                            <img src="web/images/product/pd-4.jpg" alt="Products">
                        </div>
                        <div class="singel-slied">
                            <img src="web/images/product/pd-1.jpg" alt="Products">
                        </div>
                    </div>
                    
                    <div class="products-thum mt-30">
                        <div class="singel-thum">
                            <img src="web/images/product/pdm-1.jpg" alt="Products">
                        </div>
                        <div class="singel-thum">
                            <img src="web/images/product/pdm-2.jpg" alt="Products">
                        </div>
                        <div class="singel-thum">
                            <img src="web/images/product/pdm-3.jpg" alt="Products">
                        </div>
                        <div class="singel-thum">
                            <img src="web/images/product/pdm-4.jpg" alt="Products">
                        </div>
                        <div class="singel-thum">
                            <img src="web/images/product/pdm-1.jpg" alt="Products">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <div class="products-details pt-30">
                        <div class="title">
                            <h3>Bisleri Miniral Water 20 LTs</h3>
                        </div>
                        <div class="review pb-10">
                            <p>Size : 20 Lts</p>
                        </div>
                        <h5 style="color: green"><strong>Duration :</strong> 60 Days</h5>
                        <div class="price pt-30">
                            <h3><span><del>₹50</del></span>₹40 <small class="text-aaa">/ Bottle</small> </h3>
                        </div>
                        <div class="Desciption pt-30">
                            <h6>Short Description:</h6>
                            <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s it to make sfsa type specimen book. It has survived not only five but centuries. </p>
                        </div>
                        {{-- <div class="quanty-availability pt-25">
                            <div class="quanty">
                                <p>Qty:</p>
                                <div class="qty">
                                    <input type="number" class="count" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="availability-loc pt-25">
                            <h6>Delivery Location</h6>
                            <div class="location">
                                <div class="row pt-10">
                                    <div class="location-select col-6">
                                        <select name="" id="">
                                            <option value="">Select Area</option>
                                            <option value="">Area 1</option>
                                            <option value="">Area 2</option>
                                            <option value="">Area 3</option>
                                        </select>
                                    </div>
                                    <div class="location-select col-6">
                                        <select name="" id="">
                                            <option value="">Select Sub Area</option>
                                            <option value="">Sub Area 1</option>
                                            <option value="">Sub Area 2</option>
                                            <option value="">Sub Area 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="availability">
                                <p>Please check your location</p>
                                <p class="success">Delivery is available in your location </p>
                                <p class="no-delivery">Delivery not is available in your location </p>
                            </div>
                            
                        </div> --}}
                        <div class="pt-50">
                            <ul>
                                <li>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        Book Now
                                    </button>
                                    <a class="btn btn-success" href=""><i class="fa fa-whatsapp"></i> Book on whatsapp</a> 
                                    <a class="btn btn-secondary" href=""><i class="fa fa-phone"></i> Call to Book</a> 
                                </li>
                            </ul>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <form class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Booking Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="booking-block">
                                            <div class="form-row mb-10">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Name</label>
                                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Phone</label>
                                                    <input type="text" class="form-control" id="inputPassword4" placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="form-row mb-10">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Delivery Date</label>
                                                    <input type="date" class="form-control" id="inputEmail4" placeholder="Delivery date">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Email</label>
                                                    <input type="email" class="form-control" id="inputPassword4" placeholder="Enter email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress">Address</label>
                                                <input type="text" class="form-control mb-10" id="inputAddress" placeholder="1234 Main St">
                                            </div>
                                            <div class="form-row mb-10">
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Area</label>
                                                    <select id="inputState" class="form-control">
                                                        <option selected>Choose Area</option>
                                                        <option>Ganeshguri</option>
                                                        <option>Christan Basti</option>
                                                        <option>Dispur</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Sub Area</label>
                                                    <select id="inputState" class="form-control">
                                                        <option selected>Choose Sub Area</option>
                                                        <option>Rajbari Path</option>
                                                        <option>Sewali Path</option>
                                                        <option>MLA Hostel</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState">Shift</label>
                                                    <select id="inputState" class="form-control">
                                                        <option selected>Choose Shift</option>
                                                        <option>Morning Shift</option>
                                                        <option>Evening Shift</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Send Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
    <!--====== PRODUCTS DETAILS PART ENDS ======-->

    <!--====== PRODUCTS TAB PART START ======-->    
    <section id="Product-tab" class="pt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="Product-tab">
                        <ul class="nav" id="myTab" role="tablist">
                            <li>
                                <a class="active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">description</a>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div class="Product-tab-cont">
                                    <p>MOVIE STAR – Online Movie,Video & TV Show PSD Template is a the best design for 2017. any kinds of online video Template Based on Bootstrap, 12 column Responsive grid Template. “MOVIE STAR” is a smooth and colorful online video PSD Template, perfect suitable for , Businesses or Personal One page Template. It includes everything you need for the website development such as online Movie,Video & TV Show Template .PSD files are well organized also you can customize very easy . we have include 21 psd file for you. Please, don’t forget to leave a stars rating for this Template! <br> MOVIE STAR – Online Movie,Video & TV Show PSD Template is a the best design for 2017. any kinds of online video Template Based on Bootstrap, 12 column Responsive grid Template. “MOVIE STAR” is a smooth and colorful online video PSD Template, perfect suitable for , Businesses or Personal One page Template. It includes everything you need for the website development such as online Movie,Video & TV Show Template.</p>
                                    <h6>Item Features :</h6>
                                    <ul>
                                        <li>Perfect unique design</li>
                                        <li>Fully responsive</li>
                                        <li>Amazing parallax effects</li>
                                        <li>SEO friendly</li>
                                        <li>Well organized and valid code</li>
                                        <li>Google fonts</li>
                                        <li>WPML ready</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== PRODUCTS TAB PART ENDS ======-->

    <!--====== PRODUTCT PAGE PART START ======-->
    <div id="produtct-part" class="pt-30 pb-30">
        <div class="container">
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center pb-15">
                        <h2>Our Related Products</h2>
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
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-1.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-2.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-3.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-2.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">$259</span>
                                    <span class="discount-price">$215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== PRODUTCT PAGE PART ENDS ======-->
@endsection

{{-- Script --}}
@section('script')
@endsection