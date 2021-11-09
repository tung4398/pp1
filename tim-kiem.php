<?php
session_start();
	include("projectcnw_db.php");
    // include("checklogin.php");
    // $user = checkLoggedUser();
    $q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : "";
    $q = trim($q);
    $p = isset($_REQUEST["p"]) ? $_REQUEST["p"] * 1 : 0;
	if ($p < 1) $p = 1;
    $cond = "";
    // $q = htmlspecialchars($q);
    if($q !== htmlspecialchars($q)) {echo '<h1>Tìm kiếm không hợp lệ, quay lại <a href="./">Trang chủ</a></h1>'; exit(); }
    if(strpos($q,"'")) $q = str_replace("'","\'", $q);
    if(strpos($q,'"')) $q = str_replace('"','\"', $q);
    if ($q){
        $cond = "where title like '%{$q}%'";
        $cond .= " or product_info like '%{$q}%'";
        $cond .= " or description like '%{$q}%'";
    }
    $sql = " select * from grab_content {$cond} ";
	// print_r($sql);exit();
    $result_search = select_one($sql);
	// print_r($result_search);exit();
    $sqlcount = "select count(*) as c from grab_content {$cond}";
    $count = select_one($sqlcount);
    $total = $count['c'];
    $nop = 12;
	$offset = $nop * ($p -1);
	$num = ceil($total / $nop);

    // $sql = "select * from sub_cate where content like '%{$q}%'";
    // $sub_cate = select_list($sql);
	// print_r($sub_cate);exit();
    // if(!($sub_cate)) {
        // $sql = "select distinct * from sub_cate";
        $sql = "select * from sub_cate where name in (SELECT DISTINCT name from sub_cate)";
    // }
    // echo $sql;
    $sub_cate = select_list($sql);
	// print_r($sub_cate);exit();
    
    $sql = "select * from grab_content {$cond} limit {$nop} offset {$offset}";
	// print_r($sql);exit();
    $datas = select_list($sql);
	// print_r($datas);exit();

    $sql = "select * from grab_category";
    $result_parents = select_list($sql);

    $sql = 'SELECT * FROM grab_content ORDER BY id DESC LIMIT 1';
    $resultLast = select_one($sql);
    $user = "";
    if (isset($_SESSION['account'])){
        $user = $_SESSION['account'];
    }
    $flagDM = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách <?php echo $q?></title>
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

    <div class="wrapper">
        <div class="category">
            <div class="category__top">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">TÌM KIẾM: <?php echo $q ?></li>
                    </ol>
                </nav>
                <h2 class="category__title">TÌM KIẾM : <?php echo $q ?> <span>(Tổng <?php echo $total ?> sản phẩm)</span></h2>
            </div>

            <div class="category__slider">
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/21_Oct0468af6801f667e65b977404965133ce.png" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/09_Sep30f9cb2011418ee4304d9939723c94fb.jpg" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/16_Sepcc01c685f8d18a12de9426960a76cbd8.png" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/17_Aug64b3660eb57428b518472ecbf1d89651.jpg" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/20_Jula0d037d74f1f932f062ec28ba166e18b.jpg" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/21_Sepa0f67c51cb5b23015c7983183a9df4c9.png" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/23_Sep0bb263ab134125ab780683af11dddf9e.png" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/26_Julca8e600d08b85456c41a0a04c861ea9c.png" class="d-block w-100" alt="">
                </div>
                <div class="category__slider-item">
                    <a href="#"></a>
                    <img src="images/slider/29_Seped75375d994936c22bbe17181f9c0292.jpg" class="d-block w-100" alt="">
                </div>
            </div>

            <div class="category__content">
                <!-- left -->
                <div class="category__content-left">
                    <h3 class="filter-text">LỌC SẢN PHẨM</h3>

                    <div class="accordion accordion--category" id="accordionExample">
                        <?php foreach($sub_cate as $item) {?>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?php echo ($item['id']); ?>">
                                <button class="accordion-button text-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo ($item['id']); ?>" aria-expanded="true" aria-controls="collapse<?php echo ($item['id']); ?>">
                                    <?php echo ($item['name']); ?>
                                </button>
                                </h2>
                                <div id="collapse<?php echo ($item['id']); ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?php echo ($item['id']); ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <input type="hidden" id="sql_search">
                                    <ul>
                                    <?php switch($item['name']): 
                                        case ('DANH MỤC'): ?>
                                            <?php $flagDM++; if($flagDM > 2) break;?> 
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <a href="tim-kiem.php?q=<?php echo $content?>" class="category__content-link">
                                                        <i class="fas fa-caret-right"></i>
                                                        <?php echo $content; ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('HÃNG SẢN XUẤT'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label class="form-check-label">
                                                        <input type="checkbox" class="product_check form-check-input" id="search_brand" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('KHOẢNG GIÁ'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="product_check" id="search_price" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('NHU CẦU SỬ DỤNG'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_demand" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('CPU'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_cpu" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('RAM'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_ram" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('Ổ CỨNG'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_hd" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('VGA - CARD MÀN HÌNH'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_vga" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('DVDRW'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_dvdrw" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('ĐỘ PHÂN GIẢI MÀN HÌNH'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_sc_hd" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('TẦN SỐ MÀN HÌNH'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_sc_hz" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('HỆ ĐIỀU HÀNH'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_os" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php case ('THỜI HẠN BẢO HÀNH'): ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="search_insurance" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                        <?php break; ?>
                                        <?php default: ?>
                                            <?php foreach(explode(',', $item['content']) as $content){ ?>
                                                <li>
                                                    <p class="category__content-link">
                                                        <label>
                                                            <input type="checkbox" class="product_check" id="<?php echo $item['name']?>" value="<?php echo $content?>">
                                                            <?php echo $content?>
                                                        </label>
                                                    </p>
                                                </li>
                                            <?php } ?>
                                    <?php endswitch; ?>
                                    </ul>
                                </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>

                </div>
                <!-- right -->
                <div class="category__content-right">
                    <div class="category__top-box">
                        <div class="category__top-box--1">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Tình trạng kho hàng</option>
                                <option value="1">Còn hàng</option>
                            </select>
                            <div class="form__filter-price">
                                <label for="filter-start">Lọc theo giá tiền:</label>
                                <input type="text" id="filter-start" placeholder="2.009.000 ">
                                <span>đ</span>
                                <label for="filter-end"> - </label>
                                <input type="text" id="filter-end" placeholder="189.999.000 ">
                                <span>đ</span>
                                <a href="#" class="btn category__btn">Lọc</a>
                            </div>
                        </div>
                        <div class="category__top-box--2">
                        <ul>
                                <li><label class="category-box-choice " data-order="desc"><input type="radio" name="cate_radio" id="cate_new" class="product_check">Hàng Mới</label></li>
                                <li><label class="category-box-choice" data-order="desc"><input type="radio" name="cate_radio" id="cate_high-view" class="product_check">Xem Nhiều</label></li>
                                <li><label class="category-box-choice" data-order="desc"><input type="radio" name="cate_radio" id="cate_much-lower" class="product_check">Giá giảm nhiều</label></li>
                                <li><label class="category-box-choice" data-order="desc"><input type="radio" name="cate_radio" id="cate_price-upper" class="product_check">Giá Tăng Dần</label></li>
                                <li><label class="category-box-choice" data-order="desc"><input type="radio" name="cate_radio" id="cate_price-lower" class="product_check">Giá Giảm Dần</label></li>
                            </ul>
                            
                            <select class="form-select" aria-label="Default select example 2">
                                <option selected>Lọc sản phẩm</option>
                                <option value="rate">Đánh giá</option>
                                <option value="sort">Tên A->Z</option>
                            </select>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                <?php for ($i=1;$i<=$num;$i++) { ?>
                                    <li class="page-item"><a class="page-link" href="tim-kiem.php?q=<?php echo $q ?>&p=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    
                    <div class="category__products" id="search_res">
                        <svg viewBox="25 25 50 50" class="hide" id="loader">
                            <circle cx="50" cy="50" r="20"></circle>
                        </svg>
                        <?php foreach ($datas as $data) {?>
                            <div class="product">
                            <div class="aspect-ratio">
                                <a href="chi-tiet.php?id=<?php echo $data["id"] ?>" class="product__img"><img src="<?php $img = explode(',', $data['img']);echo $img[0];?>" alt=""></a>
                                <div class="product__item--info">
                                    <a href="chi-tiet.php?id=<?php echo $data["id"] ?>" class="product__item--info-title"><?php echo $data["title"]?></a>
                                    <p class="product__item--info-text">- Giá bán:&emsp;&emsp;&emsp;<?php echo number_format($data['price'],0,'.','.')?>đ [Đã bao gồm VAT]</p>
                                    <p class="product__item--info-text">- Giá thấp nhất:<span class="text-bold"><?php echo number_format($data['price'],0,'.','.')?>đ</span></p>
                                    <p class="product__item--info-text">- Bảo hành:&emsp;&emsp;<?php echo $data["insurance"]?></p>
                                    <p class="product__item--info-text">- Kho hàng:&emsp;&emsp;<i class="fas fa-map-marker-alt"></i><span>131 Lê Thanh Nghị - Hai Bà Trưng - Hà Nội</span></p>

                                    <span class="product__item--info-more"><i class="fas fa-layer-group"></i>Thông số sản phẩm</span>
                                    <ul class="product_infos">
                                        <?php foreach(explode(',', $data["product_info"]) as $info){ ?>
                                            <li><?php echo $info?></li>
                                        <?php } ?>
                                    </ul>

                                    <span class="product__item--info-more"><i class="fas fa-gift"></i>Chương trình khuyến mại</span>
                                    <p class="product__item--info-text">MIỄN PHÍ GIAO HÀNG TOÀN QUỐC (trừ ghế, bàn, màn chiếu) đến hết 31/12/2021. Chi tiết xem <a href="#">tại đây</a>.</p>
                                </div>
                                </div>

                                <div class="product__info-top">
                                        <div class="product__rate">
                                            <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                                            <span class="product__qnt">(<?php echo $data["rate_qnt"]?>)</span>
                                        </div>
                                        <div class="product__code"><span>mã: <?php echo $data["product_code"]?></span></div>
                                    </div>
                                <div class="product__info">
                                    <a href="chi-tiet.php?id=<?php echo $data["id"] ?>" class="product__name"><?php echo $data["title"]?></a>
                                    <div class="product__info--main">
                                        <ul class="product__info-list">
                                            <?php foreach(explode(',', $data["product_info"]) as $info){ ?>
                                                <li><?php echo $info?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="product__price">
                                        <div>
                                            <span class="start__price"><?php echo $data["start_price"]?></span>
                                            <span class="sale"><?php echo $data["sale"]?></span>
                                        </div>
                                        <h3 class="current__price"><?php echo number_format($data['price'],0,'.','.')?>đ</h3>
                                        <div class="status-goods">
                                            <span class="<?php echo $data["product_status"]?>"><i class="<?php echo $data["product_status-icon"]?>"></i><?php echo $data["product_status-text"]?></span>
                                            <a href="cart_exec.php?id=<?php echo $data["id"]?>"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="category__pagination">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                            <?php for ($i=1;$i<=$num;$i++) { ?>
                                <li class="page-item"><a class="page-link" href="tim-kiem.php?q=<?php echo $q ?>&p=<?php echo $i ?>"><?php echo $i ?></a></li>
                            <?php } ?>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include ('bottom.php'); ?>
    
    <script src="bootstrap-5.1.1-dist/js/bootstrap.bundle.min.js"></script>
    <!--  -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--  -->
    <script src="js/slickslider.js"></script>
    <script src="js/all.js"></script>
    <script src="js/ajax_fetch.js"></script>
    <script src="js/mail.js"></script>
    <script src="js/action-search.js"></script>
    
</body>
</html>