<?php

namespace App\Http\Controllers;

use App\Services\PaystackService;
use Illuminate\Http\Request;

class BuildingVerificationController extends Controller
{
    public function index()
    {
        return view('pages.property-verification.index');
    }

    public function success()
    {
        return view('pages.property-verification.success');
    }

    public function details()
    {
        return view('pages.property-verification.details');
    }

    public function initiateVerification(Request $request)
    {
        $paymentService = new PaystackService();
        $response = $paymentService->createPaymentIntent($request, 2000, route('verification.initiate'));
        $response = json_decode($response);
      

        if (isset($response->status)) {
            if ($response->status) {
                return redirect()->to($response->paymentLink);
            }
            session()->flash('error', 'Unable to process your payment. Please try again.');
            return redirect()->route('payment.index');
        }
    }

}
