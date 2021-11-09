    <section class="form">
        <h2 class="form__title">ĐĂNG KÝ NHẬN EMAIL THÔNG BÁO KHUYẾN MẠI HOẶC ĐỂ ĐƯỢC TƯ VẤN MIỄN PHÍ</h2>
        <form class="input-group mb-3 form__group" action="mail.php" method="POST" id="form-contact">
            <input id="mail-contact" type="text" name="contact" class="form-control form__input" placeholder="Nhập email hoặc số điện thoại của bạn">
            <select id="mail-gender" name = "gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <button class="btn btn-outline-secondary form__btn" name="submit" type="submit" id="mail-submit">Gửi</button>
        </form>
        <h3 class="text-red fs-4 form-message"></h3>
    </section>

    <!-- LIST SHOWROOM -->
    <section class="showrooms">
        <div class="wrapper">
            <h2 class="showrooms__title">HỆ THỐNG CÁC SHOWROOM CỦA HACOM</h2>
            <div class="showrooms__info">
                <div class="row" id="showrooms">
                    <?php 
                        include 'dbh.php';
                        $sql = "SELECT * FROM showrooms LIMIT 2";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="col-xl-3 col-md-4 info-col">';
                                echo '<h2 class="info__location info__location--active">';
                                echo '<span>' . $row['id'] . '</span>' . $row['name'] . '</h2>';
                                echo '<h3 class="fw-bold"><i class="fas fa-map-marker-alt"></i> ';
                                echo $row['location'] . '</h3>'; 
                                echo '<a href="#"><i class="far fa-images"></i> Hình ảnh thực tế showroom</a>';
                                echo '<a href="#"><i class="far fa-map"></i> Xem bản đồ đường đi</a>';
                                echo '<a href="tel:' . substr($row['contacts'],5,9) . '">' . '';
                                echo '<i class="fas fa-phone-alt"></i> ';
                                echo $row['contacts'] . '</a>';
                                echo '<a href="tel:' . substr($row['insurance'],13,9) . '">' . '';
                                echo '<i class="fas fa-phone-alt"></i> ';
                                echo $row['insurance'] . '</a>';
                                echo '<a href="mailto:' . substr($row['email'],7) . '">' . '';
                                echo '<i class="far fa-envelope"></i> ';
                                echo $row['email'] . '</a>';
                                echo '<p><i class="far fa-clock"></i> ';
                                echo $row['open_time'] . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo "no more";
                        }
                    ?>
                    <!-- <div class="col-xl-3 col-md-4">
                        <form>
                            <select name="show_rooms" id = "show_rooms">
                                <option value="">Xem Showroom khác:</option>
                                <option value="4">HACOM - CẦU GIẤY</option>
                                <option value="5">HACOM - HÀ ĐÔNG</option>
                                <option value="6">HACOM - TP. HỒ CHÍ MINH</option>
                                <option value="7">HACOM - LONG BIÊN</option>
                                <option value="8">HACOM - TỪ SƠN</option>
                                <option value="9">HACOM - HOÀN KIẾM</option>
                                <option value="10">HACOM - BẮC TỪ LIÊM</option>
                            </select>
                        </form>
                        <br>
                        <div id="contentHint"></div>
                    </div> -->
                </div>
                <button class = "btn btn-primary fs-4 p-4 mt-4" id="show_more">See more HACOM's Showroom</button>



            </div>
        </div>
    </section>        

    <!-- SUB BTN -->
    <button id="btn_scroll-top" class="hide"><i class="fas fa-arrow-up"></i></button>
    <div class="spin-btn"></div>
    <?php if($user && $user['role'] == 1) { ?>
        <div class="exec__btn">
            <i class="fas fa-ellipsis-h"></i>
            <div class="exec__list">
                <a href="cmt_search.php" class="exec__item"><i class="fas fa-comment-slash"></i></a>
                <a href="add.php" class="exec__item"><i class="fas fa-plus"></i></a>
                <a href="delete.php?id=<?php echo $resultLast['id'] ?>" class="exec__item"><i class="far fa-trash-alt"></i></a>
                <a href="edit.php?id=<?php echo $resultLast['id'] ?>" class="exec__item"><i class="far fa-edit"></i></i></a>
                <a href="search.php" class="exec__item"><i class="fas fa-search"></i></a>
            </div>
        </div>
    <?php } ?>
    

    <!-- FOOTER -->
    <footer class="footer">
        <div class="wrapper">
            <div class="footer__policies">
                <h2 class="footer__title d-none">chính sách bán hàng</h2>
                <div class="footer__policy-item">
                    <i class="fas fa-shipping-fast"></i>
                    <div class="footer__policy">
                        <h2 class="footer__policy-title">CHÍNH SÁCH GIAO HÀNG</h2>
                        <h3 class="footer__policy-text">Nhận hàng và thanh toán tại nhà</h3>
                    </div>
                </div>
                <div class="footer__policy-item">
                    <i class="fas fa-sync"></i>
                    <div class="footer__policy">
                        <h2 class="footer__policy-title">ĐỔI TRẢ DỄ DÀNG</h2>
                        <h3 class="footer__policy-text">Dùng thử trong vòng 3 ngày</h3>
                    </div>
                </div>
                <div class="footer__policy-item">
                    <i class="far fa-credit-card"></i>
                    <div class="footer__policy">
                        <h2 class="footer__policy-title">THANH TOÁN TIỆN LỢI</h2>
                        <h3 class="footer__policy-text">Trả tiền mặt, CK, trả góp 0%</h3>
                    </div>
                </div>
                <div class="footer__policy-item">
                    <i class="far fa-comments"></i>
                    <div class="footer__policy">
                        <h2 class="footer__policy-title">HỖ TRỢ NHIỆT TÌNH</h2>
                        <h3 class="footer__policy-text">Tư vấn, giải đáp mọi thắc mắc</h3>
                    </div>
                </div>
            </div>
            <!-- <= Tablet -->
                <div class="footer--mb-tl d-none">
                        <h2 class="footer__title">kết nối với chúng tôi</h2>
                    <div class="footer__socials footer__socials--mb-tl">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                    <!--  -->
                    <h2 class="footer__title">hệ thống showroom</h2>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                HACOM- HAI BÀ TRƯNG
                            </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p class="fs-5 p-3 fw-light">- 129+131 Lê Thanh Nghị - Đồng Tâm - Hai Bà Trưng - Hà Nội</p>
                                <p class="fs-5 p-3 fw-light">- Tel: 1900 1903 (máy lẻ 25395) – (024) 32051005</p>
                                <p class="fs-5 p-3 fw-light">- Email: kinhdoanh.haibatrung@hanoicomputer.com</p>
                                <a href="#" class="fs-5 p-3 fw-light text-primary d-inline-block">Xem bản đồ</a>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                HACOM- ĐỐNG ĐA
                            </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p class="fs-5 p-3 fw-light">- 43 Thái Hà - Trung Liệt - Đống Đa - Hà Nội</p>
                                <p class="fs-5 p-3 fw-light">- Tel: 1900 1903 (máy lẻ 25375) - (0243) 5380088</p>
                                <p class="fs-5 p-3 fw-light">- Email: kinhdoanh.dongda@hanoicomputer.com</p>
                                <a href="#" class="fs-5 p-3 fw-light text-primary d-inline-block">Xem bản đồ</a>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                HACOM- CẦU GIẤY
                            </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p class="fs-5 p-3 fw-light">- 79 Nguyễn Văn Huyên - Cầu Giấy - Hà Nội</p>
                                <p class="fs-5 p-3 fw-light">- Tel: 1900 1903 (máy lẻ 25378) - (024) 38610088</p>
                                <p class="fs-5 p-3 fw-light">- Email: kinhdoanh.caugiay@hanoicomputer.com</p>
                                <a href="#" class="fs-5 p-3 fw-light text-primary d-inline-block">Xem bản đồ</a>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                HACOM- HÀ ĐÔNG
                            </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <p class="fs-5 p-3 fw-light">- 511+513 Quang Trung - Hà Đông - Hà Nội</p>
                                <p class="fs-5 p-3 fw-light">- Tel: 1900 1903 (máy lẻ 25381) - (024) 38580088</p>
                                <p class="fs-5 p-3 fw-light">- Email: kinhdoanh.haibatrung@hanoicomputer.com</p>
                                <a href="#" class="fs-5 p-3 fw-light text-primary d-inline-block">Xem bản đồ</a>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFive">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                HACOM- HẢI PHÒNG
                            </button>
                            </h2>
                            <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSix">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                HACOM- TỪ SƠN
                            </button>
                            </h2>
                            <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingSeven">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                HACOM- HOÀN KIẾM
                            </button>
                            </h2>
                            <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingEight">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                HACOM- BẮC TỪ LIÊM
                            </button>
                            </h2>
                            <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingEight">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                PHÒNG CAMERA & TB AN NINH
                            </button>
                            </h2>
                            <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingNine">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                                PHÒNG BÁN HÀNG DỰ ÁN
                            </button>
                            </h2>
                            <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTen">
                            <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                                PHÒNG BÁN HÀNG TRỰC TUYẾN
                            </button>
                            </h2>
                            <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                            </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="text-center mt-5">
                        <h2 class="fs-4 p-3 fw bold">© 2021 Công ty Cổ phần đầu tư công nghệ HACOM</h2>
                        <p class="fs-5 p-3 fw-light">Địa chỉ: Số 129 + 131, phố Lê Thanh Nghị, Phường Đồng Tâm, Quận Hai Bà Trưng, Hà Nội</p>
                        <p class="fs-5 p-3 fw-light">GPĐKKD số 0101161194 do Sở KHĐT Tp.Hà Nội cấp ngày 31/8/2001</p>
                        <p class="fs-5 p-3 fw-light">Email: info@hacom.vn. Điện thoại: 1900 1903</p>
                        <a href="#" class="btn footer__btn-swap my-5">Chuyển sang phiên bản dành cho PC</a>

                    </div>
                </div>
            <!--  -->
        </div>
        <hr>
        <div class="wrapper footer__links-list">
            <div class="row">
                <div class="col">
                    <div class="footer__links">
                        <h3 class="footer__links-title">GIỚI THIỆU HACOM</h3>
                        <a href="#" class="footer__link">Giới thiệu công ty</a>
                        <a href="#" class="footer__link">Thông tin liên hệ</a>
                        <a href="#" class="footer__link">Thông tin tuyển dụng</a>
                        <a href="#" class="footer__link">Tin tức</a>
                        <div class="footer__socials">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="footer__links">
                        <h3 class="footer__links-title">HỖ TRỢ KHÁCH HÀNG</h3>
                        <a href="#" class="footer__link">Hướng dẫn mua hàng trực tuyến</a>
                        <a href="#" class="footer__link">Hướng dẫn thanh toán</a>
                        <a href="#" class="footer__link">Hướng dẫn mua hàng trả góp</a>
                        <a href="#" class="footer__link">In hóa đơn điện tử</a>
                        <a href="#" class="footer__link">Góp ý, Khiếu nại</a>
                        <a href="#" class="footer__link">Tin tức</a>
                        <a href="#" class="btn footer__btn-swap">Xem giao diện bản mobile</a>
                    </div>
                </div>
                <div class="col">
                    <div class="footer__links">
                        <h3 class="footer__links-title">CHÍNH SÁCH CHUNG</h3>
                        <a href="#" class="footer__link">Chính sách, quy định chung</a>
                        <a href="#" class="footer__link">Chính sách vận chuyển</a>
                        <a href="#" class="footer__link">Chính sách bảo hành</a>
                        <a href="#" class="footer__link">Chính sách đổi trả và hoàn tiền</a>
                        <a href="#" class="footer__link">Chính sách cho doanh nghiệp</a>
                        <a href="#" class="footer__link">Chính sách hàng chính hãng</a>
                        <a href="#" class="footer__link">Bảo mật thông tin khách hàng</a>
                    </div>
                </div>
                <div class="col">
                    <div class="footer__links">
                        <h3 class="footer__links-title">THÔNG TIN KHUYẾN MẠI</h3>
                        <a href="#" class="footer__link">Thông tin khuyến mại</a>
                        <a href="#" class="footer__link">Sản phẩm khuyến mại</a>
                        <a href="#" class="footer__link">Sản phẩm bán chạy</a>
                        <a href="#" class="footer__link">Sản phẩm mới</a>
                        <a href="#" class="footer__commerce-img"><img src="images/logos/dathongbao.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

    </footer>

