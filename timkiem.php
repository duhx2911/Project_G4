<?php
    session_start();
    include("connect.php");
    include("lib_db.php");
    //print_r($result);
    //exit();
    $q = isset($_REQUEST["q"]) ? $_REQUEST["q"] : '';
	$qsessionname = "___Q___";
	// print_r($qsessionname).die("ok");
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
		$cond .= " tensach like '%{$sq}%' ";
		// $cond .= " or description like '%{$sq}%' ";
	}

	//print_r($_SESSION).die("ok");
    $sql = "select * from sach {$cond} order by id desc ";
	// echo $sql;exit();
	//thuc thi cau lenh sql
	$result = mysqli_query($conn,$sql);
    // print_r($sql).die('ok');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Parbo - Thiên đường sách cho bạn</title>
    <meta name="description"
        content="Mua sách online hay, giá tốt nhất, combo sách hot bán chạy, giảm giá cực khủng cùng với những ưu đãi như miễn phí giao hàng, quà tặng miễn phí, đổi trả nhanh chóng. Đa dạng sản phẩm, đáp ứng mọi nhu cầu.">
    <meta name="keywords" content="nhà sách online, mua sách hay, sách hot, sách bán chạy, sách giảm giá nhiều">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/home.css">
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="fontawesome_free_5.13.0/css/all.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript"src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
    <link rel="canonical" href="http://parbo.com/">
    <meta name="google-site-verification" content="urDZLDaX8wQZ_-x8ztGIyHqwUQh2KRHvH9FhfoGtiEw" />
    <link rel="shortcut icon" type="image/png" href="favicon/closed_book_96px.png">
</head>

<body>
    <!-- code cho nut like share facebook  -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>

    <!-- header -->
    <nav class="navbar navbar-expand-md bg-white navbar-light">
        <div class="container">
            <!-- logo  -->
            <a class="navbar-brand" href="index.php" style="color: #CF111A;"><b>Parbo</b>.com</a>

            <!-- navbar-toggler  -->
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <!-- form tìm kiếm  -->
                <form action="timkiem.php" method="GET" class="form-inline ml-auto my-2 my-lg-0 mr-3">
                    <div class="input-group" style="width: 520px;">
                        <input type="text" class="form-control" aria-label="Small"
                            placeholder="Nhập sách cần tìm kiếm...">
                        <div class="input-group-append">
                            <button type="button" value="search" class="btn" style="background-color: #CF111A; color: white;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- ô đăng nhập đăng ký giỏ hàng trên header  -->
                <ul class="navbar-nav mb-1 ml-auto">
                    <div class="dropdown">
                        <li class="nav-item account" type="button" class="btn dropdown" data-toggle="dropdown">
                            <a href="#" class="btn btn-secondary rounded-circle">
                                <i class="fa fa-user"></i>
                            </a>
                            <a class="nav-link text-dark text-uppercase" href="#" style="display:inline-block">Tài
                                khoản</a>
                        </li>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item nutdangky text-center mb-2" href="#" data-toggle="modal"
                                data-target="#formdangky">Đăng ký</a>
                            <a class="dropdown-item nutdangnhap text-center" href="#" data-toggle="modal"
                                data-target="#formdangnhap">Đăng nhập</a>
                        </div>
                    </div>
                    <li class="nav-item giohang">
                        <a href="gio-hang.html" class="btn btn-secondary rounded-circle">
                            <i class="fa fa-shopping-cart"></i>
                            <div class="cart-amount">0</div>
                        </a>
                        <a class="nav-link text-dark giohang text-uppercase" href="gio-hang.html"
                            style="display:inline-block">Giỏ
                            Hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    

    <!-- form dang ky khi click vao button tren header-->
    <div class="modal fade mt-5" id="formdangky" data-backdrop="static" tabindex="-1" aria-labelledby="dangky_tieude"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <ul class="tabs d-flex justify-content-around list-unstyled mb-0">
                        <li class="tab tab-dangnhap text-center">
                            <a class=" text-decoration-none">Đăng nhập</a>
                            <hr>
                        </li>
                        <li class="tab tab-dangky text-center">
                            <a class="text-decoration-none">Đăng ký</a>
                            <hr>
                        </li>
                    </ul>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-signup" class="form-signin mt-2">
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="Nhập họ và tên" name="name" required
                                autofocus>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="Nhập số điện thoại" name="phone"
                                required>
                        </div>
                        <div class="form-label-group">
                            <input type="email" class="form-control" placeholder="Nhập địa chỉ email" name="email"
                                required>
                        </div>
                        <div class="form-label-group">
                            <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password"
                                required>
                        </div>
                        <div class="form-label-group mb-4">
                            <input type="password" class="form-control" name="confirm_password"
                                placeholder="Nhập lại mật khẩu" required>
                        </div>
                        <button class="btn btn-lg btn-block btn-signin text-uppercase text-white mt-3" type="submit"
                            style="background: #F5A623">Đăng ký</button>
                        <hr class="mt-3 mb-2">
                        <div class="custom-control custom-checkbox">
                            <p class="text-center">Bằng việc đăng ký, bạn đã đồng ý với Parbo về</p>
                            <a href="#" class="text-decoration-none text-center" style="color: #F5A623">Điều khoản dịch
                                vụ & Chính sách bảo mật</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- form dang nhap khi click vao button tren header-->
    <div class="modal fade mt-5" id="formdangnhap" data-backdrop="static" tabindex="-1"
        aria-labelledby="dangnhap_tieude" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <ul class="tabs d-flex justify-content-around list-unstyled mb-0">
                        <li class="tab tab-dangnhap text-center">
                            <a class=" text-decoration-none">Đăng nhập</a>
                            <hr>
                        </li>
                        <li class="tab tab-dangky text-center">
                            <a class="text-decoration-none">Đăng ký</a>
                            <hr>
                        </li>
                    </ul>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-signin" class="form-signin mt-2">
                        <div class="form-label-group">
                            <input type="email" class="form-control" placeholder="Nhập địa chỉ email" name="email"
                                required autofocus>
                        </div>

                        <div class="form-label-group">
                            <input type="password" class="form-control" placeholder="Mật khẩu" name="password" required>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Nhớ mật khẩu</label>
                            <a href="#" class="float-right text-decoration-none" style="color: #F5A623">Quên mật
                                khẩu</a>
                        </div>

                        <button class="btn btn-lg btn-block btn-signin text-uppercase text-white" type="submit"
                            style="background: #F5A623">Đăng nhập</button>
                        <hr class="my-4">
                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i
                                class="fab fa-google mr-2"></i> Đăng nhập bằng Google</button>
                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i
                                class="fab fa-facebook-f mr-2"></i> Đăng nhập bằng Facebook</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- thanh tieu de "danh muc sach" + hotline + ho tro truc tuyen -->
    <section class="duoinavbar">
        <div class="container text-white">
            <div class="row justify">
                <div class="col-md-3">
                    <div class="categoryheader">
                        <div class="noidungheader text-white">
                            <i class="fa fa-bars"></i>
                            <span class="text-uppercase font-weight-bold ml-1">Danh mục sách</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="benphai float-right">
                        <div class="hotline">
                            <i class="fa fa-phone"></i>
                            <span>Hotline:<b>88888888</b> </span>
                        </div>
                        <i class="fas fa-comments-dollar"></i>
                        <a href="#">Hỗ trợ trực tuyến </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- khoi sach moi  -->
    <section class="_1khoi sachmoi bg-white">
        <div class="container">
            <div class="noidung" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-transparent pt-4">
                        <h1 class="header text-uppercase" style="font-weight: 400;">TÌM KIẾM THEO "<?php echo $q?>"</h1>
                        <a href="sach-moi-tuyen-chon.html" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                    </div>
                </div>
                <div class="khoisanpham" style="padding-bottom: 2rem;">
                    <!-- 1 san pham -->
                    <?php foreach($result as $item) { ?>
                    <div class="card">
                        <a href="chitiet.php?id=<?php echo $item['id'] ?>" class="motsanpham"
                            style="text-decoration: none; color: black;" data-toggle="tooltip" data-placement="bottom"
                            title="Lập Kế Hoạch Kinh Doanh Hiệu Quả">
                            <img class="card-img-top anh" src="<?php echo $item['img'] ?>"
                                alt="lap-ke-hoach-kinh-doanh-hieu-qua">
                            <div class="card-body noidungsp mt-3">
                                <h3 class="card-title ten"><?php echo $item['tensach'] ?></h3>
                                <small class="tacgia text-muted"><?php echo $item['tacgia'] ?></small>
                                <div class="gia d-flex align-items-baseline">
                                    <div class="giamoi"><?php echo $item['giasale'] ?></div>
                                    <div class="giacu text-muted"><?php echo $item['giagoc'] ?></div>
                                    <div class="sale"><?php echo $item['sale'] ?></div>
                                </div>
                                <div class="danhgia">
                                    <ul class="d-flex" style="list-style: none;">
                                    <?php echo $item['rating'] ?>
                                        <li><span class="text-muted"><?php echo $item['comment'] ?> nhận xét</span></li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- div _1khoi -- khoi sachnendoc -->
    <section class="_1khoi sachnendoc bg-white mt-4">
        <div class="container">
            <div class="noidung" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-transparent pt-4">
                        <h2 class="header text-uppercase" style="font-weight: 400;">SÁCH HAY NÊN ĐỌC</h2>
                        <a href="#" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                    </div>
                    <!-- 1 san pham -->
                    <div class="col-lg col-sm-4">
                        <div class="card">
                            <a href="#" class="motsanpham" style="text-decoration: none; color: black;"
                                data-toggle="tooltip" data-placement="bottom"
                                title="Từng bước chân nở hoa: Khi câu kinh bước tới">
                                <img class="card-img-top anh" src="images/tung-buoc-chan-no-hoa.jpg"
                                    alt="tung-buoc-chan-no-hoa">
                                <div class="card-body noidungsp mt-3">
                                    <h3 class="card-title ten">Từng bước chân nở hoa: Khi câu kinh bước tới</h3>
                                    <small class="thoigian text-muted">03/04/2022</small>
                                    <div><a class="detail" href="#">Xem chi tiết</a></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg col-sm-4">
                        <div class="card">
                            <a href="#" class="motsanpham" style="text-decoration: none; color: black;"
                                data-toggle="tooltip" data-placement="bottom" title="Cảm ơn vì đã được thương">
                                <img class="card-img-top anh" src="images/cam-on-vi-da-duoc-thuong.jpg"
                                    alt="cam-on-vi-da-duoc-thuong">
                                <div class="card-body noidungsp mt-3">
                                    <h3 class="card-title ten">Cảm ơn vì đã được thương</h3>
                                    <small class="thoigian text-muted">31/03/2022</small>
                                    <div><a class="detail" href="#">Xem chi tiết</a></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg col-sm-4">
                        <div class="card">
                            <a href="#" class="motsanpham" style="text-decoration: none; color: black;"
                                data-toggle="tooltip" data-placement="bottom"
                                title="Hào quang của vua Gia Long trong mắt Michel Gaultier">
                                <img class="card-img-top anh" src="images/vua-gia-long.jpg" alt="vua-gia-long">
                                <div class="card-body noidungsp mt-3">
                                    <h3 class="card-title ten">Hào quang của vua Gia Long trong mắt Michel Gaultier</h3>
                                    <small class="thoigian text-muted">21/03/2022</small>
                                    <div><a class="detail" href="#">Xem chi tiết</a></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg col-sm-4">
                        <div class="card">
                            <a href="#" class="motsanpham" style="text-decoration: none; color: black;"
                                data-toggle="tooltip" data-placement="bottom"
                                title="Suối nguồn” và cái tôi hiện sinh trong từng cá thể">
                                <img class="card-img-top anh" src="images/suoi-nguon-va-cai-toi-trong-tung-ca-the.jpg"
                                    alt="suoi-nguon-va-cai-toi-trong-tung-ca-the">
                                <div class="card-body noidungsp mt-3">
                                    <h3 class="card-title ten">"Suối nguồn” và cái tôi hiện sinh trong từng cá thể</h3>
                                    <small class="thoigian text-muted">16/03/2022</small>
                                    <div><a class="detail" href="#">Xem chi tiết</a></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg col-sm-4">
                        <div class="card cuoicung">
                            <a href="#" class="motsanpham" style="text-decoration: none; color: black;"
                                data-toggle="tooltip" data-placement="bottom"
                                title="Đại dịch trên những con đường tơ lụa">
                                <img class="card-img-top anh" src="images/dai-dich-tren-con-duong-to-lua.jpg"
                                    alt="dai-dich-tren-con-duong-to-lua">
                                <div class="card-body noidungsp mt-3">
                                    <h3 class="card-title ten">Đại dịch trên những con đường tơ lụa</h3>
                                    <small class="thoigian text-muted">16/03/2022</small>
                                    <div><a class="detail" href="#">Xem chi tiết</a></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </section>

    <!-- thanh cac dich vu :mien phi giao hang, qua tang mien phi ........ -->
    <section class="abovefooter text-white" style="background-color: #CF111A;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-books.png" alt="icon-books">
                        <div class="noidung">
                            <h3 class="tieude font-weight-bold">HƠN 14.000 TỰA SÁCH HAY</h3>
                            <p class="detail">Tuyển chọn bởi Parbo</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-ship.png" alt="icon-ship">
                        <div class="noidung">
                            <h3 class="tieude font-weight-bold">MIỄN PHÍ GIAO HÀNG</h3>
                            <p class="detail">Từ 150.000đ ở Hà Nội</p>
                            <p class="detail">Từ 300.000đ ở tỉnh thành khác</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-gift.png" alt="icon-gift">
                        <div class="noidung">
                            <h3 class="tieude font-weight-bold">QUÀ TẶNG MIỄN PHÍ</h3>
                            <p class="detail">Tặng Bookmark</p>
                            <p class="detail">Bao sách miễn phí</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-return.png" alt="icon-return">
                        <div class="noidung">
                            <h3 class="tieude font-weight-bold">ĐỔI TRẢ NHANH CHÓNG</h3>
                            <p class="detail">Hàng bị lỗi được đổi trả nhanh chóng trong 15 ngày đầu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer  -->
    <footer>
        <div class="container py-4">
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="gioithieu">
                        <h3 class="header text-uppercase font-weight-bold">Về Parbo</h3>
                        <a href="#">Giới thiệu về Parbo</a>
                        <a href="#">Tuyển dụng</a>
                        <div class="fb-like" data-href="https://www.facebook.com/Parbo-110745443947730/"
                            data-width="300px" data-layout="button" data-action="like" data-size="small"
                            data-share="true"></div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="hotrokh">
                        <h3 class="header text-uppercase font-weight-bold">HỖ TRỢ KHÁCH HÀNG</h3>
                        <a href="#">Hướng dẫn đặt hàng</a>
                        <a href="#">Phương thức thanh toán</a>
                        <a href="#">Phương thức vận chuyển</a>
                        <a href="#">Chính sách đổi trả</a>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="lienket">
                        <h3 class="header text-uppercase font-weight-bold">HỢP TÁC VÀ LIÊN KẾT</h3>
                        <img src="images/dang-ky-bo-cong-thuong.png" alt="dang-ky-bo-cong-thuong">
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="ptthanhtoan">
                        <h3 class="header text-uppercase font-weight-bold">Phương thức thanh toán</h3>
                        <img src="images/visa-payment.jpg" alt="visa-payment">
                        <img src="images/master-card-payment.jpg" alt="master-card-payment">
                        <img src="images/jcb-payment.jpg" alt="jcb-payment">
                        <img src="images/atm-payment.jpg" alt="atm-payment">
                        <img src="images/cod-payment.jpg" alt="cod-payment">
                        <img src="images/payoo-payment.jpg" alt="payoo-payment">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- nut cuon len dau trang -->
    <div class="fixed-bottom">
        <div class="btn btn-warning float-right rounded-circle nutcuonlen" id="backtotop" href="#"
            style="background:#CF111A;"><i class="fa fa-chevron-up text-white"></i></div>
    </div>

</body>

</html>