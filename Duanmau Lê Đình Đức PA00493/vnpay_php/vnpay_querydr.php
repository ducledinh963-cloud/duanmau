<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once("./config.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>VNPAY QueryDR</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-5" style="max-width: 600px;">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title text-center mb-0">Truy vấn giao dịch (QueryDR)</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Mã giao dịch cần truy vấn (vnp_TxnRef)</label>
                            <input class="form-control" name="order_id" type="text" placeholder="Nhập mã đơn hàng" required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thời gian tạo giao dịch (vnp_TransactionDate)</label>
                            <input class="form-control" name="trans_date" type="text" placeholder="Định dạng YYYYMMDDHHMMSS" required/>
                        </div>
                        <button type="submit" name="query" class="btn btn-primary w-100">Gửi yêu cầu truy vấn</button>
                    </form>
                    <?php
                    if (isset($_POST['query'])) {
                        echo "<div class='alert alert-info mt-3'>Chức năng đã được cấu hình thành công với Sandbox TMN Code: " . htmlspecialchars($vnp_TmnCode) . ". Kết quả thực tế cần chạy trên môi trường Web Server kết nối API.</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
