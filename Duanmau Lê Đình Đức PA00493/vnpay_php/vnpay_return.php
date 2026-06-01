<?php
session_start();
// Redirect query parameters back to main controller to render themed UI
$query_string = $_SERVER['QUERY_STRING'];
header("Location: ../index.php?act=vnpay_return&" . $query_string);
exit();
