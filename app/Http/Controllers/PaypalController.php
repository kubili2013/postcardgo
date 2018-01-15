<?php

namespace App\Http\Controllers;

use App\Exceptions\PaypalException;
//use PayPal\Api\PaymentExecution;
use App\Http\Requests\PostcardRequest;
use App\Jobs\CreatePostcard;
use App\Models\Payment;
use App\Models\PaypalPayer;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;
use Omnipay;

//use PayPal\Api\Amount;
//use PayPal\Api\Payer;
//use PayPal\Api\Payment;
//use PayPal\Api\RedirectUrls;
//use PayPal\Api\Transaction;
//use PayPal\Auth\OAuthTokenCredential;
//use PayPal\Exception\PayPalConnectionException;
//use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

/**    public function create(Request $request){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $amount = new Amount();
        $amount->setTotal('1.00');
        $amount->setCurrency(config('paypal.currency'));
        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(config('paypal.returnurl'))
            ->setCancelUrl(config('paypal.cancelurl'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        try {
            $payment->create(PaypalController::getApiContext());
            // 写入数据库代码
            return  $payment;
        }catch (PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            return $ex->getData();
        }
    }
    public function execute(Request $request){
        $payment = Payment::get($request->input('paymentID'), PaypalController::getApiContext());
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('payerID'));
        $payment = $payment->execute($execution, PaypalController::getApiContext());
        //$payment->state == "";
        return $payment;
    }

    private static function getApiContext(){
        if(config('paypal.mode') == "sandbox"){
            return new ApiContext(new OAuthTokenCredential(config('paypal.sandbox.client_id'),config('paypal.sandbox.secret')));
        }else if(config('paypal.mode') == "live"){
            return new ApiContext(new OAuthTokenCredential(config('paypal.sandbox.client_id'),config('paypal.sandbox.secret')));
        }else{
            throw PaypalException::modelError();
        }
    } **/

    public function topay(PostcardRequest $request){
        $postcard = $this->dispatchNow(CreatePostcard::fromRequest($request));
        $payment = new Payment();
        $gateway = Omnipay::gateway('paypal_rest');
        $response = $gateway->purchase(
            array(
                'currency' => 'USD',
                'amount' => '4.99',
                'returnUrl' => config("laravel-omnipay.gateways.paypal_rest.options.returnUrl"),
                'cancelUrl' => config("laravel-omnipay.gateways.paypal_rest.options.cancelUrl")
            )
        )->send();
        $data = $response->getData();
        $payment->payment_id = $data['id'];
        $payment->payer = "0";
        $payment->status = $data['state'];
        $payment->amount = "4.99";
        $payment->postcard_id = $postcard -> id;
        $payment -> save();
        if ($response->isRedirect()) {
            return redirect($response->getRedirectUrl());
        }else{
            return redirect(route('home'));
        }
    }

    public function callback(\Illuminate\Http\Request $request){
        $gateway = Omnipay::gateway('paypal_rest');
        $transaction = $gateway->completePurchase(array(
            'payer_id'             => $request->get('PayerID'),
            'transactionReference' => $request->get('paymentId'),
        ));
        $response = $transaction->send();
        $data = $response->getData();
        if ($response->isSuccessful()) {
            $payment = Payment::where("payment_id",$request->get('paymentId'))->first();
            $payment->status = $data['state'];
            $payment->payer = $data['payer']['payer_info']['payer_id'];
            $payment->update();
            $postcard  = $payment->postcard;
            $postcard->status = 'payed';
            $postcard -> update();
            $payer = PaypalPayer::where("payer_id",$data['payer']['payer_info']['payer_id'])->first();
            if(!$payer){
                $payer = new PaypalPayer();
                $payer->email = $data['payer']['payer_info']['email'];
                $payer->payer_id = $data['payer']['payer_info']['payer_id'];
                $payer->first_name = $data['payer']['payer_info']['first_name'];
                $payer->last_name = $data['payer']['payer_info']['last_name'];
                $payer->recipient_name = $data['payer']['payer_info']['shipping_address']['recipient_name'];
                $payer->shipping_address_line1 = $data['payer']['payer_info']['shipping_address']['line1'];
                $payer->shipping_address_city = $data['payer']['payer_info']['shipping_address']['city'];
                $payer->shipping_address_state = $data['payer']['payer_info']['shipping_address']['state'];
                $payer->postal_code = $data['payer']['payer_info']['shipping_address']['postal_code'];
                $payer->country_code = $data['payer']['payer_info']['country_code'];
                $payer->save();
            }
            $this->success('postcard.payed.success');
            return view('users.dashboard');
        } else {
            $this->success('postcard.payed.fail');
            return view('home');
        }
    }

    public function cancel(){
        $this->success('postcard.payed.cancel');
        return view('home');
    }
}
