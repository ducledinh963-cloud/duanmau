<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tạo mới đơn hàng</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">
        <div class="container mt-5" style="max-width: 600px;">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title text-center mb-0">Thanh toán VNPAY</h3>
                </div>
                <div class="card-body">
                    <form action="vnpay_create_payment.php" id="create_form" method="post">
                        <div class="mb-3">
                            <label for="order_id" class="form-label">Mã đơn hàng</label>
                            <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>"/>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Số tiền</label>
                            <input class="form-control" id="amount" name="amount" type="number" value="10000"/>
                        </div>
                        <div class="mb-3">
                            <label for="order_desc" class="form-label">Nội dung thanh toán</label>
                            <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2">Thanh toán đơn hàng test</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="bank_code" class="form-label">Ngân hàng</label>
                            <select name="bank_code" id="bank_code" class="form-select">
                                <option value="">Không chọn</option>
                                <option value="NCB"> Ngan hang NCB</option>
                                <option value="AGRIBANK"> Ngan hang Agribank</option>
                                <option value="SCB"> Ngan hang SCB</option>
                                <option value="SACOMBANK">Ngan hang Sacombank</option>
                                <option value="EXIMBANK"> Ngan hang Eximbank</option>
                                <option value="MSBANK"> Ngan hang MSBANK</option>
                                <option value="NAMABANK"> Ngan hang NamABank</option>
                                <option value="VNMART"> Vi dien tu VnMart</option>
                                <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                <option value="VIETCOMBANK"> Ngan hang Vietcombank</option>
                                <option value="HDBANK"> Ngan hang HDBank</option>
                                <option value="DONGABANK"> Ngan hang Dong A</option>
                                <option value="TPBANK"> Ngan hang TPBank</option>
                                <option value="OJB"> Ngan hang OceanBank</option>
                                <option value="BIDV"> Ngan hang BIDV</option>
                                <option value="TECHCOMBANK"> Ngan hang Techcombank</option>
                                <option value="VPBANK"> Ngan hang VPBank</option>
                                <option value="MBBANK"> Ngan hang MBBank</option>
                                <option value="ACB"> Ngan hang ACB</option>
                                <option value="OCB"> Ngan hang OCB</option>
                                <option value="IVB"> Ngan hang IndovinaBank</option>
                                <option value="VISA"> Thanh toan qua the VISA/MASTER</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Thanh toán (Redirect)</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
