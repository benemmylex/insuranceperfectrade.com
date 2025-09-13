<?php
/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/24/2017
 * Time: 10:21 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function verify_trans ($uid, $amount, $reference) {
        //$data;
    }
}

?>