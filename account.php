<?php
    session_start();
    include("projectcnw_db.php");
    include("checklogin.php");
    $user = checkLoggedUser();

    $sql = 'SELECT * FROM grab_content ORDER BY id DESC LIMIT 1';
    $resultLast = select_one($sql);
	$sql = "select * from grab_category";
    $result_parents = select_list($sql);
    $user = "";
    if (isset($_SESSION['account'])){
        $user = $_SESSION['account'];
    }
    // print_r($user);exit();

    $data = array();
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] * 1 : 0;
    $username = isset($_REQUEST["username"]) ? $_REQUEST["username"] : "";
	$phone = isset($_REQUEST["phone"]) ? $_REQUEST["phone"] : "";
    $email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
	$gender = isset($_REQUEST["gender"]) ? $_REQUEST["gender"] * 1: 0;
    $address = isset($_REQUEST["address"]) ? $_REQUEST["address"] : "";

    $data["username"] = $username;
	$data["phone"] = $phone;
	$data["email"] = $email;
	$data["gender"] = $gender;
	$data["address"] = $address;
	$tbl = "mvc_user";
	$cond = "id={$id}";
	$sql = data_to_sql_update($tbl,$data,$cond);
	$ret = exec_update($sql);
    if($id) {
        echo '<script>alert("Bạn đã cập nhật thông tin thành công!")</script>';
        header('Refresh: 1; url=account.php');
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account</title>
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

	<div class="account__top">
		<h2>Xin chào <span class="text-danger"><?php echo $user['username']?></span>! Bạn đã đăng nhập thành công</h2>
	</div>

    <?php if($user['role'] == 1) {?>
        <div class="account__form row wrapper">
            <div class="col"><a href="./" class="account__item">Home<i class="fas fa-home"></i></a></div>
            <div class="col"><a href="./add.php" class="account__item">Add<i class="fas fa-plus"></i></a></div>
            <div class="col"><a href="./delete.php?id=<?php echo $resultLast['id'] ?>" class="account__item">Delete<i class="far fa-trash-alt"></i></a></div>
            <div class="col"><a href="./edit.php?id=<?php echo $resultLast['id'] ?>" class="account__item">Edit<i class="far fa-edit"></i></i></a></div>
            <div class="col"><a href="./search.php" class="account__item">Search<i class="fas fa-search"></i></a></div>
            <div class="col"><a href="./logout.php" class="account__item">Logout<i class="fas fa-sign-out-alt"></i></a></div>
        </div>
    <?php } else {?>

    <form class="form form__account" action="account.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user["id"]?>"/>

        <div class="form-group"><p>Họ tên</p>
        <input name="username" value="<?php echo $user["username"]?>" placeholder="Tên tài khoản" required/></div>

        <div class="form-group"><p>Số điện thoại</p>
        <input name="phone" value="<?php echo $user["phone"]?>" placeholder="Số điện thoại"/></div>

        <div class="form-group"><p>Email</p>
        <input name="email" value="<?php echo $user["email"]?>" placeholder="Email" required/></div>

        
        <div class="form-group form-gender">
            <p>Giới tính</p>
            <div><input class="form-check-input" type="radio" name="gender" id="gender1" value ='1' <?php if($user["gender"] == 1) echo 'checked'?>>
            <label class="form-check-label" for="gender1">
                Nam
            </label></div>
            <div><input class="form-check-input" type="radio" name="gender" id="gender0" value ='0' <?php if($user["gender"] == 0) echo 'checked'?>>
            <label class="form-check-label" for="gender0">
                Nữ
            </label></div>
        </div>

        <div class="form-group"><p>Địa chỉ</p>
        <input name="address" value="<?php echo $user["address"]?>" placeholder="Địa chỉ của bạn"/></div>

        <button name="update" type="update" value="update" class="btn btn-danger fs-2 px-4 py-1 mx-auto mt-4">Cập nhật</button>

    </form>
        <?php } ?>
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