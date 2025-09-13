<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/28/2017
 * Time: 5:24 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $salt = "@#6$%^&*THIS$%^&IS(&^A%^&LARGE^&**%^&SALT-8,/7%^&*";

    public function register($inputs)
    {
        $success = 0;

        $success += ($this->Db_model->insert("user_main", $inputs['main'])) ? 1 : 0;
        $success += ($this->Db_model->insert("user_profile", $inputs['profile'])) ? 1 : 0;
        $success += ($this->Db_model->insert("user_referral", $inputs['referral'])) ? 1 : 0;

        if ($success == 3) {
            $pro = $inputs['profile'];
            $this->send_email_verification_link($pro['uid'],$pro['email']);
            return true;
        } else {
            $main = $inputs['main'];
            $this->db->where("uid", $main['uid']);
            $this->db->delete(array("user_main", "user_profile"));
            return false;
        }
    }
    
    public function send_email_verification_link ($uid, $email)
    {
        if ($this->Util_model->row_count("user_profile", "WHERE email='$email'") > 0) {
            $first = $this->Util_model->get_user_info($uid);
            $data = array(
                "uid" => $uid,
                "auth" => md5(rand(1111, 9999)),
                "type" => "email_verify"
            );
            if ($this->Db_model->insert("user_auth", $data)) {
                $text = "
                    <p>Hi $first,</p>
                    <p>Welcome to ".SITE_TITLE.", a world class Trading and Financial 
                        Management Company, established with the vision of impacting the general populace 
                        with the knowledge of trading Forex and cryptocurrency and creating platforms that will bring about 
                        sustainable financial freedom.</p>
                     <p>We received a sign up with this email from  
                     <a href='".base_url()."'>www.".$this->Util_model->get_option("site_url")."</a> kindly verify your email by clicking or copying this link <a href='" . base_url() . "users/verify-email/$uid/$data[auth]/$data[type]'>" . base_url() . "users/verify-email/$uid/$data[auth]/$data[type]</a>
                       to verify your email and enjoy all the benefits on the platform.</p>
                       <h4><b>USER LOGIN DETAILS</b></h4>
                        <p style='font-size: 16px;'>
                        <b>Username: </b>".$this->Util_model->get_user_info($uid, "username", "profile")."<br>
                        <b>Password: </b>".trim(base64_decode($this->Util_model->get_user_info($uid, "password", "profile")), $this->salt)."
                        </p><br>
                        <p style='text-align: center; margin-bottom:20px;'><b>Very Important</b><br>Make sure to delete this message to avoid loosing your login details to a third party</p>
                ";

                if ($this->Mail_model->send_mail($email, "Email Verification", $text, "Verify Email")) {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-check-circle'></i> Email verification link and login details has been sent to <b>$email</b>", "alert-success", 1));
                } else {
                    $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> Error sending verification link to <b>$email</b>", "alert-danger", 1));
                }
            }
        } else {
            $this->session->set_flashdata('msg', alert_msg("<i class='fa fa-times-circle'></i> <b>$email</b> does not exit. <a href='" . base_url() . "sign-up'>Register instead</a>", "alert-danger", 1));
        }
    }

    public function login($inputs)
    {
        $q = $this->Db_model->selectGroup("*", "user_profile", "WHERE email='$inputs[user]' OR username='$inputs[user]'");
        if ($q->num_rows() == 0) {
            $return = 0;
        } else {
            $pro = $q->row_array();
            if ($pro['password'] != $inputs['pass']) {
                $return = 0;
            } else {
                $main = $this->Db_model->select("*", "user_main", "WHERE uid=$pro[uid]");
                switch ($main['status']) {
                    case '0':
                        $_SESSION['email'] = $pro['email'];
                        $return = 1;
                        break;
                    case '1':
                        $_SESSION[UID] = $pro['uid'];
                        $this->session->set_tempdata(UID, $pro['uid'], (30 * 60 * 60 * 60));
                        if ($this->Util_model->row_count("admin", "WHERE uid=$pro[uid]") > 0) {
                            $_SESSION[A_UID] = $pro['uid'];
                        }
                        $return = 2;
                        break;
                    case '2':
                        $return = 3;
                        break;
                }
            }
        }
        return $return;
    }

    public function lockscreen () {
        $protocol = (strstr($_SERVER['SERVER_PROTOCOL'],"HTTPS")) ? "HTTPS://" : "HTTP://";
        set_flashdata('redirect',$protocol.get_url());
        redirect(base_url().'associate/lock');
    }

    public function unlockscreen ($passkey) {
        //$passkey = md5($passkey);
        if ($this->Util_model->row_count("associates_main","WHERE uid=".get_sessdata(UID)." AND passkey='$passkey'") == 1) {
            $this->session->set_tempdata(A_UID,get_sessdata(UID),(15*60));
            redirect(base_url()."associate");
        }
    }

    public function user_auth ($uid, $auth_text, $type) {
        if ($this->Util_model->row_count("user_auth","WHERE uid=$uid AND auth='$auth_text' AND type='$type'") > 0) {
            if ($this->Db_model->delete("user_auth","WHERE uid=$uid AND auth='$auth_text' AND type='$type'")) {
                return true;
            } else {
                return false;
            }
        }  else {
            return false;
        }
    }

    public function check_associate () {
        if ($this->Util_model->row_count("associates_main","WHERE uid=".get_sessdata(UID)) == 1) {
            if (!$this->session->has_userdata(A_UID)) {
                if (!strstr($_SERVER['REQUEST_URI'],'lock')) {
                    $this->lockscreen();
                }
            } else {
                $this->session->set_tempdata(A_UID,get_sessdata(UID),(15*60));
            }
        } else {
            redirect(base_url()."base");
        }
    }

    public function sign_out($redirect=true)
    {
        /*drop_sess(UID);
        drop_tempdata(UID);
        drop_tempdata(A_UID);*/
        unset($_SESSION[UID]);
        unset($_SESSION[A_UID]);
        session_destroy();

        if (!$redirect) {
            redirect(base_url()."sign-in");
        }
    }

}

?>