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
                            <h3>Product List</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== PRODUTCT PAGE PART START ======-->
    <div id="produtct-part" class="pt-40 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="produtct-top-bar d-md-flex justify-content-end">
                        <div class="produtct-bar">
                            <div class="produtct">
                                <p>Sort by :</p>
                                <select name="select">
                                    <option>Most Relevent</option>
                                    <option>High to Low</option>
                                    <option>Low to High</option>
                                    <option>Popularity</option>
                                </select>
                                <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- produtct-bar -->

            <div class="row pro-list">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-1.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-2.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-3.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-2.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-1.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-4.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-2.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-6">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-detail')}}" class="products-image">
                            <img src="web/images/product/p-1.jpg" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-detail')}}">Mineral water big bottle</a></h6>
                            <div class="price-rating d-flex justify-content-between">
                                <div class="price">
                                    <span class="regular-price">₹259</span>
                                    <span class="discount-price">₹215</span>
                                </div>
                            </div>
                            <div class="products-cart">
                                <a class="cart-add" href="{{route('web.product.product-detail')}}"> Check Detail <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <nav class="produtct-next pt-50">
                        <ul class="pagination justify-content-center">
                            <li><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li><a class="page-link active" href="#">1</a></li>
                            <li><a class="page-link" href="#">2</a></li>
                            <li><a class="page-link" href="#">3</a></li>
                            <li><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--====== PRODUTCT PAGE PART ENDS ======-->
@endsection

{{-- Script --}}
@section('script')
@endsection