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
                            <h3>Log In</h3>
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
              <h3 class="pb-3">Log In</h3>
              <div class="form-outline mb-2">
                <label class="form-label" >Mobile Number</label>
                <input type="text"  class="form-control form-control-md" placeholder="Enter Mobile Number address" />
              </div>
    
              <div class="form-outline mb-2">
                <label class="form-label" >Enter Password</label>
                <input type="password"  class="form-control form-control-md" placeholder="Enter password" />
              </div>
    
              <div class="d-flex justify-content-end">
                <a href="#!" class="text-body">Forgot password?</a>
              </div>
    
              <div class="text-center text-lg-start mt-2">
                <button type="button" class="btn btn-block singel-form btn-primary">Log In</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('web.register')}}"
                    class="link-danger">Register</a></p>
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