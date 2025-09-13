<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/28/2017
 * Time: 4:42 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    private $salt = "@#6$%^&*THIS$%^&IS(&^A%^&LARGE^&**%^&SALT-8,/7%^&*";

    public function __construct()
    {
        parent::__construct();
        $this->load->model("users/Users_model","users");
    }

    public function sign_up ($ref_id = '', $self=NULL) {
        if ($this->session->has_userdata(UID) && $self == NULL) redirect(base_url()."home");
        if ($ref_id != '') {
            $data['ref_id'] = $ref_id;
        } else if ($this->session->has_userdata('ref')) {
            $data['ref_id'] = $this->session->userdata('ref');
        } else $data['ref_id'] = "";

        $this->form_validation->set_rules('name','Name','trim|required');
        $this->form_validation->set_rules('username','Username','trim|required|callback_username_check');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|callback_email_check');
        $this->form_validation->set_rules('phone','Phone Number','trim|required|min_length[7]|max_length[11]|callback_phone_check');
        $this->form_validation->set_rules('code','Phone code','trim|required');
        $this->form_validation->set_rules('password','Password','trim|required|alpha_numeric|min_length[6]|max_length[50]');
        //$this->form_validation->set_rules('advert','Advert Channel','trim|required');
        if ($self == NULL) {
            $this->form_validation->set_rules('ref', 'Referral ID', 'trim|callback_ref_check');
        }

        if($this->form_validation->run() == TRUE) {
            $uid = $this->Util_model->generate_id(11111111,99999999,'user_main','uid');
            $email = strtolower($this->input->post("email"));
            $_SESSION['email'] = $email;
            $ref_id = ($self == NULL) ? $this->input->post("ref") : $ref_id;
            $ser = (is_numeric($ref_id) ? "uid=$ref_id" : "email='$ref_id' OR username='$ref_id'");
            $admin = $this->Util_model->get_info("user_profile", "uid", "WHERE role=2 LIMIT 1");
            $ref_id = (empty($ref_id) ? $admin : $this->Util_model->get_info("user_profile","uid","WHERE $ser"));
            $ref_id2 = $this->Util_model->get_info("user_referral", "refID1", "WHERE uid=$ref_id");
            $ref_id3 = $this->Util_model->get_info("user_referral", "refID2", "WHERE uid=$ref_id");
            $coordinator = ($this->Util_model->get_user_info($ref_id, 'role', 'profile') > 1) ? $ref_id : $this->Util_model->get_info("user_referral", "coordinator", "WHERE uid=$ref_id");

            $uname = $this->input->post('username');
            $pass = $this->input->post('password');

            $input = array (
                'main' => array (
                    'uid'               =>  $uid,
                    'name'              =>  ucwords($this->input->post('name')),
                    'status'            =>  1 //To be wiped while taking online
                ),
                'profile' => array (
                    'uid'               =>  $uid,
                    'username'          =>  $uname,
                    'email'             =>  strtolower($this->input->post('email')),
                    'phone'             =>  str_replace(" ", "", ltrim($this->input->post('phone'),'0')),
                    'country'           =>  $this->input->post('code'),
                    'password'          =>  base64_encode($pass),
                    //'ref_from'          =>  $this->input->post('advert'),
                    'role'              =>  1
                ),
                'referral' => array (
                    'uid'               =>  $uid,
                    'refID1'             =>  $ref_id,
                    'refID2'            =>  $ref_id2,
                    'refID3'            =>  $ref_id3,
                    'coordinator'       =>  $coordinator
                )
            );

            if ($this->users->register($input)) {
                if ($self == NULL) {
                    redirect(base_url() . "sign-in/$uname/$pass");
                } else {
                    redirect(base_url()."add-member");
                }
            }
        } else {
            $this->session->set_flashdata("msg", validation_errors());
            if ($self != NULL) { redirect(base_url()."add-member"); }
        }

        //$data['breadcrumb'] = '<li><a href="'.base_url().'sign-up">Sign up</a></li>';
        //Load view and layout
        $this->load->view('users/sign_up',$data);
    }

    public function username_check($uname) {
        if ($this->Util_model->row_count("user_profile","WHERE username = '$uname'") > 0) {
            $this->form_validation->set_message("username_check","Error: username already exist <a href='".base_url()."sign-in' class='alert-link'>Sign In instead</a>");
            return false;
        } else
            return true;
    }

    public function email_check($email) {
        if ($this->Util_model->row_count("user_profile","WHERE email = '$email'") > 0) {
            $this->form_validation->set_message("email_check","Error: email already exist <a href='".base_url()."sign-in' class='alert-link'>Sign In instead</a>");
            return false;
        } else
            return true;
    }

    public function phone_check($phone) {
        $phone = str_replace(" ", "", ltrim($phone,'0'));
        if ($this->Util_model->row_count("user_profile","WHERE phone = $phone") > 0) {
            $this->form_validation->set_message("phone_check","Error: phones already exist <a href='".base_url()."sign-in' class='alert-link'>Sign In instead</a>");
            return false;
        } else
            return true;
    }

    public function ref_check($ref) {
        if ($ref == '') {
            return true;
        } else {
            $ser = (is_numeric($ref) ? "uid=$ref" : "email='$ref' OR username='$ref'");
            if ($this->Util_model->row_count("user_profile","WHERE $ser") == 0) {
                $this->form_validation->set_message("ref_check","Error: the referral doesn't exist");
                return false;
            } else
                return true;
        }
    }

    public function send_email_verification_link ($uid) {
        $email = $this->Util_model->get_user_info($uid,"email","profile");
        $this->Db_model->delete("user_auth","WHERE uid=$uid AND type='email_verify'");
        $this->users->send_email_verification_link($uid, $email);
        redirect(base_url()."home");
    }

    public function verify_email ($uid, $auth_text, $type) {
        if ($this->users->user_auth($uid, $auth_text, $type)) {
            //$ref = $this->Util_model->get_user_info($uid,"refID1","referral");
            //$this->General_model->add_point($ref, $uid, "verify_email");
            $this->Db_model->update("user_profile",array("verified"=>1),"WHERE uid=$uid");
            $this->session->set_flashdata("msg",alert_msg("<i class='fa fa-check-circle'></i> You email has been verified successfully and you have been awarded with 1 star","alert-success",1));
        } else {
            $email = $this->Util_model->get_user_info($uid,"email","profile");
            $this->session->set_flashdata("msg",alert_msg("<i class='fa fa-times-circle'></i> Email verification failed.","alert-danger",1));
        }
        redirect(base_url()."home");
    }

    public function sign_in($uname=NULL, $pass=NULL) {
        if ($this->session->has_userdata(UID)) redirect(base_url()."home");
        $this->form_validation->set_rules('user','Email/Username','trim|required');
        $this->form_validation->set_rules('pass','Password','trim|required|min_length[6]|max_length[50]');

        if ($this->form_validation->run() == TRUE || $uname != NULL || $pass != NULL) {
            $user = ($uname == NULL) ? $this->input->post('user') : $uname;
            $pass = ($pass == NULL) ? $this->input->post('pass') : $pass;

            $inputs = array(
                "user" => strtolower($user),
                "pass" => base64_encode($pass)
            );

            $result = $this->users->login($inputs);

            switch ($result) {
                case 0:
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times'></i> Incorrect email/username or password", "alert-danger",1));
                    break;
                case 1:
                    redirect('user/activate');
                    break;
                case 2:
                    unset($_SESSION["msg"]);
                    if ($this->session->has_userdata(A_UID) && $this->session->userdata(A_UID) == $this->session->userdata(UID)) {
                        redirect(base_url()."admin");
                    } else {
                        if (!$this->session->has_userdata('redirect'))
                            redirect(base_url()."home");
                        else
                            redirect($this->session->userdata('redirect'));
                    }

                    break;
                case 3:
                    $this->session->set_flashdata("msg", alert_msg("<i class='fa fa-times'></i> Your account has been blocked for violating rule(s). Send a mail to <b>".$this->Util_model->get_option('site_email')."</b> to activate your account.", "alert-danger",1));
                    break;
            }
        }

        //$data['breadcrumb'] = '<li><a href="'.base_url().'sign-in">Sign in</a></li>';
        //Load view and layout
        $this->load->view('users/sign_in');
    }

    public function sign_out () {
        $this->users->sign_out();
        redirect(base_url());
    }

    public function reset_password ($uid=NULL,$auth_text=NULL,$type=NULL) {
        if ($uid != NULL && $auth_text != NULL && $type != NULL) {
            if ($this->users->user_auth($uid, $auth_text, $type)) {
                $this->session->set_userdata("uid", $uid);
                $this->session->set_userdata("auth_text", $auth_text);
                $this->session->set_userdata("type", $type);
            }
        }
        //Load view and layout
        $this->load->view('users/reset_password');
    }

    public function send_reset_link () {
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');

        if ($this->form_validation->run() == true) {
            if ($this->Util_model->row_count("user_profile","WHERE email='$_POST[email]'") > 0) {
                $uid = $this->Util_model->get_info("user_profile","uid","WHERE email='$_POST[email]'");
                $first = $this->Util_model->get_user_info($uid);
                $this->Db_model->delete("user_auth","WHERE uid=$uid AND type='pass_reset'");
                $data = array (
                    "uid"           =>  $uid,
                    "auth"          =>  md5(rand(1111,9999)),
                    "type"          =>  "pass_reset"
                );
                if ($this->Db_model->insert("user_auth",$data)) {
                    $this->load->model("Mail_model","mail");
                    $markups = array (
                        "[HEADING]"             =>  "Password Reset Request",
                        "[PLAIN-TEXT]"          =>  "<p>Click the above button to change your password.</p>
                                             <p>You are seeing this message because a request was made from 
                                             <a href='".base_url()."'>www.bit-inference.uk</a> to change your account 
                                             password on <a href='".base_url()."'>www.bit-inference.uk</a>. If this request 
                                             was not made by you, kindly ignore this message</p>",
                        "[BUTTON-HREF]"         =>  base_url()."users/reset-password/$uid/$data[auth]/$data[type]",
                        "[BUTTON-TEXT]"         =>  "Reset Password",
                        "[FIRST-NAME]"          =>  $first
                    );

                    if ($this->Mail_model->send_mail($_POST['email'], "Password Reset", $markups)) {
                        $this->session->set_flashdata('msg',alert_msg("<i class='fa fa-check-circle'></i> Password reset link sent to <b>$_POST[email]</b>","alert-success", 1));
                        redirect(base_url()."users/reset-password");
                    } else {
                        $this->session->set_flashdata('msg',alert_msg("<i class='fa fa-times-circle'></i> Error sending mail to <b>$_POST[email]</b>","alert-danger", 1));
                        redirect(base_url()."users/reset-password");
                    }
                }
            } else {
                $this->session->set_flashdata('msg',alert_msg("<i class='fa fa-times-circle'></i> <b>$_POST[email]</b> does not exit. <a href='".base_url()."sign-up'>Register instead</a>","alert-danger", 1));
                redirect(base_url()."users/reset-password");
            }
        } else {
            $this->session->set_flashdata('msg',validation_errors());
            redirect(base_url()."users/reset-password");
        }

    }

    /*public function verify_email ($uid=NULL, $auth_text=NULL, $type=NULL) {
        if ($uid != NULL && $auth_text != NULL && $type != NULL) {
            if ($this->users->user_auth($uid, $auth_text, $type)) {
                $
                $this->Db_model->update("user_profile",array("status"=>1, "point"=>$this->Util_model->get_info("user_profile","point","WHERE uid=$uid")+500),"WHERE uid=$uid");
                $this->Db_model->delete("user_auth","WHERE uid=$uid AND auth='$auth_text' AND type='$type'");
                $this->session->set_flashdata("msg",alert_msg("<i class='fa fa-check-circle'></i> Email verified successfully","alert-success",1));
                redirect(base_url());
            } else {
                $this->session->set_flashdata("msg",alert_msg("<i class='fa fa-times-circle'></i> Unsuccessful: An error occured during verification","alert-danger",1));
                redirect(base_url());
            }
        }
    }*/

    public function change_password () {
        $this->form_validation->set_rules('pass','Password','trim|required|min_length[6]|max_length[50]');

        if ($this->form_validation->run() == true) {
            $data = array(
                "password"      =>  md5($this->input->post('pass'))
            );
            if ($this->Db_model->update("user_profile",$data,"WHERE uid=".$this->session->userdata('uid'))) {
                drop_sess('uid');
                drop_sess('auth_text');
                drop_sess('type');
                $this->session->set_flashdata('msg',alert_msg("<i class='fa fa-check-circle'></i> Password changed successfully. Sign in with the new password","alert-success", 1));
                redirect(base_url()."sign-in");
            } else {
                $this->session->set_flashdata('msg',alert_msg("<i class='fa fa-times-circle'></i> Password was not changed successfully. Please try again","alert-danger", 1));
                redirect(base_url()."users/reset-password");
            }
        } else {
            $this->session->set_flashdata('msg',validation_errors());
            redirect(base_url()."users/reset-password");
        }

    }

    public function wallet ($tab='history', $method=NULL) {
        $this->Util_model->log_redirect();
        $data['breadcrumb'] = '<li>Wallet</li>';
        switch ($tab) {
            case 'deposit':
                $data['tab'] = $tab;
                if ($method == NULL) {
                    $data['method'] = 'card';
                } else {
                    $data['method'] = $method;
                }
                break;
            case 'withdraw':
                $data['tab'] = $tab;
                if ($method == NULL) {
                    $data['method'] = 'bank';
                } else {
                    $data['method'] = $method;
                }
                break;
            case 'history':
                $data['tab'] = $tab;
                if ($method != NULL) {
                    $data['ref'] = $method;
                }
                break;
        }

        //Load view and layout
        $data['main_content'] = 'users/wallet';
        $this->load->view('layouts/main',$data);
    }

    public function confirm_password () {
        $password = $this->input->post("password");
        if (base64_encode($password) == $this->Util_model->get_user_info($this->session->userdata(UID), 'password', 'profile')) {
            echo true;
        } else {
            echo false;
        }
    }
}