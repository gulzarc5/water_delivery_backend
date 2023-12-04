<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliverySheet\DeliverySheetController;
use App\Http\Controllers\Admin\Employee\EmployeeController;
use App\Http\Controllers\Admin\Invoice\OrderInvoiceController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Membership\MembershipOrderController;
use App\Http\Controllers\Admin\Order\BulkOrderController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductSizeController;
use App\Http\Controllers\Admin\Refund\AdminRefundController;
use App\Http\Controllers\Admin\Setting\BrandController;
use App\Http\Controllers\Admin\Setting\DeliverySlotController;
use App\Http\Controllers\Admin\Setting\InvoiceController;
use App\Http\Controllers\Admin\Setting\MainAreaController;
use App\Http\Controllers\Admin\Setting\SizeController;
use App\Http\Controllers\Admin\Setting\SliderController;
use App\Http\Controllers\Admin\Setting\SubAreaController;
use App\Http\Controllers\Admin\Setting\SubscriptionController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\UserSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin'],function(){
    Route::view('/admin/login','admin.index')->name('admin.login_form');    
    Route::post('/login', [LoginController::class,'adminLogin']);
   

    Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function(){
        Route::get('/dashboard', [DashboardController::class,'dashboardView'])->name('admin.dashboard'); 
        Route::post('logout', [LoginController::class,'logout'])->name('admin.logout');
        Route::get('/change/password/form', [DashboardController::class,'changePasswordForm'])->name('admin.change_password_form');
        Route::post('/change/password', [DashboardController::class,'changePassword'])->name('admin.change_password');

        Route::group(['prefix'=>'coupon'],function(){
            Route::get('list',[CouponController::class,'couponList'])->name('admin.coupon_list');
            Route::get('add/form',[CouponController::class,'addCoupon'])->name('admin.coupon_add_form');
            Route::post('insert/form', [CouponController::class,'couponInsertForm'])->name('admin.coupon_insert_form');
            Route::get('edit/{id}', [CouponController::class,'couponEdit'])->name('admin.coupon_edit');
            Route::put('update/{id}', [CouponController::class,'couponUpdate'])->name('admin.coupon_update');
            Route::get('status/{coupon}', [CouponController::class,'couponStatus'])->name('admin.coupon_status');
            Route::get('view/{id}', [CouponController::class,'couponView'])->name('admin.coupon_view');
        });
 

        Route::group(['prefix' => 'setting'],function(){

            Route::group(['prefix' => 'brand'],function(){
                Route::get('/',[BrandController::class,'list'])->name('admin.setting.brand_list');
                Route::get('/form/{brand_id?}',[BrandController::class,'brandForm'])->name('admin.setting.brand_form');
                Route::post('/submit',[BrandController::class,'brandSubmit'])->name('admin.setting.brand_submit');
                Route::get('/status/{brand_id}',[BrandController::class,'brandStatus'])->name('admin.setting.brand_status');
            });

            Route::group(['prefix' => 'size'],function(){
                Route::get('/',[SizeController::class,'list'])->name('admin.setting.size_list');
                Route::get('/form/{size_id?}',[SizeController::class,'sizeForm'])->name('admin.setting.size_form');
                Route::post('/submit',[SizeController::class,'sizeSubmit'])->name('admin.setting.size_submit');
                Route::get('/status/{size_id}',[SizeController::class,'sizeStatus'])->name('admin.setting.size_status');
            });

            Route::group(['prefix' => 'slider'],function(){
                Route::get('/',[SliderController::class,'list'])->name('admin.setting.slider_list');
                Route::get('/form',[SliderController::class,'sliderForm'])->name('admin.setting.slider_form');
                Route::post('/save',[SliderController::class,'sliderSave'])->name('admin.setting.slider_save');
                Route::get('/status/{slider_id}',[SliderController::class,'sliderStatus'])->name('admin.setting.slider_status');
                Route::get('/delete/{slider_id}',[SliderController::class,'deleteSlider'])->name('admin.setting.slider_delete');
            });

            Route::group(['prefix' => 'plans'],function(){
                Route::group(['prefix' => 'master'],function(){
                    Route::get('/',[SubscriptionController::class,'list'])->name('admin.setting.plan_master_list');
                    Route::get('/form/{master_id?}',[SubscriptionController::class,'masterForm'])->name('admin.setting.plan_master_form');
                    Route::post('/submit',[SubscriptionController::class,'masterSubmit'])->name('admin.setting.plan_master_submit');
                    Route::get('/status/{master_id}',[SubscriptionController::class,'masterStatus'])->name('admin.setting.plan_master_status');
                });
                Route::group(['prefix' => 'details'],function(){
                    Route::get('/',[SubscriptionController::class,'planList'])->name('admin.setting.plan_details_list');
                    Route::get('/form/{plan_id?}',[SubscriptionController::class,'planForm'])->name('admin.setting.plan_details_form');
                    Route::post('/submit',[SubscriptionController::class,'planSubmit'])->name('admin.setting.plan_details_submit');
                    Route::get('/status/{plan_id}',[SubscriptionController::class,'planStatus'])->name('admin.setting.plan_details_status');
                });
            });

            Route::group(['prefix' => 'area'],function(){
                Route::group(['prefix' => 'main','as'=>'admin.setting.main_area.'],function(){
                    Route::get('/',[MainAreaController::class,'list'])->name('list');
                    Route::get('/form/{area_id?}',[MainAreaController::class,'addForm'])->name('form');
                    Route::post('/submit',[MainAreaController::class,'areaAdd'])->name('add');
                    Route::get('/status/{area_id}',[MainAreaController::class,'areaStatus'])->name('status');
                });
                Route::group(['prefix' => 'sub', 'as'=>'admin.setting.sub_area.'],function(){
                    Route::get('/',[SubAreaController::class,'List'])->name('list');
                    Route::get('/form/{area_id?}',[SubAreaController::class,'addForm'])->name('form');
                    Route::post('/submit',[SubAreaController::class,'areaAdd'])->name('add');
                    Route::get('/status/{area_id}',[SubAreaController::class,'areaStatus'])->name('status');
                    Route::get('/get/{main_location_id}',[SubAreaController::class,'getSubLocation'])->name('get');
                });
            });

            Route::group(['prefix' => 'delivery/slot'],function(){
                Route::get('/',[DeliverySlotController::class,'list'])->name('admin.setting.slot_list');
                Route::get('/form/{slot_id?}',[DeliverySlotController::class,'slotForm'])->name('admin.setting.slot_form');
                Route::post('/submit',[DeliverySlotController::class,'slotSubmit'])->name('admin.setting.slot_submit');
                Route::get('/status/{slot_id}',[DeliverySlotController::class,'slotStatus'])->name('admin.setting.slot_status');
            });

            Route::group(['prefix' => 'invoice'],function(){
                Route::get('/form', [InvoiceController::class,'invoiceForm'])->name('admin.invoice_form');
                Route::post('update/', [InvoiceController::class,'invoiceUpdate'])->name('admin.invoiceUpdate');
            });

        });

        Route::group(['prefix' => 'product'],function(){
            Route::get('/list',[ProductController::class,'list'])->name('admin.product.list');
            Route::get('/from/{product_id?}',[ProductController::class,'productFrom'])->name('admin.product.from');
            Route::post('/from/submit',[ProductController::class,'fromSubmit'])->name('admin.product.from_submit');
            Route::get('/status/{product_id}',[ProductController::class,'productStatus'])->name('admin.product.status');
            Route::get('/view/{product}',[ProductController::class,'productView'])->name('admin.product.view');

            Route::group(['prefix'=>'images'],function(){
                Route::get('/{product}',[ProductController::class,'imagesView'])->name('admin.product.images.view');
                Route::post('add',[ProductController::class,'imagesAdd'])->name('admin.product.images.add');
                Route::get('cover/{product}/{image}',[ProductController::class,'makeCover'])->name('admin.product.images.make_cover');
                Route::get('delete/{image}',[ProductController::class,'deleteImage'])->name('admin.product.images.delete');
            });

            Route::group(['prefix' => 'size'],function(){
                Route::get('/list',[ProductSizeController::class,'list'])->name('admin.size.list');
                Route::get('/from/{product_id}/{size_id?}',[ProductSizeController::class,'sizeFrom'])->name('admin.size.from');
                Route::post('/from/submit',[ProductSizeController::class,'fromSubmit'])->name('admin.size.from_submit');
                Route::get('/status/{size}',[ProductSizeController::class,'sizeStatus'])->name('admin.size.status');
            });
        });

        Route::group(['prefix' => 'user'],function(){
            Route::get('/list',[UserController::class,'list'])->name('admin.user.list');
            Route::get('/list/ajax',[UserController::class,'listAjax'])->name('admin.user.list_ajax');

            Route::get('unregistered/list',[UserController::class,'unregisteredList'])->name('admin.unregistered.user.list');
            Route::get('unregistered/list/ajax',[UserController::class,'unregisteredListAjax'])->name('admin.unregistered.user.list_ajax');
            Route::get('unregistered/list/export',[UserController::class,'unregisteredListExport'])->name('admin.unregistered.user.list_export');

            Route::get('/edit/form/{user_id}',[UserController::class,'editUserForm'])->name('admin.user.edit_user_form');
            Route::post('/update/user/',[UserController::class,'updateUser'])->name('admin.user.update_user');
            Route::get('user/status/{user_id}',[UserController::class,'userStatus'])->name('admin.user.status');
            Route::get('user/details/{user_id}',[UserController::class,'viewUserDetails'])->name('admin.user.details');

             Route::group(['prefix' => 'subscription'],function(){
                Route::get('paid/list',[UserSubscriptionController::class,'paidList'])->name('admin.user.subscription.paid_list');
                Route::get('paid/list/list',[UserSubscriptionController::class,'paidListAjax'])->name('admin.user.subscription.paid_list_ajax');
                Route::get('un/paid/list',[UserSubscriptionController::class,'unPaidList'])->name('admin.user.subscription.un_paid_list');
                Route::get('un/paid/list/list',[UserSubscriptionController::class,'unPaidListAjax'])->name('admin.user.subscription.un_paid_list_ajax');
                Route::get('details/{subscription_id}',[UserSubscriptionController::class,'subscriptionDetails'])->name('admin.user.subscription.details');
            });
        });
        Route::group(['prefix' => 'back/office/employee'],function(){
            Route::get('/list',[EmployeeController::class,'list'])->name('admin.employee.list');
            Route::get('/list/ajax',[EmployeeController::class,'listAjax'])->name('admin.employee.list_ajax');

            Route::get('/add/form',[EmployeeController::class,'addEmployeeForm'])->name('admin.employee.add_form');
            Route::post('/form/submit/',[EmployeeController::class,'formSubmit'])->name('admin.employee.form.submit');
            Route::get('status/{employee_id}',[EmployeeController::class,'employeeStatus'])->name('admin.emloyee.status');
        });

        Route::group(['prefix' => 'ajax'],function(){
            Route::get('get/size/by/brand/{brand_id}',[AjaxController::class,'getSizeByBrand']);
        });

        Route::group(['prefix' => 'order'],function(){
            Route::get('/',[OrderController::class,'newList'])->name('admin.order.new_list');
            Route::get('new/ajax',[OrderController::class,'newListAjax'])->name('admin.order.new_list_ajax');
            Route::get('view/{order_id}',[OrderController::class,'orderView'])->name('admin.order.view');

            Route::get('search/form',[OrderController::class,'orderSearchForm'])->name('admin.order.search_form');
            Route::get('search/form/submit',[OrderController::class,'orderSearchFormSubmit'])->name('admin.order.search_form_submit');

            Route::get('/status/update/{id}/{status}',[OrderController::class,'statusUpdate'])->name('admin.order.status_update');
            Route::get('/print/{id}',[OrderController::class,'orderReceiptPrint'])->name('admin.order.print');


            Route::group(['prefix'=>'bulk'],function(){
                Route::get('/list',[BulkOrderController::class,'list'])->name('admin.bulk.order_list');
                Route::get('/status/{id}/{status}',[BulkOrderController::class,'status'])->name('admin.bulk.order_status');
            });
        });

        Route::group(['prefix' =>"delivery/sheet"],function(){
            Route::get('/form',[DeliverySheetController::class,'form'])->name('admin.delivery.sheet.form');
            Route::get('/form/submit',[DeliverySheetController::class,'formSubmit'])->name('admin.delivery.sheet.form.submit');

            Route::get('export',[DeliverySheetController::class,'excelExport'])->name('admin.delivery.sheet.export');
            Route::get('print/all',[DeliverySheetController::class,'receiptPrintAll'])->name('admin.delivery.sheet.print.all');
        });

        Route::group(['prefix'=>'order/invoice'],function(){
            Route::get('/form',[OrderInvoiceController::class,'form'])->name('admin.order.invoice.form');
            Route::get('customer/proceed',[OrderInvoiceController::class,'invoiceCustomerProceed'])->name('admin.order.invoice.customer.proceed');
            Route::post('customer/place',[OrderInvoiceController::class,'invoiceOrderPlace'])->name('admin.order.invoice.customer.place');
            Route::get('coupon/apply/{user_id}/{coupon_id}',[OrderInvoiceController::class,'couponApply']);


            Route::group(['prefix'=>'customer'],function(){
                Route::get('get/{mobile}',[OrderInvoiceController::class,'getCustomer'])->name('admin.order.invoice.get_customer');
                Route::post('register',[OrderInvoiceController::class,'customerRegister'])->name('admin.order.invoice.customer.register');
                Route::post('address/add',[OrderInvoiceController::class,'AddressAdd'])->name('admin.order.invoice.customer.address.add');
            });

            Route::group(['prefix' => 'product'],function(){
                Route::get('/{brand_id}',[OrderInvoiceController::class,'getProduct']);
                Route::get('remove/{cart_id}',[OrderInvoiceController::class,'cardItemRemove'])->name('admin.order.invoice.cart.remove');
                Route::post('cart/add',[OrderInvoiceController::class,'cardItemAdd'])->name('admin.order.invoice.cart.add');
            });


            Route::group(['prefix' => 'membership'],function(){
                Route::get('/customer',[MembershipOrderController::class,'form'])->name('admin.order.invoice.membership.form');
                Route::get('/check/{user_id}',[MembershipOrderController::class,'checkMembership'])->name('admin.order.invoice.membership.check');
                Route::get('customer/proceed',[MembershipOrderController::class,'customerProceed'])->name('admin.order.invoice.membership.customer.proceed');
                Route::post('order/place',[MembershipOrderController::class,'OrderPlace'])->name('admin.order.invoice.membership.order.place');

                Route::group(['prefix' => 'product'],function(){
                    Route::get('/list/{plan_id}',[MembershipOrderController::class,'getProduct']);
                    Route::post('/price',[MembershipOrderController::class,'getPrice'])->name('admin.membership.order.price');
                });
            });
        });

        Route::group(['prefix'=>'refund'],function(){
            Route::get('/',[AdminRefundController::class,'list'])->name('admin.refund_list');
            Route::get('/status/update/{refund_id}/{status}',[AdminRefundController::class,'refundStatus'])->name('admin.refund.status');
        });
    });
});
