<div class="container">
    <div class="static-page-card" style="padding: 0; overflow: hidden;">
        <div style="display: grid; grid-template-columns: 1fr 1.2fr;">
            <!-- LEFT: INFO -->
            <div style="background-color: var(--primary-color); color: white; padding: 40px; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h2 style="color: white; margin-bottom: 20px;">Liên Hệ Với Chúng Tôi</h2>
                    <p style="margin-bottom: 25px; opacity: 0.9;">Hãy liên hệ ngay nếu bạn có bất kỳ thắc mắc, đề xuất hợp tác hoặc cần hỗ trợ về đơn hàng.</p>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fa-solid fa-location-dot" style="font-size: 1.2rem; margin-top: 3px;"></i>
                        <div>
                            <h4 style="font-weight: 600; margin-bottom: 3px;">Địa chỉ văn phòng</h4>
                            <p style="font-size: 0.9rem; opacity: 0.85;">114 Đường 9A, KDC Trung Sơn, Bình Hưng, Bình Chánh, TP. Hồ Chí Minh</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fa-solid fa-phone" style="font-size: 1.2rem; margin-top: 3px;"></i>
                        <div>
                            <h4 style="font-weight: 600; margin-bottom: 3px;">Số điện thoại hỗ trợ</h4>
                            <p style="font-size: 0.9rem; opacity: 0.85;">037 53 12345 (Tất cả các ngày trong tuần)</p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fa-solid fa-envelope" style="font-size: 1.2rem; margin-top: 3px;"></i>
                        <div>
                            <h4 style="font-weight: 600; margin-bottom: 3px;">Email tiếp nhận thông tin</h4>
                            <p style="font-size: 0.9rem; opacity: 0.85;">info@foodmap.asia / hotro@foodmap.vn</p>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 40px; font-size: 0.85rem; opacity: 0.7;">
                    Bản quyền thuộc về Foodmap.asia
                </div>
            </div>

            <!-- RIGHT: FORM -->
            <div style="padding: 40px;">
                <h3 style="color: var(--text-color); margin-bottom: 25px; font-weight: 700;">Gửi tin nhắn phản hồi</h3>
                
                <form action="#" method="POST" onsubmit="alert('Cảm ơn phản hồi của bạn! Chúng tôi sẽ liên hệ lại sớm nhất.'); this.reset(); return false;">
                    <div class="form-group">
                        <label for="name">Họ và tên của bạn *</label>
                        <input type="text" id="name" class="form-control" placeholder="Nhập đầy đủ họ tên" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Địa chỉ Email *</label>
                        <input type="email" id="email" class="form-control" placeholder="example@gmail.com" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Nội dung tin nhắn *</label>
                        <textarea id="message" class="form-control" style="min-height: 120px; resize: vertical;" placeholder="Nhập câu hỏi hoặc ý kiến của bạn..." required></textarea>
                    </div>

                    <button type="submit" class="form-btn">GỬI YÊU CẦU LIÊN HỆ</button>
                </form>
            </div>
        </div>
        
        <!-- MAP IFRAME SIMULATION OR INTEGRATION -->
        <div style="height: 300px; width: 100%;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.9544103877566!2d106.69176337570308!3d10.73800245989766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f9b8c07e0bb%3A0xe53be9bf845ba0b1!2zMTE0IMSQxrDhu51uZyA5QSwgQsOsbmggSHV5bmgsIELDrG5oIENow6FuaCwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1717144000000!5m2!1svi!2s" 
                width="100%" 
                height="100%" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
