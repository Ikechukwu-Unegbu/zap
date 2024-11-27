<?php

namespace App\Http\Controllers;

use App\Models\Paystack;
use App\Services\PaystackService;
use App\Services\PropertyService;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class BuildingVerificationController extends Controller
{
    public function index()
    {
        return view('pages.property-verification.index');
    }

    public function success(PropertyService $propertyService)
    {
        $payRef = request()->input('trxref');
        $transaction = Paystack::where('reference_id', $payRef)->first();
        $transaction->status = true;
        $transaction->save();

        // dd($transaction->prop_no);

        $searchParameters = [
            // 'document_name' => 'document name',
            'approval_number' => $transaction->prop_no,
            // 'organization_name' => 'organization name',
            // Add other parameters as needed
        ];

        $response = $propertyService->searchDocuments($searchParameters);
        // dd($response['data']);

        $transaction->meta = $response['data'];
        $transaction->save();
     
        return view('pages.property-verification.success')->with('response', $response)->with('transaction', $transaction);
    }

    public function details($transactionRef)
    {
        $transaction = Paystack::where('reference_id', $transactionRef)->first();
        $transaction->meta = json_decode($transaction->meta, true);
        // dd($transaction->meta[0]['name']);
        return view('pages.property-verification.details')->with('transaction', $transaction);
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
