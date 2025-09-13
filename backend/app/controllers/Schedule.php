<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 4/27/2018
 * Time: 1:10 AM
 */

defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{

    public function crypto_payment_confirm()
    {
        $this->load->model("Crypto_payment_model", "crypto");
        $s = $this->Db_model->selectGroup("*", "user_wallet", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $order = $this->crypto->confirm_order($row['ref']);
                if ($order['status']) {
                    $this->Db_model->update("user_wallet", ["status" => 1], "WHERE ref='$row[ref]'");
                } else {
                    $this->Db_model->update("user_wallet", ["status" => 2], "WHERE ref='$row[ref]'");
                }
            }
        }
    }

    public function investment_profit()
    {
        $s = $this->Db_model->selectGroup("*", "investment", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $uid = $row['uid'];
                $date_split = explode(" ", $row['start']);
                $plan = $this->Util_model->get_info("plans", "*", "WHERE id=$row[plan]");
                if ($row['duration'] > 0 && $date_split[0] != date_time('d')) {
                    $daily_profit = $plan['roi'];
                    $roi = get_percentage($row['amount'], $daily_profit);
                    $profit = $row['profit'] + $roi;
                    $duration = $row['duration'] - 1;
                    $this->Main_model->add_to_bonus(
                        $roi,
                        $row['uid'],
                        0,
                        "ROI",
                        "",
                        1
                    ); //ROI bonus
                    $this->Db_model->update("investment", ["duration" => $duration, "profit" => $profit], "WHERE id=$row[id]");
                    if ($duration == 0) {
                        $this->Db_model->update("investment", ["status" => 1], "WHERE id=$row[id]");
                        $this->Main_model->add_to_wallet(
                            //Return complete capital not the percentage
                            /* get_percentage( */ $row['amount'],/*  $plan['cashout']), */
                            $row['uid'],
                            0,
                            "Capital return",
                            "Capital return",
                            "Cashout",
                            $row['id'],
                            "",
                            1
                        ); //Capital return

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
                        $firstName = $first;

                        if ($planName == "BRONZE") {
                            $subject = "7days investment Plan Completed – Let’s Keep the Momentum Going!";
                            $text = "
                                <p><strong>Dear $firstName,</strong></p>
                                <p>Congratulations on successfully completing your 7days investment plan! We hope you’re pleased with the progress so far.</p>
                                <p>Your plan has now expired, and we’re excited to continue supporting your journey. We hope you are looking forward to activate your 7days plan or moving to the next plan. We look forward to your renewal deposit as soon as possible so we can help you build on the momentum you’ve started.</p>
                                <p>If you have any questions or need assistance with the renewal process, feel free to contact us anytime.</p>
                                <p>Best regards,<br>JTINVEST Support Team</p>
                            ";
                        } elseif ($planName == "SILVER") {
                            $subject = "Congratulations on Your SLIVER VIP Plan COMPLETED SUCCESSFUL – Let’s Keep the Momentum Going!";
                            $text = "
                                <p><strong>Dear $firstName,</strong></p>
                                <p>Congratulations on your 30days successfully completing your sliver VIP Special Investment Plan! We are delighted to have been part of your financial journey and commend your commitment to reaching your investment goals.</p>
                                <p>We are looking forward to see you activate your 30 days VIP investment plan. As your VIP plan has now matured, it’s the perfect time to redeposit as soon as possible to continue building on your success. To help you maintain your financial momentum, we encourage you to consider redepositing into one of our exclusive investment options designed to meet your evolving goals.</p>
                                <p>Our team is here to assist you in selecting the best plan tailored to your needs. Feel free to contact your Relationship Manager or reach out to us directly to explore your reinvestment options.</p>
                                <p>Thank you for your continued trust in JTINVEST. We look forward to helping you achieve even greater milestones.</p>
                                <p>Warm regards,<br>JTINVEST Company</p>
                            ";
                        } elseif ($planName == "GOLD") {
                            $subject = "Congratulations on Your GOLD VIP Plan COMPLETED SUCCESSFUL – Let’s Keep the Momentum Going!";
                            $text = "
                                <p><strong>Dear $firstName,</strong></p>
                                <p>Congratulations on your 60days successfully completing your GOLD VIP Special Investment Plan! We are delighted to have been part of your financial journey and commend your commitment to reaching your investment goals.</p>
                                <p>We are looking forward to see you activate your 60days VIP investment plan. As your VIP plan has now matured, it’s the perfect time to redeposit as soon as possible to continue building on your success. To help you maintain your financial momentum, we encourage you to consider redepositing into one of our exclusive investment options designed to meet your evolving goals.</p>
                                <p>Our team is here to assist you in selecting the best plan tailored to your needs. Feel free to contact your Relationship Manager or reach out to us directly to explore your reinvestment options.</p>
                                <p>Thank you for your continued trust in JTINVEST. We look forward to helping you achieve even greater milestones.</p>
                                <p>Warm regards,<br>JTINVEST Company</p>
                            ";
                        } elseif ($planName == "DIAMOND") {
                            $subject = "Congratulations on Your DIAMOND VIP Plan COMPLETED SUCCESSFUL – Let’s Keep the Momentum Going!";
                            $text = "
                                <p><strong>Dear $firstName,</strong></p>
                                <p>Congratulations on your 90days successfully completing your DIAMOND VIP Special Investment Plan! We are delighted to have been part of your financial journey and commend your commitment to reaching your investment goals.</p>
                                <p>We are looking forward to see you activate your 90days VIP investment plan. As your VIP plan has now matured, it’s the perfect time to redeposit as soon as possible to continue building on your success. To help you maintain your financial momentum, we encourage you to consider redepositing into one of our exclusive investment options designed to meet your evolving goals.</p>
                                <p>Our team is here to assist you in selecting the best plan tailored to your needs. Feel free to contact your Relationship Manager or reach out to us directly to explore your reinvestment options.</p>
                                <p>Thank you for your continued trust in JTINVEST. We look forward to helping you achieve even greater milestones.</p>
                                <p>Warm regards,<br>JTINVEST Company</p>
                            ";
                        }
                        $this->Mail_model->send_mail($email, $subject, $text);

                    }
                }
            }
        }

        /*$s = $this->Db_model->selectGroup("*", "investment", "WHERE status=0");
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $date_split = explode(" ", $row['end']);
                $plan = $this->Util_model->get_info("plans", "*", "WHERE id=$row[plan]");
                if ($row['duration'] == 0) {
                    $this->Db_model->update("investment", ["status" => 1], "WHERE id=$row[id]");
                } else {
                    //$end_date = get_next_prev_date(date_time(), 7, "next", "Y-m-d H:i:s");
                    $date = explode(" ", $row['start']);
                    if ($date[0] != date_time('d')) {
                        $duration = $row['duration'] - 1;
                        if ($duration == 0) {
                            $daily_profit = $plan['roi'];
                            $roi = get_percentage($row['amount'], $daily_profit);
                            
                            
                            $this->Db_model->update("investment", ["duration" => $duration, "profit" => $roi, "status" => 1], "WHERE id=$row[id]");
                        } else {
                            $this->Db_model->update("investment", ["duration" => $duration], "WHERE id=$row[id]");
                        }
                    }
                }
            }
        }*/
    }

    public function bot()
    {
        $fh = fopen('bot.txt', 'r');
        $inserts = 0;
        while ($line = fgets($fh)) {
            // <... Do your work with the line ...>
            // echo $line . "<br>";
            $word = trim($line);
            $count = strlen($word);
            $uid = rand(11111111, 99999999);
            $emails = array('gmail.com', 'yahoo.com', 'hotmail.com');
            $numb = rand(11, 99);
            shuffle($emails);
            $line = trim($line);
            $data = [
                "user_main" => [
                    "uid" => $uid,
                    "name" => $line,
                    "status" => 1
                ],
                "user_profile" => [
                    "uid" => $uid,
                    "username" => strtoupper($line) . $numb,
                    "email" => strtoupper($line) . $numb . "@" . $emails[0],
                    "role" => 0,
                    "password" => base64_encode("password")
                ]
            ];
            foreach ($data as $table => $input) {
                $this->Db_model->insert($table, $input);
            }
        }
        fclose($fh);
    }

}