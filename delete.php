<?php
	session_start() ;
	//print_r($_SESSION);
	include("projectcnw_db.php");
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
	if ($id<  1) return ;
	//tao sql
	$sql = "select * from grab_content 
	where id={$id}";
	//echo $sql;exit();
	//thuc thi cau lenh sql
	$result = select_one($sql);
	//print_r($result);exit();
	if (!$result) return ;
	//print_r($result);exit();

    $sql = "select * from grab_category";
    $result_parents = select_list($sql);
    $sql = 'SELECT * FROM grab_content ORDER BY id DESC LIMIT 1';
    $resultLast = select_one($sql);
    if (isset($_SESSION['account'])){
        $user = $_SESSION['account'];
    }
    if($user['role'] == 0) {
        header("location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
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

    <!-- DELETE -->
    <div class="exec__content wrapper">
        <div class="exec__top">
            <h1>Xóa thông tin</h1>
            <div class="exec__more">
			<ul>
                <li><a href="add.php"><i class="fas fa-plus"></i></a></li>
                <li><a href="search.php"><i class="fas fa-search"></i></a></li>
			</ul>
        </div>
        </div>
        <br/>
        <form class="form" action="delete_exec.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $result["id"]?>"/>

            <label>Category</label>
            <select name="cid" disabled>
                <option value="">Chọn chuyên mục</option>
            <?php foreach ($cates as $item) {?>
                <option value="<?php echo $item["id"]?>" <?php if ($item["id"] == $result["cid"]){?>selected<?php } ?>><?php echo $item["name"]?></option>
            <?php } ?>
            </select>
            
            <label>Image</label>
            <img src="<?php $img = explode(',', $result['img']);echo $img[0];?>" width="200px"/>

            <label>Title</label>
            <input name="title" value="<?php echo $result["title"]?>" disabled/>

            <label>Product Code</label>
            <input name="title" value="<?php echo $result["product_code"]?>" disabled/>

            <label>Product Info</label>
            <textarea name="description" disabled><?php echo $result["product_info"]?></textarea>

            <label>Start Price</label>
            <input name="start_price" value="" disabled/>

            <label>Price</label>
            <input name="price" value="<?php echo number_format($result['price'],0,'.','.').'đ'?>" disabled/>

            <label>Sale</label>
            <input name="sale" value="" disabled/>

            <label>Insurance</label>
            <input name="title" value="" disabled/>

            <label>Gifts</label>
            <textarea name="description" disabled><?php echo $result["gift"]?></textarea>

            <label>Description</label>
            <textarea name="description" disabled><?php echo $result["description"]?></textarea>

            <div class="exec_bottom">
                <button type="submit" name="submit">DELETE</button>
                <div class="exec__more">
                    <ul>
                        <li><a href="add.php"><i class="fas fa-plus"></i></a></li>
                        <li><a href="search.php"><i class="fas fa-search"></i></a></li>
                    </ul>
                </div>
            </div>
        </form>
        <br/>
        <br/>
	</div>
    
    <?php include ('bottom.php'); ?>
    
    
    <script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <!--  -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/slick.js"></script>
    <!--  -->
    <script src="js/slickslider.js"></script>
    <script src="js/all.js"></script>
    <script src="js/ajax_fetch.js"></script>
    <script src="js/mail.js"></script>
</body>
</html>