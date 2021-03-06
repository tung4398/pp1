<?php
    session_start();
	include("projectcnw_db.php");
	//get input -> ko co, vi la trang chu
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] * 1 : 0;
	//$q = isset($_REQUEST["q"]) ? trim($_REQUEST["q"]) : "";
	if ($id <  1) return ;
	//tao sql
	//$sql = "select * from grab_content where id={$id}";
	$sql = "select * from grab_content where id=" . $id ;
	// echo $sql;exit();
	//thuc thi cau lenh sql
	$result = select_one($sql);
	// print_r($result);exit();
	if (!$result) return ;
	
	$sql = "select * from grab_content 
	where cid={$result['cid']} and id !=" . $id;
	//echo $sql;exit();
	$resultOther = select_list($sql);
	// print_r($resultOther);exit();

    $cid = $result['cid'];
	$sql = "select * from grab_category where id=" . $cid ;
	$result_cate = select_one($sql);
	// print_r($result_parent);exit();
    
    $sql = "select * from grab_category";
    $result_parents = select_list($sql);
	// print_r($result_parents);exit();
    $sql = 'SELECT * FROM grab_content ORDER BY id DESC LIMIT 1';
    $resultLast = select_one($sql);
    $user = "";
    if (isset($_SESSION['account'])){
        $user = $_SESSION['account'];
    }

    /* select user_review */
    $sql = "SELECT * FROM review_table WHERE cid =" .$id;
    $user_reviews = select_list($sql);
    // print_r ($user_reviews);exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $result['title']?></title>
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

    <!-- DETAIL -->
    <div class="wrapper">
        <div class="product__detail">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb mt-4 product__detail-breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Trang ch???</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="./chuyen-muc.php?id=<?php echo $result_cate['id']?>"><?php echo $result_cate['name']?></a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $result["title"]?></li>
                </ol>
            </nav>
            <h2 class="product__detail-title"><?php echo $result["title"]?></h2>
            <!--  -->
            <div class="product__detail-content">
                <div class="product__detail-left">
                    <div class="product__slider">
                        <?php foreach(explode(',', $result['img']) as $img){ ?>
                            <div class="product__slider-item">
                                <img src="<?php echo $img?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                </div>  
                <div class="product__detail-main">
                    <div class="product__detail-top">
                        <h2 class="product__detail-top-title d-none"><?php echo $result["title"]?></h2>
                        <ul>
                            <li class="product__detail-top-item">
                                M?? SP: <span><?php echo $result["product_code"]?></span>
                            </li>
                            <li class="product__detail-top-item">
                                ????nh gi??: <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span id ="user_rating"><?php echo $result["rate_qnt"]?></span>
                            </li>
                            <li class="product__detail-top-item">
                                B??nh lu???n: <span><?php echo $result["comment_qnt"]?></span>
                            </li>
                            <li class="product__detail-top-item">
                                L?????t xem: <span><?php echo $result["view_qnt"]?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="product__detail-info">
                        <h3>Th??ng s??? s???n ph???m</h3>
                        <ul>
                        <?php foreach(explode(',', $result["product_info"]) as $info){ ?>
                            <li><?php echo $info?></li>
                        <?php } ?>
                        </ul>
                    </div>
                    <div class="product__detail-price">
                        <span><?php echo number_format($result['price'],0,'.','.')?> ??</span>
                        <span><?php echo $result["start_price"]?></span>
                        <span><?php echo $result["sale"]?></span>
                        <span class="product__detail-price--mb d-none">(Gi?? ???? bao g???m VAT)</span>
                    </div>
                    <div class="product__detail-more">
                        <span>Gi?? ???? c?? VAT</span>
                        <span>B???o h??nh <?php echo $result["insurance"]?></span>
                        <br>
                        <span class="ribbon">Qu??t VNPAYQR gi???m th??m 100k</span>
                    </div>
                    <div class="product__detail-gifts">
                        <h3 class="product__detail-gifts-title">
                            <i class="fas fa-gift"></i>
                            Qu?? t???ng v?? ??u ????i k??m theo
                        </h3>
                        <?php echo $result["gift"]?>
                    </div>
                    <a class="addtocart" href="cart_exec.php?id=<?php echo $result["id"]?>"><i class="fas fa-cart-plus"></i>Th??m v??o gi??? h??ng</a>
                    <div class="product__detail-buy">
                        <button class="btn" type="submit" name="add">?????T MUA NGAY
                            <span>Giao h??ng t???n n??i nhanh ch??ng</span>
                        </button>
                        <a href="#" class="btn">TR??? G??P QUA TH??? VISA, MASTER,...
                            <span>Ch??? t??? 3.249.917??/ th??ng (12 th??ng)</span>
                        </button>
                        <a href="#" class="btn">TR??? G??P H??? S?? DUY???T 15 PH??T
                            <span>Ch??? t??? 6.499.834??/ th??ng (6 th??ng)</span>
                        </a>
                    </div>
                </div>

                <div class="product__detail-right">
                    <div class="card">
                        <div class="card-header">
                            S???N PH???M ??ANG C?? S???N T???I
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#" class="text-red ">79 Nguy???n V??n Huy??n - C???u Gi???y - H?? N???i</a></li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Y??N T??M MUA H??NG
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">Uy t??n 20 n??m x??y d???ng v?? ph??t tri???n</a></li>
                            <li class="list-group-item"><a href="#">S???n ph???m ch??nh h??ng 100%</a></li>
                            <li class="list-group-item"><a href="#">Tr??? g??p l??i su???t 0% to??n b??? gi??? h??ng</a></li>
                            <li class="list-group-item"><a href="#">Tr??? b???o h??nh t???n n??i s??? d???ng</a></li>
                            <li class="list-group-item"><a href="#">B???o h??nh t???n n??i cho doanh nghi???p</a></li>
                            <li class="list-group-item"><a href="#">??u ????i ri??ng cho h???c sinh sinh vi??n</a></li>
                            <li class="list-group-item"><a href="#">V??? sinh mi???n ph?? tr???n ?????i PC, Laptop</a></li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            MI???N PH?? GIAO H??NG
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="#">Giao h??ng si??u t???c trong 2h</a></li>
                            <li class="list-group-item"><a href="#">Giao h??ng mi???n ph?? to??n qu???c</a></li>
                            <li class="list-group-item"><a href="#">Nh???n h??ng v?? thanh to??n t???i nh?? (ship COD)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
        <div class="product__desc">
            <?php echo $result["description"]?>
        </div>
        <!-- REVIEW -->
        <div class="card">
            <div class="card-header fs-1 py-4">Kh??ch h??ng ch???m ??i???m, ????nh gi??, nh???n x??t</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center ">
                        <h1 class="text-danger mt-4 mb-4 fs-3">
                            <span id="average_rating">0.0</span> / 5
                        </h1>
                        <div class="mb-3 fs-3">
                            <i class="fas fa-star star-light mr-1 main_star star-light"></i>
                            <i class="fas fa-star star-light mr-1 main_star star-light"></i>
                            <i class="fas fa-star star-light mr-1 main_star star-light"></i>
                            <i class="fas fa-star star-light mr-1 main_star star-light"></i>
                            <i class="fas fa-star star-light mr-1 main_star star-light"></i>
                        </div>
                        <h3 class="fs-3"><span id="total_review">0</span> ????nh gi??</h3>
                    </div>

                    <div class="col-sm-4">
                        <div class="rate__progress">
                            <div class="progress-label-left"><span class="progress-num">5</span> <i class="fas fa-star text-danger"></i></div>

                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>) ????nh gi??</div>
                        </div>
                        <!--  -->
                        <div class="rate__progress">
                            <div class="progress-label-left"><span class="progress-num">4</span> <i class="fas fa-star text-danger"></i></div>
                            
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>) ????nh gi??</div>
                        </div>
                        <!--  -->
                        <div class="rate__progress">
                            <div class="progress-label-left"><span class="progress-num">3</span> <i class="fas fa-star text-danger"></i></div>
                            
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>) ????nh gi??</div>
                        </div>
                        <!--  -->
                        <div class="rate__progress">
                            <div class="progress-label-left"><span class="progress-num">2</span> <i class="fas fa-star text-danger"></i></div>
                            
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>) ????nh gi??</div>
                        </div>
                        <!--  -->
                        <div class="rate__progress">
                            <div class="progress-label-left"><span class="progress-num">1</span> <i class="fas fa-star text-danger"></i></div>
                            
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>) ????nh gi??</div>
                        </div>
                    </div>

                    <div class="col-sm-4 text-center">
                        <h3 class="my-4 fs-2 fw-bold">Chia s??? nh???n x??t v??? s???n ph???m</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary fs-3 py-3 px-4">Vi???t nh???n x??t c???a b???n</button>
                    </div>
                </div>
        </div>

        <!-- User review content -->
        <div class="mt-5 p-4" id="review_content"></div>
        <!--  -->
        <div id="review_modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-1">????nh gi?? s???n ph???m</h5>
                        <button type="button" class="btn-close fs-3 p-4" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4 fs-3">
                            <i class="fas fa-star star-light submit_star mr-1 text-danger" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group mb-3">
                            <input type="text" name="user_name" id="user_name" class="form-control fs-3" placeholder="H??? t??n" />
                        </div>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control fs-3" placeholder="Nh???p ????nh gi?? s???n ph???m (t???i thi???u 80 k?? t???)"></textarea>
                            <input type="hidden" id="current_index" value ="<?php echo $id?>">
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary fs-3" id="save_review">G???i ????nh gi??</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- OTHER -->
    <div class="wrapper">
        <div class="product_other">
            <div class="product_other-title">
                <span>S???n ph???m t????ng t???</span>
            </div>
            <div class="products__content">
                <?php foreach ($resultOther as $item) {?>
                    <div class="product">
                        <div class="aspect-ratio">
                            <a href="./chi-tiet.php?id=<?php echo $item["id"]?>" class="product__img">
                                <img src=" <?php $img = explode(',', $item['img']);echo $img[0];?> " alt="">
                            </a>
                        </div>
                        <div class="product__info">
                            <div class="product__info-top">
                                <div class="product__rate">
                                    <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                    <span class="product__qnt">(<?php echo $item["rate_qnt"]?>)</span>
                                </div>
                                <div class="product__code"><span>m??: <?php echo $item["product_code"]?></span></div>
                            </div>
                            <a href="#" class="product__name"><?php echo $item["title"]?></a>
                            <div class="product__price">
                                <span class="start__price"><?php echo $item["start_price"]?></span>
                                <span class="sale"><?php echo $item["sale"]?></span>
                                <h3 class="current__price"><?php echo number_format($item['price'],0,'.','.')?>??</h3>
                                <div class="status-goods">
                                    <span class="<?php echo $item["product_status"]?>"><i class="<?php echo $item["product_status-icon"]?>"></i><?php echo $item["product_status-text"]?></span>
                                    <a href="cart_exec.php?id=<?php echo $item["id"]?>"><i class="fas fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
    </div>

    <!-- FORM -->
    <?php include('bottom.php'); ?>
    
    
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
    <script src="js/review.js"></script>

    </body>
</html>