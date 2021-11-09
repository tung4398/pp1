<?php
	session_start() ;
	include("projectcnw_db.php");
	$q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : "";
    $q = intval($q);
    // echo $q;
	$qsessionname = "___Q___";
	if (!isset($_REQUEST["q"])){
		$q = isset($_SESSION[$qsessionname]) ? $_SESSION[$qsessionname] : '';
	}else{
		$_SESSION[$qsessionname] = $q;
	}
	$cond = "";
	$searchfields = array("","");
	// print_r($_SESSION);
	$sql = "select * from review_table where cid = {$q}";
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
    <title>Delete Comment</title>
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
        <h1>Xóa bình luận/ đánh giá</h1>
        <hr>
        <form method="GET" action="cmt_search.php">
        <input name="q" value="<?php echo $q ?>" placeholder="Id bài cần xóa comment"/>
        <button>Search (cid)</button></form>
        <table >
        <tr>
            <th>Review_id</th><!--  -->
            <th>User name</th>
            <th>User rating</th>
            <th>User review</th>
            <th>Date time</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($result as $item) {?>
        <tr>
            <td><?php echo $item['review_id'];?></td>
            <td><?php echo $item['user_name'];?></td>
            <td><?php echo $item['user_rating'];?></td>
            <td><?php echo $item['user_review'];?></td>
            <td><?php echo date('l, F d y h:i:s', $item['datetime'])?></td>
            <td><a href="cmt_del.php?id=<?php echo $item['review_id'];?>"><i class="fas fa-comment-slash"></a></td>
        </tr>
        <?php } ?>
        </table>
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