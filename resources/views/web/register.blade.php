@extends('web.template.master')

{{-- Content --}}
@section('content')

    <section id="page-banner" class="pt-70 pb-0">
        <div class="banner-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-banner-content text-right">
                            <a href="">Home</a>
                            <h3>Register</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-30 pt-30">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100 ">
          <div class="col-md-9 col-lg-6 col-xl-5  ">
            <img src="{{asset('web/images/signInPhoto.jpg')}}" class="img-fluid d-none d-sm-block w-100" alt="Pyaas Logo">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 shadow-lg p-4">
            <form>
              <h3 class="pb-3">Register</h3>
              <div class="form-outline mb-3">
                <label class="form-label">Mobile Number</label>
                <div class="d-flex">
                    <input type="text" class="form-control form-control-md w-75" placeholder="Enter Mobile Number address">
                    <a name="Get_OTP" id="Get_OTP" class="btn btn-primary" href="#" role="button">Get OTP</a>
                </div>
                <label class="form-label pt-2">OTP Number</label>
                <input type="text" class="form-control form-control-md w-50" placeholder="Enter OTP">
              </div>

              <hr><!-- Line -->

              <div class="row">
                <div class="col-md-8 pr-1">
                  <div class="form-outline mb-2">
                    <label class="form-label">Enter Name</label>
                    <input type="text" class="form-control form-control-md " placeholder="Enter Name">
                  </div>
                </div>
                <div class="col-md-4 pl-1">       
                  <div class="form-outline mb-2">
                    <label class="form-label" >Gender</label>
                    <select name="gender" id="" style="width: 100%">
                      <option value="">Male</option>
                      <option value="">Female</option>
                    </select>
                  </div>
                </div>
              </div>
    
              <div class="d-flex justify-content-end">
                <a href="#!" class="text-body">Forgot password?</a>
              </div>
    
              <div class="text-center text-lg-start mt-2">
                <button type="button" class="btn btn-block singel-form btn-primary">Register</button>                
                <p><small>By Continuing your are accepting our <a href="{{route('web.tc')}}" target="_blank">Terms & Condition</a> </small></p>
                <p class="small fw-bold mb-0">
                  Already have an account? 
                  <a href="{{route('web.signin')}}" class="link-danger">Signin</a>
                </p>
              </div>
    
            </form>
          </div>
        </div>
      </div>
    </section>
@endsection

{{-- Script --}}
@section('script')
@endsection