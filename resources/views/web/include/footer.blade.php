<!--====== FOOTER PART START ======-->    
<footer id="footer-part" class="pt-50">
  <div class="container">
      
      <div class="footer pb-10">
          <div class="row">
              <div class="col-lg-3 col-md-6">
                  <div class="footer-about pt-30">
                      <a href="{{route('web.index')}}"><img src="{{asset('web/images/pyaas-logo.png')}}" alt="logo"></a>
                      <div class="social-block pl-30">
                          <a href="https://www.facebook.com/pyaasapp" class="facebook"><i class="fa fa-facebook"></i></a>
                          <a href="https://www.instagram.com/pyaasapp/" class="instagram"><i class="fa fa-instagram"></i></a>
                          <a href="https://in.linkedin.com/in/pyaas-app-95a298223" class="linkedin"><i class="fa fa-linkedin"></i></a>
                          {{-- <a href="" class="twitter"><i class="fa fa-pinterest"></i></a> --}}
                      </div>
                      {{-- <span class="pl-30"><i class="fa fa-globe"></i>www.pyaas.in</span> --}}
                  </div>
              </div>
              <div class="col-lg-3 col-md-3 col-6">
                  <div class="footer-title pt-30">
                      <h5>Information</h5>
                  </div>
                  <div class="footer-info">
                      <ul>
                          <li><a href="{{route('web.refund')}}">Refund Policy</a></li>
                          {{-- <li><a href="cancellation.php">Cancellation</a></li> --}}
                          <li><a href="{{route('web.disclamer')}}">Disclaimer</a></li>
                          {{-- <li><a href="faq.php">Faq</a></li> --}}
                          {{-- <li><a href="delivery-info.php">Delivery Information</a></li> --}}
                          <li><a href="{{route('web.privacy')}}">Privacy Policy</a></li>
                          <li><a href="{{route('web.tc')}}">Terms &amp; Conditions</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-2 col-md-3 col-6">
                  <div class="footer-title pt-30">
                      <h5>Pages</h5>
                  </div>
                  <div class="footer-info">
                      <ul>
                          <li><a href="{{route('web.index')}}">Home</a></li>
                          <li><a href="{{route('web.index')}}#product-part">Product</a></li>
                          <li><a href="{{route('web.index')}}#brand-part">Brand</a></li>
                          {{-- <li><a href="#">Cart</a></li>
                          <li><a href="#">MY Order</a></li>
                          <li><a href="#">My Account</a></li> --}}
                          <li><a href="{{route('web.contact')}}">Contact</a></li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="footer-title pt-30">
                      <h5>Get In Touch</h5>
                  </div>
                  <div class="footer-address">
                      <ul>
                          <li>
                              <div class="icon map-i">
                                  <i class="fa fa-map-marker"></i>
                              </div>
                              <div class="address">
                                  <h5>Pyaas</h5>
                                  <p> Ganeshguri, Guwahati, Assam 781006.</p>
                              </div>
                          </li>
                          <li>
                              <div class="icon">
                                  <i class="fa fa-volume-control-phone"></i>
                              </div>
                              <div class="address">
                                  <p>+91 60037 37738 (10 AM - 7 PM)</p>
                              </div>
                          </li>
                          <li>
                              <div class="icon">
                                  <i class="fa fa-envelope-o"></i>
                              </div>
                              <div class="address">
                                  <p>pyaasapp@gmail.com</p>
                              </div>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  <div class="copyright pt-5 pb-5 text-center">
      <p>© All Rights Reserved <span>Pyaas</span> 2021. | Powered By <a target="_blank" href="https://webinfotech.net.in/">Webinfotech</a></p>
  </div>
  
</footer>    
<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TO TOP PART START ======-->    
<a href="#" class="back-to-top">
  <img src="{{asset('web/images/back-to-top.png')}}" alt="Icon">
</a>    
<!--====== BACK TO TOP PART ENDS ======-->

<!--====== ACCOUNT POPPUP PART START ======-->    
<!-- <div class="account-popup-area">
  <div class="account-popup-wrapper">
      <div class="account-popup-content">
          <div class="account-top">
              <div class="account-title">
                  <h3><span>Create an</span> Account</h3>
              </div>
              <a href="javascript:void(0)" class="popup-close">
                  <span></span>
                  <span></span>
              </a>
          </div>
          <div class="account-form">
              <form action="#">
                  <div class="single-form clearfix">
                      <div class="form-title text-right">
                          <p>Email</p>
                      </div>
                      <div class="form-input">
                          <input type="email" name="email" placeholder="Email">
                      </div>
                  </div>
                  <div class="single-form clearfix">
                      <div class="form-title text-right">
                          <p>Password</p>
                      </div>
                      <div class="form-input">
                          <input type="password" name="password" placeholder="Password">
                      </div>
                  </div>
                  <div class="single-form clearfix">
                      <div class="form-title text-right">
                          <p>Confirm Password</p>
                      </div>
                      <div class="form-input">
                          <input type="password" name="password" placeholder="Password">
                      </div>
                  </div>
                  <div class="single-form clearfix">
                      <div class="form-input">
                          <button type="submit">Sing Up</button>
                      </div>
                  </div>
                  
              </form>
              <div class="single-form clearfix">
                  <div class="form-input">
                      <p>Already Have Account? <a href="#">Sing in</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>     -->
<!--====== ACCOUNT POPPUP PART ENDS ======-->     

<!--====== jquery js ======-->
<script src="{{asset('web/js/Increase.js')}}"></script>
<script src="{{asset('web/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset('web/js/vendor/jquery-1.12.4.min.js')}}"></script>

<!--====== Bootstrap js ======-->
<script src="{{asset('web/js/popper.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>

<!--====== Owl Carousel js ======-->
<script src="{{asset('web/js/owl.carousel.min.js')}}"></script>

<!--====== Magnific Popup js ======-->
<script src="{{asset('web/js/jquery.magnific-popup.min.js')}}"></script>

<!--====== Slick js ======-->
<script src="{{asset('web/js/slick.min.js')}}"></script>

<!--====== Nice Number js ======-->
<script src="{{asset('web/js/jquery.nice-number.min.js')}}"></script>

<!--====== Nice Select js ======-->
<script src="{{asset('web/js/jquery.nice-select.min.js')}}"></script>

<!--====== Validator js ======-->
<script src="{{asset('web/js/validator.min.js')}}"></script>

<!--====== Ajax Contact js ======-->
<script src="{{asset('web/js/ajax-contact.js')}}"></script>

<!--====== Main js ======-->
<script src="{{asset('web/js/main.js')}}"></script>

<!--====== Google Map js ======-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
<script src="{{asset('web/js/map-script.js')}}"></script>
@yield('script')

</body>

</html>
