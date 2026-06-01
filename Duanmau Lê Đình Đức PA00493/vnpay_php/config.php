<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$vnp_TmnCode = "2QXG2AHP"; // Website ID in VNPAY System
$vnp_HashSecret = "GETLEPZCQZOMHUXMMXXWJPOUXMLZQLXT"; // Secret key
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

// Construct Return URL dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domain = $_SERVER['HTTP_HOST'];
// Get directory of current script and go up one level if we are inside vnpay_php
$script_name = $_SERVER['SCRIPT_NAME'];
$dir_path = dirname($script_name);
// Normalize to root project URL
$vnp_Returnurl = $protocol . $domain . dirname($dir_path) . "/index.php?act=vnpay_return";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/api.html";
$apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api.html";
// Expire date
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
