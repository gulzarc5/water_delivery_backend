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
                            <h3>Brand List</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== PRODUTCT PAGE PART START ======-->
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
                <div class="col-lg-3 col-md-6 col-sm-6"style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-1.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Bisleri Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-2.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Bailley Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-3.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Aquafina Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-4.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Kinley Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-5.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Hydros Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-6.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Qua Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 " style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-7.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Foster's Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="cursor: pointer;">
                    <div class="singel-products mt-30">
                        <a href="{{route('web.product.product-list')}}" class="products-image">
                            <img src="{{asset('web/images/brand/brand-8.png')}}" alt="Products">
                        </a>
                        <div class="products-contant">
                            <h6 class="products-title"><a href="{{route('web.product.product-list')}}">Kingfisher Mineral Water</a></h6>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <a href="#" class="view-all-btn">View all <i class="fa fa-long-arrow-right"></i></a>
                </div> --}}
            </div>
        </div>
      </section> 
    <!--====== PRODUTCT PAGE PART ENDS ======-->
@endsection

{{-- Script --}}
@section('script')
@endsection