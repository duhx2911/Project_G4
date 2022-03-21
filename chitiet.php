<?php
    session_start();
    // if(isset($_SESSION['cart']))
    // {
    //     // echo "pre >";
    //     // var_dump($_SESSION['cart']);
    // }

    include("lib_db.php");
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
	if ($id<  1) return ;
    $sql = "SELECT * FROM sach where id=$id";

    $result = select_one($sql);
    $sqlOther = "SELECT * FROM sach limit 5";
    $resultOther = select_list($sqlOther);
    // print_r($result).die("ok");
    $cm = "SELECT * FROM danhmucsach WHERE id={$result["gid"]}";
    $cmo = select_one($cm);
    
?>

<!DOCTYPE html>
<html lang="li">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/product-item.css">
    <script type="text/javascript" src="js/main.js"></script>
    <link rel="stylesheet" href="fontawesome_free_5.13.0/css/all.css">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- <script src="js/bootstrap/js/bootstrap.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script type="text/javascript"src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
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
                <form class="form-inline ml-auto my-2 my-lg-0 mr-3">
                    <div class="input-group" style="width: 520px;">
                        <input type="text" class="form-control" aria-label="Small"
                            placeholder="Nhập sách cần tìm kiếm...">
                        <div class="input-group-append">
                            <button type="button" class="btn" style="background-color: #CF111A; color: white;">
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
                        <a href="giohang.php" class="btn btn-secondary rounded-circle">
                            <i class="fa fa-shopping-cart"></i>
                            <div class="cart-amount">0</div>
                        </a>
                        <a class="nav-link text-dark giohang text-uppercase" href="giohang.php"
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

    <!-- thanh "danh muc sach" đã được ẩn bên trong + hotline + ho tro truc tuyen -->
    <section class="duoinavbar">
        <div class="container text-white">
            <div class="row justify">
                <div class="col-lg-3 col-md-5">
                    <div class="categoryheader">
                        <div class="noidungheader text-white">
                            <i class="fa fa-bars"></i>
                            <span class="text-uppercase font-weight-bold ml-1">Danh mục sách</span>
                        </div>
                        <!-- CATEGORIES -->
                        <div class="categorycontent">
                            <ul>
                                <li> <a href="#"> Sách Kinh Tế - Kỹ Năng</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Kinh Tế - Kỹ
                                                Năng</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Kinh Tế - Chính Trị</a></li>
                                            <li><a href="#">Sách Khởi Nghiệp</a></li>
                                            <li><a href="#">Sách Tài Chính, Kế Toán</a></li>
                                            <li><a href="#">Sách Quản Trị Nhân Sự</a></li>
                                            <li><a href="#">Sách Kỹ Năng Làm Việc</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Nhân Vật - Bài Học Kinh Doanh</a></li>
                                            <li><a href="#">Sách Quản Trị - Lãnh Đạo</a></li>
                                            <li><a href="#">Sách Kinh Tế Học</a></li>
                                            <li><a href="#">Sách Chứng Khoán - Bất Động Sản - Đầu Tư</a></li>
                                            <li><a href="#">Sách Marketing - Bán Hàng</a></li>
                                        </div>
                                    </ul>
                                </li>

                                <li><a href="">Nghệ Thuật Sống - Tâm Lý </a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Nghệ Thuật Sống -
                                                Tâm
                                                Lý</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Sách Nghệ Thuật Sống</a></li>
                                            <li><a href="#">Sách Tâm Lý</a></li>
                                            <li><a href="#">Sách Hướng Nghiệp</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Sách Nghệ Thuật Sống Đẹp</a></li>
                                            <li><a href="#">Sách Tư Duy </a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Văn Học Việt Nam</a><i class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Văn Học Việt
                                                Nam</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Truyện Ngắn - Tản Văn </a></li>
                                            <li><a href="#">Tiểu Thuyết lịch Sử </a></li>
                                            <li><a href="#">Phóng Sự - Ký Sự - Du ký - Tùy Bút</a></li>
                                            <li><a href="#">Thơ</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Tiểu thuyết</a></li>
                                            <li><a href="#">Tiểu sử - Hồi ký</a></li>
                                            <li><a href="#">Phê Bình Văn Học</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Văn Học Nước Ngoài</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Văn Học Nước
                                                Ngoài</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Văn Học Hiện Đại</a></li>
                                            <li><a href="#">Tiểu Thuyết </a></li>
                                            <li><a href="#">Truyện Trinh Thám</a></li>
                                            <li><a href="#">Thần Thoại - Cổ Tích</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Văn Học Kinh Điển</a></li>
                                            <li><a href="#">Sách Giả Tưởng - Kinh Dị</a></li>
                                            <li><a href="#">Truyện Kiếm Hiệp</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Thiếu Nhi</a><i class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Thiếu
                                                Nhi</a>
                                        </li>
                                        <div class="content trai">
                                            <li><a href="#">Mẫu Giáo</a></li>
                                            <li><a href="#">Thiếu Niên</a></li>
                                            <li><a href="#">Kiến Thức - Bách Khoa</a></li>
                                            <li><a href="#">Truyện Cổ Tích</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Nhi Đồng</a></li>
                                            <li><a href="#">Văn Học Thiếu Nhi</a></li>
                                            <li><a href="#">Kỹ Năng Sống</a></li>
                                            <li><a href="#">Truyện Tranh</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Giáo Dục - Gia Đình</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Giáo Dục -
                                                Gia
                                                Đình</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Giáo dục</a></li>
                                            <li><a href="#">Thai Giáo</a></li>
                                            <li><a href="#">Sách Dinh Dưỡng - Chăm Sóc Trẻ</a></li>
                                            <li><a href="#">Ẩm Thực - Nấu Ăn</a></li>
                                            <li><a href="#">Sách Tham Khảo</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Giới Tính</a></li>
                                            <li><a href="#">Sách Làm Cha Mẹ</a></li>
                                            <li><a href="#">Kiến Thức - Kỹ Năng Cho Trẻ</a></li>
                                            <li><a href="#">Ngoại Ngữ - Từ Điển</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Lịch Sử</a><i class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Lịch Sử</a>
                                        </li>
                                        <div class="content trai">
                                            <li><a href="#">Lịch Sử Việt Nam</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Lịch Sử Thế Giới</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Văn Hóa - Nghệ Thuật</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Văn Hóa -
                                                Nghệ
                                                Thuật</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Văn Hóa</a></li>
                                            <li><a href="#">Phong Tục Tập Quán</a></li>
                                            <li><a href="#">Phong Thủy</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Nghệ Thuật</a></li>
                                            <li><a href="#">Kiến Trúc</a></li>
                                            <li><a href="#">Du Lịch</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Khoa Học - Triết Học</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Khoa Học -
                                                Triết
                                                Học</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Triết Học Phương Tây</a></li>
                                            <li><a href="#">Khoa Học Cơ Bản</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Minh Tiết Phương Đông</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">Sách Tâm Linh - Tôn Giáo</a><i
                                        class="fa fa-chevron-right float-right"></i>

                                </li>
                                <li><a href="#">Sách Y Học - Thực Dưỡng</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Sách Y Học - Thực
                                                Dưỡng</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Chăm Sóc Sức Khỏe</a></li>
                                            <li><a href="#">Y Học</a></li>
                                            <li><a href="#">Thiền - Yoga</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Thực Dưỡng</a></li>
                                            <li><a href="#">Đông Y - Cổ Truyền</a></li>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 ml-auto contact d-none d-md-block">
                    <div class="benphai float-right">
                        <div class="hotline">
                            <i class="fa fa-phone"></i>
                            <span>Hotline:<b>1900 2001</b> </span>
                        </div>
                        <i class="fas fa-comments-dollar"></i>
                        <a href="#">Hỗ trợ trực tuyến </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- breadcrumb  -->
    <section class="breadcrumbbar">
        <div class="container">
            <ol class="breadcrumb mb-0 p-0 bg-transparent">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Sách kinh tế</a></li>
                <li class="breadcrumb-item active"><a href="#">Sách kỹ năng làm việc</a></li>
            </ol>
        </div>
    </section>

    <!-- nội dung của trang  -->
    <section class="product-page mb-4">
        <div class="container">
            <!-- chi tiết 1 sản phẩm -->
            <div class="product-detail bg-white p-4">
                <div class="row">
                    <!-- ảnh  -->
                    <div class="col-md-5 khoianh">
                        <div class="anhto mb-4">
                            <a class="active" href="<?php echo $result["img"] ?>" data-fancybox="thumb-img">
                                <img class="product-image" src="<?php echo $result["img"] ?>" alt="lap-ke-hoach-kinh-doanh-hieu-qua-mt" style="width: 100%;">
                            </a>
                            <a href="<?php echo $result["thump"] ?>" data-fancybox="thumb-img"></a>
                        </div>
                        <div class="list-anhchitiet d-flex mb-4" style="margin-left: 2rem;">
                            <img class="thumb-img thumb1 mr-3" src="<?php echo $result["img"] ?>" class="img-fluid" alt="lap-ke-hoach-kinh-doanh-hieu-qua-mt">
                            <img class="thumb-img thumb2" src="<?php echo $result["thump"] ?>" class="img-fluid" alt="lap-ke-hoach-kinh-doanh-hieu-qua-ms">
                        </div>
                    </div>
                    <!-- thông tin sản phẩm: tên, giá bìa giá bán tiết kiệm, các khuyến mãi, nút chọn mua.... -->
                    <div class="col-md-7 khoithongtin">
                        <div class="row">
                            <div class="col-md-12 header">
                                <h4 class="ten"><?php echo $result["tensach"] ?></h4>
                                <div class="rate">
                                <?php echo $result["rating"] ?>
                                </div>
                                <hr>
                            </div>
                            <div class="col-md-7">
                                <div class="gia">
                                    <div class="giabia">Giá bìa:<span class="giacu ml-2"><?php echo $result["giagoc"] ?></span></div>
                                    <div class="giaban">Giá bán tại Parbo: 
                                        <span class="giamoi font-weight-bold"><?php echo $result["giasale"] ?></span>
                                            <!-- <span class="donvitien">₫</span> -->
                                        </div>
                                    <div class="tietkiem">Tiết kiệm: <span class="sale"><?php echo $result["sale"] ?></span>
                                    </div>
                                </div>
                                <div class="uudai my-3">
                                    <h6 class="header font-weight-bold">Khuyến mãi & Ưu đãi tại Parbo:</h6>
                                    <ul>
                                        <li><b>Miễn phí giao hàng </b>cho đơn hàng từ 150.000đ ở TP.HCM và 300.000đ ở
                                            Tỉnh/Thành khác <a href="#">>> Chi tiết</a></li>
                                        <li><b>Combo sách HOT - GIẢM 25% </b><a href="#">>>Xem ngay</a></li>
                                        <li>Tặng Bookmark cho mỗi đơn hàng</li>
                                        <li>Bao sách miễn phí (theo yêu cầu)</li>
                                    </ul>
                                </div>
                                <div class="soluong d-flex">
                                    <label class="font-weight-bold">Số lượng: </label>
                                    <div class="input-number input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn-spin btn-dec">-</span>
                                        </div>
                                        <input type="text" value="1" class="soluongsp  text-center">
                                        <div class="input-group-append">
                                            <span class="input-group-text btn-spin btn-inc">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nutmua btn w-100 text-uppercase">
                                    <button name="btn_add_cart">       
                                            Thêm vào giỏ hàng
                                    </button>
                                    <input type="hidden" name="id_get" value="<?php echo $id ?>">
                                    <script>
                                        $(document).ready(function(){
                                            $('[name="btn_add_cart"]').click(function(){
                                                $.ajax({
                                                data:{
                                                    id: $('[name="id_get"]').val(),
                                                },
                                                method: 'POST',
                                                url: 'cart.php',
                                                }).done(function(res){
                                                alert('Đã thêm vào giỏ hàng');
                                                });
                                            })
                                        });
                                    </script>
                                
                                </div>
                                <a class="huongdanmuahang text-decoration-none" href="#">(Vui lòng xem hướng dẫn mua
                                    hàng)</a>
                                <small class="share">Share: </small>
                                <div class="fb-like" data-href="https://www.facebook.com/Parbo-110745443947730/"
                                    data-width="300px" data-layout="button" data-action="like" data-size="small"
                                    data-share="true"></div>
                            </div>
                            <!-- thông tin khác của sản phẩm:  tác giả, ngày xuất bản, kích thước ....  -->
                            <div class="col-md-5">
                                <div class="thongtinsach">
                                    <ul>
                                        <li>Tác giả: <a href="#" class="tacgia"><?php echo $result["tacgia"] ?></a></li>
                                        <li>Ngày xuất bản: <b><?php echo $result["ngayxuatban"] ?></b></li>
                                        <li>Kích thước: <b><?php echo $result["kichthuoc"] ?></b></li>
                                        <li>Dịch giả: <?php echo $result["dichgia"] ?></li>
                                        <li>Nhà xuất bản: <?php echo $result["nxb"] ?></li>
                                        <li>Hình thức bìa: <b><?php echo $result["hinhthucbia"] ?></b></li>
                                        <li>Số trang: <b><?php echo $result["sotrang"] ?></b></li>
                                        <li>Cân nặng: <b><?php echo $result["cannang"] ?></b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- decripstion của 1 sản phẩm: giới thiệu , đánh giá độc giả  -->
                    <div class="product-description col-md-9">
                        <!-- 2 tab ở trên  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active text-uppercase" id="nav-gioithieu-tab"
                                    data-toggle="tab" href="#nav-gioithieu" role="tab" aria-controls="nav-gioithieu"
                                    aria-selected="true">Giới thiệu</a>
                                <a class="nav-item nav-link text-uppercase" id="nav-danhgia-tab" data-toggle="tab"
                                    href="#nav-danhgia" role="tab" aria-controls="nav-danhgia"
                                    aria-selected="false">Đánh
                                    giá của độc giả</a>
                            </div>
                        </nav>
                        <!-- nội dung của từng tab  -->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active ml-3" id="nav-gioithieu" role="tabpanel"
                                aria-labelledby="nav-gioithieu-tab">
                                <?php echo $result["chitietsach"] ?>
                            </div>
                            <div class="tab-pane fade" id="nav-danhgia" role="tabpanel" aria-labelledby="nav-danhgia-tab">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <p class="tieude">Đánh giá trung bình</p>
                                        <div class="diem">0/5</div>
                                        <div class="sao">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <p class="sonhanxet text-muted">(0 nhận xét)</p>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="tiledanhgia text-center">
                                            <div class="motthanh d-flex align-items-center">5 <i class="fa fa-star"></i>
                                                <div class="progress mx-2">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div> 0%
                                            </div>
                                            <div class="motthanh d-flex align-items-center">4 <i class="fa fa-star"></i>
                                                <div class="progress mx-2">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div> 0%
                                            </div>
                                            <div class="motthanh d-flex align-items-center">3 <i class="fa fa-star"></i>
                                                <div class="progress mx-2">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div> 0%
                                            </div>
                                            <div class="motthanh d-flex align-items-center">2 <i class="fa fa-star"></i>
                                                <div class="progress mx-2">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div> 0%
                                            </div>
                                            <div class="motthanh d-flex align-items-center">1 <i class="fa fa-star"></i>
                                                <div class="progress mx-2">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div> 0%
                                            </div>
                                            <div class="btn vietdanhgia mt-3">Viết đánh giá của bạn</div>
                                        </div>
                                        <!-- nội dung của form đánh giá  -->
                                        <div class="formdanhgia">
                                            <h6 class="tieude text-uppercase">GỬI ĐÁNH GIÁ CỦA BẠN</h6>
                                            <span class="danhgiacuaban">Đánh giá của bạn về sản phẩm này:</span>
                                            <div class="rating d-flex flex-row-reverse align-items-center justify-content-end">
                                                <input type="radio" name="star" id="star1"><label for="star1"></label>
                                                <input type="radio" name="star" id="star2"><label for="star2"></label>
                                                <input type="radio" name="star" id="star3"><label for="star3"></label>
                                                <input type="radio" name="star" id="star4"><label for="star4"></label>
                                                <input type="radio" name="star" id="star5"><label for="star5"></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="txtFullname w-100" placeholder="Mời bạn nhập tên(Bắt buộc)">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="txtEmail w-100" placeholder="Mời bạn nhập email(Bắt buộc)">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="txtComment w-100" placeholder="Đánh giá của bạn về sản phẩm này">
                                            </div>
                                            <div class="btn nutguibl">Gửi bình luận</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- het tab nav-danhgia  -->
                        </div>
                        <!-- het tab-content  -->
                    </div>
                    <!-- het product-description -->
                </div>
                <!-- het row  -->
            </div>
            <!-- het product-detail -->
        </div>
        <!-- het container  -->
    </section>
    <!-- het product-page -->

    <!-- khối sản phẩm tương tự -->
    <section class="_1khoi sachmoi">
        <section class="container">
            <div class="noidung bg-white" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-light pt-4">
                        <h5 class="header text-uppercase" style="font-weight: 400;">Sản phẩm tương tự</h5>
                        <a href="sach-moi-tuyen-chon.html" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                    </div>
                </div>
                <div class="home-product">
                    <div class="grid__row">
                        <?php foreach($resultOther as $sptt){ ?> 
                            <div class="grid__column-2-4">
                                <!--Sản phẩm -->
                                <div class="card ">
                                    <a href="chitiet.php?id=<?php echo $sptt["id"] ?>" class="motsanpham"
                                        style="text-decoration: none; color: black;" data-toggle="tooltip"
                                        data-placement="bottom" title="<?php echo $sptt["tensach"] ?>">
                                        <img class="card-img-top anh" src="<?php echo $sptt["img"] ?>" alt="lap-ke-hoach-kinh-doanh-hieu-qua">
                                        <div class="card-body noidungsp mt-3">
                                            <h6 class="card-title ten"><?php echo $sptt["tensach"] ?></h6>
                                            <small class="tacgia text-muted"><?php echo $sptt["tacgia"] ?></small>
                                            <div class="gia d-flex align-items-baseline">
                                                <div class="giamoi"><?php echo $sptt["giasale"] ?></div>
                                                <div class="giacu text-muted"><?php echo $sptt["giagoc"] ?></div>
                                                <div class="sale"><?php echo $sptt["sale"] ?></div>
                                            </div>
                                            <div class="danhgia">
                                                <ul class="d-flex" style="list-style: none;">
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <span class="text-muted"><?php echo $sptt["comment"] ?> nhận xét</span>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>         
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- khối sản phẩm đã xem  -->
    <section class="_1khoi combohot mt-4">
        <div class="container">
            <div class="noidung bg-white" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-light">
                        <h5 class="header text-uppercase" style="font-weight: 400;">Sản phẩm bạn đã xem</h5>
                        <a href="#" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                    </div>
                </div>
                <div class="home-product">
                    <div class="grid__row">
                        <?php foreach($resultOther as $sptt){ ?> 
                            <div class="grid__column-2-4">
                                <!--Sản phẩm -->
                                <div class="card ">
                                    <a href="chitiet.php?id=<?php echo $sptt["id"] ?>" class="motsanpham"
                                        style="text-decoration: none; color: black;" data-toggle="tooltip"
                                        data-placement="bottom" title="<?php echo $sptt["tensach"] ?>">
                                        <img class="card-img-top anh" src="<?php echo $sptt["img"] ?>" alt="lap-ke-hoach-kinh-doanh-hieu-qua">
                                        <div class="card-body noidungsp mt-3">
                                            <h6 class="card-title ten"><?php echo $sptt["tensach"] ?></h6>
                                            <small class="tacgia text-muted"><?php echo $sptt["tacgia"] ?></small>
                                            <div class="gia d-flex align-items-baseline">
                                                <div class="giamoi"><?php echo $sptt["giasale"] ?></div>
                                                <div class="giacu text-muted"><?php echo $sptt["giagoc"] ?></div>
                                                <div class="sale"><?php echo $sptt["sale"] ?></div>
                                            </div>
                                            <div class="danhgia">
                                                <ul class="d-flex" style="list-style: none;">
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li class="active"><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <span class="text-muted"><?php echo $sptt["comment"] ?> nhận xét</span>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>         
                    </div>
                </div>
            </div>
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
                            <h6 class="tieude font-weight-bold">HƠN 14.000 TỰA SÁCH HAY</h6>
                            <p class="detail">Tuyển chọn bởi Parbo</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-ship.png" alt="icon-ship">
                        <div class="noidung">
                            <h6 class="tieude font-weight-bold">MIỄN PHÍ GIAO HÀNG</h6>
                            <p class="detail">Từ 150.000đ ở TP.HCM</p>
                            <p class="detail">Từ 300.000đ ở tỉnh thành khác</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-gift.png" alt="icon-gift">
                        <div class="noidung">
                            <h6 class="tieude font-weight-bold">QUÀ TẶNG MIỄN PHÍ</h6>
                            <p class="detail">Tặng Bookmark</p>
                            <p class="detail">Bao sách miễn phí</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-return.png" alt="icon-return">
                        <div class="noidung">
                            <h6 class="tieude font-weight-bold">ĐỔI TRẢ NHANH CHÓNG</h6>
                            <p class="detail">Hàng bị lỗi được đổi trả nhanh chóng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- het .abovefooter  -->

    <!-- footer  -->
    <footer>
        <div class="container py-4">
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="gioithieu">
                        <h6 class="header text-uppercase font-weight-bold">Về Parbo</h6>
                        <a href="#">Giới thiệu về Parbo</a>
                        <a href="#">Tuyển dụng</a>
                        <div class="fb-like" data-href="https://www.facebook.com/Parbo-110745443947730/"
                            data-width="300px" data-layout="button" data-action="like" data-size="small"
                            data-share="true"></div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="hotrokh">
                        <h6 class="header text-uppercase font-weight-bold">HỖ TRỢ KHÁCH HÀNG</h6>
                        <a href="#">Hướng dẫn đặt hàng</a>
                        <a href="#">Phương thức thanh toán</a>
                        <a href="#">Phương thức vận chuyển</a>
                        <a href="#">Chính sách đổi trả</a>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="lienket">
                        <h6 class="header text-uppercase font-weight-bold">HỢP TÁC VÀ LIÊN KẾT</h6>
                        <img src="images/dang-ky-bo-cong-thuong.png" alt="dang-ky-bo-cong-thuong">
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="ptthanhtoan">
                        <h6 class="header text-uppercase font-weight-bold">Phương thức thanh toán</h6>
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
        <div class="btn btn-warning float-right rounded-circle nutcuonlen" id="backtotop" href="#" style="background:#CF111A;"><i
                class="fa fa-chevron-up text-white"></i></div>
    </div>


</body>

</html>
