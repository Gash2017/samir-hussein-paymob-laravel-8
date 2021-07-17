<?php

namespace App\Http\Controllers;

use PayMob\Facades\PayMob;
use Illuminate\Http\Request;

class PayMobController extends Controller
{
    public function index()
    {
        $auth = PayMob::AuthenticationRequest();
        $order = PayMob::OrderRegistrationAPI([
            'auth_token' => $auth->token,
            'amount_cents' => 150 * 100, //put your price
            'currency' => 'EGP',
            'delivery_needed' => false, // another option true

            // change merchant_order_id every time you try
            'merchant_order_id' => 1008, //put order id from your database must be unique id

            'items' => [[ // all items information
                "name" => "Product 1",
                "amount_cents" => 150 * 100,
                "description" => "Smart Watch",
                "quantity" => "2"
            ]]
        ]);
        $PaymentKey = PayMob::PaymentKeyRequest([
            'auth_token' => $auth->token,
            'amount_cents' => 150 * 100, //put your price
            'currency' => 'EGP',
            'order_id' => $order->id,
            "billing_data" => [ // put your client information
                "apartment" => "803",
                "email" => "arabiccreative80@gmail.com",
                "floor" => "42",
                "first_name" => "Gaber",
                "building" => "444",
                "phone_number" => "01013688446",
                "shipping_method" => "PKG",
                "postal_code" => "22728",
                "city" => "Hosh Essa",
                "country" => "Egypt",
                "street" => "Elgomhoreya",
                "last_name" => "Elshemy",
                "state" => "Elbehera"
            ]
        ]);
// dd($PaymentKey);
        return view('paymob')->with(['token' => $PaymentKey->token]);
    }
}