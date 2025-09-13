<?php
/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/24/2017
 * Time: 10:21 AM
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function send_token($uid, $type)
    {
        if ($this->Db_model->row_count("user_auth", "WHERE uid=$uid AND type='$type'") > 0) {
            $this->Db_model->delete("user_auth", "WHERE uid=$uid AND type='$type'");
        }
        $token = $this->Util_model->generate_id(111111, 999999, "user_auth", "auth");
        $inputs = array(
            "uid" => $uid,
            "auth" => $token,
            "type" => $type
        );
        if ($this->Db_model->insert("user_auth", $inputs)) {
            return true;
        } else {
            return false;
        }
    }

    public function verify_token($uid, $auth, $type)
    {
        if ($this->Db_model->row_count("user_auth", "WHERE uid=$uid AND auth='$auth' AND type='$type'") > 0) {
            $this->Db_model->delete("user_auth", "WHERE uid=$uid AND type='$type'");
            return true;
        } else {
            return false;
        }
    }

    public function user_role($role, $output = 'plain')
    {
        switch ($role) {
            case 0:
                switch ($output) {
                    case 'plain':
                        $return = 'Pre-register';
                        break;
                    case 'label':
                        $return = "<span class='label label-danger'>Pre-register</span>";
                        break;
                }
                break;
            case 1:
                switch ($output) {
                    case 'plain':
                        $return = 'Free';
                        break;
                    case 'label':
                        $return = "<span class='badge bg-gradient-danger'>Free</span>";
                        break;
                }
                break;
            case 2:
                switch ($output) {
                    case 'plain':
                        $return = 'Pro';
                        break;
                    case 'label':
                        $return = "<span class='badge bg-gradient-green'>Pro</span>";
                        break;
                }
                break;
            case 3:
                switch ($output) {
                    case 'plain':
                        $return = 'Pro+';
                        break;
                    case 'label':
                        $return = "<span class='badge bg-gradient-blue'>Pro+</span>";
                        break;
                }
                break;
            case 4:
                switch ($output) {
                    case 'plain':
                        $return = 'Pro++';
                        break;
                    case 'label':
                        $return = "<span class='badge bg-gradient-indigo'>Pro++</span>";
                        break;
                }
                break;
        }
        return $return;
    }

    public function check_balance($uid, $amount)
    {
        $balance = $this->General_model->get_balance($uid, false);
        if ($amount > $balance) {
            $this->Util_model->create_redirect();
            $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Insufficient balance. Deposit to continue", "alert-danger", 1));
            $top_up = $amount - $balance;
            $this->session->set_flashdata('amount', $top_up);
            return false;
        } else {
            return true;
        }
    }

    public function add_to_wallet($amount, $creditor, $debitor, $creditor_desc = "", $debitor_desc = "", $type = "deposit", $extra = "", $ref = "", $status = 0)
    {
        ##################################################################
        #                                                                #
        # to: The receiver of the fund (if it's a debit)                 #
        # desc: The description of the fund ie. from the card a deposit  #
        # was made, the reason for the credit etc.                       #
        # type: The type of transaction it was ie. Credit or Debit       #
        # ref: A unique ID used in identifying a transaction             #
        ##################################################################
        $ref = ($ref == "") ? $ref = $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "varchar", true, 'fb') : $ref;
        $input = array(
            "amount" => $amount,
            "creditor" => $creditor,
            "debitor" => $debitor,
            "creditor_desc" => $creditor_desc,
            "debitor_desc" => $debitor_desc,
            "type" => $type,
            "extra" => $extra,
            "ref" => $ref,
            "status" => $status
        );

        if ($this->Db_model->insert("user_wallet", $input)) {
            if ($creditor > 0) {
                $this->add_to_wallet_ex($amount, $creditor, $creditor_desc, "credit", $ref);
            }
            if ($debitor > 0) {
                $this->add_to_wallet_ex($amount, $debitor, $debitor_desc, "debit", $ref);
            }
            return array("return" => true, "reference" => $ref);
        } else {
            return array("return" => false, "reference" => NULL);
        }
    }

    public function add_to_bonus($amount, $creditor, $debitor, $type = "ROI", $ref = "", $status = 0)
    {
        ##################################################################
        #                                                                #
        # to: The receiver of the fund (if it's a debit)                 #
        # type: The type of transaction it was ie. Credit or Debit       #
        # ref: A unique ID used in identifying a transaction             #
        ##################################################################
        $ref = ($ref == "") ? $ref = $this->Util_model->generate_id(1111111111, 9999999999, "user_bonus", "ref", "varchar", true, 'fb') : $ref;
        $input = array(
            "amount" => $amount,
            "creditor" => $creditor,
            "debitor" => $debitor,
            "type" => $type,
            "ref" => $ref,
            "status" => $status
        );

        if ($this->Db_model->insert("user_bonus", $input)) {
            return array("return" => true, "reference" => $ref);
        } else {
            return array("return" => false, "reference" => NULL);
        }
    }

    public function give_coupon($uid, $coupon, $relate)
    {
        $this->Db_model->insert("user_coupon", [
            "uid" => $uid,
            "relate" => $relate,
            "coupon" => $coupon,
            "used" => 0,
            "date_added" => date_time(),
            "date_used" => date_time()
        ]);
    }

    //#####################DATA COUPON######################################################################################
    public function verify_data_coupon($uid, $coupon, $bundle)
    {
        if ($this->Util_model->row_count("user_coupon", "WHERE uid=$uid AND coupon='$coupon' AND relate='data_coupon' AND used=0") == 0) {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> You are not eligible to use this coupon", "alert-danger", 1));
            return false;
        } else if ($this->Util_model->row_count("data_coupon", "WHERE code='$coupon' AND status=1") == 0) {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Coupon doesn't exist or has expired", "alert-danger", 1));
            return false;
        } else {
            $d_coupon = $this->Util_model->get_info("data_coupon", "*", "WHERE code='$coupon'");
            if ($d_coupon['bundle'] != $bundle) {
                $network = $this->Util_model->get_info("networks", "network", "WHERE id=" . $this->Util_model->get_info("data_bundle", "network_id", "WHERE id=$d_coupon[bundle]"));
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> This coupon can only be used for <b>$network " . $this->Util_model->get_info("data_bundle", "bundle", "WHERE id=$bundle") . "</b> data bundle", "alert-danger", 1));
                return false;
            } else if ($d_coupon['usage_limit'] == 0) {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> This coupon has exceeded it's maximum usage limit", "alert-danger", 1));
                return false;
            } else {
                return true;
            }
        }
    }

    public function calculate_data_coupon_discount($coupon, $amount)
    {
        $coupon = $this->Util_model->get_info("data_coupon", "discount, type", "WHERE code='$coupon'");
        if ($coupon['type'] == "percentage") {
            $discount = get_percentage($amount, $coupon['discount']);
        } else {
            $discount = $coupon['discount'];
        }
        $amount -= $discount;
        return ['amount' => $amount, 'discount' => $discount];
    }

    public function apply_data_coupon($uid, $coupon)
    {
        if ($this->Db_model->update("user_coupon", array("used" => 1, "date_used" => date_time()), "WHERE uid=$uid AND relate='data_coupon' AND coupon='$coupon'")) {
            $usage = $this->Util_model->get_info("data_coupon", "usage_limit", "WHERE code='$coupon'");
            $this->Db_model->update("data_coupon", array("usage_limit" => $usage - 1), "WHERE code='$coupon'");
            return true;
        } else {
            return false;
        }
    }
    //#########################################################################################################################

    //#####################AIRTIME COUPON######################################################################################
    public function verify_airtime_coupon($uid, $coupon, $net_id, $amount)
    {
        if ($this->Util_model->row_count("user_coupon", "WHERE uid=$uid AND coupon='$coupon' AND relate='airtime_coupon' AND used=0") == 0) {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> You are not eligible to use this coupon", "alert-danger", 1));
            return false;
        } else if ($this->Util_model->row_count("airtime_coupon", "WHERE code='$coupon' AND status=1") == 0) {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Coupon doesn't exist or has expired", "alert-danger", 1));
            return false;
        } else if ($this->Util_model->row_count("airtime_coupon", "WHERE code='$coupon' AND network_id=$net_id") == 0 && $this->Util_model->get_info("airtime_coupon", "network_id", "WHERE code='$coupon' AND network_id=$net_id") != 0) {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Coupon cannot be used for the selected network", "alert-danger", 1));
            return false;
        } else if ($this->Util_model->row_count("airtime_coupon", "WHERE code='$coupon' AND min_amount>$amount") == 0) {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Coupon cannot be used for amount below NGN " . $this->Util_model->get_info("airtime_coupon", "min_amount", "WHERE code='$coupon'"), "alert-danger", 1));
            return false;
        } else if ($this->Util_model->row_count("airtime_coupon", "WHERE code='$coupon' AND max_amount<$amount") == 0) {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Coupon cannot be used for amount above NGN " . $this->Util_model->get_info("airtime_coupon", "max_amount", "WHERE code='$coupon'"), "alert-danger", 1));
            return false;
        } else {
            $d_coupon = $this->Util_model->get_info("airtime_coupon", "*", "WHERE code='$coupon'");
            if ($d_coupon['usage_limit'] == 0) {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> This coupon has exceeded it's maximum usage limit", "alert-danger", 1));
                return false;
            } else {
                return true;
            }
        }
    }

    public function calculate_airtime_coupon_discount($coupon, $amount)
    {
        $coupon = $this->Util_model->get_info("airtime_coupon", "discount, type", "WHERE code='$coupon'");
        if ($coupon['type'] == "percentage") {
            $discount = get_percentage($amount, $coupon['discount']);
        } else {
            $discount = $coupon['discount'];
        }
        $amount -= $discount;
        return ['amount' => $amount, 'discount' => $discount];
    }

    public function apply_airtime_coupon($uid, $coupon)
    {
        if ($this->Db_model->update("user_coupon", array("used" => 1, "date_used" => date_time()), "WHERE uid=$uid AND relate='airtime_coupon' AND coupon='$coupon'")) {
            $usage = $this->Util_model->get_info("airtime_coupon", "usage_limit", "WHERE code='$coupon'");
            $this->Db_model->update("airtime_coupon", array("usage_limit" => $usage - 1), "WHERE code='$coupon'");
            return true;
        } else {
            return false;
        }
    }
    //#########################################################################################################################

    //############################API CALL TO DATA VENDOR##################################

    public function initialize_data_request($uid, $recipient, $bund_id, $amount_paid, $discount = 0, $ref = "", $coupon = "")
    {
        $bundle = $this->Util_model->get_info("data_bundle", "*", "WHERE id=" . $bund_id);
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");
        $network = "0$bundle[network_id]";
        $plan = $bundle['unit'];

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIBuy.asp?UserID=$api_user_id&APIKey=$api_key&MobileNetwork=$network&DataPlan=$plan&MobileNumber=$recipient";
            $request = curl_get_request($url);

            if ($request['status'] == 'ORDER_RECEIVED' || $request['status'] == 'ORDER_ONHOLD') {
                if (
                    $this->Db_model->insert("data_purchase", [
                        "uid" => $uid,
                        "order_id" => $request['orderid'],
                        "reference" => $ref,
                        "recipient" => $recipient,
                        "network" => $bundle['network_id'],
                        "bundle" => $bund_id,
                        "bundle_amount" => $bundle['amount'],
                        "amount_paid" => $amount_paid,
                        "discount" => $discount,
                        "coupon" => $coupon,
                        "status" => 1,
                        "status_date" => date_time()
                    ])
                ) {
                    $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$ref'");
                    $return = [
                        "status" => true,
                        "message" => "Your order has been received and is under process.",
                        "order_id" => $request['orderid']
                    ];
                } else {
                    $return = [
                        "status" => false,
                        "message" => "An error occurred during process. Try again later"
                    ];
                }
            } else if ($request['status'] == 'INVALID_DATAPLAN') {
                $return = [
                    "status" => false,
                    "message" => "The data bundle requested is not available at the moment. Try another data bundle"
                ];
            } else if ($request['status'] == 'INVALID_RECIPIENT') {
                $return = [
                    "status" => false,
                    "message" => "The recipient number is invalid. Try again"
                ];
            } else {
                $return = [
                    "status" => false,
                    "message" => "Unable to complete transaction at the moment. Try again later"
                ];
            }
        } else {
            $return = [
                "status" => false,
                "message" => "Connection error: check your internet connectivity"
            ];
        }
        return $return;
    }

    public function query_data_transaction($order_id)
    {
        $data_pur = $this->Util_model->get_info("data_purchase", "*", "WHERE order_id=$order_id");
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIQuery.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
            $request = curl_get_request($url);

            if ($request['status'] == 'ORDER_COMPLETED') {
                $this->Db_model->update("data_purchase", ["status" => 1, "status_date" => date_time()], "WHERE order_id=$order_id");
                $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$data_pur[reference]'");
            }
        }
    }

    public function cancel_data_transaction($order_id)
    {
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIQuery.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
            $request = curl_get_request($url);

            if ($request['status'] != 'ORDER_COMPLETED') {
                $url = "https://www.nellobytesystems.com/APICancel.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
                $request = curl_get_request($url);
                if ($request['status'] == 'ORDER_CANCELLED') {
                    $ref = $this->Util_model->get_info("data_purchase", "reference", "WHERE order_id=$order_id");
                    $this->Db_model->update("data_purchase", ["status" => 2], "WHERE order_id=$order_id");
                    $this->Db_model->delete("user_wallet", "WHERE ref='$ref'");
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-checks-circle'></i> Transaction cancelled successfully", "alert-success", 1));
                    return true;
                } else {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> An error occured during cancellation", "alert-danger", 1));
                    return false;
                }
            } else {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> The data has already been delivered", "alert-danger", 1));
                return false;
            }
        }
    }

    //####################################################################################

    //#####################API CALL TO AIRTIME TOP UP VENDOR#############################
    public function initialize_airtime_request($uid, $net_id, $amount, $recipient, $amount_paid = 0, $discount = 0, $ref = "", $coupon = "")
    {
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");
        $network = "0$net_id";

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIBuyAirTime.asp?UserID=$api_user_id&APIKey=$api_key&MobileNetwork=$network&Amount=$amount&MobileNumber=$recipient";
            $request = curl_get_request($url);

            if ($request['status'] == 'ORDER_RECEIVED' || $request['status'] == 'ORDER_ONHOLD') {
                $this->Db_model->insert("airtime_purchase", [
                    "uid" => $uid,
                    "order_id" => $request['orderid'],
                    "reference" => $ref,
                    "recipient" => $recipient,
                    "network" => $net_id,
                    "amount" => $amount,
                    "amount_paid" => $amount_paid,
                    "discount" => $discount,
                    "coupon" => $coupon,
                    "status" => 1,
                    "status_date" => date_time()
                ]);
                $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$ref'");
                $return = [
                    "status" => true,
                    "message" => "Your order has been received and is under process.",
                    "order_id" => $request['orderid']
                ];
            } else if ($request['status'] == 'INVALID_RECIPIENT') {
                $return = [
                    "status" => false,
                    "message" => "The recipient number is invalid. Try again"
                ];
            } else {
                $return = [
                    "status" => false,
                    "message" => "Your transaction cannot be completed at the moment. Try again later"
                ];
            }
        } else {
            $return = [
                "status" => false,
                "message" => "Connection error: check your internet connectivity"
            ];
        }
        return $return;
    }

    public function query_airtime_transaction($order_id)
    {
        $airtime_pur = $this->Util_model->get_info("airtime_purchase", "*", "WHERE order_id=$order_id");
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIQuery.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
            $request = curl_get_request($url);

            if ($request['status'] == 'ORDER_COMPLETED') {
                $this->Db_model->update("airtime_purchase", ["status" => 1, "status_date" => date_time()], "WHERE order_id=$order_id");
                $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$airtime_pur[reference]'");
            }
        }
    }

    public function cancel_airtime_transaction($order_id)
    {
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIQuery.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
            $request = curl_get_request($url);

            if ($request['status'] != 'ORDER_COMPLETED') {
                $url = "https://www.nellobytesystems.com/APICancel.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
                $request = curl_get_request($url);
                if ($request['status'] == 'ORDER_CANCELLED') {
                    $ref = $this->Util_model->get_info("airtime_purchase", "reference", "WHERE order_id=$order_id");
                    $this->Db_model->update("airtime_purchase", ["status" => 2], "WHERE order_id=$order_id");
                    $this->Db_model->delete("user_wallet", "WHERE ref='$ref'");
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-checks-circle'></i> Transaction cancelled successfully", "alert-success", 1));
                    return true;
                } else {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> An error occurred during cancellation", "alert-danger", 1));
                    return false;
                }
            } else {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> The airtime has already been delivered", "alert-danger", 1));
                return false;
            }
        }
    }
    //######################################################################################

    public function send_bulk_sms($uid, $amount_paid, $discount, $ref, $data, $type = "user")
    {
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");
        $success = 0;
        $failed = 0;
        $refund = 0;
        $return = array();

        if (is_connected()) {
            if (is_multi($data)) {
                foreach ($data as $sms) {
                    $sender = str_replace(" ", "%20", $sms['Sender']);
                    $message = str_replace(" ", "%20", $sms['Message']);
                    $prefix = substr($sms['Recipient'], 0, 1);
                    if ($prefix == 0) {
                        if ($this->Util_model->identify_network($sms['Recipient']) > 0) {
                            $sms['Recipient'] = "234" . ltrim($sms['Recipient'], 0);
                        }
                    }
                    $url = "https://www.nellobytesystems.com/APIBuyBulkSMS.asp?UserID=$api_user_id&APIKey=$api_key&Sender=$sender&Message=$message&Recipient=$sms[Recipient]";
                    $request = curl_get_request($url);
                    if ($request['status'] == 'ORDER_COMPLETED') {
                        $this->Db_model->insert("bulksms_purchase", [
                            "uid" => $uid,
                            "order_id" => $request['orderid'],
                            "reference" => $ref,
                            "recipient" => $sms['Recipient'],
                            "sender_id" => $sms['Sender'],
                            "message" => $sms['Message'],
                            "amount" => $this->Util_model->get_option("bulksms_price"),
                            "amount_paid" => $amount_paid,
                            "discount" => $discount,
                            "status" => 1,
                            "status_date" => date_time()
                        ]);
                        $success++;
                    } else if ($request['status'] == 'ORDER_RECEIVED') {
                        $this->Db_model->insert("bulksms_purchase", [
                            "uid" => $uid,
                            "order_id" => $request['orderid'],
                            "reference" => $ref,
                            "recipient" => $sms['Recipient'],
                            "sender_id" => $sms['Sender'],
                            "message" => $sms['Message'],
                            "amount" => $this->Util_model->get_option("bulksms_price"),
                            "amount_paid" => $amount_paid,
                            "discount" => $discount,
                            "status" => 0,
                            "status_date" => date_time()
                        ]);
                        $success++;
                    } else {
                        $refund += $amount_paid;
                    }
                }
                $return = [
                    "status" => true,
                    "message" => "<b>$success</b> SMS sent successfully while <b>$failed</b> SMS failed."
                ];
            } else {
                $sender = str_replace(" ", "%20", $data['Sender']);
                $message = str_replace(" ", "%20", $data['Message']);
                $prefix = substr($data['Recipient'], 0, 1);
                if ($prefix == 0) {
                    if ($this->Util_model->identify_network($data['Recipient']) > 0) {
                        $data['Recipient'] = "234" . ltrim($data['Recipient'], 0);
                    }
                }
                $url = "https://www.nellobytesystems.com/APIBuyBulkSMS.asp?UserID=$api_user_id&APIKey=$api_key&Sender=$sender&Message=$message&Recipient=$data[Recipient]";
                $request = curl_get_request($url);
                if ($request['status'] == 'ORDER_COMPLETED') {
                    $this->Db_model->insert("bulksms_purchase", [
                        "uid" => $uid,
                        "order_id" => $request['orderid'],
                        "reference" => $ref,
                        "recipient" => $data['Recipient'],
                        "sender_id" => $data['Sender'],
                        "message" => $data['Message'],
                        "amount" => $this->Util_model->get_option("bulksms_price"),
                        "amount_paid" => $amount_paid,
                        "discount" => $discount,
                        "status" => 1,
                        "status_date" => date_time()
                    ]);
                    $return = [
                        "status" => true,
                        "message" => "SMS sent successfully."
                    ];
                } else if ($request['status'] == 'ORDER_RECEIVED') {
                    $this->Db_model->insert("bulksms_purchase", [
                        "uid" => $uid,
                        "order_id" => $request['orderid'],
                        "reference" => $ref,
                        "recipient" => $data['Recipient'],
                        "sender_id" => $data['Sender'],
                        "message" => $data['Message'],
                        "amount" => $this->Util_model->get_option("bulksms_price"),
                        "amount_paid" => $amount_paid,
                        "discount" => $discount,
                        "status" => 0,
                        "status_date" => date_time()
                    ]);
                    $return = [
                        "status" => true,
                        "message" => "SMS sent successfully."
                    ];
                } else {
                    if ($type == 'user') {
                        if ($this->Util_model->row_count("user_wallet", "WHERE debitor=$uid AND ref='$ref' AND status=1") > 0) {
                            $refund += $amount_paid;
                        }
                        $return = [
                            "status" => false,
                            "message" => "Unable to send SMS at the moment. Try again later."
                        ];
                    }
                }
            }
        } else {
            $return = [
                "status" => false,
                "message" => "Connection error: check your internet connectivity"
            ];
        }

        if ($refund > 0) {
            $new_ref = $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "varchar", true, "fb");
            $debit = $this->Main_model->add_to_wallet(
                $refund,
                $this->session->userdata(UID),
                0,
                "SMS charge refund",
                "SMS charge refund",
                "SMS refund",
                $ref,
                $new_ref
            );
            $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$new_ref'");
        }
        return $return;
    }

    public function process_offline_data()
    {
        $s = $this->Db_model->selectGroup("*", "offline_data_purchase", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $uid = $row['uid'];
                $net_id = $row['net_id'];
                $bundle_id = $row['bundle'];
                $from = $row['sender'];
                $recipient = $row['recipient'];
                $pin = $row['pin'];

                $status = false;
                $message = "An error occurred. Try again later";

                if ($net_id != $this->Util_model->identify_network($recipient)) {
                    $status = false;
                    $message = "Invalid network for recipient";
                    $this->Db_model->delete("offline_data_purchase", "WHERE id=$row[id]");
                } else if ($this->Util_model->row_count("user_profile", "WHERE phone=" . ltrim($from, 0)) == 0) {
                    $status = false;
                    $message = "User with number $from does not exist";
                    $this->Db_model->delete("offline_data_purchase", "WHERE id=$row[id]");
                } else if ($this->Util_model->row_count("user_profile", "WHERE phone=" . ltrim($from, 0) . " AND pin=$pin") == 0) {
                    $status = false;
                    $message = "Incorrect transaction PIN. Try again";
                    $this->Db_model->delete("offline_data_purchase", "WHERE id=$row[id]");
                } else {
                    $this->Db_model->update("offline_data_purchase", ["status" => 1], "WHERE id=$row[id]"); // Set to ungoing
                    $bundle = $this->Util_model->get_info("data_bundle", "*", "WHERE id=$bundle_id");
                    $discount = $this->Util_model->get_info("packages", "data_discount", "WHERE id=" . $this->Util_model->get_user_info($uid, "package", "profile"));
                    $amount_to_add = $this->General_model->get_balance($uid, false) - ($bundle['amount'] - $discount);
                    if ($amount_to_add < 0) {
                        $amount_to_add *= -1;
                        $this->load->model("Payment_model", "pay");
                        $card_id = $this->Util_model->get_info("user_card", "id", "WHERE uid=$uid AND status=1 ORDER BY id DESC LIMIT 1");
                        $this->pay->auth_charge($uid, $card_id, "3s2b1b1", $amount_to_add);
                    }

                    $amount_to_pay = $bundle['amount'] - $discount;
                    if ($this->Main_model->check_balance($uid, $amount_to_pay)) {
                        $ref = $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "varchar", true, "fb");
                        $debit = $this->Main_model->add_to_wallet(
                            $amount_to_pay,
                            0,
                            $uid,
                            $this->Util_model->get_info("networks", "network", "WHERE id=$bundle[network_id]") . " $bundle[bundle]",
                            $this->Util_model->get_info("networks", "network", "WHERE id=$bundle[network_id]") . " $bundle[bundle]",
                            "Data purchase",
                            $bundle_id,
                            $ref
                        );
                        if ($debit['return']) {
                            $data_request = $this->Main_model->initialize_data_request($uid, $recipient, $bundle['id'], $amount_to_pay, $discount, $ref, "");
                            if ($data_request['status']) {
                                $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$ref'");
                                $status = true;
                                $message = "Order received and under process. Don't resend again";
                                $this->Db_model->update("offline_data_purchase", ["status" => 2], "WHERE id=$row[id]"); // Set to ungoing
                            } else {
                                $this->Db_model->delete("user_wallet", "WHERE debitor=$uid AND ref='$ref'");
                                $status = false;
                                $message = "An error occured while processing your order. Try again later";
                                $this->Db_model->delete("offline_data_purchase", "WHERE id=$row[id]");
                            }
                        } else {
                            $status = false;
                            $message = "Unable to complete process at the moment. Try again later";
                            $this->Db_model->update("offline_data_purchase", ["status" => 0], "WHERE id=$row[id]"); // Set to ungoing
                            $this->Db_model->delete("offline_data_purchase", "WHERE id=$row[id]");
                        }
                    } else {
                        $status = false;
                        $message = "Insufficient balance";
                        $this->Db_model->delete("offline_data_purchase", "WHERE id=$row[id]");
                    }
                }

                $sms = [
                    "Sender" => "ISEBABA",
                    "Recipient" => $from,
                    "Message" => $message
                ];
                //$this->Main_model->send_bulk_sms(0, 0, 0, $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "varchar", true, "fb"), $sms, "System");

                if ($status) {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> $message", "alert-success", 1));
                } else {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> $message", "alert-danger", 1));
                }
            }
        }
    }

    public function process_offline_airtime()
    {
        $s = $this->Db_model->selectGroup("*", "offline_airtime_purchase", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $uid = $row['uid'];
                $amount = $row['amount'];
                $from = $row['sender'];
                $recipient = $row['recipient'];
                $pin = $row['pin'];
                $net_id = $this->Util_model->identify_network($recipient);

                $status = false;
                $message = "An error occurred. Try again later";
                if ($this->Util_model->row_count("user_profile", "WHERE phone=" . ltrim($from, 0)) == 0) {
                    $status = false;
                    $message = "User with number $from does not exits";
                    $this->Db_model->delete("offline_airtime_purchase", "WHERE id=$row[id]");
                } else if ($this->Util_model->row_count("user_profile", "WHERE phone=" . ltrim($from, 0) . " AND pin=$pin") == 0) {
                    $status = false;
                    $message = "Incorrect transaction PIN. Try again.";
                    $this->Db_model->delete("offline_airtime_purchase", "WHERE id=$row[id]");
                } else {
                    $this->Db_model->update("offline_airtime_purchase", ["status" => 1], "WHERE id=$row[id]"); // Set to ungoing
                    $discount = get_percentage($amount, $this->Util_model->get_info("packages", "airtime_discount", "WHERE id=" . $this->Util_model->get_user_info($uid, "package", "profile")));
                    $amount_to_add = $this->General_model->get_balance($uid, false) - ($amount - $discount);
                    if ($amount_to_add < 0) {
                        $amount_to_add *= -1;
                        $this->load->model("Payment_model", "pay");
                        $card_id = $this->Util_model->get_info("user_card", "id", "WHERE uid=$uid AND status=1 ORDER BY id DESC LIMIT 1");
                        $this->pay->auth_charge($uid, $card_id, "3s2b1b1", $amount_to_add);
                    }

                    $amount_to_pay = $amount - $discount;
                    if ($this->Main_model->check_balance($uid, $amount_to_pay)) {
                        $ref = $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "varchar", true, "fb");
                        $debit = $this->Main_model->add_to_wallet(
                            $amount_to_pay,
                            0,
                            $uid,
                            $this->Util_model->get_info("networks", "network", "WHERE id=$net_id") . " $amount",
                            $this->Util_model->get_info("networks", "network", "WHERE id=$net_id") . " $amount",
                            "Airtime purchase",
                            "",
                            $ref
                        );
                        if ($debit['return']) {
                            $airtime_request = $this->Main_model->initialize_airtime_request($uid, $net_id, $amount, $recipient, $amount_to_pay, $discount, $ref, "");
                            if ($airtime_request['status']) {
                                $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$ref'");
                                $status = true;
                                $message = "Order received and under process. Don't resend again.";
                                $this->Db_model->update("offline_airtime_purchase", ["status" => 2], "WHERE id=$row[id]"); // Set to ungoing
                            } else {
                                $this->Db_model->delete("user_wallet", "WHERE debitor=$uid AND ref='$ref'");
                                $status = false;
                                $message = "An error occurred while processing your order. Try again later";
                                $this->Db_model->delete("offline_airtime_purchase", "WHERE id=$row[id]");
                            }
                        } else {
                            $status = false;
                            $message = "Unable to complete process at the moment. Try again later";
                            $this->Db_model->delete("offline_airtime_purchase", "WHERE id=$row[id]");
                        }
                    } else {
                        $status = false;
                        $message = "Insufficient balance. Try again later";
                        $this->Db_model->delete("offline_airtime_purchase", "WHERE id=$row[id]");
                    }
                }

                $sms = [
                    "Sender" => "ISEBABA",
                    "Recipient" => $from,
                    "Message" => $message
                ];
                //$this->Main_model->send_bulk_sms(0, 0, 0, $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "varchar", true, "fb"), $sms, "System");

                if ($status) {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> $message", "alert-success", 1));
                } else {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> $message", "alert-danger", 1));
                }
            }

        }
    }

    //############################API CALL TO CABLE VENDOR##################################

    public function initialize_cable_request($uid, $smart_card, $pack_id, $amount_paid, $discount = 0, $ref = "", $coupon = "")
    {
        $package = $this->Util_model->get_info("cable_package", "*", "WHERE id=" . $pack_id);
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");
        $cable = $package['cable'];
        $bouquet = $package['package_code'];

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIBuyCableTV.asp?UserID=$api_user_id&APIKey=$api_key&CableTV=$cable&Package=$bouquet&SmartCardNo=$smart_card";
            $request = curl_get_request($url);

            if ($request['status'] == 'ORDER_RECEIVED' || $request['status'] == 'ORDER_ONHOLD') {
                if (
                    $this->Db_model->insert("cable_purchase", [
                        "uid" => $uid,
                        "order_id" => $request['orderid'],
                        "reference" => $ref,
                        "smart_card" => $smart_card,
                        "cable" => $cable,
                        "package" => $bouquet,
                        "package_amount" => $package['amount'],
                        "amount_paid" => $amount_paid,
                        "discount" => $discount,
                        "coupon" => $coupon,
                        "status" => 1,
                        "status_date" => date_time()
                    ])
                ) {
                    $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$ref'");
                    $return = [
                        "status" => true,
                        "message" => "Your order has been received and is under process.",
                        "order_id" => $request['orderid']
                    ];
                } else {
                    $return = [
                        "status" => false,
                        "message" => "An error occurred during process. Try again later"
                    ];
                }
            } else if ($request['status'] == 'INVALID_PACKAGE') {
                $return = [
                    "status" => false,
                    "message" => "The bouquet requested is not available at the moment. Try later"
                ];
            } else if ($request['status'] == 'INVALID_SMARTCARDNO') {
                $return = [
                    "status" => false,
                    "message" => "The smart card number is invalid. Try again"
                ];
            } else {
                $return = [
                    "status" => false,
                    "message" => "Unable to complete transaction at the moment. Try again later"
                ];
            }
        } else {
            $return = [
                "status" => false,
                "message" => "Connection error: check your internet connectivity"
            ];
        }
        return $return;
    }

    public function query_cable_transaction($order_id)
    {
        $reference = $this->Util_model->get_info("cable_purchase", "reference", "WHERE order_id=$order_id");
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIQuery.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
            $request = curl_get_request($url);

            if ($request['status'] == 'ORDER_COMPLETED') {
                $this->Db_model->update("cable_purchase", ["status" => 1, "status_date" => date_time()], "WHERE order_id=$order_id");
                $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$reference'");
            }
        }
    }

    public function cancel_cable_transaction($order_id)
    {
        $api_user_id = $this->Util_model->get_option("api_user_id");
        $api_key = $this->Util_model->get_option("api_key");

        if (is_connected()) {
            $url = "https://www.nellobytesystems.com/APIQuery.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
            $request = curl_get_request($url);

            if ($request['status'] != 'ORDER_COMPLETED') {
                $url = "https://www.nellobytesystems.com/APICancel.asp?UserID=$api_user_id&APIKey=$api_key&OrderID=$order_id";
                $request = curl_get_request($url);
                if ($request['status'] == 'ORDER_CANCELLED') {
                    $ref = $this->Util_model->get_info("cable_purchase", "reference", "WHERE order_id=$order_id");
                    $this->Db_model->update("cable_purchase", ["status" => 2], "WHERE order_id=$order_id");
                    $this->Db_model->delete("user_wallet", "WHERE ref='$ref'");
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-checks-circle'></i> Transaction cancelled successfully", "alert-success", 1));
                    return true;
                } else {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> An error occured during cancellation", "alert-danger", 1));
                    return false;
                }
            } else {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> The cable subscription has already been delivered", "alert-danger", 1));
                return false;
            }
        }
    }

    //####################################################################################

    /////////////////////////////////////////User subscriptions///////////////////////////////////////
    public function users_auto_subscription()
    {
        $this->load->model("Payment_model", "pay");
        $s = $this->Db_model->selectGroup("uid, package, date", "user_profile", "WHERE role=1 AND package>1");
        if ($s->num_rows() > 0) {
            $count = 0;
            foreach ($s->result_array() as $row) {
                $last_sub = ($this->Util_model->row_count("user_subscription", "WHERE uid=$row[uid]") == 0) ? $row['date'] : $this->Util_model->get_info("user_subscription", "date", "WHERE uid=$row[uid] ORDER BY id DESC LIMIT 1");
                $days = days_difference($last_sub);
                if ($days >= $this->Util_model->get_option("sub_due_days")) {
                    $count++;
                    $card = $this->Db_model->selectGroup("id, cvv", "user_card", "WHERE uid=$row[uid] AND status=1 ORDER BY id DESC LIMIT 1");
                    $amount = $this->Util_model->get_info("packages", "recurring", "WHERE id=$row[package]");
                    if ($card->num_rows() > 0) {
                        $card = $card->row_array();
                        $charge = json_decode($this->pay->initiate_auth_charge($row['uid'], $card['id'], $card['cvv'], $amount, "recurring"));
                        if ($charge->status == 1) {
                            $settled = $this->settle_upperlevel($row['uid']);
                            $amount -= $settled['total'];
                            $amount -= 10;
                            $admin = $this->Util_model->get_info("user_profile", "uid", "WHERE role=2 ORDER BY id LIMIT 1");
                            $this->add_to_wallet(10, $admin, 0, "From member " . $this->Util_model->get_user_info($row['uid']), "From $row[uid] - $admin", "Admin cut", $row['uid'], "", 1);
                            $input = array(
                                "ref" => $charge->reference,
                                "uid" => $row['uid'],
                                "amount" => $amount,
                                "channel" => "card",
                                "extra" => $card['id'],
                                "benefactors" => 0
                            );
                            $this->Db_model->insert("user_subscription", $input);
                            $this->Db_model->update("user_profile", ["status" => 1], "WHERE uid=$row[uid]");
                        } else {
                            if ($this->General_model->get_balance($row['uid'], false) >= $amount) {
                                $charge = $this->add_to_wallet($amount, 0, $row['uid'], "System charge", "System charge", "Commission", $row['package'], "", 1);
                                $settled = $this->settle_upperlevel($row['uid']);
                                $amount -= $settled['total'];
                                $amount -= 10;
                                $admin = $this->Util_model->get_info("user_profile", "uid", "WHERE role=2 ORDER BY id LIMIT 1");
                                $this->add_to_wallet(10, $admin, 0, "From member " . $this->Util_model->get_user_info($row['uid']), "From $row[uid] - $admin", "Admin cut", $row['uid'], "", 1);
                                $input = array(
                                    "ref" => $charge['reference'],
                                    "uid" => $row['uid'],
                                    "amount" => $amount,
                                    "channel" => "wallet",
                                    "extra" => "",
                                    "benefactors" => $settled['count']
                                );
                                $this->Db_model->insert("user_subscription", $input);
                                $this->Db_model->update("user_profile", ["status" => 1], "WHERE uid=$row[uid]");
                            } else {
                                $this->Db_model->update("user_profile", ["status" => 0], "WHERE uid=$row[uid]");
                            }
                        }
                    } else {
                        if ($this->General_model->get_balance($row['uid'], false) >= $amount) {
                            $charge = $this->add_to_wallet($amount, 0, $row['uid'], "System charge", "System charge", "Commission", $row['package'], "", 1);
                            $settled = $this->settle_upperlevel($row['uid']);
                            $amount -= $settled['total'];
                            $amount -= 10;
                            $admin = $this->Util_model->get_info("user_profile", "uid", "WHERE role=2 ORDER BY id LIMIT 1");
                            $this->add_to_wallet(10, $admin, 0, "From member " . $this->Util_model->get_user_info($row['uid']), "From $row[uid] - $admin", "Admin cut", $row['uid'], "", 1);
                            $input = array(
                                "ref" => $charge['reference'],
                                "uid" => $row['uid'],
                                "amount" => $amount,
                                "channel" => "wallet",
                                "extra" => "",
                                "benefactors" => $settled['count']
                            );
                            $this->Db_model->insert("user_subscription", $input);
                            $this->Db_model->update("user_profile", ["status" => 1], "WHERE uid=$row[uid]");
                        } else {
                            $this->Db_model->update("user_profile", ["status" => 0], "WHERE uid=$row[uid]");
                        }
                    }
                }
                if ($count == 10) {
                    break;
                }
            }
        }
    }

    public function repay_debt($uid, $amount)
    {
        $s = $this->Db_model->selectGroup("*", "user_debts", "WHERE uid=$uid AND status=0");
        if ($s->num_rows() > 0) {
            $debt = $s->row_array();
            $paid = $this->Util_model->sum_field("user_debts_repayment", "amount", "WHERE uid=$uid AND ref=$debt[ref]");
            $amt_to_pay = $debt['amount'] - $paid;
            if (($amt_to_pay - $amount) < 0) {
                $remain = $amount - $amt_to_pay;
                $input = array(
                    "uid" => $uid,
                    "ref" => $debt['ref'],
                    "amount" => $remain,
                    "status" => 1
                );
            } else {
                $remain = 0;
                $input = array(
                    "uid" => $uid,
                    "ref" => $debt['ref'],
                    "amount" => $amount,
                    "status" => 1
                );
            }
            $this->Db_model->insert("user_debts_repayment", $input);
            $paid = $this->Util_model->sum_field("user_debts_repayment", "amount", "WHERE ref=$debt[ref]");
            if ($paid >= $debt['amount']) {
                $this->Db_model->update("user_debts", ["status" => 1], "WHERE uid=$uid AND ref=$debt[ref]");
            }
            $return = $remain;
        } else {
            $return = $amount;
        }
        return $return;
    }

    public function settle_upperlevel($uid)
    {
        $ref = $this->Db_model->select("refID, refID2, refID3", "user_referre", "WHERE uid=$uid");
        $ref1 = $ref['refID'];
        $ref2 = $ref['refID2'];
        $ref3 = $ref['refID3'];
        $count = 0;
        $total = 0;

        if ($ref1 > 0) {
            if ($this->Util_model->get_user_info($ref1, "package", "profile") > 1) {
                $amt = $this->Util_model->get_option("income_level1");
                $remain = $this->repay_debt($ref1, $amt);
                $this->add_to_wallet($remain, $ref1, 0, "From your child " . $this->Util_model->get_user_info($uid), "From $uid - $ref1", "Recurring", $uid, "", 1);
                $total += $remain;
            } else {
                $total += 0;
            }
        }

        if ($ref2 > 0) {
            if ($this->Util_model->get_user_info($ref2, "package", "profile") > 2) {
                $amt = $this->Util_model->get_option("income_level2");
                $remain = $this->repay_debt($ref2, $amt);
                $this->add_to_wallet($remain, $ref2, 0, "From your grand child " . $this->Util_model->get_user_info($uid), "From $uid - $ref2", "Recurring", $uid, "", 1);
                $total += $remain;
            } else {
                $total += 0;
            }
        }

        if ($ref3 > 0) {
            if ($this->Util_model->get_user_info($ref3, "package", "profile") > 2) {
                $amt = $this->Util_model->get_option("income_level3");
                $remain = $this->repay_debt($ref3, $amt);
                $this->add_to_wallet($remain, $ref3, 0, "From your child " . $this->Util_model->get_user_info($uid), "From $uid - $ref3", "Recurring", $uid, "", 1);
                $total += $remain;
            } else {
                $total += 0;
            }
        }

        return ['total' => $total, 'count' => $count];
    }

    public function add_to_wallet_ex($amount, $uid, $desc, $type, $method, $ref = "")
    {
        $ref = ($ref == "") ? $this->Util_model->generate_id(11111111, 99999999, "user_wallet_ex", "ref", "var", true, 'fb') : $ref;
        $data = array(
            "amount" => $amount,
            "uid" => $uid,
            "type" => $type,
            "ref" => $ref,
            "method" => $method,
            "desc" => $desc,
            "date" => date_time(),
            "status" => 1
        );
        $this->Db_model->insert("user_wallet_ex", $data);
    }

    public function bot_transaction()
    {
        $type = array('credit', 'debit');
        $count = rand(1, 6);
        $method_num = $this->Util_model->row_count("payment_methods");
        for ($i = 1; $i <= $count; $i++) {
            $method = rand(1, $method_num);
            $uid = $this->Util_model->get_info("user_profile", "uid", "WHERE role=0 ORDER BY RAND() LIMIT 1");
            $amount = rand(100, 15000);
            shuffle($type);
            $this->add_to_wallet_ex($amount, $uid, $type[0], $method, "");
        }
    }

    public function network($uid, $level = 'all')
    {
        $first = $this->Util_model->row_count("user_referral", "WHERE refID1=$uid");
        $second = $this->Util_model->row_count("user_referral", "WHERE refID2=$uid");
        $third = $this->Util_model->row_count("user_referral", "WHERE refID3=$uid");
        if ($level == 1) {
            $return = $first;
        } else if ($level == 2) {
            $return = $second;
        } else if ($level == 3) {
            $return = $third;
        } else {
            $return = $first + $second + $third;
        }
        return $return;
    }

    public function break_cell($cid)
    {
        $return = false;
        if ($this->Util_model->row_count("user_cell", "WHERE cid=$cid") == $this->Util_model->get_option("cell_members")) {
            $cell = $this->Util_model->get_info("cell", "*", "WHERE cid=$cid");

            $leader_comm = round(get_percentage($cell['worth'], $this->Util_model->get_option('cell_leader_comm')), 2);
            $member_comm = round(get_percentage($cell['worth'], $this->Util_model->get_option('cell_members_comm')), 2);
            $cell_leader1 = $cell['leader'];
            $s = $this->Db_model->selectGroup("uid", "user_cell", "WHERE cid=$cid AND uid<>$cell_leader1");
            $cell_leader2 = 0;
            $cell_leader2_worth = 0;
            foreach ($s->result_array() as $row) {
                $worth = $this->Util_model->get_user_info($row['uid'], "net_worth", "profile");
                if ($worth > $cell_leader2_worth) {
                    $cell_leader2 = $row['uid'];
                    $cell_leader2_worth = $worth;
                }
            }
            $new_cell_count = ($this->Util_model->get_option("cell_members") - 2) / 2;

            $s = $this->Db_model->selectGroup("uid", "user_cell", "WHERE cid=$cid AND uid<>$cell_leader1 ORDER BY id LIMIT " . $new_cell_count);
            foreach ($s->result_array() as $row) {
                $this->add_to_bonus(
                    $member_comm,
                    $row['uid'],
                    0,
                    "Group",
                    "",
                    1
                );
            } // Add members commission
            $this->add_to_bonus(
                $leader_comm,
                $cell_leader1,
                0,
                "Group",
                "",
                1
            ); //Leader commission
            if ($this->Db_model->insert("cell", ["cid" => $this->Util_model->generate_id(11111111, 99999999, 'cell', 'cid', 'int'), "leader" => $cell_leader2, "members" => ($new_cell_count + 1), "status" => 1])) {
                $cid2 = $this->Util_model->get_info("cell", "cid", "WHERE status=1 ORDER BY id DESC LIMIT 1"); //Get the cell ID of the new cell
                $this->Db_model->update("user_cell", ["cid" => $cid2], "WHERE uid=$cell_leader2"); //Change the cell ID of the new cell leader
                $s = $this->Db_model->selectGroup("uid", "user_cell", "WHERE cid=$cid AND uid<>$cell_leader1 ORDER BY RAND() LIMIT $new_cell_count");
                foreach ($s->result_array() as $row) {
                    $this->Db_model->update("user_cell", ["cid" => $cid2], "WHERE uid=$row[uid]");
                }
                $this->Db_model->update("cell", ["members" => ($new_cell_count + 1), "worth" => 0], "WHERE cid=$cid"); //Update the old cell to the new members count
                $return = true;
            }
        }
        return $return;
    }

    public function add_cell_member($uid, $amount)
    {
        if ($this->Util_model->row_count("user_cell", "WHERE uid=$uid") == 0) {
            $refID = $this->Util_model->get_info("user_referral", "refID1", "WHERE uid=$uid");
            $cid = $this->Util_model->get_info("user_cell", "cid", "WHERE uid=$refID");
            if ($this->Db_model->insert("user_cell", ["uid" => $uid, "cid" => $cid])) {
                $cell_worth = $this->Util_model->get_info("cell", "worth", "WHERE cid=$cid");
                $cell_worth += $amount;
                $this->Db_model->update("cell", ["worth" => $cell_worth, "date" => date_time()], "WHERE cid=$cid");
                $this->break_cell($cid);
            }
        }
    }

    private function get_level_id($worth)
    {
        $s = $this->Db_model->selectGroup("id, start", "level", "ORDER BY start DESC");
        $level = 0;
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                if ($worth >= $row['start']) {
                    $level = $row['id'];
                    break;
                }
            }
        }
        return $level;
    }

    public function update_networth($uid, $amount)
    {
        $refids = [
            $this->Util_model->get_user_info($uid, "refID1", "referral"),
            $this->Util_model->get_user_info($uid, "refID2", "referral"),
            $this->Util_model->get_user_info($uid, "refID3", "referral")
        ];
        $ids = array();
        foreach ($refids as $id) {
            if (!in_array($id, $ids) && $id > 0) {
                $ids[] = $id;
            }
        }
        foreach ($ids as $id) {
            if ($id > 0) {
                $info = $this->Util_model->get_info("user_profile", "net_worth, level, role", "WHERE uid=$id");
                $worth = $info['net_worth'] + $amount;
                $level = $this->get_level_id($worth);
                $this->Db_model->update("user_profile", ["net_worth" => $worth, "level" => $level], "WHERE uid=$id");
                if ($info['level'] > 0) {
                    if ($level > $info['level']) {
                        $this->add_to_wallet(
                            $this->Util_model->get_info("level", "reward", "WHERE id=$info[level]"),
                            $id,
                            0,
                            "Reward for completion of " . $this->Util_model->get_info("level", "name", "WHERE id=$info[level]"),
                            "Reward for completion of " . $this->Util_model->get_info("level", "name", "WHERE id=$info[level]"),
                            "Level Reward",
                            "Level " . $this->Util_model->get_info("level", "name", "WHERE id=$info[level]") . " Reward",
                            '',
                            1
                        );
                        if ($this->Util_model->get_info("level", "coordinator", "WHERE id=$level") == 1 && $info['role'] == 1) {
                            $this->Db_model->update("user_profile", ["role" => 2], "WHERE uid=$id");
                            $s = $this->Db_model->selectGroup("uid", "user_referral", "WHERE refID1=$id");
                            if ($s->num_rows() > 0) {
                                foreach ($s->result_array() as $row) {
                                    $this->Db_model->update("user_referral", ["coordinator" => $id], "WHERE uid=$row[uid]");
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function invest($plan_id, $amount, $uid = NULL)
    {
        $uid = ($uid == NULL) ? $this->session->userdata(UID) : $uid;
        $plan = $this->Util_model->get_info("plans", "id, name, type, duration", "WHERE id=$plan_id");
        $wallet = $this->add_to_wallet($amount, 0, $uid, "Forex investment", "Forex investment", "Investment", "$plan[type] ($plan[name])", "", 1);
        if ($wallet['return']) {
            $data = array(
                "uid" => $uid,
                "plan" => $plan['id'],
                "type" => $plan['type'],
                "amount" => $amount,
                "profit" => 0,
                "duration" => $plan['duration'],
                "status" => 0,
                "start" => date_time()
            );
            $this->Db_model->insert("investment", $data);
            $first = $this->Util_model->get_user_info($uid);
            $email = $this->Util_model->get_user_info($uid, "email", "profile");

            /* Plan names
            Bronze
            Silver
            Gold
            Diamond
             */
            // Personalized email content for each plan
            $planName = strtoupper($plan["name"]);
            $firstName = $first; // already fetched above

            if ($planName == "BRONZE") {
                $subject = "Congratulations on Taking the First Step!";
                $text = "
                        <p><strong>Dear $firstName,</strong></p>
                        <p>Congratulations on your successful deposit into the <strong>Bronze Plan</strong> — you've taken an exciting first step toward building your financial future!</p>
                        <p>Every great journey begins with a single move, and we’re thrilled to be part of yours. Our team is here to support you every step of the way as your investment grows. Stay focused, stay confident — your goals are within reach!</p>
                        <p>If you have any questions or need assistance, feel free to reach out. We’re always here to help.</p>
                        <p>To your success,<br>JTINVEST Support Team</p>
                    ";
                $this->Mail_model->send_mail($email, $subject, $text);
            } elseif ($planName == "SILVER") {
                $subject = "Congratulations on Your Silver VIP Investment Milestone!";
                $text = "
                    <p><strong>Dear $firstName,</strong></p>
                    <p>We are thrilled to congratulate you on your recent deposit into your <strong>Silver VIP Special Investment Plan</strong>. Your decision reflects both vision and confidence—qualities that set you apart as a truly discerning investor.</p>
                    <p>Congratulations on your 30 days Silver VIP investment plan. At JTINVEST, we are honored to be your trusted financial partner. Your commitment to your financial goals inspires us, and we are dedicated to providing you with premium support, tailored strategies, and exclusive insights to help you grow and protect your wealth.</p>
                    <p>Welcome to a new chapter of opportunity, privilege, and potential. Together, we will build a future that rewards your ambition.</p>
                    <p>Warmest congratulations once again,<br>Support Manager<br>JTINVEST</p>
                ";
                $this->Mail_model->send_mail($email, $subject, $text);
            } elseif ($planName == "GOLD") {
                $subject = "Congratulations on Your GOLD VIP Investment Milestone!";
                $text = "
                    <p><strong>Dear $firstName,</strong></p>
                    <p>We are thrilled to congratulate you on your recent deposit into your <strong>GOLD VIP Special Investment Plan</strong>. Your decision reflects both vision and confidence—qualities that set you apart as a truly discerning investor.</p>
                    <p>Congratulations on your 60 days GOLD VIP investment plan. At JTINVEST, we are honored to be your trusted financial partner. Your commitment to your financial goals inspires us, and we are dedicated to providing you with premium support, tailored strategies, and exclusive insights to help you grow and protect your wealth.</p>
                    <p>Welcome to a new chapter of opportunity, privilege, and potential. Together, we will build a future that rewards your ambition.</p>
                    <p>Warmest congratulations once again,<br>Support Manager<br>JTINVEST</p>
                ";
                $this->Mail_model->send_mail($email, $subject, $text);
            } elseif ($planName == "DIAMOND") {
                $subject = "Congratulations on Your DIAMOND VIP Investment Milestone!";
                $text = "
                    <p><strong>Dear $firstName,</strong></p>
                    <p>We are thrilled to congratulate you on your recent deposit into your <strong>DIAMOND VIP Special Investment Plan</strong>. Your decision reflects both vision and confidence—qualities that set you apart as a truly discerning investor.</p>
                    <p>Congratulations on your 90 days DIAMOND VIP investment plan. At JTINVEST, we are honored to be your trusted financial partner. Your commitment to your financial goals inspires us, and we are dedicated to providing you with premium support, tailored strategies, and exclusive insights to help you grow and protect your wealth.</p>
                    <p>Welcome to a new chapter of opportunity, privilege, and potential. Together, we will build a future that rewards your ambition.</p>
                    <p>Warmest congratulations once again,<br>Support Manager<br>JTINVEST</p>
                ";
                $this->Mail_model->send_mail($email, $subject, $text);
            }

            //Net worth addition
            $ref = $this->Util_model->get_info("user_referral", "*", "WHERE uid=$uid");
            /*for ($i=1; $i<=3; $i++) {
                if ($ref["refID$i"] != 0) {
                    $net_worth = $this->Util_model->get_user_info($ref["refID$i"], "net_worth", "profile");
                    $net_worth += $amount;
                    $this->Db_model->update("user_profile", ["net_worth" => $net_worth], "WHERE uid=" . $ref["refID$i"]);
                }
            }*/
            //---------------------------
            if ($ref['refID1'] > 0) {
                $this->add_to_bonus(
                    get_percentage($amount, $this->Util_model->get_option('referral1')),
                    $ref['refID1'],
                    0,
                    'Referral',
                    "",
                    1
                );
            } // Add referral bonus to the 1st upliner
            if ($ref['refID2'] > 0) {
                $this->add_to_bonus(
                    get_percentage($amount, $this->Util_model->get_option('referral2')),
                    $ref['refID2'],
                    0,
                    'Referral',
                    "",
                    1
                );
            } // Add referral bonus to the 2nd upliner
            if ($ref['refID3'] > 0) {
                $this->add_to_bonus(
                    get_percentage($amount, $this->Util_model->get_option('referral3')),
                    $ref['refID3'],
                    0,
                    'Referral',
                    "",
                    1
                );
            } // Add referral bonus to the 3rd upliner
            if ($ref['coordinator'] > 0) {
                $this->add_to_bonus(
                    get_percentage($amount, $this->Util_model->get_option('coordinator_comm')),
                    $ref['coordinator'],
                    0,
                    'Coordinator',
                    "",
                    1
                );
            } // Add referral bonus to the 3rd upliner

            $this->update_networth($uid, $amount); //Update the networth of all the upliners
            if ($this->Util_model->row_count("investment", "WHERE uid=$uid") == 1) {
                $this->Db_model->update("user_profile", ["level" => 1], "WHERE uid=$uid"); // mAKE AN INVESTOR
                $this->add_cell_member($uid, $amount); //Add member to a cell if he/she doesn't belong to any
            }

            $return = array(
                "status" => true,
                "msg" => "<i class='fa fa-check-circle'></i> Investment was booked successfully."
            );
        } else {
            $return = array(
                "status" => false,
                "msg" => "<i class='fa fa-times-circle'></i> An error occurred. Try again shortly"
            );
        }
        return $return;
    }

}

?>