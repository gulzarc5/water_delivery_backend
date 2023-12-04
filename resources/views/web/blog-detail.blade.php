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
                            <h3>Etiam sit amet justo tincidunt.s</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== PAGE BANNER PART ENDS ======-->

<!--====== BLOG DEATILS PART START ======-->
    
<section id="blog-details-part" class="pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mx-auto">
                <div class="blog-details">
                    <div class="blog-details-image pb-20">
                        <img src="{{asset('web/images/blog/bd-1.jpg')}}" alt="Blog Details">
                    </div>
                    <div class="blog-details-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Mauris gravida est quis neque moles tie blandit elit. Mauris gravida est quis est neque moles tie blandit elit.</h4>
                                <div class="d-flex">
                                    <span class="mr-10"><i class="fa fa-calendar"></i> 02-10-2010</span>
                                    <span><i class="fa fa-user"></i> by admin</span>
                                </div>
                                <div class="share pull-right">
                                    <ul>
                                        <li class="head">Share :</li>
                                        <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-skype"></i></a></li>
                                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                    </ul>
                                </div>
                                <hr/>
                            </div>
                            <div class="col-lg-12">
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. <br>
                                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== BLOG DEATILS PART ENDS ======-->
@endsection

{{-- Script --}}
@section('script')
@endsection