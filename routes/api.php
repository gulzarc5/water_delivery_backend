<?php

use App\Http\Controllers\Api\AppSettingController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Order\Bulk\BulkOrderController;
use App\Http\Controllers\Api\Order\OrderController;
use App\Http\Controllers\Api\Order\Subscription\SubscriptionOrderController;
use App\Http\Controllers\Api\Plan\SubscriptionController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\User\OtpController;
use App\Http\Controllers\Api\User\RegistrationController;
use App\Http\Controllers\Api\User\UserAddressController;
use App\Http\Controllers\Api\User\UserCoinController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\UserOrderController;
use App\Http\Controllers\Api\User\UserSubscriptionController;
use Illuminate\Support\Facades\Route;



Route::group([ 'namespace' => 'Api'], function () {
    Route::get('app/load/api',[AppSettingController::class,'appLoad']);
    Route::get('fcm/token/update/{user_id}/{token}',[AppSettingController::class,'fcmTokenUpdate']);
    Route::get('location/list',[AppSettingController::class,'locationList']);

    Route::group(['prefix'=>'bulk/order'],function(){
        Route::post('place',[BulkOrderController::class,'BulkOrderPlace']);
        Route::get('brand/size/fetch',[BulkOrderController::class,'settingDataFetch']);
    });


    Route::group(['prefix' =>'user'], function () {   
        Route::group(['prefix'=>'marketing'],function () {
            Route::get("check/uniqueness/{mobile}",[OtpController::class,"userCheck"]);    
            Route::post("register",[RegistrationController::class,"marketingUserRegister"]);    
        });
        Route::group(['prefix' => 'otp'],function(){
            Route::post('send', [OtpController::class,'sendOtp']);
            Route::post('verify', [OtpController::class,'otpVerify']);
        });

        Route::group(['prefix' => 'registration'],function(){
            Route::post('detail/update',[RegistrationController::class,'registrationDetailUpdate']);
            
        });

        Route::group(['middleware' => 'auth:api'], function () {

            Route::group(['prefix' =>'coin'],function(){
                Route::get('/',[UserCoinController::class,'index']);
                Route::get('/history',[UserCoinController::class,'history']);
            });
    

            Route::group(['prefix' => 'profile'],function(){
                Route::get('fetch',[UserController::class,'userProfileFetch']);
                Route::post('update',[UserController::class,'userProfileUpdate']);
            });

            Route::group(['prefix' => 'address'],function(){
                Route::get('list',[UserAddressController::class,'userAddressList']);
                Route::get('fetch/{address_id}',[UserAddressController::class,'userAddress']);
                Route::post('add',[UserAddressController::class,'userAddressSubmit']);
                Route::put('update/{address_id}',[UserAddressController::class,'userAddressUpdate']);
                Route::get('delete/{address_id}',[UserAddressController::class,'userAddressDelete']);
            });

            Route::group(['prefix' => 'subscription'],function(){
                Route::get('/list',[UserSubscriptionController::class,'list']);
                Route::get('/detail/{subscription_id}',[UserSubscriptionController::class,'detail']);
                Route::get('cancel/{id}',[UserSubscriptionController::class,'cancel']);
            });

            Route::group(['prefix' => 'order'],function(){
                Route::get('/list',[UserOrderController::class,'list']);
                Route::get('/previous',[UserOrderController::class,'previousOrder']);
                Route::get('/detail/{order_id}',[UserOrderController::class,'detail']);
                Route::get('cancel/{order_id}',[UserOrderController::class,'orderCancel']);
            });
        });
    });

    Route::group(['prefix' => 'product'],function(){
        Route::get('list',[ProductController::class,'list']);
        Route::get('details/{product_id}',[ProductController::class,'details']);
    });
    Route::group(['prefix' => 'subscription'],function(){
        Route::get('master',[SubscriptionController::class,'masterList']);
        Route::get('plan/list',[SubscriptionController::class,'planList']);
        Route::get('plan/details/{plan_details_id}',[SubscriptionController::class,'planDetails']);
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::group(['prefix' => 'order'],function(){
            Route::post('place',[OrderController::class,'orderPlace']);
            Route::post('payment/verify',[OrderController::class,'paymentVerify']);
            Route::post('payment/pay/now',[OrderController::class,'paymentPayNow']);
            Route::post('price/calculate',[OrderController::class,'priceFatch']);
            Route::get('coupon/apply/{couponCode}',[OrderController::class,'couponApply']);
            Route::get('coupon/fetch',[OrderController::class,'couponFetch']);

            Route::group(['prefix' => 'subscription'],function(){
                Route::post('place',[SubscriptionOrderController::class,'orderPlace']);
                Route::post('payment/verify',[SubscriptionOrderController::class,'paymentVerify']);
                Route::post('price/calculate',[SubscriptionOrderController::class,'priceFatch']);
            });

            Route::group(['prefix' => 'refil'],function(){
                Route::post('place',[OrderController::class,'refilSubscriptionOrder']);
            });

        });

        Route::group(['prefix' => 'cart'],function(){
            Route::post('add',[CartController::class,'add']);
            Route::post('update',[CartController::class,'cartUpdate']);
            Route::get('list',[CartController::class,'list']);
            Route::get('delete/{id}',[CartController::class,'cartDelete']);
            Route::get('re/order/{order_id}',[CartController::class,'cartReOrder']);
        });
    });
});
