<?php
    session_start();
    include("projectcnw_db.php");
    // $cart = [];
    $_SESSION['sum_price'] = 0;
    $count = 0;
    if(isset($_SESSION['cart'])) {
        $count = count($_SESSION['cart']);
    }

    /* --------------------------------------------- */
    $sql = "select * from grab_category";
    $result_parents = select_list($sql);
    $user ="";
    if (isset($_SESSION['account'])){
        $user = $_SESSION['account'];
    }

    if($user['role'] == 1) {
        echo '<script>alert("❌Bạn không thể thực hiện chức năng với tài khoản này!")</script>';
        echo"<script>window.location = 'index.php'</script>";
    }

    $sql = 'SELECT * FROM grab_content ORDER BY id DESC LIMIT 1';
    $resultLast = select_one($sql);
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

    <!-- CART -->
    <div class="wrapper">
        <div class="cart">
            <div class="cart__top">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng của bạn</li>
                    </ol>
                </nav>
            </div>
            <h2>Giỏ hàng</h2>
            <div class="cart__content">
                <div class="cart__content--left">
                    <div class="cart__content--left-top">
                        <div class="cart__total-item">
                            <input type="checkbox" name="" id="" checked>
                            <p>Tất cả ( <?php echo $count?> sản phẩm)</p>
                        </div>
                        <span>Đơn giá</span>
                        <span>Số lượng</span>
                        <span>Thành tiền</span>
                        <a href="#" class="text-center"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    
                    <div class="cart__content--left-body">
                        <?php if(isset($_SESSION['cart'])) { ?>
                            <?php foreach($_SESSION['cart'] as $key => $val) {?> 
                                <div class="cart__product mb-3">
                                    <div class="cart__product-info">
                                        <input type="checkbox" name="" id="" checked>
                                        <a href="./chi-tiet.php?id=<?php echo $key?>"><img src="<?php $img = explode(',', $val['img']);echo $img[0];?>" alt=""></a>
                                        <div class="cart__product-more">
                                            <a href="./chi-tiet.php?id=<?php echo $key?>" class="cart__product-name"><?php echo $val['title'] ?></a>
                                            <p class="cart__product-code">Mã SP: <?php echo $val['product_code'] ?></p>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="cart__product-price">
                                        <?php echo number_format($val['price'],0,'.','.')?> đ
                                        <input type="hidden" name="" class="iprice" value="<?php echo $val['price'] ?>">
                                    </div>
                                    <!--  -->
                                    <form action="cart_update.php" method="post" class="cart__product-qnt">
                                        <button id="decBtn">-</button>
                                        <input type="number" class="form-control d-inline iquantity" min="1" max="10" value="<?php echo $val['qnt'] ?>" name="change_qnt" >
                                        <input type="hidden" name="title" value="<?php echo $val['title'] ?>">
                                        <button id="incBtn">+</button>
                                    </form>
                                    <!--  -->
                                    <div class="cart__total-price">
                                        <span class="itotal"></sp>
                                        <?php 
                                            $productPrice = (double)$val['price'];
                                            $product_total_price = $productPrice * $val['qnt'];
                                            $_SESSION['sum_price'] += $product_total_price;
                                            echo number_format($product_total_price, 0, '.', '.');
                                        ?> đ
                                    </div>
                                    <!--   -->
                                    <a href="cart_del.php?key=<?php echo $key?>"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            <?php } ?>
                        <!-- endif -->
                        <?php } if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {?>
                            <div class="cart__empty">
                                <img src="images/logos/empty_cart.png" alt="" class="cart__empty-img">
                                <p>Không có sản phẩm nào trong giỏ hàng của bạn</p>
                                <a href="./" class="btn cart__empty-btn">Tiếp tục mua sắm</a>
                            </div>
                            <?php }?>
                        </div>

                </div>

                <form action="payment.php" class="cart__content-right" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Mã giảm giá/ quà tặng">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Áp dụng</button>
                    </div>
                    <div class="cart__payment">
                        <div>
                            <span>Tạm tính</span>
                            <span id="gtotal_temp"><?php echo number_format($_SESSION['sum_price'],0,'.','.')?> đ</span>
                        </div>
                        <div>
                            <span>Giảm giá</span>
                            <span>0 đ</span>
                        </div>
                        <div>
                            <span>Thành tiền</span>
                            <span id="gtotal"><?php echo number_format($_SESSION['sum_price'],0, '.','.')?> đ</span>
                        </div>
                        <p class="vat">(Đã bao gồm VAT nếu có)</p>
                    </div>
                    <input type="hidden" name="sum_price" value="<?php echo $_SESSION['sum_price'] ?>">
                    <button class="btn btn__payment w-100">Tiến hành đặt hàng</button>
                </form>
            </div>
        </div>
    </div>

    <?php include ('bottom.php'); ?>
    
    
    <script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <!--  -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!--  -->
    <script src="js/cart.js"></script>
    <script src="js/all.js"></script>
    <script src="js/ajax_fetch.js"></script>
    <script src="js/mail.js"></script>

</body>
</html>