<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\{AdminAuthController, CustomerController, MembershipController, EventController, TransactionController, CouponController, GalleryController, DdaController as AdminDdaController};
use App\Http\Controllers\Web\Frontend\{CustomerAuthController};
use App\Http\Controllers\Api\Frontend\{CheckoutController};
use App\Http\Controllers\DdaController;
use Mews\Captcha\CaptchaController;
use Illuminate\Support\Facades\Mail;
use App\Mail\MembershipAcknowledgementMail;
use Carbon\Carbon;
use App\Http\Controllers\DdaPaymentController;

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


// Route::get('/deitiesdesignawards', function () {
//     return view('deitiesdesignawards.coming-soon');
//     });
Route::prefix('deitiesdesignawards')->group(function () {

    Route::get('/', function () {
        return view('deitiesdesignawards.sections.index');
    });
    
    

    Route::get('/about', function () {
        return view('deitiesdesignawards.sections.about');
    });

    Route::get('/categories', function () {
        return view('deitiesdesignawards.sections.categories');
    });

    Route::get('/design-category', function () {
        return view('deitiesdesignawards.sections.design-category');
    });

    Route::get('/contact', function () {
        return view('deitiesdesignawards.sections.contact');
    });

    Route::get('/faq', function () {
        return view('deitiesdesignawards.sections.faq');
    });

    Route::get('/gallery', function () {
        return view('deitiesdesignawards.sections.gallery');
    });

    Route::get('/inspiration', function () {
        return view('deitiesdesignawards.sections.inspiration');
    });

    Route::get('/jury', function () {
        return view('deitiesdesignawards.sections.jury');
    });

    Route::get('/participate', function () {
        return view('deitiesdesignawards.sections.participate');
    });

    Route::get('/partners', function () {
        return view('deitiesdesignawards.sections.partners');
    });

    Route::get('/press-kit', function () {
        return view('deitiesdesignawards.sections.press-kit');
    });

    Route::get('/privacy', function () {
        return view('deitiesdesignawards.sections.privacy');
    });

    Route::get('/sponsor-us', function () {
        return view('deitiesdesignawards.sections.sponsor-us');
    });

    Route::get('/submit', function () {
        return view('deitiesdesignawards.sections.submit');
    });

    Route::post('/submit', [DdaController::class, 'store'])
    ->name('dda.submit');

    Route::post('/submit', [DdaController::class, 'store'])
    ->name('dda.submit');

    Route::get('/login', [CustomerAuthController::class, 'ddaLogin'])
    ->name('dda.login');


// Payment Routes
Route::get(
    '/order-summary/{id}',
    [DdaPaymentController::class, 'orderSummary']
)->name('dda.order.summary');

Route::post(
    '/create-order',
    [DdaPaymentController::class, 'createOrder']
)->name('dda.create.order');

Route::post(
    '/razorpay/callback',
    [DdaPaymentController::class, 'razorpayCallback']
)->name('dda.razorpay.callback');

Route::get(
    '/payment-success',
    [DdaPaymentController::class, 'paymentSuccess']
)->name('dda.payment.success');

Route::get(
    '/payment-failed',
    [DdaPaymentController::class, 'paymentFailed']
)->name('dda.payment.failed');

Route::post(
    '/paypal/create-order',
    [DdaPaymentController::class, 'createPaypalOrder']
)->name('dda.paypal.create');

Route::get(
    '/paypal/success',
    [DdaPaymentController::class, 'paypalSuccess']
)->name('dda.paypal.success');

Route::get(
    '/paypal/cancel',
    [DdaPaymentController::class, 'paypalCancel']
)->name('dda.paypal.cancel');

Route::get('/terms', function () {
    return view('deitiesdesignawards.sections.terms');
});

    Route::get('/terms', function () {
        return view('deitiesdesignawards.sections.terms');
    });

    Route::get('/media-preview', function () {
        return view('deitiesdesignawards.sections.media-preview');
    });

    

});

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

    Route::prefix('dda')->name('dda.')->group(function () {

    // Listing
    Route::get('/', [AdminDdaController::class, 'index'])
        ->name('index');

    // View Submission
    Route::get('/{id}', [AdminDdaController::class, 'show'])
        ->name('show');

    // Edit Page
    Route::get('/{id}/edit', [AdminDdaController::class, 'edit'])
        ->name('edit');

    // Update Submission
    Route::put('/{id}', [AdminDdaController::class, 'update'])
        ->name('update');

    // Update Review Status
    Route::post('/{id}/status', [AdminDdaController::class, 'updateStatus'])
        ->name('status.update');
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


