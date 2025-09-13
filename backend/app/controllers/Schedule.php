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
                            /* get_percentage( */
                            $row['amount'],/*  $plan['cashout']), */
                            $row['uid'],
                            0,
                            "Capital return",
                            "Capital return",
                            "Cashout",
                            $row['id'],
                            "",
                            1
                        ); //Capital return

                        // Prepare and send completion email
                        $firstName = $this->Util_model->get_user_info($uid, "firstname", "profile");
                        if (empty($firstName)) {
                            // fallback to whatever get_user_info($uid) returns (username/fullname)
                            $firstName = $this->Util_model->get_user_info($uid);
                        }
                        $email = $this->Util_model->get_user_info($uid, "email", "profile");
                        $planName = strtoupper($plan["name"]);
                        $planDuration = isset($plan['duration']) ? $plan['duration'] : '';

                        // Messages for all plans (Beginner, Silver, Gold, Diamond, Master, Forex Tech)
                        $messages = [
                            "BEGINNER" => [
                                "subject" => "Your Beginner Plan Has Completed — Congratulations!",
                                "text" => "<p><strong>Dear {$firstName},</strong></p>
                               <p>Congratulations on completing your {$planDuration}-day <strong>Beginner</strong> investment plan. We hope you’re pleased with the results and invite you to reinvest or upgrade to another plan.</p>
                               <p>If you need assistance choosing your next step, our team is here to help.</p>
                               <p>Best regards,<br>" . SITE_TITLE . " Support Team</p>"
                            ],
                            "SILVER" => [
                                "subject" => "Your Silver Plan Has Matured — Congratulations!",
                                "text" => "<p><strong>Dear {$firstName},</strong></p>
                               <p>Congratulations on completing your {$planDuration}-day <strong>Silver</strong> investment plan. This is a great milestone — consider redepositing to continue growing your portfolio.</p>
                               <p>Warm regards,<br>" . SITE_TITLE . " Support Team</p>"
                            ],
                            "GOLD" => [
                                "subject" => "Your Gold Plan Has Matured — Congratulations!",
                                "text" => "<p><strong>Dear {$firstName},</strong></p>
                               <p>Well done on completing your {$planDuration}-day <strong>Gold</strong> investment plan. We’re here to help you reinvest or move to a higher tier.</p>
                               <p>Warm regards,<br>" . SITE_TITLE . " Support Team</p>"
                            ],
                            "DIAMOND" => [
                                "subject" => "Your Diamond Plan Has Matured — Congratulations!",
                                "text" => "<p><strong>Dear {$firstName},</strong></p>
                               <p>Congratulations on completing your {$planDuration}-day <strong>Diamond</strong> investment plan. You’ve reached a key milestone — reach out to our team to discuss next steps.</p>
                               <p>Warm regards,<br>" . SITE_TITLE . " Support Team</p>"
                            ],
                            "MASTER" => [
                                "subject" => "Your Master Plan Has Completed — Thank You!",
                                "text" => "<p><strong>Dear {$firstName},</strong></p>
                               <p>Thank you for completing your {$planDuration}-day <strong>Master</strong> investment plan. This is a premium tier — our relationship managers are available to guide your next investment move.</p>
                               <p>Respectfully,<br>" . SITE_TITLE . " Support Team</p>"
                            ],
                            "FOREX TECH" => [
                                "subject" => "Your Forex Tech Plan Has Completed — Congratulations!",
                                "text" => "<p><strong>Dear {$firstName},</strong></p>
                               <p>Congratulations on completing your {$planDuration}-day <strong>Forex Tech</strong> investment plan. We hope the results met your expectations — consider reinvesting or contacting us for tailored options.</p>
                               <p>Best regards,<br>" . SITE_TITLE . " Support Team</p>"
                            ]
                        ];

                        if (isset($messages[$planName])) {
                            $this->Mail_model->send_mail($email, $messages[$planName]["subject"], $messages[$planName]["text"]);
                        } else {
                            // default fallback email
                            $subject = "Investment Plan Completed";
                            $text = "<p><strong>Dear {$firstName},</strong></p>
                         <p>Your <strong>{$plan['name']}</strong> plan ({$planDuration} days) has completed. Thank you for investing with " . SITE_TITLE . ".</p>
                         <p>Best regards,<br>" . SITE_TITLE . " Support Team</p>";
                            $this->Mail_model->send_mail($email, $subject, $text);
                        }
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
