<?php
    session_start();
	include("projectcnw_db.php");
    //get ID product
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $location = "window.location = 'chi-tiet.php?id=$id'";
    // echo $location;exit();

    $sql = "select * from grab_content where id=" . $id ;
    $result = select_one($sql);
    // print_r($result);exit();
    //check status
    
    if($result) {
        if(isset($_SESSION['cart'])) {
            if(isset($_SESSION['cart'][$id])) {
                echo"<script>alert('Sản phẩm đã có trong giỏ hàng!')</script>";
                $_SESSION['cart'][$id]['qnt'] += 1;
            } else {
                echo"<script>alert('Đã thêm sản phẩm vào giỏ hàng!')</script>";
                $_SESSION['cart'][$id]['qnt'] = 1;
            }
            $_SESSION['cart'][$id]['title'] = $result['title'];
            $_SESSION['cart'][$id]['img'] = $result['img'];
            $_SESSION['cart'][$id]['product_code'] = $result['product_code'];
            $_SESSION['cart'][$id]['price'] = $result['price'];
            /* --- */
            echo"<script>$location</script>";
        } else {
            $_SESSION['cart'][$id]['qnt'] = 1;
            $_SESSION['cart'][$id]['title'] = $result['title'];
            $_SESSION['cart'][$id]['img'] = $result['img'];
            $_SESSION['cart'][$id]['product_code'] = $result['product_code'];
            $_SESSION['cart'][$id]['price'] = $result['price'];
            /* --- */
            echo"<script>alert('Đã thêm sản phẩm vào giỏ hàng!')</script>";
            echo"<script>$location</script>";
    
        }
    } else {
        echo"<script>alert('Không tồn tại sản phẩm')</script>";
        echo"<script>$location</script>";
    }

?>