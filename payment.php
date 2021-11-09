<?php
    session_start();
    include("projectcnw_db.php");
    include("checklogin.php");
    $user = checkLoggedUser();

    $sum_price = isset($_REQUEST["sum_price"]) ? $_REQUEST["sum_price"] : "";

    $sql = 'SELECT * FROM grab_content ORDER BY id DESC LIMIT 1';
    $resultLast = select_one($sql);
	$sql = "select * from grab_category";
    $result_parents = select_list($sql);
    $user = "";
    if (isset($_SESSION['account'])){
        $user = $_SESSION['account'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin giỏ hàng</title>
    <link rel="stylesheet" href="bootstrap-5.1.1-dist/css/bootstrap.min.css">
    <!--  -->
    <link rel="stylesheet" href="css/slick-theme.min.css">
    <link rel="stylesheet" href="css/slick.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!--  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500;700;800&display=swap" rel="stylesheet">
    <!--  -->
    <link rel="stylesheet" href="fontawesome-free-5.15.4-web/css/all.min.css">
</head>
<body>
    <?php include ('header.php'); ?>

    <div class="payment wrapper">
        <div class="form form__payment">
            <input type="hidden" name="id" value="<?php echo $user["id"]?>"/>

            <div class="form-group"><p>Họ tên</p>
            <input name="username" value="<?php echo $user["username"]?>" placeholder="Tên tài khoản" required/></div>

            <div class="form-group"><p>Số điện thoại</p>
            <input name="phone" value="<?php echo $user["phone"]?>" placeholder="Số điện thoại" required/></div>

            <div class="form-group"><p>Email</p>
            <input name="email" value="<?php echo $user["email"]?>" placeholder="Email" required/></div>

            <div class="form-group form-gender">
                <p>Giới tính</p>
                <div><input class="form-check-input" type="radio" name="gender" id="gender1" value ='1' checked>
                <label class="form-check-label" for="gender1">
                    Nam
                </label></div>
                <div><input class="form-check-input" type="radio" name="gender" id="gender0" value ='0'>
                <label class="form-check-label" for="gender0">
                    Nữ
                </label></div>
            </div>

            <div class="form-group"><p>Địa chỉ</p>
            <input name="address" value="<?php echo $user["address"]?>" placeholder="Địa chỉ của bạn"/></div>
            <img src="images/logos/logo-trang.png" class="img-fluid w-50 mx-auto" alt="">
        </div>

        <form class="payment__products" action="payment_exec.php" method="post">
            <input type="hidden" name="buyer_id" value="<?php echo $user['id'] ?>">
            <?php if(isset($_SESSION['cart'])) { ?>
                <?php foreach($_SESSION['cart'] as $key => $val) {?> 
                    <div class="cart__product mb-3">
                        <div class="cart__product-info">
                            <a href="./chi-tiet.php?id=<?php echo $key?>"><img src="<?php $img = explode(',', $val['img']);echo $img[0];?>" alt=""></a>
                            <div class="cart__product-more">
                                <a href="./chi-tiet.php?id=<?php echo $key?>" class="cart__product-name"><?php echo $val['title'] ?></a>
                                <p class="cart__product-code">Mã SP: <?php echo $val['product_code'] ?></p>
                                <input type="hidden" name="product_code" value="<?php echo $val['product_code'] ?>">
                            </div>
                        </div>
                        <div>
                            x<?php echo $val['qnt'] ?>
                            <input type="hidden" name="qnt" value="<?php echo $val['qnt'] ?>">
                        </div>
                        <div class="cart__product-price">
                            <?php echo number_format($val['price'],0,'.','.')?> đ
                            <input type="hidden" name="price" value="<?php echo $val['price'] ?>">
                        </div>
                    </div>
                <?php }?>
            <?php }?>
            <div class="payment__total-price">
                <span>Thành tiền: </span>
                <span id="gtotal" class="text-red"><?php echo number_format($sum_price,0, '.','.')?> đ</span>
                <input type="hidden" name="sum_price" value="<?php echo $sum_price ?>">
            </div>
            <select name="pay_mode" class="fs-4 p-4 w-100 my-2" required>
                <option value="" hidden>Chọn hình thức thanh toán</option>
                <option value="COD">Thanh toán tiền mặt khi nhận hàng (tiền mặt / quẹt thẻ ATM, Visa, Master)</option>
                <option value="online">Thanh toán qua chuyển khoản qua tài khoản ngân hàng (khuyên dùng)</option>
                <option value="nganluong">Thanh toán qua Ngân Lượng (ATM nội địa, Visa, Master)</option>
                <option value="Alepay">Trả góp qua Alepay (Ngân Lượng)</option>
                <option value="VnPay">Thanh toán trực tuyến (Bằng thẻ ATM/Visa/Master qua cổng VnPay)</option>
            </select>
            <button class="btn btn-danger w-100 fs-2 payment__btn mt-4 py-2" name="payment">Đặt hàng</button>
        </form>
    </div>

    <?php include ('bottom.php'); ?>

    <script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <!--  -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!--  -->
    <script src="js/ajax_add.js"></script>
    <script src="js/all.js"></script>
    <script src="js/ajax_fetch.js"></script>
    <script src="js/mail.js"></script>

</body>
</html>