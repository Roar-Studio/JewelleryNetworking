<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\{AuthController, CustomerController as AdminCustomerController, MembershipController, EventController, CouponController, TransactionController, GalleryController};
use App\Http\Controllers\Api\Frontend\{MasterController, CustomerAuthController, CustomerController as FrontendCustomerController, CheckoutController};
use App\Http\Controllers\CronController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('encrypt.decrypt')->post('/check-valid-user', [MasterController::class, 'checkValidUser']);
Route::middleware('encrypt.decrypt')->post('/save-new-customer', [CustomerAuthController::class, 'saveNewCustomer'])->name('saveNewCustomer');
Route::middleware('encrypt.decrypt')->post('/resend-customer-otp', [CustomerAuthController::class, 'resendCustomerOtp'])->name('resendCustomerOtp');
Route::middleware('encrypt.decrypt')->post('/validate-registration-otp', [CustomerAuthController::class, 'validateRegistrationOtp'])->name('validateRegistrationOtp');
Route::middleware('encrypt.decrypt')->post('/validate-forgot-otp', [CustomerAuthController::class, 'validateForgotOtp'])->name('validateForgotOtp');
Route::middleware('encrypt.decrypt')->post('/login', [CustomerAuthController::class, 'customerLogin']);
Route::middleware('encrypt.decrypt')->get('/get-membership', [CustomerAuthController::class, 'getMembership']);
Route::middleware('encrypt.decrypt')->post('/get-events', [CustomerAuthController::class, 'getEvents']);
Route::middleware('encrypt.decrypt')->get('/get-event/{id?}', [CustomerAuthController::class, 'getEventDetail']);
Route::middleware('encrypt.decrypt')->post('/get-forgot-otp', [CustomerAuthController::class, 'getForgotOtp']);
Route::middleware('encrypt.decrypt')->post('/save-new-password', [CustomerAuthController::class, 'saveNewPassword']);
Route::middleware('encrypt.decrypt')->post('/get-checkout-data', [CheckoutController::class, 'getCheckoutData']);
Route::middleware('encrypt.decrypt')->post('/get-coupons', [CheckoutController::class, 'getCoupons']);
Route::middleware('encrypt.decrypt')->post('/get-coupon-by-id', [CheckoutController::class, 'getCouponById']);
Route::middleware('encrypt.decrypt')->post('/get-user-by-membership-id', [CustomerAuthController::class, 'getUserByMembershipId']);
Route::middleware('encrypt.decrypt')->post('/add-enquiry', [CustomerAuthController::class, 'addEnquiry'])->name('addEnquiry');
Route::middleware('encrypt.decrypt')->post('/send-community', [CustomerAuthController::class, 'sendToCommunity'])->name('sendToCommunity');
Route::middleware('encrypt.decrypt')->get('/get-all-folders', [CustomerAuthController::class, 'getAllFolders']);
Route::middleware('encrypt.decrypt')->get('/get-gallery-images/{category_id}', [CustomerAuthController::class, 'getGalleryImages']);
Route::middleware('encrypt.decrypt')->get('/get-video-gallery/{category_id}', [CustomerAuthController::class, 'getVideoGallery']);
Route::middleware('encrypt.decrypt')->get('/send-dummy-mail', [CustomerAuthController::class, 'sendDummyMail'])->name('sendDummyMail');

Route::middleware(['encrypt.decrypt'])->post('/place-order', [CheckoutController::class, 'placeOrder']);
Route::middleware(['encrypt.decrypt'])->post('/razorpay/callback', [CheckoutController::class, 'razorpayCallback']);
Route::middleware(['encrypt.decrypt'])->get('/paypal/checkout/{order_id}', [CheckoutController::class, 'paypalCheckout']);
Route::middleware(['encrypt.decrypt'])->get('/paypal/checkout/success/{order_id}', [CheckoutController::class, 'paypalSuccess'])->name('paypal.success');

Route::get('/config/razorpay-key', function () {
    return response()->json(['key' => env('RAZORPAY_KEY')]);
});

Route::middleware('encrypt.decrypt')->post('/admin/register', [AuthController::class, 'register']);
Route::middleware('encrypt.decrypt')->post('/admin/login', [AuthController::class, 'login']);
Route::middleware('encrypt.decrypt')->post('/admin/import', [AuthController::class, 'import']);

Route::middleware(['auth:sanctum', 'check.admin.session', 'encrypt.decrypt'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::group(['prefix' => 'customer', 'name' => 'customer.'], function () {
            Route::post('/addnew', [AdminCustomerController::class, 'store']);  
            Route::get('/list', [AdminCustomerController::class, 'index']);
            Route::post('/view/{id}', [AdminCustomerController::class, 'show']);
            Route::post('/activity/{cust_id}', [AdminCustomerController::class, 'activityHistory']);
            Route::post('/update', [AdminCustomerController::class, 'update']);
            Route::post('/check-valid-username', [AdminCustomerController::class, 'checkValidUserName']);
            Route::post('/membership/update', [AdminCustomerController::class, 'membershipUpdate']);
            Route::post('/resumeupdate', [AdminCustomerController::class, 'resumeUpdate']);
            Route::get('/get-all-customers', [AdminCustomerController::class, 'getAllCustomers']);
            Route::get('/get-all-categories', [AdminCustomerController::class, 'getAllCategories']);
            Route::post('/remove/{id}', [AdminCustomerController::class, 'removeCustomer']);
            Route::post('/media/remove/{id}', [AdminCustomerController::class, 'removeMediaImage']);
            Route::post('/removeUploaded', [CustomerAuthController::class, 'removeUploaded']);

        });

        Route::group(['prefix' => 'membership', 'name' => 'membership.'], function () {
            Route::post('/addnew', [MembershipController::class, 'store']); 
            Route::get('/list', [MembershipController::class, 'index']);
            Route::post('/view/{id}', [MembershipController::class, 'show']);
            Route::post('/update', [MembershipController::class, 'update']);
        });

        Route::group(['prefix' => 'event', 'name' => 'event.'], function () {
            Route::post('/addnew', [EventController::class, 'store']); 
            Route::get('/list', [EventController::class, 'index']);
            Route::get('/get-all-events', [EventController::class, 'getAllEvents']);
            Route::post('/view/{id}', [EventController::class, 'show']);
            Route::post('/register-list/{id}', [EventController::class, 'registerList']);
            Route::post('/update', [EventController::class, 'update']);
            Route::post('/remove/{id}', [EventController::class, 'removeEvent']);
            Route::post('/sponsor/remove/{id}', [EventController::class, 'removeSponsor']);
        });

        Route::group(['prefix' => 'coupon', 'name' => 'coupon.'], function () {
            Route::post('/addnew', [CouponController::class, 'store']); 
            Route::get('/list', [CouponController::class, 'index']);
            Route::post('/view/{id}', [CouponController::class, 'show']);
            Route::post('/update', [CouponController::class, 'update']);
            Route::post('/remove/{id}', [CouponController::class, 'removeCoupon']);
            Route::post('/check-valid-coupon-code', [CouponController::class, 'checkValidCouponCode']);
        });

        Route::group(['prefix' => 'gallery', 'name' => 'gallery.'], function () {
            Route::post('/addnew', [GalleryController::class, 'store']); 
            Route::post('/file-upload', [GalleryController::class, 'fileUpload']);
            Route::get('/list', [GalleryController::class, 'index']);
            Route::post('/view/{id}', [GalleryController::class, 'show']);
            Route::post('/update', [GalleryController::class, 'update']);
            Route::post('/remove/{id}', [GalleryController::class, 'removeGallery']);
            Route::post('/removefile/{file_id}', [GalleryController::class, 'removeGalleryFile']);
            Route::post('/check-valid-gallery-code', [GalleryController::class, 'checkValidGalleryCode']);
            Route::post('/add-videos', [GalleryController::class, 'addVideos']);
            Route::post('/view/{id}', [GalleryController::class, 'view']);
            Route::post('/manage-videos', [GalleryController::class, 'manageVideos']);
            Route::post('/remove-video/{id}', [GalleryController::class, 'removeVideo']);
        });

        Route::group(['prefix' => 'transaction', 'name' => 'transaction.'], function () {
            Route::get('/list', [TransactionController::class, 'index']);
            Route::post('/view/{id}', [TransactionController::class, 'show']);
        });
        
    });
});

// Route::middleware(['check.session', 'encrypt.decrypt'])->group(function () {
//     Route::name('customer.')->group(function () {
//         Route::get('/user', [CustomerAuthController::class, 'user']);
//     });
// });

Route::middleware(['auth:customer-api', 'check.customer.session', 'encrypt.decrypt'])->group(function () {
    Route::name('customer.')->group(function () {
        Route::get('/user', [CustomerAuthController::class, 'user']);
        Route::post('/getMembersData', [CustomerAuthController::class, 'getMembers']);
        Route::get('/getMember/{id}', [CustomerAuthController::class, 'getMemberById']);
        Route::get('/get-basic-details', [CustomerAuthController::class, 'getBasicDetails']);
        Route::get('/get-company-details', [CustomerAuthController::class, 'getCompanyDetails']);
        Route::get('/get-subscription-details', [CustomerAuthController::class, 'getsubscriptionDetails']);
        Route ::get('/get-transaction-details', [CustomerAuthController::class, 'getTransactionDetails']);
        Route::post('/update-basic-details', [CustomerAuthController::class, 'updateBasicDetails']);
        Route::post('/update-company-details', [CustomerAuthController::class, 'updateCompanyDetails']);
        Route::post('/check-valid-username', [CustomerAuthController::class, 'checkValidUserName']);
        Route::post('/update-password', [CustomerAuthController::class, 'updatePassword']);
        Route::post('/update-profile-image', [CustomerAuthController::class, 'updateProfileImage']);
        Route::post('/media/remove/{id}', [CustomerAuthController::class, 'removeMediaImage']);
        Route::post('/removeUploaded', [CustomerAuthController::class, 'removeUploaded']);
        Route::post('/submit-comment', [CustomerAuthController::class, 'submitComment'])->name('submitComment');
        Route::post('/submit-feedback', [CustomerAuthController::class, 'submitFeedback'])->name('submitFeedback');

        Route::post('/logout', [CustomerAuthController::class, 'logout']);
    });
});

Route::get('/send-expiry-notifications', [CronController::class, 'sendExpiryNotifications']);
