<?php

/**
 * Created by PhpStorm.
 * User: testing
 * Date: 9/19/2019
 * Time: 1:18 AM
 */
class General extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index () {
        $this->load->view("general/index");
    }

    public function about () {
        $data['main_content'] = "general/about";
        $this->load->view("layouts/general_main", $data);
    }

    public function faq () {
        $data['main_content'] = "general/faq";
        $this->load->view("layouts/general_main", $data);
    }

    public function contacts () {
        $data['main_content'] = "general/contacts";
        $this->load->view("layouts/general_main", $data);
    }

    public function message () {
        $msg = "<h4><b>".strtoupper($this->input->post("name"))."</b></h4>";
        $msg .= "<br><br>";
        $msg .= $this->input->post("message");
        $this->Util_model->send_mail($this->input->post("email"), "support@primeonex.com", $this->input->post("subject"), $msg);
        echo "Message sent to <b>support@primeonex.com</b>. <a href='https://primeonex.com'>Click here to go back</a> ";
    }

    public function documentation () {
        $this->load->view("documentation/index");
    }

    public function testing () {
        echo base64_encode('nwekeGodwin65');
    }

}