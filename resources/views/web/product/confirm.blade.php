@extends('web.template.master')

{{-- Content --}}
@section('content')
    <section id="page-banner" class="pt-70 pb-0">
        <div class="banner-inner" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-banner-content text-right">
                            <a href="">Home</a>
                            <h3>Order conformation Page</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-40 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">

                    {{-- Successful --}}
                    <div class="order-section shadow pb-4">
                        <div class="header-text text-center">
                            <i class="fa fa-check-circle fa-4x text-primary p-2" aria-hidden="true"></i>
                            <h4>Order Conformation </h4>
                        </div>
                        <hr>
                        <div class="order-no">
                            <h4 class="text-center text-dark">Your Order number is <span class="text-danger"> #439493439</span> </h4>
                        </div>
                        <hr>
                        <div class="container conformation-email-section">
                            <div class="text-center">
                                <p><span class="text-muted">You'll receive conformation shortly to register phone/email</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Not Successful --}}
                    <div class="order-section shadow pb-4">
                        <div class="header-text text-center">
                            <i class="fa fa-times fa-4x text-danger p-2" aria-hidden="true"></i>
                            <h4 class="text-danger">Order Unsuccessful </h4>
                        </div>
                        <hr>
                        <div class="order-no">
                            <h4 class="text-center text-danger">Your Order was not placed</h4>
                        </div>
                        <hr>
                        <div class="container conformation-email-section">
                            <div class="text-center">
                                <p><span class="text-muted">If money is deducted from your account, it will be revert back in3-4 days.</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <a href="{{route('web.index')}}" class="btn btn-outline-secondary mr-4">Continue Shopping</a>
                        <a href="{{route('web.index')}}" class="btn btn-primary">Order History</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== PRODUTCT PAGE PART ENDS ======-->
@endsection

{{-- Script --}}
@section('script')
@endsection