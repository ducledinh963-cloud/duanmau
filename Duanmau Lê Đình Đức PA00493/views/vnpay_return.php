<?php
// views/vnpay_return.php
?>
<div class="container" style="margin-top: 40px; margin-bottom: 60px; max-width: 600px; margin-left: auto; margin-right: auto;">
    <div style="background: white; border-radius: 20px; border: 1px solid var(--border-color); padding: 40px; box-shadow: var(--shadow-lg); text-align: center; position: relative; overflow: hidden;">
        
        <!-- Premium background accent gradient line -->
        <div style="position: absolute; top: 0; left: 0; right: 0; height: 6px; background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));"></div>

        <?php if ($payment_status === 'success'): ?>
            <!-- SUCCESS STATUS -->
            <div style="margin-bottom: 25px;">
                <!-- Checkmark SVG with custom bounce animation styling -->
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 0 auto; display: block;">
                    <circle cx="40" cy="40" r="36" fill="#e8f8f0" />
                    <circle cx="40" cy="40" r="36" stroke="var(--primary-color)" stroke-width="4" stroke-linecap="round" />
                    <path d="M26 40L35 49L54 30" stroke="var(--primary-color)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            
            <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--primary-color); margin-bottom: 10px;">Thanh toán thành công!</h2>
            <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 30px; line-height: 1.5;">Cảm ơn bạn đã tin dùng sản phẩm của chúng tôi. Đơn hàng của bạn đã được thanh toán và đang tiến hành xử lý giao hàng.</p>
            
        <?php else: ?>
            <!-- FAILURE STATUS -->
            <div style="margin-bottom: 25px;">
                <!-- Cross SVG for errors -->
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin: 0 auto; display: block;">
                    <circle cx="40" cy="40" r="36" fill="#fdedec" />
                    <circle cx="40" cy="40" r="36" stroke="var(--danger-color)" stroke-width="4" stroke-linecap="round" />
                    <path d="M28 28L52 52M52 28L28 52" stroke="var(--danger-color)" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            
            <h2 style="font-size: 1.8rem; font-weight: 800; color: var(--danger-color); margin-bottom: 10px;">Thanh toán thất bại</h2>
            <p style="color: #64748b; font-size: 0.95rem; margin-bottom: 30px; line-height: 1.5;">
                <?= !empty($error_message) ? $error_message : 'Đã có lỗi xảy ra trong quá trình thanh toán hoặc giao dịch bị hủy bỏ.' ?>
            </p>
        <?php endif; ?>

        <!-- TRANSACTION RECEIPT DETAILS -->
        <div style="background: #f8fafc; border-radius: 12px; border: 1px solid var(--border-color); padding: 20px; margin-bottom: 35px; text-align: left;">
            <h4 style="font-size: 1rem; font-weight: 700; color: #1e293b; margin-top: 0; margin-bottom: 15px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                <span>Chi tiết giao dịch</span>
                <span style="font-size: 0.75rem; font-weight: 500; background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 4px;">VNPAY Gateway</span>
            </h4>
            
            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.9rem;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b;">Mã đơn hàng:</span>
                    <span style="font-weight: 700; color: #0f172a;">DH-<?= htmlspecialchars($_GET['vnp_TxnRef'] ?? 'N/A') ?></span>
                </div>
                
                <?php if (isset($_GET['vnp_Amount'])): ?>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b;">Số tiền thanh toán:</span>
                    <span style="font-weight: 700; color: var(--secondary-color); font-size: 1.1rem;"><?= number_format($_GET['vnp_Amount'] / 100, 0, ',', '.') ?> ₫</span>
                </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['vnp_TransactionNo']) && $_GET['vnp_TransactionNo'] != '0'): ?>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b;">Mã giao dịch VNPay:</span>
                    <span style="font-weight: 600; color: #334155; font-family: monospace;"><?= htmlspecialchars($_GET['vnp_TransactionNo']) ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['vnp_BankCode'])): ?>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b;">Ngân hàng thanh toán:</span>
                    <span style="font-weight: 600; color: #334155;"><?= htmlspecialchars($_GET['vnp_BankCode']) ?></span>
                </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['vnp_PayDate'])): 
                    $paydate = $_GET['vnp_PayDate'];
                    if (strlen($paydate) == 14) {
                        $formatted_date = substr($paydate, 8, 2) . ':' . substr($paydate, 10, 2) . ':' . substr($paydate, 12, 2) . ' - ' . substr($paydate, 6, 2) . '/' . substr($paydate, 4, 2) . '/' . substr($paydate, 0, 4);
                    } else {
                        $formatted_date = $paydate;
                    }
                ?>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #64748b;">Thời gian thanh toán:</span>
                    <span style="font-weight: 500; color: #334155;"><?= htmlspecialchars($formatted_date) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="index.php" style="flex: 1; max-width: 200px; padding: 12px 20px; background-color: var(--primary-color); color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 0.9rem; transition: background-color 0.2s, transform 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 8px;" onmouseover="this.style.backgroundColor='var(--primary-hover)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='var(--primary-color)'; this.style.transform='translateY(0)';">
                <i class="fa-solid fa-house"></i> VỀ TRANG CHỦ
            </a>
            
            <?php if ($payment_status !== 'success'): ?>
                <a href="index.php?act=viewcart" style="flex: 1; max-width: 200px; padding: 12px 20px; background-color: #e2e8f0; color: #475569; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 0.9rem; transition: background-color 0.2s, transform 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 8px;" onmouseover="this.style.backgroundColor='#cbd5e1'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='#e2e8f0'; this.style.transform='translateY(0)';">
                    <i class="fa-solid fa-cart-shopping"></i> THỬ LẠI
                </a>
            <?php else: ?>
                <a href="index.php?act=sanpham" style="flex: 1; max-width: 200px; padding: 12px 20px; background-color: var(--secondary-color); color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 0.9rem; transition: background-color 0.2s, transform 0.2s; display: inline-flex; align-items: center; justify-content: center; gap: 8px;" onmouseover="this.style.backgroundColor='var(--secondary-hover)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.backgroundColor='var(--secondary-color)'; this.style.transform='translateY(0)';">
                    <i class="fa-solid fa-bag-shopping"></i> MUA SẮM TIẾP
                </a>
            <?php endif; ?>
        </div>

    </div>
</div>
