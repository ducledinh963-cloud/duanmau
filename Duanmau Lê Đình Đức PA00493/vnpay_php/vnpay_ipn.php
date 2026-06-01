<?php
/*
 * IPN URL: Nhận kết quả thanh toán từ VNPAY
 * Sau khi thanh toán tại VNPAY, VNPAY sẽ gọi về IPN URL để cập nhật kết quả giao dịch.
 */
require_once("./config.php");
require_once("../models/pdo.php");
require_once("../models/donhang.php");

$inputData = array();
$vnp_SecureHash = $_GET['vnp_SecureHash'] ?? '';
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}
unset($inputData['vnp_SecureHash']);
unset($inputData['vnp_SecureHashType']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
$vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? '';
$vnp_TxnRef = $_GET['vnp_TxnRef'] ?? '';
$vnp_Amount = isset($_GET['vnp_Amount']) ? ($_GET['vnp_Amount'] / 100) : 0;

try {
    // 1. Kiểm tra chữ ký bảo mật
    if ($secureHash === $vnp_SecureHash) {
        // 2. Lấy thông tin đơn hàng trong CSDL
        $order = loadone_donhang($vnp_TxnRef);
        
        if ($order) {
            // 3. Kiểm tra số tiền giao dịch khớp với đơn hàng
            if (abs($order['total_amount'] - $vnp_Amount) < 0.01) {
                // 4. Kiểm tra trạng thái đơn hàng (tránh xác nhận trùng lặp)
                if ($order['status'] == 0) {
                    if ($vnp_ResponseCode == '00') {
                        // Cập nhật trạng thái: Đã thanh toán / Đang giao (1)
                        update_donhang_status($vnp_TxnRef, 1);
                        $returnData = array('RspCode' => '00', 'Message' => 'Confirm Success');
                    } else {
                        // Cập nhật trạng thái: Hủy / Thất bại (3)
                        update_donhang_status($vnp_TxnRef, 3);
                        $returnData = array('RspCode' => '00', 'Message' => 'Payment Failed or Cancelled');
                    }
                } else {
                    $returnData = array('RspCode' => '02', 'Message' => 'Order already confirmed');
                }
            } else {
                $returnData = array('RspCode' => '04', 'Message' => 'Invalid amount');
            }
        } else {
            $returnData = array('RspCode' => '01', 'Message' => 'Order not found');
        }
    } else {
        $returnData = array('RspCode' => '97', 'Message' => 'Invalid signature');
    }
} catch (Exception $e) {
    $returnData = array('RspCode' => '99', 'Message' => 'Unknown error: ' . $e->getMessage());
}

header('Content-Type: application/json');
echo json_encode($returnData);
