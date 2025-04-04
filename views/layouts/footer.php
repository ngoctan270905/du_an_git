    </main>
    <!-- Footer -->
    <footer class="bg-light pt-5">
        <div class="container">
            <div class="row">
                <!-- Đăng ký nhận bản tin -->
                <div class="col-12 mb-4">
                    <div class="bg-secondary bg-opacity-10 p-4 rounded">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">ĐĂNG KÝ NHẬN BẢN TIN</h5>
                            </div>
                            <div class="col-md-6">
                                <form action="index.php?act=subscribe" method="POST" class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ email của bạn" required>
                                    <button class="btn btn-danger" type="submit">Đăng ký</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin công ty -->
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">DỊCH VỤ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php?act=terms" class="text-dark text-decoration-none">Điều khoản sử dụng</a></li>
                        <li class="mb-2"><a href="index.php?act=privacy" class="text-dark text-decoration-none">Chính sách bảo mật</a></li>
                        <li class="mb-2"><a href="index.php?act=about" class="text-dark text-decoration-none">Giới thiệu Fahasa</a></li>
                        <li class="mb-2"><a href="index.php?act=stores" class="text-dark text-decoration-none">Hệ thống trung tâm</a></li>
                    </ul>
                </div>

                <!-- Hỗ trợ -->
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">HỖ TRỢ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php?act=return-policy" class="text-dark text-decoration-none">Chính sách đổi trả</a></li>
                        <li class="mb-2"><a href="index.php?act=warranty" class="text-dark text-decoration-none">Chính sách bảo hành</a></li>
                        <li class="mb-2"><a href="index.php?act=shipping" class="text-dark text-decoration-none">Chính sách vận chuyển</a></li>
                        <li class="mb-2"><a href="index.php?act=payment" class="text-dark text-decoration-none">Phương thức thanh toán</a></li>
                    </ul>
                </div>

                <!-- Tài khoản -->
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">TÀI KHOẢN CỦA TÔI</h5>
                    <ul class="list-unstyled">
                        <?php if(!isset($_SESSION['user'])): ?>
                            <li class="mb-2"><a href="index.php?act=login" class="text-dark text-decoration-none">Đăng nhập/Tạo tài khoản</a></li>
                        <?php else: ?>
                            <li class="mb-2"><a href="index.php?act=profile" class="text-dark text-decoration-none">Thông tin tài khoản</a></li>
                            <li class="mb-2"><a href="index.php?act=address" class="text-dark text-decoration-none">Thay đổi địa chỉ</a></li>
                            <li class="mb-2"><a href="index.php?act=orders" class="text-dark text-decoration-none">Lịch sử mua hàng</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Liên hệ -->
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">LIÊN HỆ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?php echo htmlspecialchars($config['company_address'] ?? '60-62 Lê Lợi, Q.1, TP. HCM'); ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <?php echo htmlspecialchars($config['company_email'] ?? 'cskh@fahasa.com.vn'); ?>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <?php echo htmlspecialchars($config['company_phone'] ?? '1900636467'); ?>
                        </li>
                    </ul>
                    <!-- Social Media -->
                    <div class="social-links mt-3">
                        <?php if(isset($config['social_links']) && is_array($config['social_links'])): ?>
                            <?php foreach($config['social_links'] as $platform => $link): ?>
                                <a href="<?php echo htmlspecialchars($link); ?>" class="text-dark me-3" target="_blank">
                                    <i class="fab fa-<?php echo $platform; ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <a href="#" class="text-dark me-3"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="text-dark me-3"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="text-dark me-3"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="text-dark me-3"><i class="fab fa-twitter"></i></a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="col-12 mt-4">
                    <h5 class="mb-3">PHƯƠNG THỨC THANH TOÁN</h5>
                    <div class="payment-methods">
                        <?php if(isset($payment_methods) && is_array($payment_methods)): ?>
                            <?php foreach($payment_methods as $method): ?>
                                <img src="assets/images/payment/<?php echo htmlspecialchars($method['icon']); ?>" 
                                     alt="<?php echo htmlspecialchars($method['name']); ?>" 
                                     class="me-2" style="height: 30px;">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <img src="assets/images/payment/vnpay.png" alt="VNPay" class="me-2" style="height: 30px;">
                            <img src="assets/images/payment/momo.png" alt="Momo" class="me-2" style="height: 30px;">
                            <img src="assets/images/payment/zalopay.png" alt="ZaloPay" class="me-2" style="height: 30px;">
                            <img src="assets/images/payment/shopeepay.png" alt="ShopeePay" class="me-2" style="height: 30px;">
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Shipping Partners -->
                <div class="col-12 mt-4">
                    <h5 class="mb-3">ĐỐI TÁC VẬN CHUYỂN</h5>
                    <div class="shipping-partners">
                        <?php if(isset($shipping_partners) && is_array($shipping_partners)): ?>
                            <?php foreach($shipping_partners as $partner): ?>
                                <img src="assets/images/shipping/<?php echo htmlspecialchars($partner['icon']); ?>" 
                                     alt="<?php echo htmlspecialchars($partner['name']); ?>" 
                                     class="me-2" style="height: 30px;">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <img src="assets/images/shipping/ghn.png" alt="GHN" class="me-2" style="height: 30px;">
                            <img src="assets/images/shipping/ninjavan.png" alt="NinjaVan" class="me-2" style="height: 30px;">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="row mt-4 border-top pt-3">
                <div class="col-12 text-center">
                    <p class="mb-0">© <?php echo date('Y'); ?> <?php echo htmlspecialchars($config['company_name'] ?? 'FAHASA.COM'); ?> - <?php echo htmlspecialchars($config['company_description'] ?? 'Bản quyền của Công Ty Cổ Phần Phát Hành Sách TP HCM - FAHASA'); ?></p>
                    <p class="small text-muted">
                        <?php echo htmlspecialchars($config['business_license'] ?? 'Giấy chứng nhận Đăng ký Kinh doanh số 0304132047 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp ngày 20/12/2005.'); ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 