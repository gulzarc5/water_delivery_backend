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
                            <h3>Checkout</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="cart-part" class="pt-50 pb-50 bg-white rounded cart">
        <div class="container">
            <div class="row" id="Div1">         
                <div class="col-lg-8 accordion"  id="accordionExample">
                    <!--  DELIVERY ADDRESS -->
                    <div class="delivery-address-section mb-3 border shadow-lg ">
                       <div class="delivery-address-text">
                           <h4 class="membership-bg d-flex justify-content-between">
                               <span>DELIVERY ADDRESS</span>
                           </h4>
                       </div>
                       <div id="collapseOne" class="collapse show m-3" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="delivery-address-body " id="addressClick" style="cursor: pointer;">
                                <div class="delivery-info row pl-3 ">
                                    {{-- Address Item --}}
                                    <div class="address-body pyaas-border pr-2" >
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input " id="address1" name="address1" >
                                            <label class="custom-control-label" for="address1">
                                                <div class="pt-1 user-info" >
                                                    <h5 class="name">Mriganka Hazarika</h5>
                                                    <p>Amingaon, North Guwahati</p>
                                                    <p>Guwahati-781030, Assam</p>
                                                    <p>Mobie : 8474003779</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    {{-- Address Item --}}
                                    <div class="address-body pyaas-border pr-2" >
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input checked" id="address2" name="address1" >
                                            <label class="custom-control-label" for="address2">
                                                <div class="pt-1 user-info" >
                                                    <h5 class="name">Mriganka Hazarika</h5>
                                                    <p>Amingaon, North Guwahati</p>
                                                    <p>Guwahati-781030, Assam</p>
                                                    <p>Mobie : 8474003779</p>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Add Address --}}
                                    <div class="address-body pyaas-border pr-2 bg-white" onclick="switchVisible();" >
                                        <div class="address h-70 justify-content-center text-center" >
                                            <div class="pt-0">
                                                <i class="fa fa-plus fa-2x text-aaa" aria-hidden="true"></i>
                                                <div class="title pt-3">
                                                    <h5 class="text-aaa">Add New Address</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm mt-2" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Continue</button>
                            </div>
                        </div>
                    </div>                                                       
                
                    <!--  DELIVERY DATE & SHIFT -->
                    <div class="delivery-date mb-3 border shadow-lg">
                        <div class="delivery-date-header ">
                            <h4 class="membership-bg d-flex justify-content-between">
                                DELIVERY DATE & SHIFT
                                </a> 
                            </h4>
                        </div>
                        <div id="collapseTwo" class="collapse p-3" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="date-input">
                                        <label for="date">Select Date for Delivery</label>
                                        <input class="form-control" name="date" type="date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="delivery-shift mb-4">
                                        <label>Select Delivery Shift</label>
                                        <div class="d-flex">
                                            <div class="form-check"  id="form">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input checked" id="shift2" name="shift1" >
                                                    <label class="custom-control-label" for="shift2">
                                                        <p class="pay-text"><strong>Morning Shift</strong>  <br><small style="margin-top: -3px">&nbsp 10AM - 1PM</small></p>
                                                    </label>
                                                </div>
                                            </div>&nbsp &nbsp
                                            <div class="form-check" id="form2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input " id="shift1" name="shift1" >
                                                    <label class="custom-control-label" for="shift1">
                                                        <p class="pay-text"><strong>Evening Shift</strong>  <br><small style="margin-top: -3px">&nbsp 4PM - 7PM</small></p>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm"  data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapse">Back</button> 
                            <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Continue</button>
                        </div>
                    </div>

                    <!-- Payment section -->
                    <div class="Payment border shadow-lg" id="id5">
                        <div class="delivery-payment-header">
                            <h4 class="membership-bg d-flex justify-content-between">
                                PAYMENT
                                </a> 
                            </h4>
                        </div>
                        <div id="collapseThree" class="collapse m-3" aria-labelledby="headingThree" data-parent="#accordionExample">
                            <div class="delivery-payment-details mb-2 p-2">
                                <div class="row">
                                    <div class="col-lg-5" id="OnlineDiv">
                                        <div class="form-check"  id="form">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input " id="payment1" name="payment" >
                                                <label class="custom-control-label" for="payment1">
                                                    <p class="pay-text"><strong>Online</strong>  <br><small style="margin-top: -3px">&nbsp; Pay With Payment Gateway</small></p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5" id="CodDiv">
                                        <div class="form-check"  id="form">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input " id="payment2" name="payment" >
                                                <label class="custom-control-label" for="payment2">
                                                    <p class="pay-text"><strong>Cash On Delivery</strong>  <br><small style="margin-top: -3px">&nbsp; Pay at The Time of Delivery</small></p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-outline-secondary btn-sm"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapse">Back</button> 
                                    <a class="btn btn-primary btn-sm" href="{{route('web.product.confirm')}}">Proceed to Pay</a>
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
                        <div class="col-6 offset-6">
                            <a class="btn btn-outline-secondary btn-block"  href="{{route('web.index')}}" >Continue Shopping</a> 
                        </div> 
                    </div>
                </div>
            </div>

            <div class="row" id="Div2" style="display:none;">  
                <div class="col-md-12 col-lg-9 mx-auto">
                    <form action="">
                        <h3 class="pb-4">Enter Delivery Address</h3>
                        <div class="form-group">
                            <label for="inlineFormInputName " class="text-muted">Full Name</label>
                            <input type="text" class="form-control" id="InputName"  placeholder="Enter Name">
                        </div>
                        <div class="form-row pt-2">
                            <div class="col-md-6">
                                <label for="inlineFormInputName" class="text-muted">Phone Number</label>
                                <input type="text" class="form-control" placeholder=" Enter Your Phone Number">
                            </div>
                            <div class="col">
                                <label for="inlineFormInputName" class="text-muted">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Email Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inlineFormInputName " class="text-muted">Address</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-row pt-2">
                            <div class="col-md-6">
                                <label for="inlineFormInputName" class="text-muted">Sub Address</label>
                                <input type="text" class="form-control" placeholder="Enter Your Sub Address ">
                            </div>
                            <div class="col-md-6">
                                <label for="inlineFormInputName" class="text-muted">House No. / flat No.</label>
                                <input type="text" class="form-control" placeholder="Enter Your House No. / flat No.">
                            </div>
                        </div>
                        <div class="form-row pt-2">
                            <div class="col-md-6">
                                <label for="inlineFormInputName" class="text-muted">Street Name</label>
                                <input type="text" class="form-control" placeholder="Enter Street Name">
                            </div>
                            <div class="col-md-6">
                                <label for="inlineFormInputName" class="text-muted">Landmark</label>
                                <input type="text" class="form-control" placeholder="Enter Landmark">
                            </div>
                            <div class="col-md-6">
                                <label for="inlineFormInputName" class="text-muted">Pin Number</label>
                                <input type="text" class="form-control" placeholder="Enter Pin Number">
                            </div>                                                                
                        </div>
                        <div class="d-flex">
                            <div class="custom-control custom-radio p-3">
                                <input type="radio" class="custom-control-input" id="defaultChecked2" name="defaultExample2" checked>
                                <label class="custom-control-label" for="defaultChecked2">Home</label>
                            </div>
                            <div class="custom-control custom-radio p-3">
                                <input type="radio" class="custom-control-input" id="defaultChecked2" name="defaultExample2" checked>
                                <label class="custom-control-label" for="defaultChecked2">Office</label>
                            </div>
                        </div>
                        <div class="d-flex pt-2 justify-content-space btn-toolbar">
                            <button class="btn btn-secondary btn-sm mr-2" type="button" onclick="switchVisible();">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Script --}}
@section('script')              
    <script>
        let div1=document.getElementById('Div1');
        let div2=document.getElementById('Div2');
        let h3 = document.getElementById('DelInf');
        let div3 = document.getElementById('card-summary');
        function switchVisible() {
            if (div1 !== undefined && div2 !== undefined) {
                div1.style.display = div2.style.display  === '' ? 'none' : div2.style.display === 'none' ? 'none' : 'flex';
                div2.style.display = div1.style.display === '' ? 'none' : div1.style.display === 'none' ? 'flex' : 'none';
                h3.style.display = 'none';
            }
        }

    </script>
@endsection