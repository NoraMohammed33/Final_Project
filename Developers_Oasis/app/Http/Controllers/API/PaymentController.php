<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Expert;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $gateway;
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_SANDBOX_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_SANDBOX_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {

        try{
            $response = $this->gateway->purchase([
                'amount' => $request->input('amount'),
                'currency' => 'USD',
                'returnUrl' => url('/api/success').'?service_id='.$request->input('service_id').'&auth_user_id='.Auth::id(),
                'cancelUrl' => url('/api/error'),
            ])->send();

            if($response->isRedirect()){
                $redirectUrl = $response->getRedirectUrl();
                return response()->json(['redirect_url' => $redirectUrl]);            }
            else{
                return $response->getMessage();
            }
        }catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function success(Request $request){
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction = $this->gateway->completePurchase(array(
                'payerId'=> $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transaction->send();
            if($response->isSuccessful()){
                $arr = $response->getData();
                $serviceId = $request->input('service_id');
                $service = Service::find($serviceId);
                $expertId = $service->expert_id;
                $contract = new Contract();
                $contract->user_id = $request->input('auth_user_id');
                $contract->service_id = $serviceId;
                $contract->expert_id = $expertId;
                $contract->charge_id =$arr['id'];
                $contract->save();
                return redirect('http://localhost:8000/success');
            }
            else{
                return $response->getMessage();
            }

        }
        else{
            return redirect('http://localhost:8000/error');
        }
    }

    public function error(){
        return redirect('http://localhost:8000/error');
    }












}
