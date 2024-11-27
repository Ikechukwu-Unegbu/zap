<?php

namespace App\Services;

use Exception;
use App\Models\Paystack;
use App\Models\PaymentGateway;
use Illuminate\Support\Collection;
use App\Interfaces\Payment\Payment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Exceptions\PaymentInitialisationError;
use App\Services\Account\AccountBalanceService;


class PaystackService{

    public function isGatewayAvailable(): bool
    {
        return true;
    }

    public function createPaymentIntent($request, $amount, $redirectURL, $user=null, array $meta = [])
    {
        // var_dump(env('PAYSTACK_SECRET'));die;
        $transaction = Paystack::create([
            'user_id'       =>  $user?->id,
            'reference_id'  => $this->generateUniqueId(),
            'amount'        => $amount,
            'currency'      => 'NGN',
            'prop_no'      =>$request->approval_number,
            'email'         =>$request->email,
            'redirect_url'  => $redirectURL,
            'meta'          => json_encode($meta)
        ]);

        try {

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . env('PAYSTACK_KEY'),
            ])->post('https://api.paystack.co/transaction/initialize', [
                'reference'     =>  $transaction->reference_id,
                'amount'        =>  $transaction->amount * 100,
                'currency'      =>  $transaction->currency,
                'email'         =>  $request->email,
                'callback_url'  =>  $transaction->redirect_url,
                'channels'      =>  ['card', 'bank', 'bank_transfer']
            ]);

            if (! $response->ok()) {
                dd($response->object());
                throw new Exception('Invalid Response From Payment Gateway');
            }

            $response = $response->object();

            return collect([
                'paymentLink' => $response->data->authorization_url,
                'message' => $response->message,
                'status' => $response->status,
                'reference' =>  $response->data->reference
            ]);
            
        } catch (\Throwable $th) {
            
            Log::error($th->getMessage());
            throw new Exception('Could not initialize fluttterwave payment: '.$th->getMessage() );
        }
    }
 
    public function processPayment($request): bool
    {
        if (! $this->verifyTransaction($request->reference)) {
            $transaction->failed();
            return false;
        }

        $transaction = Paystack::where('reference_id', $request->reference)->first();

        if ($transaction == null || ! $transaction->exists()) {
            return false;
        }

        if ($transaction->status != true) {

            //update relevant logic

            $transaction->success();
            return true;
        }

        return false;

    }

    private function verifyTransaction($transactionId): bool
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.flutterwave.secret-key', env('PAYSTACK_SECRET')),
        ])->get("https://api.paystack.co/transaction/verify/$transactionId");
        
        $response = $response->object();

        if (! isset($response->status) || ! isset($response->data->status)) return false;
        
        if ($response->status || $response->data->status == 'success') {
            return true;
        }

        return false;
    }
  

   
    public function generateUniqueId(): string
    {
        return 'paystack_' . rand(1000, 99999999).str_replace(' ', '', microtime()).rand(1000, 99999999);

    }

}
