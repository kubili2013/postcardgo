<?php

return [

	// The default gateway to use
	'default' => 'paypal',

	// Add in each gateway here
	'gateways' => [
		'paypal' => [
			'driver'  => 'PayPal_Express',
			'options' => [
				'solutionType'   => '',
				'landingPage'    => '',
				'headerImageUrl' => ''
			]
		],
        'paypal_rest' => [
            'driver'  => 'PayPal_Rest',
            'options' => [
                'clientId'  => env('PAYPAL_REST_CLIENT_ID',''),
                'secret'    => env('PAYPAL_REST_CLIENT_SECRET',''),
                'token'     => env('PAYPAL_REST_TOKEN',''),
                'testMode'  => env( 'PAYPAL_REST_TEST_MODE',true),
                'returnUrl' => env( 'PAYPAL_REST_RETURN_URL',""),
                'cancelUrl' => env( 'PAYPAL_REST_CANCEL_URL',""),
            ],

        ],
	]

];