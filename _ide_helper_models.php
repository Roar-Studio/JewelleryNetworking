<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $coupon_code
 * @property string|null $coupon_name
 * @property string|null $description
 * @property string|null $marketing_text
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $discount_type
 * @property string $discount_flat_inr
 * @property string $discount_flat_usd
 * @property string $discount_percent_inr
 * @property string $discount_percent_usd
 * @property string|null $maximum_discount_inr
 * @property string|null $maximum_discount_usd
 * @property string $minimum_purchase_inr
 * @property string $minimum_purchase_usd
 * @property string $coupon_type
 * @property string|null $membership_type
 * @property string|null $event_type
 * @property string|null $user_specific
 * @property string $max_use_per_user
 * @property int $is_active
 * @property int $is_deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCouponType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountFlatInr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountFlatUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountPercentInr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountPercentUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMarketingText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaxUsePerUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaximumDiscountInr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaximumDiscountUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMembershipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMinimumPurchaseInr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMinimumPurchaseUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUserSpecific($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $password
 * @property string $mobile_no
 * @property string $mobile_no_cc
 * @property string|null $mobile_no_ic
 * @property int|null $category_id
 * @property string $plan_type
 * @property string|null $plan_started_at
 * @property string|null $plan_expired_at
 * @property string|null $username
 * @property string|null $specialization
 * @property string|null $profile_photo
 * @property string|null $company_logo
 * @property string|null $company_video
 * @property string|null $trn_no
 * @property string|null $company_name
 * @property string|null $company_address
 * @property string|null $google_map_link
 * @property string|null $business_description
 * @property string|null $youtube_link
 * @property string|null $linkedin_link
 * @property string|null $website
 * @property string|null $specialisation
 * @property string|null $facebook_link
 * @property string|null $x_link
 * @property string|null $instagram_link
 * @property string|null $is_deleted
 * @property string $is_active
 * @property int $otp_attempts
 * @property string|null $first_failed_attempt_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $mobile_device_id
 * @property string|null $desktop_device_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MediaImage> $media_images
 * @property-read int|null $media_images_count
 * @property-read \App\Models\MembershipPlan|null $membership_plan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransactionDetail> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBusinessDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCompanyLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCompanyVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDesktopDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFacebookLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFirstFailedAttemptAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereGoogleMapLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereInstagramLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereLinkedinLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobileDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobileNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobileNoCc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereMobileNoIc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereOtpAttempts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePlanExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePlanStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePlanType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereProfilePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereSpecialisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereSpecialization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereTrnNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereXLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereYoutubeLink($value)
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $entry_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string $city
 * @property string $country
 * @property string|null $organisation
 * @property string $participant_type
 * @property string $piece_name
 * @property string $award_category
 * @property string $materials
 * @property string $year
 * @property string $deity
 * @property string $statement
 * @property array|null $images
 * @property bool $declaration
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DdaTransaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|DDA newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DDA newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DDA query()
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereAwardCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereDeclaration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereDeity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereMaterials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereOrganisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereParticipantType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA wherePieceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DDA whereYear($value)
 */
	class DDA extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $dda_id
 * @property string $gateway
 * @property string|null $gateway_order_id
 * @property string|null $gateway_payment_id
 * @property string|null $gateway_signature
 * @property string $transaction_no
 * @property string $amount
 * @property string $currency
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DDA $submission
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereDdaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereGatewayOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereGatewayPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereGatewaySignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereTransactionNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DdaTransaction whereUpdatedAt($value)
 */
	class DdaTransaction extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string|null $country
 * @property string|null $company_name
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereUpdatedAt($value)
 */
	class Enquiry extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $event_type
 * @property string|null $event_mode
 * @property string|null $description
 * @property string|null $currency_type
 * @property string|null $amount_in_inr
 * @property string|null $amount_in_usd
 * @property string|null $event_start_datetime
 * @property string|null $event_end_datetime
 * @property string|null $venue_address
 * @property string|null $google_maps_link
 * @property string|null $google_meet_link
 * @property int|null $total_seats
 * @property string|null $banner
 * @property string|null $display_start_date
 * @property string|null $display_end_date
 * @property int $is_active
 * @property int $is_deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sponsor> $sponsors
 * @property-read int|null $sponsors_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransactionDetail> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAmountInInr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereAmountInUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDisplayEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereDisplayStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventEndDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventStartDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereGoogleMapsLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereGoogleMeetLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTotalSeats($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereVenueAddress($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $customer_id
 * @property int $member_id
 * @property int $rating
 * @property string|null $feedback
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\Customer $member
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUpdatedAt($value)
 */
	class Feedback extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder|Functions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Functions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Functions query()
 */
	class Functions extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $gallery_type
 * @property int $gallery_category_id
 * @property string $url
 * @property int $is_active
 * @property int $is_deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GalleryCategory $category
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereGalleryCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereGalleryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereUrl($value)
 */
	class Gallery extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $gallery_type
 * @property string $name
 * @property string|null $gallery_date
 * @property string|null $location
 * @property int $is_active
 * @property int $is_deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Gallery> $media_files
 * @property-read int|null $media_files_count
 * @property-read \App\Models\Gallery|null $thumbnail
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Videos> $videos
 * @property-read int|null $videos_count
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereGalleryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereGalleryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryCategory whereUpdatedAt($value)
 */
	class GalleryCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $customer_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaImage whereUpdatedAt($value)
 */
	class MediaImage extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $currency_type
 * @property string $amount_in_inr
 * @property string $amount_in_usd
 * @property int $duration
 * @property string|null $description
 * @property string|null $benefits
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TransactionDetail> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereAmountInInr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereAmountInUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MembershipPlan whereUpdatedAt($value)
 */
	class MembershipPlan extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $otp
 * @property string $status
 * @property string $token
 * @property int|null $customer_id
 * @property string|null $verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster query()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpMaster whereVerifiedAt($value)
 */
	class OtpMaster extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $customer_id
 * @property string $requested_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest whereRequestedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtpRequest whereUpdatedAt($value)
 */
	class OtpRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $event_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor whereUpdatedAt($value)
 */
	class Sponsor extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $transaction_id
 * @property string|null $order_id
 * @property int|null $customer_id
 * @property string $transactionable_type
 * @property int $transactionable_id
 * @property string $currency_type
 * @property string $total_amount
 * @property string $status
 * @property string|null $payment_method
 * @property string|null $transaction_reference
 * @property string|null $transaction_date
 * @property string|null $start_date
 * @property string|null $expire_date
 * @property string|null $note
 * @property string|null $remark
 * @property string $updated_by_admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payer_first_name
 * @property string|null $payer_last_name
 * @property string|null $payer_mobile_no
 * @property string|null $payer_mobile_no_cc
 * @property string|null $payer_mobile_no_ic
 * @property string|null $payer_email
 * @property string|null $payer_taxid
 * @property string|null $payer_company_name
 * @property string|null $payer_company_address
 * @property string $price
 * @property string $gst
 * @property string $discount
 * @property string|null $coupon_id
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read \App\Models\Customer|null $customer
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $transactionable
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereCurrencyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereGst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerMobileNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerMobileNoCc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerMobileNoIc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePayerTaxid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereTransactionReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereTransactionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereTransactionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDetail whereUpdatedByAdmin($value)
 */
	class TransactionDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property string|null $session_id
 * @property string|null $device_id
 * @property string|null $user_agent
 * @property string|null $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserAgent($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $gallery_type
 * @property int $gallery_category_id
 * @property string $youtube_url
 * @property int $is_active
 * @property int $is_deleted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GalleryCategory $galleryCategory
 * @property-read mixed $embed_url
 * @property-read mixed $thumbnail_url
 * @method static \Illuminate\Database\Eloquent\Builder|Videos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Videos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Videos query()
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereGalleryCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereGalleryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Videos whereYoutubeUrl($value)
 */
	class Videos extends \Eloquent {}
}

