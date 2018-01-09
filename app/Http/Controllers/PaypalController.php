<?php

namespace App\Http\Controllers;

use App\Exceptions\PaypalException;
use PayPal\Api\PaymentExecution;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function create(Request $request){
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
    }
}
