<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once("./config.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>VNPAY Refund</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-5" style="max-width: 600px;">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title text-center mb-0">Hoàn tiền giao dịch (Refund)</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Mã đơn hàng cần hoàn tiền</label>
                            <input class="form-control" name="order_id" type="text" required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số tiền hoàn (VND)</label>
                            <input class="form-control" name="amount" type="number" required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kiểu hoàn tiền</label>
                            <select name="refund_type" class="form-select">
                                <option value="02">Hoàn tiền toàn phần</option>
                                <option value="03">Hoàn tiền một phần</option>
                            </select>
                        </div>
                        <button type="submit" name="refund" class="btn btn-danger w-100">Gửi yêu cầu hoàn tiền</button>
                    </form>
                    <?php
                    if (isset($_POST['refund'])) {
                        echo "<div class='alert alert-warning mt-3'>Yêu cầu hoàn tiền đã cấu hình tham số Merchant ID: " . htmlspecialchars($vnp_TmnCode) . ". Giao dịch thử nghiệm cần có kết nối trực tiếp đến cổng Sandbox Merchant WebAPI.</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
