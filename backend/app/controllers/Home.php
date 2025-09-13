<?php
/**
 *  
 */

class Home extends CI_Controller
{
    private $page_limit = 50, $featured, $style;

    public function __construct()
    {
        parent::__construct();
        $this->Util_model->log_redirect();
    }

    public function index()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
        ';
        $data['tab'] = "home";
        $data['main_content'] = 'users/home';
        $this->load->view('layouts/main', $data);
    }

    public function fund()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-money"></i> Fund Account</li>
        </ol>
        ';
        $data['tab'] = "fund";
        $data['main_content'] = 'users/fund';
        $this->load->view('layouts/main', $data);
    }

    public function forex()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-bar-chart"></i> Forex Plan</li>
        </ol>
        ';
        $data['tab'] = "forex";
        $data['main_content'] = 'users/forex';
        $this->load->view('layouts/main', $data);
    }

    public function crypto()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-bitcoin"></i> Crypto Plan</li>
        </ol>
        ';
        $data['tab'] = "crypto";
        $data['main_content'] = 'users/crypto';
        $this->load->view('layouts/main', $data);
    }

    public function investment()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-cubes"></i> Investment</li>
        </ol>
        ';
        $data['tab'] = "investment";
        $data['main_content'] = 'users/investment';
        $this->load->view('layouts/main', $data);
    }

    public function fund_list()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-exchange"></i> Fund List</li>
        </ol>
        ';
        $data['tab'] = "fund_list";
        $data['main_content'] = 'users/fund_list';
        $this->load->view('layouts/main', $data);
    }

    public function card()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-credit-card"></i> Card</li>
        </ol>
        ';
        $data['tab'] = "card";
        $data['main_content'] = 'users/card';
        $this->load->view('layouts/main', $data);
    }

    public function withdraw()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-circle-o-notch"></i> Withdraw Fund</li>
        </ol>
        ';
        $data['tab'] = "withdraw";
        $data['main_content'] = 'users/withdraw';
        $this->load->view('layouts/main', $data);
    }

    public function referrals()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-sitemap"></i> My Network</li>
        </ol>
        ';
        $data['tab'] = "referrals";
        $data['main_content'] = 'users/referrals';
        $this->load->view('layouts/main', $data);
    }

    public function add_member()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user-plus"></i> Register</li>
        </ol>
        ';
        $data['tab'] = "register";
        $data['main_content'] = 'users/register';
        $this->load->view('layouts/main', $data);
    }

    public function invest()
    {
        $plan = $this->input->post("plan");
        $amount = $this->input->post("amount");

        if ($this->General_model->get_balance($this->session->userdata(UID), false) >= $amount) {
            $return = $this->Main_model->invest($plan, $amount);
        } else {
            $return = array(
                "status" => false,
                "msg" => "<i class='fa fa-times-circle'></i> Insufficient balance. <a href='" . base_url() . "fund'>Fund account</a>"
            );
        }

        echo json_encode($return);
    }

    public function book_funding()
    {
        $this->form_validation->set_rules("method", "Payment method", "trim|required");
        $this->form_validation->set_rules("trans_id", "Transaction ID", "trim|required");
        $this->form_validation->set_rules("amount", "Amount", "trim|required|numeric");

        if ($this->form_validation->run() == TRUE) {
            $amount = $this->input->post("amount");
            $method = $this->input->post("method");
            $trans_id = $this->input->post("trans_id");

            if ($this->Util_model->row_count("user_wallet", "WHERE type LIKE '%$trans_id'") > 0) {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> The transaction ID already exist. Check and try again", "alert-danger", 1));
                redirect(base_url() . "fund");
            } else {
                $uid = $this->session->userdata(UID);
                $data = [
                    "amount" => $amount,
                    "creditor" => $uid,
                    "debitor" => 0,
                    "creditor_desc" => "Account funding",
                    "debitor_desc" => "Account funding",
                    "type" => "Funding $trans_id",
                    "extra" => ucwords($method) . " $" . number_format($amount) . " ($trans_id)",
                    "ref" => $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "var", true, 'fb')
                ];
                $this->Db_model->insert("user_wallet", $data);
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Fund booked successfully. Awaiting confirmation from admin", "alert-success", 1));
                $first = $this->Util_model->get_user_info($uid);
                $date = date("Y-m-d");
                $text = "
                    <p><strong>Dear $first,</strong></p>
                    <h3><strong>Pending Deposit</strong> - $$amount is yet to be approved and deposited to your Account</h3>
                    <p>This email is to inform you that you made a recent deposit of <strong>$$amount</strong>&nbsp;to your account
                        on <strong>$date</strong>.</p>
                    <p><strong>Transaction Details:</strong></p>
                    <ul>
                        <li><strong>Deposit Amount:</strong> $$amount</li>
                        <li><strong>Date:</strong> $date</li>
                        <li>Status: Pending</li>
                    </ul>
                ";
                $email = $this->Util_model->get_user_info($uid, "email", "profile");
                $this->Mail_model->send_mail($email, "Deposit Pending", $text);
                redirect(base_url() . "fund-list");
            }
        } else {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> An error occured while booking fund. Try again later", "alert-danger", 1));
            redirect(base_url() . "fund");
        }
    }

    public function book_funding_bank_transfer()
    {
        $this->form_validation->set_rules("bank_name", "Bank name", "trim|required");
        $this->form_validation->set_rules("account_name", "Account name", "trim|required");
        $this->form_validation->set_rules("account_number", "Account number", "trim|required|numeric");
        $this->form_validation->set_rules("branch", "Bank branch", "trim|required");
        $this->form_validation->set_rules("country", "Country", "trim|required");
        $this->form_validation->set_rules("amount", "Amount", "trim|required|numeric");

        if ($this->form_validation->run() == TRUE) {
            $bank_name = $this->input->post("bank_name");
            $account_name = $this->input->post("account_name");
            $account_number = $this->input->post("account_number");
            $branch = $this->input->post("branch");
            $country = $this->input->post("country");
            $amount = $this->input->post("amount");

            /* if ($this->Util_model->row_count("user_wallet", "WHERE type LIKE '%$trans_id'") > 0) {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> The transaction ID already exist. Check and try again", "alert-danger", 1));
                redirect(base_url()."fund");
            } else { */
            $details = "
                    type:Bank Transfer::
                    bank_name:$bank_name::
                    account_name:$account_name::
                    account_number:$account_number::
                    branch:$branch::
                    country:$country::
                    amount:$amount
                ";

            $data = [
                "amount" => $amount,
                "creditor" => $this->session->userdata(UID),
                "debitor" => 0,
                "creditor_desc" => "Account funding",
                "debitor_desc" => "Account funding",
                "type" => "Deposit",
                "extra" => $details,
                "ref" => $this->Util_model->generate_id(1111111111, 9999999999, "user_wallet", "ref", "var", true, 'fb')
            ];
            $this->Db_model->insert("user_wallet", $data);
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Fund booked successfully. Awaiting confirmation from admin", "alert-success", 1));
            $uid = $this->session->userdata(UID);
            $first = $this->Util_model->get_user_info($uid);
            $date = date("Y-m-d");
            $text = "
                <p><strong>Dear $first,</strong></p>
                <h3><strong>Pending Deposit</strong> - $$amount is yet to be approved and deposited to your Account</h3>
                <p>This email is to inform you that you made a recent deposit of <strong>$$amount</strong>&nbsp;to your account
                    on <strong>$date</strong>.</p>
                <p><strong>Transaction Details:</strong></p>
                <ul>
                    <li><strong>Deposit Amount:</strong> $$amount</li>
                    <li><strong>Date:</strong> $date</li>
                    <li>Status: Pending</li>
                </ul>
            ";
            $email = $this->Util_model->get_user_info($uid, "email", "profile");
            $this->Mail_model->send_mail($email, "Deposit Pending", $text);
            redirect(base_url() . "fund-list");
            //}
        } else {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> An error occured while booking fund. Try again later", "alert-danger", 1));
            redirect(base_url() . "fund");
        }
    }

    public function book_withdrawal_bank_transfer()
    {
        $this->form_validation->set_rules("bank_name", "Bank name", "trim|required");
        $this->form_validation->set_rules("account_name", "Account name", "trim|required");
        $this->form_validation->set_rules("account_number", "Account number", "trim|required|numeric");
        $this->form_validation->set_rules("account_type", "Bank branch", "trim|required");
        $this->form_validation->set_rules("branch", "Country", "trim|required");
        $this->form_validation->set_rules("beneficiary_reference", "Beneficiary reference", "trim|required|numeric");
        $this->form_validation->set_rules("bank_amount", "Amount", "trim|required|numeric");
        $this->form_validation->set_rules("bank_password", "Account password", "trim|required");

        if ($this->form_validation->run()) {
            $bank_name = $this->input->post("bank_name");
            $account_name = $this->input->post("account_name");
            $account_number = $this->input->post("account_number");
            $account_type = $this->input->post("account_type");
            $branch = $this->input->post("branch");
            $beneficiary_reference = $this->input->post("beneficiary_reference");
            $bank_amount = $this->input->post("bank_amount");
            $bank_password = $this->input->post("bank_password");

            if (!$this->confirm_password($bank_password)) {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Incorrect password. Check and try again", "alert-danger", 1));
            } else {
                $details = "
                    bank_name:$bank_name::
                    account_name:$account_name::
                    account_number:$account_number::
                    account_type:$account_type::
                    branch:$branch::
                    beneficiary_reference:$beneficiary_reference::
                    bank_amount:$bank_amount
                ";

                $wallet = $this->Main_model->add_to_wallet($bank_amount, 0, $this->session->userdata(UID), "Withdrawal", "Withdrawal", "Withdraw", $details);

                if ($wallet['return']) {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Withdrawal booked successfully", "alert-success", 1));
                    $uid = $this->session->userdata(UID);
                    $first = $this->Util_model->get_user_info($uid);
                    $date = date("Y-m-d");
                    $text = "
                        <p><strong>Dear $first,</strong></p>
                        <h3><strong>Pending withdrawal</strong> - $$bank_amount is yet to be approved and deposited to your Account</h3>
                        <p>This email is to inform you that you made a recent deposit of <strong>$$bank_amount</strong>&nbsp;to your account
                            on <strong>$date</strong>.</p>
                        <p><strong>Transaction Details:</strong></p>
                        <ul>
                            <li><strong>Amount:</strong> $$bank_amount</li>
                            <li><strong>Date:</strong> $date</li>
                            <li>Status: Pending</li>
                        </ul>
                    ";
                    $email = $this->Util_model->get_user_info($uid, "email", "profile");
                    $this->Mail_model->send_mail($email, "Withdrawal Request", $text);
                } else {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Withdrawal booked unsuccessfully", "alert-danger", 1));
                }
            }
        } else {
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> " . validation_errors('<p>', '</p>'), "alert-danger", 1));
        }
        redirect(base_url() . "withdraw");
    }

    public function confirm_password($password)
    {
        if (base64_encode($password) == $this->Util_model->get_user_info($this->session->userdata(UID), 'password', 'profile')) {
            return true;
        }
        return false;
    }

    public function confirm_order($order_id)
    {
        $s = $this->Db_model->selectGroup("ref", "user_wallet", "WHERE type LIKE '%$order_id'");
        if ($s->num_rows() > 0) {
            $row = $s->row_array();
            $this->load->model("Crypto_payment_model", "crypto");
            $order = $this->crypto->confirm_order($row['ref']);
            if ($order['status']) {
                $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$row[ref]'");
            } else {
                $this->Db_model->update("user_wallet", ["status" => 2], "WHERE ref='$row[ref]'");
            }
        }
        redirect(base_url() . "fund-list");
    }

    public function cashout()
    {
        $amount = $this->input->post("amount");
        if ($amount > 0) {
            $keys = array("ROI", "Referral", "Group", "Reinvest", "Coordinator");
            for ($i = 0; $i < count($keys); $i++) {
                $bonus = $this->General_model->get_balance($this->session->userdata(UID), false, true, $keys[$i]);
                $threshold = $this->Util_model->get_option(strtolower($keys[$i]) . "_threshold");
                if ($bonus > 0) {
                    $times = floor($bonus / $threshold);
                    $available = $times * $threshold;
                    $this->Main_model->add_to_bonus($available, 0, $this->session->userdata(UID), $keys[$i], "", 1);
                }
            }
            if ($this->Main_model->add_to_wallet($amount, $this->session->userdata(UID), 0, "Commission cashout", "Commission cashout", "Cashout", "", "", 1)['return']) {
                $return = [
                    "status" => true,
                    "msg" => "<i class='fa fa-check-circle'></i> " . USD . number_format($amount) . " credited to wallet and available for withdrawal"
                ];
            } else {
                $return = [
                    "status" => false,
                    "msg" => "<i class='fa fa-times-circle'></i> Error: An error occured cashing out revenues. Try again"
                ];
            }
        } else {
            $return = [
                "status" => false,
                "msg" => "<i class='fa fa-times-circle'></i> Error: Amount must be greater than " . USD . "0.00"
            ];
        }
        echo json_encode($return);
    }

    public function reinvest()
    {
        $amount = $this->input->post('amount');
        if ($amount >= 20) {
            $s = $this->Db_model->selectGroup("*", "plans", "WHERE status=1 ORDER BY min_amt DESC");
            $plan = 0;
            foreach ($s->result_array() as $row) {
                if ($amount >= $row['min_amt']) {
                    $plan = $row['id'];
                    break;
                }
            }
            if ($plan > 0) {
                $keys = array("ROI", "Referral", "Group", "Reinvest", "Coordinator");
                for ($i = 0; $i < count($keys); $i++) {
                    $bonus = $this->General_model->get_balance($this->session->userdata(UID), false, true, $keys[$i]);
                    $threshold = $this->Util_model->get_option(strtolower($keys[$i]) . "_threshold");
                    if ($bonus > 0) {
                        $times = floor($bonus / $threshold);
                        $available = $times * $threshold;
                        $this->Main_model->add_to_bonus($available, 0, $this->session->userdata(UID), $keys[$i], "", 1);
                    }
                }
                if ($this->Main_model->add_to_wallet($amount, $this->session->userdata(UID), 0, "Commission cashout", "Commission cashout", "Cashout", "", "", 1)['return']) {
                    $invest = $this->Main_model->invest($plan, $amount);
                    if ($invest['status']) {
                        $comm = get_percentage($amount, $this->Util_model->get_option("reinvest_comm"));
                        $this->Main_model->add_to_bonus($comm, $this->session->userdata(UID), 0, 'Reinvest', "", 1);
                    }
                    $return = $invest;
                } else {
                    $return = [
                        "status" => false,
                        "msg" => "<i class='fa fa-times-circle'></i> Unable to complete operation at the moment"
                    ];
                }
            } else {
                $return = [
                    "status" => false,
                    "msg" => "<i class='fa fa-times-circle'></i> Amount doesn't fit any plan"
                ];
            }
        } else {
            $return = [
                "status" => false,
                "msg" => "<i class='fa fa-times-circle'></i> Amount must be more than " . USD . "20.00"
            ];
        }
        echo json_encode($return);
    }

    public function withdraw_fund()
    {
        if ($_POST['amount'] > $this->General_model->get_balance($this->session->userdata(UID), false)) {
            echo 0;
        } else {
            $wallet = $this->Main_model->add_to_wallet($_POST['amount'], 0, $this->session->userdata(UID), "Withdrawal", "Withdrawal", "Withdraw", $_POST['method'] . " (" . rtrim($_POST['details'], ', ') . ")");
            if ($wallet['return']) {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Withdrawal booked successfully.", "alert-success", 1));
                $uid = $this->session->userdata(UID);
                $first = $this->Util_model->get_user_info($uid);
                $amount = $_POST['amount'];
                $date = date("Y-m-d");
                $text = "
                    <p><strong>Dear $first,</strong></p>
                    <h3><strong>Pending withdrawal</strong> - $$amount is yet to be approved and deposited to your Account</h3>
                    <p>This email is to inform you that you made a recent deposit of <strong>$$amount</strong>&nbsp;to your account
                        on <strong>$date</strong>.</p>
                    <p><strong>Transaction Details:</strong></p>
                    <ul>
                        <li><strong>Amount:</strong> $$amount</li>
                        <li><strong>Date:</strong> $date</li>
                        <li>Status: Pending</li>
                    </ul>
                ";
                $email = $this->Util_model->get_user_info($uid, "email", "profile");
                $this->Mail_model->send_mail($email, "Withdrawal Request", $text);
                echo 1;
            } else {
                echo 2;
            }
        }
    }

    public function profile($username = NULL)
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><i class="fa fa-user"></i> My Profile</li>
        </ol>
        ';
        if ($username == NULL) {
            $pro = $this->Util_model->get_info("user_profile", "*", "WHERE uid=" . $this->session->userdata(UID));
            $data['pro'] = [
                "name" => $this->Util_model->get_user_info($this->session->userdata(UID)),
                "email" => $pro['email'],
                "phone" => $this->Util_model->get_info("countries", "phone_code", "WHERE id=$pro[country]") . $pro['phone'],
                "username" => $pro['username']
            ];
            $data['uid'] = 0;
        } else {
            $uid = $this->Util_model->get_info("user_profile", "uid", "WHERE username='$username'");
            if ($uid) {
                $data['uid'] = $uid;
            }
        }
        $data['tab'] = "profile";
        $data['main_content'] = 'users/profile';
        $this->load->view('layouts/main', $data);
    }

    public function update_personal()
    {
        $this->form_validation->set_rules("name", "Name", "trim|required");
        if ($this->form_validation->run() == TRUE) {
            if ($this->Db_model->update("user_main", ["name" => $this->input->post('name')], "WHERE uid=" . $this->session->userdata(UID))) {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Personal details updated successfully", "alert-success", 1));
            } else {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Unsuccessful: An error occured", "alert-danger", 1));
            }
        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        redirect(base_url() . "profile");
    }

    public function update_password()
    {
        $this->form_validation->set_rules('new_password', 'Password', 'trim|required|alpha_numeric|min_length[6]|max_length[50]');
        $this->form_validation->set_rules('con_password', 'Confirm password', 'trim|required|matches[new_password]');

        if ($this->form_validation->run() == TRUE) {
            $this->load->model("users/Users_model", "user");
            $password = base64_encode($this->input->post('cur_password'));
            $new_password = base64_encode($this->input->post('new_password'));
            if ($password == $this->Util_model->get_user_info($this->session->userdata(UID), "password", "profile")) {
                if ($this->Db_model->update("user_profile", ["password" => $new_password], "WHERE uid=" . $this->session->userdata(UID))) {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Password changed successfully", "alert-success", 1));
                } else {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Unsuccessful: An error occured", "alert-danger", 1));
                }
            } else {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> Incorrect password. Try again", "alert-danger", 1));
            }
        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        redirect(base_url() . "profile");
    }

}
?>