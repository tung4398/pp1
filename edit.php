<?php
session_start();
	include("projectcnw_db.php");
	include("util.php");
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
	//echo $sql;exit();
	//thuc thi cau lenh sql
	$cates = select_list($sql);
	$statuses = default_statuses();
	
	$cookie_name = "user";
	$cookie_value = $result['title'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $sql = "select * from grab_category";
    $result_parents = select_list($sql);
    
    $errors = array('img' => '','title' => '','product_code' => '','price' => '');

    if(isset($_POST['submit'])) {
        if(empty($_POST['img'])) {
            $errors['img'] = 'Please choose a new images <br />';
        } else {
            $img = $_POST['img'];
        }

        if(empty($_POST['title'])) {
            $errors['title'] = ' A title is required <br />';
        } else {
            $title = $_POST['title'];
        }

        if(empty($_POST['product_code'])) {
            $errors['product_code'] = ' A Product code is required <br />';
        } else {
            $product_code = $_POST['product_code'];
        }

        if(empty($_POST['price'])) {
            $errors['price'] = ' A price is required <br />';
        } else {
            $price = $_POST['price'];
        }
    }
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
    <title>Edit</title>
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

    <!-- EDIT -->
    <div class="exec__content wrapper">
        <div class="exec__top">
            <h1>Sửa thông tin</h1>
            <div class="exec__more">
                <ul>
                    <li><a href="add.php"><i class="fas fa-plus"></i></a></li>
                    <li><a href="search.php"><i class="fas fa-search"></i></a></li>
                </ul>
            </div>
        </div>
        <br/>

        <form class="form" action="edit_exec.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $result["id"]?>"/>

            <label>Category</label>
            <select name="cid">
                <option value="">Chọn chuyên mục</option>
            <?php foreach ($cates as $item) {?>
                <option value="<?php echo $item["id"]?>" <?php if ($item["id"] == $result["cid"]){?>selected<?php } ?>><?php echo $item["name"]?></option>
            <?php } ?>
            </select>
            
            <label>Old image</label>
            <img src="<?php $img = explode(',', $result['img']);echo $img[0];?>" width="200px"/>
            <label>Choose new image <span class="text-red">*</span></label>
            <input name="img" type="file" value="<?php echo $result["img"]?>" required/>
            <div class="text-red"><?php echo $errors['img'];?></div>

            <label>Title <span class="text-red">*</span></label>
            <input name="title" value="<?php echo $result["title"]?>" placeholder="Title" required/>
            <div class="text-red"><?php echo $errors['title'];?></div>

            <label>Product Code <span class="text-red">*</span></label>
            <input name="product_code" value="<?php echo $result["product_code"]?>" placeholder="ABCD123" required/>
            <div class="text-red"><?php echo $errors['product_code'];?></div>

            <label>Product Info</label>
            <textarea placeholder="" name="product_info" value="<?php echo $result["product_info"]?>"></textarea>

            <label>Start Price</label>
            <input name="start_price" value="<?php echo $result["start_price"]?>" placeholder="00.000.000đ" />

            <label>Price <span class="text-red">*</span></label>
            <input name="price" value="<?php echo number_format($result['price'],0,'.','.')?>" placeholder="xxxxxxxx" required/>
            <div class="text-red"><?php echo $errors['price']?></div>

            <label>Sale</label>
            <input name="sale" value="<?php echo $result["sale"]?>" placeholder="(Tiết kiệm: đ )"/>

            <label>Insurance</label>
            <input name="insurance" value="<?php echo $result["insurance"]?>" placeholder="x Tháng"/>

            <label>Gifts</label>
            <textarea placeholder="Remember to use HTML tag <>" name="gift" value="<?php echo $result["gift"]?>"></textarea>

            <label>Description</label>
            <textarea placeholder="Remember to use h2 <hr> h3 and p tag <>" name="description" value="<?php echo $result["description"]?>"></textarea>

            <div class="exec_bottom">
                <button name="submit" type="submit" value="submit">Edit</button>
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