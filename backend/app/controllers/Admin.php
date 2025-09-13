<?php

/**
 * Created by PhpStorm.
 * User: testing
 * Date: 8/15/2019
 * Time: 12:57 AM
 */
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->Util_model->log_redirect();
        if (!$this->session->has_userdata(A_UID) || $this->session->userdata(A_UID) != $this->session->userdata(UID)) {
            redirect(base_url());
        }
    }

    public function index()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
        </ol>
        ';
        $this->load->model('users/Users_model', 'users');
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "users";
        $data['main_content'] = 'admin/users';
        $this->load->view('layouts/main', $data);
    }

    public function transactions()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-exchange"></i> Transaction</a></li>
        </ol>
        ';
        $data['style'] = "<link rel='stylesheet' href='" . base_url() . "assets/plugins/datatables/datatables.min.css'>";
        $data['tab'] = "transactions";
        $data['main_content'] = 'admin/transactions';
        $this->load->view('layouts/main', $data);
    }
    public function options()
    {
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-gear"></i> Options</a></li>
        </ol>
        ';
        $data['tab'] = "options";
        $data['main_content'] = 'admin/options';
        $this->load->view('layouts/main', $data);
    }

    public function options_save()
    {
        $this->form_validation->set_rules("referral_bonus", "Referral bonus", "trim|numeric");
        $this->form_validation->set_rules("btc_address", "Bitcoin address", "trim");
        $this->form_validation->set_rules("eth_address", "Binance address", "trim");
        $this->form_validation->set_rules("usdt_address", "USDT address", "trim");

        $this->form_validation->set_rules("bank_name", "Bank name", "trim");
        $this->form_validation->set_rules("account_name", "Account name", "trim");
        $this->form_validation->set_rules("account_number", "Account number", "trim");
        $this->form_validation->set_rules("account_type", "Bank branch", "trim");
        $this->form_validation->set_rules("branch", "Branch", "trim");
        $this->form_validation->set_rules("beneficiary_reference", "Beneficiary reference", "trim|numeric");

        //$this->form_validation->set_rules("pm_account", "Perfect Money account number", "trim");

        if ($this->form_validation->run() == true) {
            $this->Db_model->update("options", ["value" => $this->input->post("referral_bonus")], "WHERE name='referral_bonus'");
            $this->Db_model->update("options", ["value" => $this->input->post("btc_address")], "WHERE name='btc_address'");
            $this->Db_model->update("options", ["value" => $this->input->post("eth_address")], "WHERE name='eth_address'");
            $this->Db_model->update("options", ["value" => $this->input->post("usdt_address")], "WHERE name='usdt_address'");

            $this->Db_model->update("options", ["value" => $this->input->post("bank_name")], "WHERE name='bank_name'");
            $this->Db_model->update("options", ["value" => $this->input->post("account_name")], "WHERE name='account_name'");
            $this->Db_model->update("options", ["value" => $this->input->post("account_number")], "WHERE name='account_number'");
            $this->Db_model->update("options", ["value" => $this->input->post("account_type")], "WHERE name='account_type'");
            $this->Db_model->update("options", ["value" => $this->input->post("branch")], "WHERE name='branch'");
            $this->Db_model->update("options", ["value" => $this->input->post("beneficiary_reference")], "WHERE name='beneficiary_reference'");
            //$this->Db_model->update("options", ["value" => $this->input->post("pm_account")], "WHERE name='pm_account'");
            $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-check-circle'></i> Options updated successfully", "alert-success", 1));
        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        redirect(base_url() . "admin/options");
    }

    public function bot_transactions()
    {
        $this->Main_model->bot_transaction();
        echo true;
    }

    public function add_bonus()
    {
        $this->form_validation->set_rules("username", "Username", "required|trim");
        $this->form_validation->set_rules("amount", "Amount", "required|trim");

        if ($this->form_validation->run() == TRUE) {
            if ($this->Util_model->row_count("user_profile", "WHERE username='$_POST[username]'") > 0) {
                $uid = $this->Util_model->get_info("user_profile", "uid", "WHERE username='$_POST[username]'");
                if ($this->Main_model->add_to_wallet($this->input->post("amount"), $uid, 0, "Account top up", "Account top up", "Bonus", "", "", 1)['return']) {
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-checks-circle'></i> Bonus added successfully", "alert-success", 1));
                }
            } else {
                $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times-circle'></i> The user with that username doesn't exist", "alert-danger", 1));
            }
        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-money"></i> Add bonus</a></li>
        </ol>
        ';
        $data['tab'] = "bonus";
        $data['main_content'] = 'admin/add_bonus';
        $this->load->view('layouts/main', $data);
    }

    public function newsletter()
    {
        $this->form_validation->set_rules("receiver", "Receiver", "required|trim");
        $this->form_validation->set_rules("subject", "Subject", "required|trim");

        if ($this->form_validation->run() == TRUE) {
            $btn_href = (empty($this->input->post("button_href"))) ? base_url() : $this->input->post("button_href");
            $btn_text = (empty($this->input->post("button_label"))) ? "Visit Our Site" : $this->input->post("button_label");
            $markups = array(
                "[TEXT]" => $this->input->post("message"),
                "[BUTTON]" => "<a href='$btn_href'>$btn_text</a>",
                "[NAME]" => (empty($this->input->post("name"))) ? "Sir/Madam" : $this->input->post("name"),
                "[ADDITIONAL_TEXT]" => $this->input->post("additional_text")
            );

            $recipient = rtrim(trim($this->input->post('receiver')), ',');
            $label = (empty($this->input->post("label"))) ? SITE_TITLE : $this->input->post("label");
            if (strstr($recipient, ",")) {
                $success = 0;
                $recipient = explode(",", $recipient);
                foreach ($recipient as $to) {
                    if ($this->Mail_model->send_mail($to, $this->input->post("subject"), $markups, $label)) {
                        $success++;
                    }
                }
                if ($success == count($recipient)) {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-check-circle'></i> Message sent successfully to $success emails", "alert-success", 1));
                } else if ($success > 0) {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Message sent to only $success out of " . count($recipient), "alert-danger", 1));
                } else {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Error sending message. Please try again", "alert-danger", 1));
                }
            } else {
                if ($this->Mail_model->send_mail($recipient, $this->input->post("subject"), $markups, $label)) {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-check-circle'></i> Message sent successfully", "alert-success", 1));
                } else {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Error sending message", "alert-danger", 1));
                }
            }

        } else {
            $this->session->set_flashdata("msg", validation_errors());
        }
        $data['breadcrumb'] = '
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-envelope"></i> Newsletter</a></li>
        </ol>
        ';
        $data['style'] = "<link href='https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css' rel='stylesheet'>";
        $data['tab'] = "newsletter";
        $data['main_content'] = 'admin/newsletter';
        $this->load->view('layouts/main', $data);
    }

}

?>