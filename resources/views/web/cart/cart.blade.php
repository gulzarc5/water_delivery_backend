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
                        <h3>Shopping Cart</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="cart-part" class="pt-50 pb-50 bg-white rounded cart">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="cart shadow-sm border">                    
                    <div class="cart-header mb-xs-30">
                        <h4 class="mb-0">Cart</h4>
                        <p><small>You have 2 items in your cart</small></p>
                    </div>
                    <div class="pb-4 cart-list">                        
                        <div class="d-flex justify-content-between pr-3 pl-3 items rounded">
                            <div class="d-flex flex-row align-items-center">
                                <img class="img-rounded" src="web/images/product/pd-1.jpg" width="80" height="100">
                                <div class="ml-3 pr-5 text-wrap">
                                    <span class="font-weight-bold d-block">Bisleri Miniral Water 20 LTs</span>
                                    <span class="spec"><small>This product details is as written here</small></span>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-start align-items-center"> 
                                <div class="input-group row justify-content-around">
                                    <div class="product-quantite">
                                        <div class="qty">
                                            <input type="number" class="qty" value="0">
                                        </div>
                                    </div>
                                </div>
                                <span class="ml-5 font-weight-bold d-flex align-items-center pr-3"><del>₹50</del>&nbsp;₹40 </span>
                                <a href="#"><i class="fa fa-trash-o fa-lg ml-3 text-black-50"></i></a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between pr-3 pl-3 items rounded">
                            <div class="d-flex flex-row align-items-center">
                                <img class="img-rounded" src="web/images/product/pd-2.jpg" width="80" height="100">
                                <div class="ml-3 pr-5">
                                    <span class="font-weight-bold d-block">Hydros Miniral Water 20 LTs</span>
                                    <span class="spec"><small>This product details is as written here</small></span>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-start align-items-center"> 
                                <div class="input-group row justify-content-around">
                                    <div class="product-quantite">
                                        <div class="qty">
                                            <input type="number" class="qty" value="0">
                                        </div>
                                    </div>
                                </div>
                                <span class="ml-5 font-weight-bold d-flex align-items-center pr-3"><del>₹50</del>&nbsp;₹40 </span>
                                <a href="#"><i class="fa fa-trash-o fa-lg ml-3 text-black-50"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pr-1 pl-1">
                <div class="shadow-sm border rounded mb-2" id="card-summary">
                    <div class="payment-info">                   
                        <div class="cart-header p-3 mb-3">
                            <h4>Card summary</h4>
                        </div>                
                        <div class="pr-4 pl-4 pb-4">
                            <span class="badge badge-pill text-primary p-0 mb-0">2 Items added</span>
                            <div class="d-flex justify-content-between information text-dark pb-1">
                                <strong>Subtotal</strong>
                                <span>₹3000</span>
                            </div>
                            <div class="d-flex justify-content-between information text-dark pb-1">
                                <strong>Shipping</strong>
                                <span>₹20</span>
                            </div>
                            <div class="d-flex justify-content-between information text-dark pb-1">
                                <strong>Empty jar</strong>
                                <span>₹140</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between information text-dark">
                                <strong>Total <small style="color: #777">(Incl. taxes)</small></strong>
                                <strong>₹3020</strong>
                            </div>                              
                        </div>            
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 pr-1">
                        <a class="btn btn-outline-secondary btn-block"  href="{{route('web.index')}}" >Continue Shopping</a> 
                    </div> 
                    <div class="col-6 pl-1">
                        <a class="btn btn-success btn-block" href="{{route('web.checkout.checkout')}}">Proceed to Checkout</a>
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