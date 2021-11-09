<?php
session_start();
	include("projectcnw_db.php");
	include("util.php");
	//get input
	//tao sql
	$sql = "select * from grab_category";
	//echo $sql;exit();
	//thuc thi cau lenh sql
	$cates = select_list($sql);
	//print_r($cates);exit();
    
	// $statuses = default_statuses();

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
    <title>Add</title>
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

    <!-- ADD -->
    <div class="exec__content wrapper">
        <div class="exec__top">
            <h1>Thêm thông tin</h1>
            <div class="exec__more">
                <ul>
                    <li><a href="add.php"><i class="fas fa-plus"></i></a></li>
                    <li><a href="search.php"><i class="fas fa-search"></i></a></li>
                </ul>
            </div>
        </div>
        <br/>
        <form class="form" action="add_exec.php" method="POST" enctype="multipart/form-data">
            <label>Category <span class="text-red">*</span></label>
            <select name="cid" required>
                <option value="">Chọn chuyên mục</option>
            <?php foreach ($cates as $item) {?>
                <option value="<?php echo $item["id"]?>"><?php echo $item["name"]?></option>
            <?php } ?>
            </select>
            
            <label>Image <span class="text-red">*</span></label>
            <input name="img" type="file" value="" required/>
            <img src="" width="200px"/>

            <label>Title <span class="text-red">*</span></label>
            <input name="title" value="" placeholder="Title" required/>

            <label>Product Code <span class="text-red">*</span></label>
            <input name="product_code" value="" placeholder="ABCD123" required/>

            <label>Product Info</label>
            <textarea placeholder="Remember to enter the data inside the <li></li> tag pair" name="product_info"></textarea>

            <label>Start Price</label>
            <input name="start_price" value="" placeholder="00.000.000đ"/>

            <label>Price <span class="text-red">*</span></label>
            <input name="price" value="" placeholder="00.000.000" required/>

            <label>Sale</label>
            <input name="sale" value="" placeholder="(Tiết kiệm: x% )"/>

            <label>Insurance</label>
            <input name="insurance" value="" placeholder="x Tháng"/>

            <label>Gifts</label>
            <textarea placeholder="Remember to use HTML tag <>" name="gift"></textarea>

            <label>Description</label>
            <textarea placeholder="Remember to use h2 <hr> h3 and p tag <>" name="description"></textarea>

            <div class="exec_bottom">
                <button type="submit" name="submit">ADD</button>
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
    <!--  -->
    <script src="js/ajax_add.js"></script>
    <script src="js/all.js"></script>
    <script src="js/ajax_fetch.js"></script>
    <script src="js/mail.js"></script>
</body>
</html>