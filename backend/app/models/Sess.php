<?php 
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

if (!isset($_SESSION['flash'])) {
	$_SESSION['flash'] = array();
}

function set_sessdata($data,$value=NULL) { // Session data or an associative array of data
	/* 
	| Check if the data variable is an array also check if the val variale is empty |
	| If the condition then use the associative array key as the session key and value as the session value
	*/
	if (is_array($data) && !is_array($value)) {
		foreach ($data as $key => $val) {
			$_SESSION[$key] = $val;
		}
	} else if (is_array($data) && is_array($value)) {
		for ($i=0; $i<count($data); $i++) {
			$_SESSION[$data[$i]] = $_SESSION[$value[$i]];
		}
	} else {
		$_SESSION[$data] = $value;
	}
}

function set_flashdata($data,$val=NULL) {
	set_sessdata($data,$val);
	if (is_array($data)) {
		foreach ($data as $key) {
			if (!in_array($key,$_SESSION['flash'])) array_push($_SESSION['flash'],$key);
		}
	}  else {
		if (!in_array($data,$_SESSION['flash'])) array_push($_SESSION['flash'],$data);
	}
}

function set_tempdata($data,$value=NULL,$time=300) { // data, value and corresponding expiring time can also be an array respectively provided all will have the same expiring time
	if (is_array($data) && !is_array($value)) {
		foreach ($data as $key => $val) {
			setcookie($key, $val, time() + $time, '/');
		}
	} else if (is_array($data) && is_array($value)) {
		for ($i=0; $i<count($data); $i++) {
			setcookie($data[$i], $value[$i], time() + $time, '/');
		}
	} else {
		setcookie($data, $value, time() + $time, '/');
	}
}

function get_sessdata($key) {
	$sess = (is_sess($key))?$_SESSION[$key]:NULL;
	if (in_array($key,$_SESSION['flash']))
		unset($_SESSION[$key]);
	return $sess;
}

function get_tempdata($key) {
	return $_COOKIE[$key];
}

function is_sess($key) {
    if (is_tempdata($key)) {
        set_sessdata($key,get_tempdata($key));
    }
	return (isset($_SESSION[$key]))?true:false;
}

function is_tempdata($key) {
	return (isset($_COOKIE[$key]))?true:false;
}

function is_flashdata($key) {
	return (in_array($key,$_SESSION['flash']))?true:false;
}

function drop_sess($key) {
	$return = false;
	if (is_array($key)) {
		foreach ($key as $a_key) {
			if (in_array($a_key,$_SESSION['flash'])) {
				$arr_key = array_keys($_SESSION['flash'],$a_key);
				$flash = $_SESSION['flash'];
				unset($flash[$arr_key]);
				unset($_SESSION[$a_key]);
				$return = true;
			} else {
				unset($_SESSION[$a_key]);
				$return = true;
			}
		}
	} else {
		if (in_array($key,$_SESSION['flash'])) {
			$arr_key = array_keys($_SESSION['flash'],$key);
			$flash = $_SESSION['flash'];
			unset($flash[$arr_key]);
			unset($_SESSION[$key]);
			$return = true;
		} else {
			unset($_SESSION[$key]);
			$return = true;
		}
	}
	return $return;
}

function drop_tempdata($key) {
	if (isset($_COOKIE[$key])) {
		setcookie($key, NULL, time() - 10, '/');
	}
	return true;
}

?>