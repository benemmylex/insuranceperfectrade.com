<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function upload_image($file,$uploaddir='',$newName='') {
	//require_once("../classes/functions.php");
	$fileName = $file['name']; //The file name
	$fileTmpLoc = $file['tmp_name']; //File in the PHP tmp folder
	//$fileType = $file['type']; // The type of file it is
	$fileErrorMsg = $file['error']; // 0 for false... and 1 for true
	$thepath = pathinfo($fileName);
	$ext = $thepath['extension'];
	if ($uploaddir == '') {
		$uploaddir = './uploads/'.date('Ym').'/';
		if (!file_exists($uploaddir)) {
			makeDir('./uploads/'.date('Ym'));
		}
	}
	$filenm = ($newName == '')?$uploaddir.date('U').".$ext":$uploaddir."/$newName.$ext";
	
	if(move_uploaded_file($file['tmp_name'],$filenm)){
		chmod($dir,'0755');
		$startRz = new ImageResize('256','192','128','96',$uploaddir,"../images/uploads",$filenm);
		$imgCnt = $startRz->getImages();
		return array(true,$imgCnt);
	} else return array(false,"");
	
}

function upload_resized_image($file,$dir,$newName='',$width=220,$height=240) {
	require_once("resizer.class.php");
	$resizer = new resizer();
	return $resizer->resize($file['name'],$file['tmp_name'],$dir,$width,$height,$newName);
}

function upload_pic($control, $path='', $imageName='', $size='2000000')
{
	if ($path == '') {
		$path = 'uploads/'.date('Ym').'/';
		if (!file_exists('./'.$path)) {
			makeDir('./uploads/'.date('Ym'));
		}
	}
	
	$thepath = pathinfo($_FILES[$control]['name']);
	$ext = $thepath['extension'];
	
	$imageName = ($imageName == '')?date('U').".$ext":$imageName.".$ext";
	
    if( ! isset($_FILES[$control]) || ! is_uploaded_file($_FILES[$control]['tmp_name']))
    {
        $return = array('result'=>false,'err'=>'No file was chosen');
    } else if($_FILES[$control]['size']>$size)
    {
        $return = array('result'=>false,'err'=>'File is too large ('.round(($_FILES[$control]["size"]/1000)).'kb), please choose a file under '.round($size/1000).'kb');
    } else if($_FILES[$control]['error'] !== UPLOAD_ERR_OK)
    {
        $return = array('result'=>false,'err'=>'Upload failed. Error code: '.$_FILES[$control]['error']);
    } else {
		switch(strtolower($_FILES[$control]['type']))
		{
		case 'image/jpeg':
				$image = imagecreatefromjpeg($_FILES[$control]['tmp_name']);
				move_uploaded_file($_FILES[$control]["tmp_name"],'./'.$path.$imageName);
				$return = array("result"=>true,"file_name"=>$path.$imageName);
				break;
		case 'image/png':
				$image = imagecreatefrompng($_FILES[$control]['tmp_name']);
				move_uploaded_file($_FILES[$control]["tmp_name"],'./'.$path.$imageName);
				$return = array("result"=>true,"file_name"=>$path.$imageName);
				break;
		case 'image/gif':
				$image = imagecreatefromgif($_FILES[$control]['tmp_name']);
				move_uploaded_file($_FILES[$control]["tmp_name"],'./'.$path.$imageName);
				$return = array("result"=>true,"file_name"=>$path.$imageName);
				break;
		default:
			   $return = array('result'=>false,'err'=>'This file type is not allowed');
		}
		@unlink($_FILES[$control]['tmp_name']);
	}
	return $return;
    
	
	/*$old_width      = imagesx($image);
    $old_height     = imagesy($image);


    //Create tn version
    if($sizes=='tn' || $sizes=='all')
    {
    $max_width = 100;
    $max_height = 100;
    $scale          = min($max_width/$old_width, $max_height/$old_height);
    if ($old_width > 100 || $old_height > 100)
    {
    $new_width      = ceil($scale*$old_width);
    $new_height     = ceil($scale*$old_height);
    } else {
        $new_width = $old_width;
        $new_height = $old_height;
    }
    $new = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($new, $image,0, 0, 0, 0,$new_width, $new_height, $old_width, $old_height);
    switch(strtolower($_FILES[$control]['type']))
    {
    case 'image/jpeg':
            imagejpeg($new, $path.'tn_'.$imageName, 90);
            break;
    case 'image/png':
            imagealphablending($new, false);
            imagecopyresampled($new, $image,0, 0, 0, 0,$new_width, $new_height, $old_width, $old_height);
            imagesavealpha($new, true); 
            imagepng($new, $path.'tn_'.$imageName, 0);
            break;
    case 'image/gif':
            imagegif($new, $path.'tn_'.$imageName);
            break;
    default:
    }
    }

    imagedestroy($image);
    imagedestroy($new);
    print '<div style="font-family:arial;"><b>'.$imageName.'</b> Uploaded successfully. Size: '.round($_FILES[$control]['size']/1000).'kb</div>';
	*/
}

function list_images() {
	$dir = "../../uploads/";
	$scanned = array_diff(scandir($dir),array('.','..'));
	$images = "";
	foreach ($scanned as $file) {
		$images .= "<div class='image-wrap'><img src='$dir$file' /><i class='fa fa-trash fa-2x' onclick='deleteUpload(\"$dir$file\")'></i><span class='no-display'>uploads/$file</span></div>";	
	}
	echo $images;
}

// -----------------------------------------------------------------

function next_prev_date($date,$dmy,$t=0) { // t => 0 for prev, 1 for next; $date => the date; dmy => whether day, month or year
	if ($t == 0) {
		$output = date("Y-m-d", strtotime($date. "-1 $dmy"));
	} else {
		$output = date("Y-m-d", strtotime($date. "+1 $dmy"));
	}
	return $output;
}

function get_week($ddate=NULL) { // format Y-m-d
	$ddate = ($ddate == NULL)?date('Y-m-d'):$ddate;
	$date = new DateTime($ddate);
	$week = $date->format("W");
	return $week;
}

function getStartAndEndDate($week, $year) {
	$dto = new DateTime();
	$dto->setISODate($year, $week);
	$ret['week_start'] = $dto->format('m-d-Y');
	$dto->modify('+6 days');
	$ret['week_end'] = $dto->format('m-d-Y');
	return $ret;
}

function show_week_start_end($year='',$t='') {
	$year=($year == '')?date("Y"):$year;
	$opt = '<option selected="selected" value="">--Select week of '.$year.'--</option>';
	for ($week=1; $week <= 52; $week++) {
		$w = getStartAndEndDate($week,$year);
		$opt .= "<option value='$week'>Week $week: From $w[week_start] To $w[week_end] </option>";
	}
	return $opt;
}

function week_start_end($week,$year='') {
	$year=($year == '')?date("Y"):$year;
	$w = getStartAndEndDate($week,$year);
	return "<span>$w[week_start] To $w[week_end]</span>";
}

function calculate_age($dob) {
	return date_diff(date_create($dob), date_create('today'))->y;
}

function days_difference($date) {
   $datetime1 = strtotime(date_time());
    $datetime2 = strtotime($date);
    
    $secs = $datetime2 - $datetime1;// == <seconds between the two times>
    $days = $secs / 86400;
    return floor($days);
	//return date_diff(date_create($date), date_create('today'))->d;
}

function date_difference ($old, $new='') {
	$new = ($new == '')?date('Y-m-d H:i:s'):$new;
	$date_a = new DateTime($old);
	$date_b = new DateTime($new);
	
	$interval = date_diff($date_b,$date_a);
	
	return $interval->format('%H:%i:%s');
}

function time_difference ($old, $current='', $format='') {
    $current = ($current == '')?date_time():$current;
    $date = new DateTime( $old );
    $date2 = new DateTime( $current);

    $diffInSeconds = $date->getTimestamp() - $date2->getTimestamp();
    return $diffInSeconds;
}

function new_date_format($dateString, $oldFormat, $newFormat) {
	$myDateTime = DateTime::createFromFormat($oldFormat, $dateString);
	$newDateString = $myDateTime->format($newFormat);
	return $newDateString;
}

function get_hour_stamp ($hour) {
	return time()+$hour*60*60;
}

function get_time_stamp ($date, $boolean=false) {
	$date = new DateTime($date);
	// "-2209078800"
	return ($boolean == false)?$date->format("U"):$date->getTimestamp();
}

function convert_timestamp ($timestamp, $format='') {
	$format = ($format == '')?"Y-m-d H:i:s":$format;
	return date($format,$timestamp);
}

function get_next_prev_date ($date, $days=1, $type="next", $format=NULL) {
    $hours = $days * 24;
    $type = strtoupper($type);
    if ($type == 'NEXT') {
        $date = get_hour_stamp($hours);
    } else {
        $date = get_hour_stamp(-$hours);
    }
    if ($format == NULL) {
        return $date;
    } else {
        return convert_timestamp($date, $format);
    }
}

function get_time_ago ($time, $timestamp=false) {
    date_default_timezone_set('Africa/Lagos');
    $time = ($timestamp) ? $time : strtotime($time);
    $timediff = time() - $time;

    $days = intval($timediff/86400);
    $remain = $timediff%86400;
    $hours = intval($remain/3600);
    $remain = $remain%3600;
    $mins = intval($remain/60);
    $secs = $remain%60;

    if ($secs < 0) $timestring = "0 secs ago";
    if ($secs >= 0) $timestring = $secs. " sec". (($secs > 1)?"s":"")." ago";
    if ($mins > 0) $timestring = $mins. " min" .(($mins > 1)?"s ":" ")." ago";
    if ($hours > 0) $timestring = $hours. (($hours > 1)?" hrs ":" hr ")." ago";
    if ($days > 0) $timestring = $days. (($days > 1)?" days ":" day ")." ago";
    if ($days > 30) $timestring = convert_timestamp($time,"H:i M d, Y");
    return $timestring;
}

function date_inrange ($date, $curr_date=NULL) {
    $curr_date = ($curr_date == NULL) ? date_time('d') : $curr_date;
    $diff = strtotime($date) - strtotime($curr_date);
    if ($diff < 0) {
        return false;
    } else {
        return true;
    }
}

function list_day ($m=1,$sel='') {
	if ($m == 1 || $m == 3 || $m == 5 || $m == 7 || $m == 8 || $m == 10 || $m == 12) $num = 31;
	else if ($m == 4 || $m == 6 || $m == 9 ||  $m == 11) $num = 30;
	else if ($m == 2) {
		$y = date('Y') % 4;
		$num = ($y == 0)?29:28;
	} else $num = 31;
	$opt = '';
	for ($i=1; $i<=$num; $i++) {
		$select = ($sel == $i)?"selected='selected'":"";
		$opt .= "<option value='$i' $select>$i</option>";
	}
	return $opt;
}

function list_month($t=0,$sel='') {
	$opt = "";
	for ($m=1; $m<=12; $m++){
		$month = month_desc($m,$t);
		$select = ($sel == $m)?"selected='selected'":"";
		$opt .= "<option value='$m' $select>$month</option>";
	}
	return $opt;
}

function list_years($y=1940,$res=NULL,$sel='') {
	$opt = '';
	if ($res == NULL) {
		for ($year=date('Y'); $year>=$y; $year--) {
			$select = ($sel == $year)?"selected='selected'":"";
			$opt .= "<option value='$year' $select>$year</option>";
		}
	} else {
		$year_to = date('Y') - $res;
		for ($year=$year_to; $year>=$y; $year--) {
			$select = ($sel == $year)?"selected='selected'":"";
			$opt .= "<option value='$year' $select>$year</option>";
		}
	}
	return $opt;
}

function list_sessions($y,$sel='') {
	$session = '';
	for ($i=date('Y'); $i >= $y; $i--) {
		$nextYear = $i+1;
		if ($sel == "$i/$nextYear") {
			$session .= "<option value='$i/$nextYear' selected='selected'>$i/$nextYear</option>";
		} else {
			$session .= "<option value='$i/$nextYear'>$i/$nextYear</option>";
		}
	}
	return $session;
}

function month_desc($month,$s=0) {
	$mon = '';
	if ($s == 0) {
		switch ($month) {
			case 1:
				$mon = "January";
				break;
			case 2:
				$mon = "February";
				break;
			case 3:
				$mon = "March";
				break;
			case 4:
				$mon = "April";
				break;
			case 5:
				$mon = "May";
				break;
			case 6:
				$mon = "June";
				break;
			case 7:
				$mon = "July";
				break;
			case 8:
				$mon = "August";
				break;
			case 9:
				$mon = "September";
				break;
			case 10:
				$mon = "October";
				break;
			case 11:
				$mon = "November";
				break;
			case 12:
				$mon = "December";
				break;
		}
	} else {
		switch ($month) {
			case 1:
				$mon = "Jan";
				break;
			case 2:
				$mon = "Feb";
				break;
			case 3:
				$mon = "Mar";
				break;
			case 4:
				$mon = "Apr";
				break;
			case 5:
				$mon = "May";
				break;
			case 6:
				$mon = "Jun";
				break;
			case 7:
				$mon = "Jul";
				break;
			case 8:
				$mon = "Aug";
				break;
			case 9:
				$mon = "Sep";
				break;
			case 10:
				$mon = "Oct";
				break;
			case 11:
				$mon = "Nov";
				break;
			case 12:
				$mon = "Dec";
				break;
		}
	}
	
	return $mon;
}


function num_format($no,$rev=NULL) {
	if (is_numeric($no)) {
		if ($rev == NULL) {
			if (strlen($no) == 1 && $no == 0) {
				$no = "0$no";
			}
		} else {
			$no = ltrim($no,'0');
		}
	}
	return $no;
}

function id_format($id) {
	switch (strlen($id)) {
		case 1:
			$_id = "000000".$id;
			break;
		case 2:
			$_id = "00000".$id;
			break;
		case 3:
			$_id = "0000".$id;
			break;
		case 4:
			$_id = "000".$id;
			break;
		case 5:
			$_id = "00".$id;
			break;
		case 6:
			$_id = "0".$id;
			break;
		default:
			$_id = $id;
			break;
	}
	return $_id;
}

function date_time($t="") {
	if ($t == "") {
		return date("Y-m-d H:i:s");
	} elseif ($t == "t" || $t == "T") {
		return date("H:i:s");
	}  elseif ($t == "d" || $t == "D") {
		return date("Y-m-d");
	}
}

function list_countries($sel='',$descx=0) {
	$opt = "";
	$select = selectGroup("*","code_param_desc","WHERE tab_index=18 ORDER BY item_desc");
	while ($info = mysql_fetch_array($select)) {
		if ($sel == $info['item_code']) {
			$opt .= "<option value='$info[item_code]' selected='selected'>$info[item_desc] [$info[item_xdesc]]</option>";
		} else {
			$opt .= "<option value='$info[item_code]'>$info[item_desc] [$info[item_xdesc]]</option>";
		}
	}
	return $opt;
}

function alert_msg($msg,$type,$dis=0) {
	if ($dis != 0) {
		$view = "
			<div class='row'>
				<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
					<div class='alert $type alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						$msg
					</div>
				</div>
			</div>";
	} else {
		$view = "
			<div class='row'>
				<div class='col-lg-12'>
					<div class='alert $type'>
					$msg
					</div>
				</div>
			</div>";
	}
	return $view;
}

function get_header() {
	require_once("header.php");
}

function get_footer() {
	require_once("footer.php");
}

function get_file($url) {
	include_once($url);
}

function get_page_file($key) {
	switch ($key) {
		case "dashboard":
			get_file("dashboard.php");
			break;
		case "students":
			get_file("students.php");
			break;
		case "add-school":
			get_file("add_schools.php");
			break;
		case "all-schools":
			get_file("schools.php");
			break;
		case "edit-school":
			get_file("edit_schools.php");
			break;
	}
}

function get_info($tbl, $field, $ser="", $db="") {
	$info = select($field,$tbl,$ser,$db);
	return $info[$field];
}

function get_row_count($tbl, $ser="", $val="") {
	if ($ser == "") {
		$sql = "SELECT * FROM $tbl";
	} else {
		$sql = "SELECT * FROM $tbl WHERE $ser='$val'";
	}
	$q = @mysql_query($sql);
	return @mysql_num_rows($q);
}

function gen_reg_num() { //Generates reg number for student
	//$abv = get_info("options","option_value","option_name","site_abriviation");
	//$reg = $abv."/".date("y")."/".rand(1111,9999);
	$reg = rand(1111,9999);
	while (get_row_count("student_master_tab","regID",$reg) != 0) {
		//$reg = $abv."/".date("y")."/".rand(1111,9999);
		$reg = rand(1111,9999);
	}
	return $reg;
}

function validate_reg_ID($regID) {
	if (get_row_count("`student_master_tab`","`regID`",$regID) > 0) return true;
	else return false;
}

function list_item_desc($tab,$descx='',$sel='') {
	$where = ($descx == '')?"WHERE tab_index=$tab ORDER BY item_desc":"WHERE tab_index=$tab AND item_xdesc='$descx' ORDER BY item_desc";
	$opt = "";
	if (@row_count("code_param_desc",$where,get_db_name()) == 0) {
		$opt .= "<option value=''>--Not Found--</option>";
	} else {
		$opt .= "";
		$q = selectGroup("*","code_param_desc",$where,get_db_name());
		while ($row = @mysql_fetch_array($q)) {
			if ($sel == $row['item_code'])
				$opt .= "<option value='$row[item_code]' selected='selected'>$row[item_desc]</option>";
			else 
				$opt .= "<option value='$row[item_code]'>$row[item_desc]</option>";
		}
	}
	return $opt;
}

function list_item_descx($from,$val,$label,$ser='',$sel='',$db='') {
	$where = ($ser == '')?"ORDER BY $label":"$ser ORDER BY $label";
	$opt = "";
	if (@row_count($from,$where,$db) == 0) {
		$opt .= "<option value=''>--Not Found--</option>";
	} else {
		$opt .= "";
		$q = selectGroup("*",$from,$where,$db);
		while ($row = @mysql_fetch_array($q)) {
			if ($sel == $row[$val])
				$opt .= "<option value='$row[$val]' selected='selected'>$row[$label]</option>";
			else 
				$opt .= "<option value='$row[$val]'>$row[$label]</option>";
		}
	}
	return $opt;
}

function fetch_item_desc($tab,$code) {
	return get_info("code_param_desc","item_desc","WHERE tab_index=$tab AND item_code='$code'",get_db_name());
}

function fetch_item_xdesc($tab,$code) {
	return get_info("code_param_desc","item_xdesc","WHERE tab_index=$tab AND item_code='$code'",get_db_name());
}

function encode_64($str) {
	return base64_encode($str);
}

function decode_64($str) {
	return base64_decode($str);
}

function prepare_phone($phone,$country) {
	if (!strstr($phone,"+")) {
		$phone = fetch_item_xdesc(18,$country).substr($phone,-10);
	}
	return $phone;
}

function generate_code($char,$tbl='',$field='') {
	$start = '';
	$end = '';
	for ($i=1; $i<=$char; $i++) {
		$start .= 1;
		$end .= 9;	
	}
	if ($tbl == '') $rand = rand($start,$end);
	else {
		do {
			$rand = rand($start,$end);
		} while (row_count($tbl,"WHERE $field=$rand") == 1);
	}
	return $rand;
}

function deleteDir($dir) {
	if (file_exists($dir)) {
		@rmdir($dir);
	}
}

function deleteFile($file) {
	if (file_exists($file)) {
		@unlink($file);
	}
}

function makeDir($mydir) {
	$oldumask = umask(0);
	mkdir($mydir, 0777); // or even 01777 so you get the sticky bit set
	umask($oldumask); 
}

function delTree($dir) {
	$files = array_diff(scandir($dir), array('.','..'));
	foreach ($files as $file) {
		(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
	}
	return rmdir($dir);
} 

function prepare_domain($domain) {
	return str_replace(array("http://","www.","http://www."),"",$domain);
}

function set_db_name() {
	if (!isset($_SESSION['sch_db'])) {
		$host = strtolower($_SERVER['HTTP_HOST']);
		$host = strtolower(str_replace("/","",$host));
		if (isset($_GET['url'])) {
			$url = $_GET['url'];
		} else {
			$url = $host;
		}
		$url = prepare_domain($url);
		if (row_count("schools","WHERE school_url='$url'","complete_school") == 0) :
			die("Invalid school URL");
		else :
			$_SESSION['sch_db'] = get_info("schools","school_db","WHERE school_url='$url'","complete_school");
		endif;
	}
}

function get_db_name() {
	return 'college_mgt_sys';

}

function get_sch_id() {
	return ltrim(get_db_name(),"cp_");
}

function get_theme() {
	$theme = get_info("options","option_value","WHERE option_name='theme'",get_db_name());
	if ($theme == NULL) return false;
	else return $theme;
}

function get_page($link) {
	switch ($link) {
		case "Home":
			get_file(get_theme()."/pages/home.php");
			break;
		case "Contact-Us":
			get_file(get_theme()."/pages/contact.php");
			break;
		case "Admission":
			get_file(get_theme()."/pages/admission.php");
			break;
		case "Calendar":
			get_file(get_theme()."/pages/calendar.php");
			break;
		case "About-Us":
			get_file(get_theme()."/pages/about.php");
			break;
		case "Gallery":
			get_file(get_theme()."/pages/gallery.php");
			break;
		case "News":
			get_file(get_theme()."/pages/news.php");
			break;
		case "Category":
			get_file(get_theme()."/pages/category.php");
			break;
	}

}

function get_school_abv () {
	return get_info("options","option_value","WHERE `option_name`='sch_abriviation'",get_db_name());
}

function get_school_name () {
	return get_info("options","option_value","WHERE `option_name`='sch_name'",get_db_name());
}

function get_school_moto () {
	return get_info("options","option_value","WHERE `option_name`='sch_moto'",get_db_name());
}

function get_school_icon () {
	return get_info("options","option_value","WHERE `option_name`='sch_logo1'",get_db_name());
}

function get_school_logo () {
	return get_info("options","option_value","WHERE `option_name`='sch_logo'",get_db_name());
}

function get_school_watermark () {
	return get_info("options","option_value","WHERE `option_name`='sch_watermark'",get_db_name());
}

function get_school_address () {
	return get_info("options","option_value","WHERE `option_name`='sch_address'",get_db_name());
}

function get_school_phone () {
	return get_info("options","option_value","WHERE `option_name`='sch_phone'",get_db_name());
}

function get_school_email () {
	return get_info("options","option_value","WHERE `option_name`='sch_email'",get_db_name());
}

function get_style ($k=0) {
	if ($k == 0) : echo get_info("web_design","tab_value","WHERE `tab_index`='style'",get_db_name());
	else : echo get_info("web_design","tab_desc","WHERE `tab_index`='style'",get_db_name()); endif;
}

function get_slides () {
	echo get_info("web_design","tab_value","WHERE `tab_index`='slides'",get_db_name());
}

function get_principal_info ($info) {
	$info = "principal_".strtolower($info);
	return get_info("options","option_value","WHERE `option_name`='$info'",get_db_name());
}

function send_message($name,$email,$subject,$message) {
	return insert("messages",array("sender_name"=>$name,"sender_email"=>$email,"subject"=>$subject,"message"=>$message,"date"=>date_time('d')),get_db_name());
}

function check_session() {
	if (!isset($_SESSION['winz_sch_uid'])) {
		return 0;
	} else if (isset($_SESSION['winz_sch_uid']) && !isset($_SESSION['winz_sch_logged'])) {
		return 1;
	} else if (isset($_SESSION['winz_sch_uid']) && isset($_SESSION['winz_sch_logged'])) {
		return 3;
	}
}

function get_uid() {
	return $_SESSION['winz_sch_uid'];
}

function check_cookies($key)
{
    if (isset($_COOKIE[$key]))
        return true;
    else
        return false;
}

function get_url() {
	$u = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	return $u;
}

function set_cookie($cookie, $value, $expire = 2419200) {
	setcookie($cookie, $value, time() + $expire, '/');
}

function get_cookie($cookie) {
	return $_COOKIE[$cookie];
}

function unset_cookie($cookie) {
	setcookie($cookie, null, time() - 10, '/');
	unset($_COOKIE[$cookie]);
}

function check_logged() {
	if (!isset($_SESSION['winz_sch_uid']) || !isset($_SESSION['winz_sch_logged'])) {
		echo "<script> window.location = '../'; </script>";
	}
}

function is_online() {
	return (get_info("options","option_value","WHERE `option_name`='is_online'","complete_school") == 1)?true:false;
}

function format_link($url, $links) {
	if (strstr($url,'?')) {
		$ex = explode("?",$url);
		$ex = explode("&",$ex[1]);
		return "?$ex[0]&$links";
	} else {
		return "?".$links;
	}
}

function get_design_per() {
	$num = row_count("web_design","WHERE `tab_value` <> ''",get_db_name());
	$total = row_count("web_design","",get_db_name());
	$per = ($num / $total) * 100;
	return $per;
}

function get_settings_per() {
	$num = row_count("options","WHERE `option_value` <> ''",get_db_name());
	$total = row_count("options","",get_db_name());
	$per = ($num / $total) * 100;
	return $per;
}

function format_daterange($date, $what='') {
	if ($what == '') {	
		$dur_arr = explode(" - ",$date);
		$dur_arr1 = explode("/",$dur_arr[0]);
		$dur_arr2 = explode("/",$dur_arr[1]);
		$start = "$dur_arr1[2]-$dur_arr1[0]-$dur_arr1[1]";
		$end = "$dur_arr2[2]-$dur_arr2[0]-$dur_arr2[1]";
		return array("from"=>$start, "to"=>$end);
	} else {
		$dur_arr = explode(" / ",$date);
		$dur_arr1 = explode("-",$dur_arr[0]);
		$dur_arr2 = explode("-",$dur_arr[1]);
		$start = "$dur_arr1[1]/$dur_arr1[2]/$dur_arr1[0]";
		$end = "$dur_arr2[1]/$dur_arr2[2]/$dur_arr2[0]";
		return "$start TO $end";
	}
}

function format_single_date($date, $sep='', $return='array') {
	if ($sep == '') {	
		$dur_arr1 = explode("/",$date);
		$str_return = "$dur_arr1[2]-$dur_arr1[0]-$dur_arr1[1]";
		$arr_return = array("month"=>$dur_arr1[0],"day"=>$dur_arr1[1],"year"=>$dur_arr1[2]);
	} else {
		$dur_arr1 = explode("-",$date);
		$str_return = "$dur_arr1[1]/$dur_arr1[2]/$dur_arr1[0]";
		$arr_return = array("month"=>$dur_arr1[0],"day"=>$dur_arr1[1],"year"=>$dur_arr1[2]);
	}
	return ($return == 'array')?$arr_return:$str_return;
}

function get_suffix($num) {
	if (substr($num,-2) == 11) {
		return $num.'th';
	} 
	else if (substr($num,-2) == 12) {
		return $num.'th';
	} 
	else {
		switch (substr($num,-1)) {
			case 0: return $num.'th'; break;
			case 1: return $num.'st'; break;
			case 2: return $num.'nd'; break;
			case 3: return $num.'rd'; break;
			default: return $num.'th'; break;
		}
	}
}

function programme_dur($dur,$sel='') {
	$sel = ($sel != '')?"selected='selected'":'';
	$opt = "";
	if (strstr($dur,'Y')) {
		$durr = str_replace(array('y','yr','year','years'),'',$dur);
		for ($i=1; $i<=$durr; $i+=1) {
			$v = $i.'00';
			$opt .= "<option value='$v' $sel>".get_suffix($i)." Year</option>";
		}
	} else {
		$durr = str_replace(array('m','month','months','mon'),'',$dur);
		for ($i=1; $i<=$durr; $i+=1) {
			$opt .= "<option value='$i' $sel>".get_suffix($i)." Month</option>";
		}
	}
	return $opt;
}

function format_time($time,$how='a') { // a simple means array while s means string
	$exp = explode(':',$time);
	if ($how == 'a') {
		return array('h'=>$exp[0], 'm'=>$exp[1], 's'=>$exp[2]);
	} else {
		$h = ($exp[0] > 1)?"$exp[0]Hrs":"$exp[0]Hr";
		$m = ($exp[1] > 1)?"$exp[1]Mins":"$exp[1]Min";
		$s = ($exp[2] > 1)?"$exp[2]Secs":"$exp[2]Secs";
		return "$h $m $s";
	}
}

function stage_color ($stage) {
	$color = 'bg-default';
	if ($stage == 1 || $stage == 2) $color = 'bg-red';
	else if ($stage == 3 || $stage == 4) $color = 'bg-yellow';
	else if ($stage == 5 || $stage == 6 || $stage == 7) $color = 'bg-aqua';
	else if ($stage == 8 || $stage == 9 || $stage == 10) $color = 'bg-green';
	return $color;
}

function level_color ($level) {
	$color = 'bg-default';
	switch ($level) {
		case 1: $color = 'bg-red'; break;
		case 2: $color = 'bg-green'; break;
		default: $color = 'bg-aqua'; break;
	}
	return $color;
}

function status ($num) {
	$status = '';
	switch ($num) {
		case 0: $status = '<span class="badge bg-red">Unconfirmed</span>'; break;
		case 1: $status = '<span class="badge bg-green">Active</span>'; break;
		default: $status = '<span class="badge bg-yellow">Pending</span>'; break;
	}
	return $status;
}

function level_label ($level) {
	switch ($level) {
		case 1: return "Investor"; break;
		case 2: return "Repayment"; break;
		default: return "Benefactor"; break;
	}
}

function get_percentage ($total, $per, $reverse=true) {
    $total = ($total == 0) ? 1 : $total;
	if ($reverse) {
        $result = ($total * $per) / 100;
    } else {
        $result = ($per / $total) * 100;
    }
    return $result;
}

function prepare_uri ($text) {
    $text = str_replace(array('<','>','(',')','&','.',',','=','$','@','!','#','?','/','\\',']','[','\"','\"','*','^','~','%'),'',$text);
    $text = strtolower(str_replace(" ","-",$text));
	return strtolower(str_replace(array("--","---","----","-----"),"-",$text));
}

function number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function count_format ($count) {
    if ($count >= 1000000000) {
        $count = $count / 1000000000;
        return round($count,1)."B";
    } else if ($count >= 1000000) {
        $count = $count / 1000000;
        return round($count,1)."M";
    } else if ($count >= 1000) {
        $count = $count / 1000;
        return round($count,1)."K";
    } else {
        return $count;
    }
}

function word_continue ($txt, $word_count=8, $end_word="...") {
    $text = "";
    $txt = explode(" ",$txt);
    for ($i=0; $i<=($word_count-1); $i++) {
        $text .= $txt[$i]." ";
    }
    $text .= $end_word;
    return $text;
}

function text_continue ($txt, $txt_count=5, $end_txt="...") {
    if (strlen($txt) > $txt_count) {
        $txt = substr($txt,0,$txt_count).$end_txt;
    }
    return $txt;
}

function currency_converter($from_Currency='NGN',$to_Currency,$amount,$return='converted_amount') {
    if ($from_Currency == $to_Currency) {
        $data = array( 'rate' => 1, 'converted_amount' =>round($amount,2), 'from_Currency' => strtoupper($from_Currency), 'to_Currency' => strtoupper($to_Currency));
    } else {
        if (is_connected()) {
            $from_Currency = urlencode($from_Currency);
            $to_Currency = urlencode($to_Currency);
            $encode_amount = 1;
            $get = curl_request("https://finance.google.com/bctzjpnsun/converter?a=$encode_amount&from=$from_Currency&to=$to_Currency", false);
            $get = explode("<span class=bld>",$get);
            $get = explode("</span>",$get[1]);
            $rate= preg_replace("/[^0-9\.]/", null, $get[0]);
            $converted_amount = $amount*$rate;
            $data = array( 'rate' => $rate, 'converted_amount' =>round($converted_amount,2), 'from_Currency' => strtoupper($from_Currency), 'to_Currency' => strtoupper($to_Currency));
        } else {
            $data = array( 'rate' => "NILL", 'converted_amount' =>$amount, 'from_Currency' => strtoupper($from_Currency), 'to_Currency' => strtoupper($to_Currency));
        }
    }

    if ($return == 'array') {
        return $data;
    } else {
        return $data[$return];
    }
}

function is_connected()
{
    $connected = @fsockopen("www.google.com", 80);
    //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
    }
    return $is_conn;

}

function curl_request ($url, $json=true) {
    $curl_options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => false,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CONNECTTIMEOUT => 5
    );

    $curl = curl_init();
    curl_setopt_array( $curl, $curl_options );
    $result = curl_exec( $curl );

    if ($json)
        $result = (array) json_decode($result);

    return $result;
}

function get_curl_request($url, $method = 'POST', array $headers = [], array $body = [])
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    return $err; //json_decode($response, true);

}

function curl_get_request ($url, $json=true) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    $result = curl_exec($ch);
    if ($json)
        $result = (array) json_decode($result);

    return $result;
}

function http_request($url) {
    $json = file_get_contents($url);
    return json_decode($json);
}

function copyright ($start=2018) {
    return ($start == date('Y')) ? $start : "$start - ".date('Y');
}

function get_ip_address () {
    return $_SERVER['REMOTE_ADDR'];
}
?>