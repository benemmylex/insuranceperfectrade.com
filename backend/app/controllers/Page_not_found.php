<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/29/2017
 * Time: 8:51 AM
 */
class Page_not_found extends CI_Controller
{

    public function error404() {
        $data['main_content'] = '404';
        $data['tab'] = '404';
        $data['breadcrumb'] = '';
        $this->load->view('layouts/main', $data);
    }
}