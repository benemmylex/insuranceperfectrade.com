<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 6/23/2017
 * Time: 1:11 PM
 */
class Ajax extends CI_Controller
{

    public function transaction_history_pane(){
        return $this->load->view("layouts/transaction_history_pane", array()) ;
    }

    public function get_balance()
    {
        echo $this->General_model->get_balance($this->session->userdata(UID));
    }

    public function update_status()
    {
        $this->Util_model->log_redirect();
        if (!$this->session->has_userdata(A_UID) || $this->session->userdata(A_UID) != $this->session->userdata(UID)) {
            redirect(base_url());
        }
        if ($_POST['status'] == 3) {
            $row = $this->Db_model->select('*', 'user_main', "WHERE id=$_POST[id]", 0);
            $uid = $row['uid'];
            $updated = $this->Db_model->delete("user_main", "WHERE id=$_POST[id]");
            $updated = $this->Db_model->delete("user_profile", "WHERE uid=$uid");
            if ($updated) {
                echo true;
                return true;
            } else {
                echo false;
                return false;
            }
        }
        $updated = $this->Db_model->update("$_POST[table]", ["status" => $_POST['status']], "WHERE id=$_POST[id]");
        if ($updated && $_POST['table'] == 'user_wallet') {
            $row = $this->Db_model->select('*', 'user_wallet', "WHERE id=$_POST[id]", 0);
            $uid = '';
            if ($row['debitor'] == '0') {
                $uid = $row['creditor'];
            } else {
                $uid = $row['debitor'];
            }
            $first = $this->Util_model->get_user_info($uid);
            $email = $this->Util_model->get_user_info($uid, "email", "profile");
            $date = date("Y-m-d");
            $amount = $row['amount'];

            switch ($_POST['status']) {
                case 0:
                    $text = "
                        <p><strong>Dear $first,</strong></p>
                        <h3><strong>Pending Transaction</strong> - $$amount</h3>
                        <p>This email is to inform you that your transaction of <strong>$$amount</strong>&nbsp;to your account
                            is still pending.</p>
                        <p><strong>Transaction Details:</strong></p>
                        <ul>
                            <li><strong>Amount:</strong> $$amount</li>
                            <li><strong>Date:</strong> $date</li>
                            <li>Status: Pending</li>
                        </ul>
                    ";
                    $this->Mail_model->send_mail($email, "Transaction Pending", $text);
                    break;


                case 1:
                    $text = "
                        <p><strong>Dear $first,</strong></p>
                        <p><strong></strong>&nbsp;Your Transaction has been Confirmed - $$amount</p>
                        <p>We are pleased to inform you that your recent transaction of <strong>$$amount</strong> has been confirmed and approved.</p>
                        <p><strong>Transaction Details:</strong></p>
                        <ul>
                            <li><strong>Amount:</strong> $$amount</li>
                            <li><strong>Date:</strong> $date</li>
                            <li>Status: Success</li>
                        </ul>
                    ";
                    $this->Mail_model->send_mail($email, "Transaction Confirmation", $text);
                    break;


                case 2:
                    $text = "
                        <p><strong>Dear $first,</strong></p>
                        <h3><strong>Failed Transaction</strong> - $$amount could not be verified</h3>
                        <p>This email is to inform you that your recent transaction of <strong>$$amount</strong>&nbsp;to your account is not approved.</p>
                        <p><strong>Transaction Details:</strong></p>
                        <ul>
                            <li><strong>Amount:</strong> $$amount</li>
                            <li><strong>Date:</strong> $date</li>
                            <li>Status: Failed</li>
                        </ul>
                    ";
                    $this->Mail_model->send_mail($email, "Transaction Failed", $text);
                    break;

                default:
                    break;
            }
        }

        echo $updated;
    }

    public function calculator()
    {
        $s = $this->Db_model->selectGroup("*", "plans", "WHERE status=1 ORDER BY min_amt DESC");
        $plan = 0;
        $amount = $_POST["amount"];
        foreach ($s->result_array() as $row) {
            if ($amount >= $row['min_amt']) {
                $plan = $row['roi'];
                break;
            }
        }
        if ($plan > 0) {
            $daily = get_percentage($amount, $plan);
            $weekly = $daily * 5;
            $monthly = $weekly * 4;
            $yearly = $monthly * 6;
            $return = [
                "daily" => USD . count_format($daily),
                "weekly" => USD . count_format($weekly),
                "monthly" => USD . count_format($monthly),
                "yearly" => USD . count_format($yearly)
            ];
        } else {
            $return = [
                "daily" => USD . "0",
                "weekly" => USD . "0",
                "monthly" => USD . "0",
                "yearly" => USD . "0"
            ];
        }
        echo json_encode($return);
    }

    public function list_ex_trans()
    {
        $s = $this->Db_model->selectGroup("*", "user_wallet_ex", "WHERE status=1 ORDER BY id DESC LIMIT 50");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $type = ($row['type'] == "credit") ? "Deposit of \$" . number_format($row['amount']) : "Withdrawal of \$" . number_format($row['amount']);
                $trans[] = "
                <div class='trans-details'>
                    <img src='" . base_url() . $this->Util_model->picture($row['uid']) . "'> 
                    <p>
                        $type<br>
                        By " . $this->Util_model->get_user_info($row['uid']) . "
                    </p>
                </div>
                ";
            }
        } else {
            $trans = array();
        }
        $this->output->set_output(json_encode($trans));
    }

    public function get_investment_details()
    {
        $amount = $_POST['amount'];
        $row = $this->Util_model->get_info("plans", "*", "WHERE max_amt >= $amount AND status=1 LIMIT 1");
        $this->output->set_output(json_encode(["plan" => "$row[name] ($row[roi]%)", "roi" => $row['roi']]));
    }

}

?>