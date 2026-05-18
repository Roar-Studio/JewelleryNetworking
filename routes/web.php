<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\{AdminAuthController, CustomerController, MembershipController, EventController, TransactionController, CouponController, GalleryController};
use App\Http\Controllers\Web\Frontend\{CustomerAuthController};
use App\Http\Controllers\Api\Frontend\{CheckoutController};
use Mews\Captcha\CaptchaController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembershipAcknowledgementMail;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('captcha/{config?}', [CaptchaController::class, 'getCaptcha'])->name('captcha');

Route::get('/', [CustomerAuthController::class, 'home'])->name('home');
Route::get('/about-us', [CustomerAuthController::class, 'aboutUs'])->name('aboutUs');
Route::get('/membership', [CustomerAuthController::class, 'membership'])->name('membership');
Route::get('/events1', [CustomerAuthController::class, 'events1'])->name('events1');
Route::get('/events', [CustomerAuthController::class, 'events'])->name('events');
Route::get('/event/{id}', [CustomerAuthController::class, 'eventDetails'])->name('eventDetails');
Route::get('/term-and-conditions', [CustomerAuthController::class, 'termAndConditions'])->name('termAndConditions');
Route::get('/gallery', [CustomerAuthController::class, 'gallery'])->name('gallery');
Route::get('/gallery/{id}', [CustomerAuthController::class, 'galleryDetail'])->name('galleryDetail');
Route::get('/contact-us', [CustomerAuthController::class, 'contactUs'])->name('contactUs');
//Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::get('/dashboard', [CustomerAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [CustomerAuthController::class, 'profile'])->name('profile');
    Route::get('/membership-directory', [CustomerAuthController::class, 'membershipDirectory'])->name('membershipDirectory');
    Route::get('/member/{member_id}', [CustomerAuthController::class, 'memberDetails'])->name('memberDetails');
    Route::get('/order/confirmation/{order_id}', [CustomerAuthController::class, 'orderConfirmation'])->name('order.confirmation');
    Route::get('/paypal/checkout/cancel/{order_id}', [CheckoutController::class, 'paypalCancel'])->name('paypal.cancel');
    Route::get('/razorpay/checkout/cancel/{order_id}', [CheckoutController::class, 'paypalCancel'])->name('razorpay.cancel');
    Route::get('/invoice/{order_id}', [CustomerAuthController::class, 'generateInvoice'])->name('invoice');
//});

Route::get('/login', [CustomerAuthController::class, 'index'])->name('login');
Route::get('/order-summary', [CustomerAuthController::class, 'orderSummary'])->name('orderSummary');
Route::get('/forgot-password', [CustomerAuthController::class, 'forgotPassword'])->name('forgotPassword');


Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');

Route::prefix('admin/manage')->name('manage.')->group(function () {
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/import', [CustomerController::class, 'import'])->name('import');
    });
    
    Route::prefix('membership')->name('membership.')->group(function () {
        Route::get('/', [MembershipController::class, 'index'])->name('index');
    });

    Route::prefix('event')->name('event.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
    });
    Route::prefix('transaction')->name('transaction.')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
    });
    Route::prefix('coupon')->name('coupon.')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
    });

    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
    });

    // Route::prefix('event-attendees')->name('attendees.')->group(function () {
    //     Route::get('/', [EventAttendess::class, 'index'])->name('index');
    // });

});

Route::get('/test-membership-mail', function () {

    // Dummy data
    $name = "Test User";
    $expiryDate = Carbon::now()->addYear()->format('Y-m-d');
    $membershipType = "Premium";
    $benefits = "<ul>
                    <li>Unlimited Leads</li>
                    <li>Priority Support</li>
                    <li>Premium Badge</li>
                 </ul>";
    $orderId = "ORD-2KUWAGC1E0";

    // Send test mail
    Mail::to('shashikala.kushwaha@vervali.com')->send(
        new MembershipAcknowledgementMail(
            $name,
            $expiryDate,
            $membershipType,
            $benefits,
            $orderId
        )
    );

    return "Membership mail sent successfully (Test)!";
});


Route::get('/server-limits', function () {
    return [
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'memory_limit' => ini_get('memory_limit'),
        'max_execution_time' => ini_get('max_execution_time'),
    ];
});