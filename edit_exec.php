<?php
session_start();
	include("projectcnw_db.php");
	include("util.php");
	//print_r($_FILES);exit();
	$img = upload_file_by_name("img");
	//echo "img = [{$img}]"; exit();
	
	$data = array();
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] * 1 : 0;
	$cid = isset($_REQUEST["id"]) ? $_REQUEST["cid"]  * 1 : 0;
	$title = isset($_REQUEST["title"]) ? $_REQUEST["title"] : "";
	$product_code = isset($_REQUEST["product_code"]) ? $_REQUEST["product_code"] : "";
	$product_info = isset($_REQUEST["product_info"]) ? $_REQUEST["product_info"] : "";
	$start_price = isset($_REQUEST["start_price"]) ? $_REQUEST["start_price"] : "";
	$price = isset($_REQUEST["price"]) ? $_REQUEST["price"] : "";
	$sale = isset($_REQUEST["sale"]) ? $_REQUEST["sale"] : "";
	$insurance = isset($_REQUEST["insurance"]) ? $_REQUEST["insurance"] : "";
	$gift = isset($_REQUEST["gift"]) ? $_REQUEST["gift"] : "";
	$description = isset($_REQUEST["description"]) ? $_REQUEST["description"] : "";
	
	$data["img"] = $img;
	$data["cid"] = $cid;
	$data["title"] = $title;
	$data["product_code"] = $product_code;
	$data["product_info"] = $product_info;
	$data["start_price"] = $start_price;
	$data["price"] = $price;
	$data["sale"] = $sale;
	$data["insurance"] = $insurance;
	$data["gift"] = $gift;
	$data["description"] = $description;
	$tbl = "grab_content";
	$cond = "id={$id}";
	$sql = data_to_sql_update($tbl,$data,$cond);
	//echo "sql = [{$sql}]"; exit();
	$ret = exec_update($sql);
    $user = "";
    if (isset($_SESSION['account'])){
        $user = $_SESSION['account'];
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
    <title>Edit Result</title>
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
			<h1>Kết quả sửa thông tin sản phẩm</h1>
			<br/>
				<p>Bạn đã sửa dữ liệu sản phẩm thành công, bạn muốn thực hiện <a href="add.php">thêm mới</a> hay quay về <a href="search.php">danh sách sản phẩm</a></p>
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