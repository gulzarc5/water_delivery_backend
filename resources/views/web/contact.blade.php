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

    <section id="page-banner" class="pt-70 pb-0">
        <div class="banner-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-banner-content text-right">
                            <a href="">Home</a>
                            <h3>Contact</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact-part" class="pt-30 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="contact-form pt-45">
                        <h3>Leave Reply:</h3>
                        <form id="contact-form" action="http://webpro.themepul.com/Fresh_Vial/demo/freeshvila/contact.php" data-toggle="validator" novalidate="true">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <label>Nick name :</label>
                                        <input name="name" type="text" data-error="Name is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="singel-form form-group">
                                        <label>Email Address :</label>
                                        <input type="email" name="email" data-error="Valid email is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="singel-form form-group">
                                        <label>Write a message :</label>
                                        <textarea name="message" data-error="Please,leave us a message." required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="singel-form">
                                        <button type="submit" class="disabled">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-info pt-45">
                        <h6>Contact Info</h6>
                        <p>If you want to contact, you can fill this form or call or mail us your query</p>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="cont pl-15">
                                    <h5>Pyaas</h5>
                                    <p>Ganeshguri, Guwahati, Assam 781006.</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="cont pl-15">
                                    <p>pyaasapp@gmail.com</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="cont pl-15">
                                    <p>+91 60037 37738</p>
                                </div>
                            </li>
                        </ul>
                        <h6 class="pt-30">Social Media</h6>
                        <div class="social-block pt-10">
                            <a href="https://www.facebook.com/pyaasapp" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/pyaasapp/" class="instagram"><i class="fa fa-instagram"></i></a>
                            <a href="https://in.linkedin.com/in/pyaas-app-95a298223" class="linkedin"><i class="fa fa-linkedin"></i></a>
                            {{-- <a href="" class="twitter"><i class="fa fa-pinterest"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Script --}}
@section('script')
@endsection