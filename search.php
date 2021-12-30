<?php
	session_start() ;
	include("projectcnw_db.php");
	$q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : '';
	$qsessionname = "___Q___";
	if (!isset($_REQUEST["q"])){
		$q = isset($_SESSION[$qsessionname]) ? $_SESSION[$qsessionname] : '';
	}else{
		$_SESSION[$qsessionname] = $q;
	}
	$cond = "";
	$searchfields = array("","");
	if ($q){
		$sq = sql_str($q);
		$cond = "where ";
		$cond .= " (title like '%{$sq}%') ";
		$cond .= " or (product_info like '%{$sq}%') ";
		$cond .= " or (description like '%{$sq}%') ";
	}
	// print_r($_SESSION);
	$sql = "select * from grab_content {$cond} order by id limit 6 ";
	// echo $sql;exit();
	//thuc thi cau lenh sql
	$result = select_list($sql);
	// print_r($result);exit();

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
    <title>Search</title>
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

    <!-- SEARCH -->
    <div class="search__main wrapper">
        <h1>Quản lý bài viết</h1>
        <hr>
        <form method="GET" action="search.php">
        <input name="q" value="<?php echo $q ?>"/>
        <button>Search</button></form>
        <table >
        <tr>
            <th>Id</th><!--  -->
            <th>Title</th>
            <th>Product Code</th>
            <th>Product Info</th>
            <th>Start price</th>
            <th>Price</th>
            <th>Số lượng</th>
            <th>Insurance</th>
            <th>Description</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($result as $item) {?>
        <tr>
            <td><?php echo $item['id']?></td>
            <td><?php echo $item['title']?></td>
            <td><?php echo $item['product_code']?></td>
            <td><?php echo $item['product_info']?></td>
            <td><?php echo $item['start_price']?></td>
            <td><?php echo number_format($item['price'],0,'.','.').'đ'?></td>
            <td><?php echo $item['view_qnt']?></td>
            <td><?php echo $item['insurance']?></td>
            <td><?php echo $item['description']?></td>
            <td><a href="edit.php?id=<?php echo $item['id']?>"><i class="fas fa-edit"></a></td>
            <td><a href="delete.php?id=<?php echo $item['id']?>"><i class="fas fa-trash-alt"></a></td>
        </tr>
        <?php } ?>
        </table>
        <br/>
        <br/>
        <div class="exec__more">
			<ul>
                <li><a href="add.php"><i class="fas fa-plus"></i></a></li>
                <li><a href="search.php"><i class="fas fa-search"></i></a></li>
			</ul>
        </div>
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