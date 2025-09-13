<?php

/**
 * Created by PhpStorm.
 * User: testing
 * Date: 8/16/2019
 * Time: 3:12 PM
 */

require_once 'privateAPI.php';
require_once 'Exception.php';
use ALFAcoins\ALFAcoins_privateAPI;
use ALFAcoins\ALFAcoins_Exception;

class Crypto_payment_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create_order ($amount, $method) {
        // include once ALFAcoins Private API class
// internal order_id which you can use to track this order in your own system, will be also displayed on the payment page
        $order_id = rand(111111,999999);
// shop_name is the API name, replace 'ShopName 123' with your API name. Create API entry at https://www.alfacoins.com/user
        $shop_name = $this->Util_model->get_option('alfcoin_shop_name');
// shop_password_hash is an uppercase md5 hash of API password, replace 'MyShopPassword' with your actual API password
        $shop_password = $this->Util_model->get_option('alfcoin_shop_password');
// shop_secret_key is your API secret_key, it's shown one time after you created the new API entry, if you didn't write it down you can reset it in your API settings
        $shop_secret_key = $this->Util_model->get_option('alfcoin_sk');
// initialize ALFAcoins Private API class with your API settings
        $api = new ALFAcoins_privateAPI($shop_name, $shop_password, $shop_secret_key);
// prepare options to create a new order, more about it here: https://www.alfacoins.com/developers#post_requests-create
        $options = [
            // notificationURL is used for notification about order's status change
            // PLEASE NOTE: you can only use verified websites in the websites integration area
            'notificationURL' => 'http://primeonex.com/panel/home/crypto-payment-notification',
            // redirectURL is used to redirect your customer from the payment page
            'redirectURL' => "http://primeonex.com/panel/home/confirm-order/$order_id",
            // payerName is your customer's name used to notify your customer about order
            'payerName' => $this->Util_model->get_user_info($this->session->userdata(UID)),
            // payerEmail is your customer's e-mail address used to notify your customer about order
            'payerEmail' => $this->Util_model->get_user_info($this->session->userdata(UID), 'email', 'profile'),
        ];

// order description (will be displayed on your payment page)
        $order_description = "Funding $amount USD";
// cryptocurrency type
        $type = $method;
// amount in fiat currency, 100 USD in our example
        $fiat_amount = $amount;
// amount currency type, if you leave this parameter blank default will be used from your API settings
        $fiat_currency = 'USD';
// create new order, more about it - https://www.alfacoins.com/developers#post_requests-create
        try {
            //echo 'Order create result:' . PHP_EOL;
            @$order = $api->create($type, $fiat_amount, $fiat_currency, $order_id, $order_description, $options);
            $return = [
                "status"    =>  true,
                "order_id"  =>  $order_id,
                "content"   =>  $order
            ];
            //var_dump($order);
        } catch (ALFAcoins_Exception $e) {
            //echo "Order create method failed: " . $e->getMessage() . PHP_EOL;
            $return = [
                "status"    =>  false,
                "content"   =>  $e->getMessage()
            ];
        }

        return $return;
// get order status, more about it - https://www.alfacoins.com/developers#post_requests-status
        /*try {
            echo 'Order status result:' . PHP_EOL;
            var_dump($api->status($order['id']));
        } catch (ALFAcoins_Exception $e) {
            echo "Order status method failed: " . $e->getMessage() . PHP_EOL;
        }*/
    }

    public function confirm_order ($order_id) {
        // shop_name is the API name, replace 'ShopName 123' with your API name. Create API entry at https://www.alfacoins.com/user
        $shop_name = $this->Util_model->get_option('alfcoin_shop_name');
// shop_password_hash is an uppercase md5 hash of API password, replace 'MyShopPassword' with your actual API password
        $shop_password = $this->Util_model->get_option('alfcoin_shop_password');
// shop_secret_key is your API secret_key, it's shown one time after you created the new API entry, if you didn't write it down you can reset it in your API settings
        $shop_secret_key = $this->Util_model->get_option('alfcoin_sk');
// initialize ALFAcoins Private API class with your API settings
        $api = new ALFAcoins_privateAPI($shop_name, $shop_password, $shop_secret_key);
// prepare options to create a new order, more about it here: https://www.alfacoins.com/developers#post_requests-create
        $options = [
        ];

        try {
            //echo 'Order status result:' . PHP_EOL;
            $order = $api->status($order_id);
            if ($order['status'] == 'confirmed') {
                $return = [
                    "status"        =>  true,
                    "content"       =>  "Confirmed successfully"
                ];
            } else if ($order['status'] == 'expired') {
                $return = [
                    "status"        =>  false,
                    "content"       =>  "Order expired. Create a new order"
                ];
            }
        } catch (ALFAcoins_Exception $e) {
            $return = [
                "status"        =>  false,
                "content"       =>  $e->getMessage()
            ];
        }
    }

}

?>