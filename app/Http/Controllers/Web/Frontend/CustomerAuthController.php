<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Event, TransactionDetail};
use Barryvdh\DomPDF\Facade\Pdf as PDF;


class CustomerAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories = Category::all();
        return view('frontend.login', compact('categories'));
    }
    public function forgotPassword(){
        return view('frontend.forgot-password');
    }
    public function home(){
        return view('frontend.home');
    }
    public function aboutUs(){
        return view('frontend.about');
    }
    public function membership(){
        return view('frontend.membership');
    }
    public function events(){
        return view('frontend.events');
    }
    public function eventss(){
        return view('frontend.eventss');
    }
    public function eventDetails($event_id){
        if (!$event_id) {
            return redirect()->route('events')->with('error', 'Event ID is required.');
        }
        else {
            if(Event::where('id', $event_id)->exists()){
                $event = Event::find($event_id);
                if (!$event) {
                    return redirect()->route('events')->with('error', 'Event not found.');
                }
            } else {
                return redirect()->route('events')->with('error', 'Invalid Event ID.');
            }
            return view('frontend.eventDetails', compact('event_id'));
        }
    }
    public function dashboard(){
        return view('frontend.home');
    }
    public function termAndConditions(){
        return view('frontend.terms');
    }
    public function gallery(){
        return view('frontend.gallery');
    }
    public function galleryDetail($id)
    {
        return view('frontend.gallery-detail', compact('id'));
    }
    public function contactUs(){
        return view('frontend.contact');
    }
    public function orderSummary(){
        return view('frontend.orderSummary');
    }
    public function deitiesDesignAwards(){
    return view('deitiesdesignawards.coming-soon');
    }

    public function generateInvoice($order_id)
    {
        $txn = TransactionDetail::with('transactionable', 'customer')->where('status', 'completed')->where('order_id', $order_id)->firstOrFail();
        // dd($txn);
        if ($txn->transactionable instanceof \App\Models\Event) {
            $name = $txn->transactionable->name;
        } elseif ($txn->transactionable instanceof \App\Models\MembershipPlan) {
            $name = $txn->transactionable->name. ' Membership';
        }
        
        if($txn){
            $invoiceData = [
                'invoice_no' => $txn->order_id,
                'order_date' => $txn->transaction_date,
                'payment_method' => $txn->payment_method,
                'currency_type' => $txn->currency_type,
                'bill_to' => [
                    //'name' => $txn->payer_first_name . ' ' . $txn->payer_last_name,
                    'name' => $txn->customer?->first_name
                        ? trim($txn->customer?->first_name . ' ' . $txn->customer?->last_name)
                        : trim($txn->payer_first_name . ' ' . $txn->payer_last_name),
                    'company' => $txn->customer?->company_name ? $txn->customer?->company_name : $txn->payer_company_name,
                    'address' => $txn->customer?->company_address ? $txn->customer->company_address : $txn->payer_company_address,
                    'email' => $txn->payer_email,
                    'phone' => ($txn->payer_mobile_no_cc ?? '+91').$txn->payer_mobile_no,
                    'trn_no' => $txn->customer?->trn_no ? $txn->customer->trn_no : $txn->payer_taxid,
                ],
                'from' => [
                    'company' => 'Jewellery Networking',
                    'address' => '1st Floor, Flat no. 102 Wing D, Rustamjee Elita, S No 1, D N Nagar, S No. 106 Near D N Nagar Police Station, Andheri West, Mumbai City, Maharashtra, 400053',
                    'tax_id' => '27AKUPM5565G1ZI',
                ],
                'items' => [
                    [
                        'product' => $name,
                        'quantity' => 1,
                        'unit_price' => $txn->price,
                        'total_price' => $txn->total_amount,
                    ],
                ],
                'subtotal' => $txn->price,
                'tax' => $txn->gst,
                'discount' => $txn->discount,
                'total' => $txn->total_amount,
            ];
            // dd($invoiceData);
            // return view('frontend.invoice', $invoiceData);
            
            $pdf = PDF::loadView('frontend.invoice', $invoiceData)
                    ->setPaper('A4', 'portrait');
    
            return $pdf->stream('invoice_' . $invoiceData['invoice_no'] . '.pdf');
        }else{
            abort(404);
        }
    }

    public function orderConfirmation($order_id){
        $txn = TransactionDetail::with('transactionable')->where('order_id', $order_id)->firstOrFail();
        // dd($txn);
        if($txn->transactionable instanceof \App\Models\MembershipPlan){
            $txn->product_name = $txn->transactionable->name . ' Membership';
            $txn->product_image = asset('/new_ui/assets/images/jn-logo.webp');
        }
        elseif($txn->transactionable instanceof \App\Models\Event){
            $txn->product_name = $txn->transactionable->name;
            $txn->product_image = $txn->transactionable->banner ? asset('storage/'.$txn->transactionable->banner) : asset('/new_ui/assets/images/jn-logo.webp');
        }
        return view('frontend.orderConfirmation', compact('txn'));
    }
    public function profile(){
        $categories = Category::all();

        return view('frontend.profile', compact('categories'));
    }
    public function membershipDirectory(){
        $categories = Category::all();
        return view('frontend.membershipDirectory', compact('categories'));
    }
    public function memberDetails($id){
        return view('frontend.memberDetails', compact('id'));
    }
}