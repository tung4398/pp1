<?php
session_start();
	include("projectcnw_db.php");
	//get input
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] * 1 : 0;
	//tao sql
	$sql = "delete from grab_content  " ;
	$sql .= " WHERE id =$id" ;
	//echo $sql;exit();
	$ret = exec_update($sql);
	// header("Location:search.php");
	//print_r($ret);exit();
    $sql = 'SELECT * FROM grab_content ORDER BY id DESC LIMIT 1';
    $resultLast = select_one($sql);
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
    <title>Delete Result</title>
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
	
	<div class="exec__result wrapper">
		<div>
			<h1>Kết quả xóa thông tin sản phẩm</h1>
			<br/>
				<p>Bạn đã xóa dữ liệu sản phẩm thành công, bạn muốn thực hiện <a href="add.php">thêm mới</a> hay quay về <a href="search.php">danh sách sản phẩm</a></p>
			<br/>
		</div>

		<div class="exec__more">
			<ul>
				<li><a href="add.php"><i class="fas fa-plus"></i></a></li>
				<li><a href="search.php"><i class="fas fa-search"></i></a></li>
			</ul>
		</div>
	</div>

	<button id="btn_scroll-top" class="hide"><i class="fas fa-arrow-up"></i></button>
	<div class="spin-btn"></div>
	<div class="exec__btn">
		<i class="fas fa-ellipsis-h"></i>
		<div class="exec__list">
			<a href="./add.php" target="_blank" class="exec__item"><i class="fas fa-plus"></i></a>
			<a href="./delete.php" target="_blank" class="exec__item"><i class="far fa-trash-alt"></i></a>
			<a href="./edit.php" target="_blank" class="exec__item"><i class="far fa-edit"></i></i></a>
			<a href="./search.php" target="_blank" class="exec__item"><i class="fas fa-search"></i></a>
		</div>
	</div>

	<!--  -->
	<script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <!--  -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/slick.js"></script>
    <!--  -->
    <script src="js/slickslider.js"></script>
    <script src="js/all.js"></script>
    
</body>
</html>