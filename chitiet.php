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
                <!-- form t??m ki???m  -->
                <form class="form-inline ml-auto my-2 my-lg-0 mr-3">
                    <div class="input-group" style="width: 520px;">
                        <input type="text" class="form-control" aria-label="Small"
                            placeholder="Nh???p s??ch c???n t??m ki???m...">
                        <div class="input-group-append">
                            <button type="button" class="btn" style="background-color: #CF111A; color: white;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- ?? ????ng nh???p ????ng k?? gi??? h??ng tr??n header  -->
                <ul class="navbar-nav mb-1 ml-auto">
                    <div class="dropdown">
                        <li class="nav-item account" type="button" class="btn dropdown" data-toggle="dropdown">
                            <a href="#" class="btn btn-secondary rounded-circle">
                                <i class="fa fa-user"></i>
                            </a>
                            <a class="nav-link text-dark text-uppercase" href="#" style="display:inline-block">T??i
                                kho???n</a>
                        </li>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item nutdangky text-center mb-2" href="#" data-toggle="modal"
                                data-target="#formdangky">????ng k??</a>
                            <a class="dropdown-item nutdangnhap text-center" href="#" data-toggle="modal"
                                data-target="#formdangnhap">????ng nh???p</a>
                        </div>
                    </div>
                    <li class="nav-item giohang">
                        <a href="giohang.php" class="btn btn-secondary rounded-circle">
                            <i class="fa fa-shopping-cart"></i>
                            <div class="cart-amount">0</div>
                        </a>
                        <a class="nav-link text-dark giohang text-uppercase" href="giohang.php"
                            style="display:inline-block">Gi???
                            H??ng</a>
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
                            <a class=" text-decoration-none">????ng nh???p</a>
                            <hr>
                        </li>
                        <li class="tab tab-dangky text-center">
                            <a class="text-decoration-none">????ng k??</a>
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
                            <input type="text" class="form-control" placeholder="Nh???p h??? v?? t??n" name="name" required
                                autofocus>
                        </div>
                        <div class="form-label-group">
                            <input type="text" class="form-control" placeholder="Nh???p s??? ??i???n tho???i" name="phone"
                                required>
                        </div>
                        <div class="form-label-group">
                            <input type="email" class="form-control" placeholder="Nh???p ?????a ch??? email" name="email"
                                required>
                        </div>
                        <div class="form-label-group">
                            <input type="password" class="form-control" placeholder="Nh???p m???t kh???u" name="password"
                                required>
                        </div>
                        <div class="form-label-group mb-4">
                            <input type="password" class="form-control" name="confirm_password"
                                placeholder="Nh???p l???i m???t kh???u" required>
                        </div>
                        <button class="btn btn-lg btn-block btn-signin text-uppercase text-white mt-3" type="submit"
                            style="background: #F5A623">????ng k??</button>
                        <hr class="mt-3 mb-2">
                        <div class="custom-control custom-checkbox">
                            <p class="text-center">B???ng vi???c ????ng k??, b???n ???? ?????ng ?? v???i Parbo v???</p>
                            <a href="#" class="text-decoration-none text-center" style="color: #F5A623">??i???u kho???n d???ch
                                v??? & Ch??nh s??ch b???o m???t</a>
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
                            <a class=" text-decoration-none">????ng nh???p</a>
                            <hr>
                        </li>
                        <li class="tab tab-dangky text-center">
                            <a class="text-decoration-none">????ng k??</a>
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
                            <input type="email" class="form-control" placeholder="Nh???p ?????a ch??? email" name="email"
                                required autofocus>
                        </div>

                        <div class="form-label-group">
                            <input type="password" class="form-control" placeholder="M???t kh???u" name="password" required>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Nh??? m???t kh???u</label>
                            <a href="#" class="float-right text-decoration-none" style="color: #F5A623">Qu??n m???t
                                kh???u</a>
                        </div>

                        <button class="btn btn-lg btn-block btn-signin text-uppercase text-white" type="submit"
                            style="background: #F5A623">????ng nh???p</button>
                        <hr class="my-4">
                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i
                                class="fab fa-google mr-2"></i> ????ng nh???p b???ng Google</button>
                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i
                                class="fab fa-facebook-f mr-2"></i> ????ng nh???p b???ng Facebook</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- thanh "danh muc sach" ???? ???????c ???n b??n trong + hotline + ho tro truc tuyen -->
    <section class="duoinavbar">
        <div class="container text-white">
            <div class="row justify">
                <div class="col-lg-3 col-md-5">
                    <div class="categoryheader">
                        <div class="noidungheader text-white">
                            <i class="fa fa-bars"></i>
                            <span class="text-uppercase font-weight-bold ml-1">Danh m???c s??ch</span>
                        </div>
                        <!-- CATEGORIES -->
                        <div class="categorycontent">
                            <ul>
                                <li> <a href="#"> S??ch Kinh T??? - K??? N??ng</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch Kinh T??? - K???
                                                N??ng</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Kinh T??? - Ch??nh Tr???</a></li>
                                            <li><a href="#">S??ch Kh???i Nghi???p</a></li>
                                            <li><a href="#">S??ch T??i Ch??nh, K??? To??n</a></li>
                                            <li><a href="#">S??ch Qu???n Tr??? Nh??n S???</a></li>
                                            <li><a href="#">S??ch K??? N??ng L??m Vi???c</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Nh??n V???t - B??i H???c Kinh Doanh</a></li>
                                            <li><a href="#">S??ch Qu???n Tr??? - L??nh ?????o</a></li>
                                            <li><a href="#">S??ch Kinh T??? H???c</a></li>
                                            <li><a href="#">S??ch Ch???ng Kho??n - B???t ?????ng S???n - ?????u T??</a></li>
                                            <li><a href="#">S??ch Marketing - B??n H??ng</a></li>
                                        </div>
                                    </ul>
                                </li>

                                <li><a href="">Ngh??? Thu???t S???ng - T??m L?? </a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">Ngh??? Thu???t S???ng -
                                                T??m
                                                L??</a></li>
                                        <div class="content trai">
                                            <li><a href="#">S??ch Ngh??? Thu???t S???ng</a></li>
                                            <li><a href="#">S??ch T??m L??</a></li>
                                            <li><a href="#">S??ch H?????ng Nghi???p</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">S??ch Ngh??? Thu???t S???ng ?????p</a></li>
                                            <li><a href="#">S??ch T?? Duy </a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch V??n H???c Vi???t Nam</a><i class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch V??n H???c Vi???t
                                                Nam</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Truy???n Ng???n - T???n V??n </a></li>
                                            <li><a href="#">Ti???u Thuy???t l???ch S??? </a></li>
                                            <li><a href="#">Ph??ng S??? - K?? S??? - Du k?? - T??y B??t</a></li>
                                            <li><a href="#">Th??</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Ti???u thuy???t</a></li>
                                            <li><a href="#">Ti???u s??? - H???i k??</a></li>
                                            <li><a href="#">Ph?? B??nh V??n H???c</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch V??n H???c N?????c Ngo??i</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch V??n H???c N?????c
                                                Ngo??i</a></li>
                                        <div class="content trai">
                                            <li><a href="#">V??n H???c Hi???n ?????i</a></li>
                                            <li><a href="#">Ti???u Thuy???t </a></li>
                                            <li><a href="#">Truy???n Trinh Th??m</a></li>
                                            <li><a href="#">Th???n Tho???i - C??? T??ch</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">V??n H???c Kinh ??i???n</a></li>
                                            <li><a href="#">S??ch Gi??? T?????ng - Kinh D???</a></li>
                                            <li><a href="#">Truy???n Ki???m Hi???p</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch Thi???u Nhi</a><i class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch Thi???u
                                                Nhi</a>
                                        </li>
                                        <div class="content trai">
                                            <li><a href="#">M???u Gi??o</a></li>
                                            <li><a href="#">Thi???u Ni??n</a></li>
                                            <li><a href="#">Ki???n Th???c - B??ch Khoa</a></li>
                                            <li><a href="#">Truy???n C??? T??ch</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Nhi ?????ng</a></li>
                                            <li><a href="#">V??n H???c Thi???u Nhi</a></li>
                                            <li><a href="#">K??? N??ng S???ng</a></li>
                                            <li><a href="#">Truy???n Tranh</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch Gi??o D???c - Gia ????nh</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch Gi??o D???c -
                                                Gia
                                                ????nh</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Gi??o d???c</a></li>
                                            <li><a href="#">Thai Gi??o</a></li>
                                            <li><a href="#">S??ch Dinh D?????ng - Ch??m S??c Tr???</a></li>
                                            <li><a href="#">???m Th???c - N???u ??n</a></li>
                                            <li><a href="#">S??ch Tham Kh???o</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Gi???i T??nh</a></li>
                                            <li><a href="#">S??ch L??m Cha M???</a></li>
                                            <li><a href="#">Ki???n Th???c - K??? N??ng Cho Tr???</a></li>
                                            <li><a href="#">Ngo???i Ng??? - T??? ??i???n</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch L???ch S???</a><i class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch L???ch S???</a>
                                        </li>
                                        <div class="content trai">
                                            <li><a href="#">L???ch S??? Vi???t Nam</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">L???ch S??? Th??? Gi???i</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch V??n H??a - Ngh??? Thu???t</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch V??n H??a -
                                                Ngh???
                                                Thu???t</a></li>
                                        <div class="content trai">
                                            <li><a href="#">V??n H??a</a></li>
                                            <li><a href="#">Phong T???c T???p Qu??n</a></li>
                                            <li><a href="#">Phong Th???y</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Ngh??? Thu???t</a></li>
                                            <li><a href="#">Ki???n Tr??c</a></li>
                                            <li><a href="#">Du L???ch</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch Khoa H???c - Tri???t H???c</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch Khoa H???c -
                                                Tri???t
                                                H???c</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Tri???t H???c Ph????ng T??y</a></li>
                                            <li><a href="#">Khoa H???c C?? B???n</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Minh Ti???t Ph????ng ????ng</a></li>
                                        </div>
                                    </ul>
                                </li>
                                <li><a href="#">S??ch T??m Linh - T??n Gi??o</a><i
                                        class="fa fa-chevron-right float-right"></i>

                                </li>
                                <li><a href="#">S??ch Y H???c - Th???c D?????ng</a><i
                                        class="fa fa-chevron-right float-right"></i>
                                    <ul>
                                        <li class="liheader"><a href="#" class="header text-uppercase">S??ch Y H???c - Th???c
                                                D?????ng</a></li>
                                        <div class="content trai">
                                            <li><a href="#">Ch??m S??c S???c Kh???e</a></li>
                                            <li><a href="#">Y H???c</a></li>
                                            <li><a href="#">Thi???n - Yoga</a></li>
                                        </div>
                                        <div class="content phai">
                                            <li><a href="#">Th???c D?????ng</a></li>
                                            <li><a href="#">????ng Y - C??? Truy???n</a></li>
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
                        <a href="#">H??? tr??? tr???c tuy???n </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- breadcrumb  -->
    <section class="breadcrumbbar">
        <div class="container">
            <ol class="breadcrumb mb-0 p-0 bg-transparent">
                <li class="breadcrumb-item"><a href="index.php">Trang ch???</a></li>
                <li class="breadcrumb-item"><a href="#">S??ch kinh t???</a></li>
                <li class="breadcrumb-item active"><a href="#">S??ch k??? n??ng l??m vi???c</a></li>
            </ol>
        </div>
    </section>

    <!-- n???i dung c???a trang  -->
    <section class="product-page mb-4">
        <div class="container">
            <!-- chi ti???t 1 s???n ph???m -->
            <div class="product-detail bg-white p-4">
                <div class="row">
                    <!-- ???nh  -->
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
                    <!-- th??ng tin s???n ph???m: t??n, gi?? b??a gi?? b??n ti???t ki???m, c??c khuy???n m??i, n??t ch???n mua.... -->
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
                                    <div class="giabia">Gi?? b??a:<span class="giacu ml-2"><?php echo $result["giagoc"] ?></span></div>
                                    <div class="giaban">Gi?? b??n t???i Parbo: 
                                        <span class="giamoi font-weight-bold"><?php echo $result["giasale"] ?></span>
                                            <!-- <span class="donvitien">???</span> -->
                                        </div>
                                    <div class="tietkiem">Ti???t ki???m: <span class="sale"><?php echo $result["sale"] ?></span>
                                    </div>
                                </div>
                                <div class="uudai my-3">
                                    <h6 class="header font-weight-bold">Khuy???n m??i & ??u ????i t???i Parbo:</h6>
                                    <ul>
                                        <li><b>Mi???n ph?? giao h??ng </b>cho ????n h??ng t??? 150.000?? ??? TP.HCM v?? 300.000?? ???
                                            T???nh/Th??nh kh??c <a href="#">>> Chi ti???t</a></li>
                                        <li><b>Combo s??ch HOT - GI???M 25% </b><a href="#">>>Xem ngay</a></li>
                                        <li>T???ng Bookmark cho m???i ????n h??ng</li>
                                        <li>Bao s??ch mi???n ph?? (theo y??u c???u)</li>
                                    </ul>
                                </div>
                                <div class="soluong d-flex">
                                    <label class="font-weight-bold">S??? l?????ng: </label>
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
                                            Th??m v??o gi??? h??ng
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
                                                alert('???? th??m v??o gi??? h??ng');
                                                });
                                            })
                                        });
                                    </script>
                                
                                </div>
                                <a class="huongdanmuahang text-decoration-none" href="#">(Vui l??ng xem h?????ng d???n mua
                                    h??ng)</a>
                                <small class="share">Share: </small>
                                <div class="fb-like" data-href="https://www.facebook.com/Parbo-110745443947730/"
                                    data-width="300px" data-layout="button" data-action="like" data-size="small"
                                    data-share="true"></div>
                            </div>
                            <!-- th??ng tin kh??c c???a s???n ph???m:  t??c gi???, ng??y xu???t b???n, k??ch th?????c ....  -->
                            <div class="col-md-5">
                                <div class="thongtinsach">
                                    <ul>
                                        <li>T??c gi???: <a href="#" class="tacgia"><?php echo $result["tacgia"] ?></a></li>
                                        <li>Ng??y xu???t b???n: <b><?php echo $result["ngayxuatban"] ?></b></li>
                                        <li>K??ch th?????c: <b><?php echo $result["kichthuoc"] ?></b></li>
                                        <li>D???ch gi???: <?php echo $result["dichgia"] ?></li>
                                        <li>Nh?? xu???t b???n: <?php echo $result["nxb"] ?></li>
                                        <li>H??nh th???c b??a: <b><?php echo $result["hinhthucbia"] ?></b></li>
                                        <li>S??? trang: <b><?php echo $result["sotrang"] ?></b></li>
                                        <li>C??n n???ng: <b><?php echo $result["cannang"] ?></b></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- decripstion c???a 1 s???n ph???m: gi???i thi???u , ????nh gi?? ?????c gi???  -->
                    <div class="product-description col-md-9">
                        <!-- 2 tab ??? tr??n  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active text-uppercase" id="nav-gioithieu-tab"
                                    data-toggle="tab" href="#nav-gioithieu" role="tab" aria-controls="nav-gioithieu"
                                    aria-selected="true">Gi???i thi???u</a>
                                <a class="nav-item nav-link text-uppercase" id="nav-danhgia-tab" data-toggle="tab"
                                    href="#nav-danhgia" role="tab" aria-controls="nav-danhgia"
                                    aria-selected="false">????nh
                                    gi?? c???a ?????c gi???</a>
                            </div>
                        </nav>
                        <!-- n???i dung c???a t???ng tab  -->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active ml-3" id="nav-gioithieu" role="tabpanel"
                                aria-labelledby="nav-gioithieu-tab">
                                <?php echo $result["chitietsach"] ?>
                            </div>
                            <div class="tab-pane fade" id="nav-danhgia" role="tabpanel" aria-labelledby="nav-danhgia-tab">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <p class="tieude">????nh gi?? trung b??nh</p>
                                        <div class="diem">0/5</div>
                                        <div class="sao">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <p class="sonhanxet text-muted">(0 nh???n x??t)</p>
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
                                            <div class="btn vietdanhgia mt-3">Vi???t ????nh gi?? c???a b???n</div>
                                        </div>
                                        <!-- n???i dung c???a form ????nh gi??  -->
                                        <div class="formdanhgia">
                                            <h6 class="tieude text-uppercase">G???I ????NH GI?? C???A B???N</h6>
                                            <span class="danhgiacuaban">????nh gi?? c???a b???n v??? s???n ph???m n??y:</span>
                                            <div class="rating d-flex flex-row-reverse align-items-center justify-content-end">
                                                <input type="radio" name="star" id="star1"><label for="star1"></label>
                                                <input type="radio" name="star" id="star2"><label for="star2"></label>
                                                <input type="radio" name="star" id="star3"><label for="star3"></label>
                                                <input type="radio" name="star" id="star4"><label for="star4"></label>
                                                <input type="radio" name="star" id="star5"><label for="star5"></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="txtFullname w-100" placeholder="M???i b???n nh???p t??n(B???t bu???c)">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="txtEmail w-100" placeholder="M???i b???n nh???p email(B???t bu???c)">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="txtComment w-100" placeholder="????nh gi?? c???a b???n v??? s???n ph???m n??y">
                                            </div>
                                            <div class="btn nutguibl">G???i b??nh lu???n</div>
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

    <!-- kh???i s???n ph???m t????ng t??? -->
    <section class="_1khoi sachmoi">
        <section class="container">
            <div class="noidung bg-white" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-light pt-4">
                        <h5 class="header text-uppercase" style="font-weight: 400;">S???n ph???m t????ng t???</h5>
                        <a href="sach-moi-tuyen-chon.html" class="btn btn-warning btn-sm text-white">Xem t???t c???</a>
                    </div>
                </div>
                <div class="home-product">
                    <div class="grid__row">
                        <?php foreach($resultOther as $sptt){ ?> 
                            <div class="grid__column-2-4">
                                <!--S???n ph???m -->
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
                                                    <span class="text-muted"><?php echo $sptt["comment"] ?> nh???n x??t</span>
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

    <!-- kh???i s???n ph???m ???? xem  -->
    <section class="_1khoi combohot mt-4">
        <div class="container">
            <div class="noidung bg-white" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-light">
                        <h5 class="header text-uppercase" style="font-weight: 400;">S???n ph???m b???n ???? xem</h5>
                        <a href="#" class="btn btn-warning btn-sm text-white">Xem t???t c???</a>
                    </div>
                </div>
                <div class="home-product">
                    <div class="grid__row">
                        <?php foreach($resultOther as $sptt){ ?> 
                            <div class="grid__column-2-4">
                                <!--S???n ph???m -->
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
                                                    <span class="text-muted"><?php echo $sptt["comment"] ?> nh???n x??t</span>
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
                            <h6 class="tieude font-weight-bold">H??N 14.000 T???A S??CH HAY</h6>
                            <p class="detail">Tuy???n ch???n b???i Parbo</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-ship.png" alt="icon-ship">
                        <div class="noidung">
                            <h6 class="tieude font-weight-bold">MI???N PH?? GIAO H??NG</h6>
                            <p class="detail">T??? 150.000?? ??? TP.HCM</p>
                            <p class="detail">T??? 300.000?? ??? t???nh th??nh kh??c</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-gift.png" alt="icon-gift">
                        <div class="noidung">
                            <h6 class="tieude font-weight-bold">QU?? T???NG MI???N PH??</h6>
                            <p class="detail">T???ng Bookmark</p>
                            <p class="detail">Bao s??ch mi???n ph??</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="dichvu d-flex align-items-center">
                        <img src="images/icon-return.png" alt="icon-return">
                        <div class="noidung">
                            <h6 class="tieude font-weight-bold">?????I TR??? NHANH CH??NG</h6>
                            <p class="detail">H??ng b??? l???i ???????c ?????i tr??? nhanh ch??ng</p>
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
                        <h6 class="header text-uppercase font-weight-bold">V??? Parbo</h6>
                        <a href="#">Gi???i thi???u v??? Parbo</a>
                        <a href="#">Tuy???n d???ng</a>
                        <div class="fb-like" data-href="https://www.facebook.com/Parbo-110745443947730/"
                            data-width="300px" data-layout="button" data-action="like" data-size="small"
                            data-share="true"></div>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="hotrokh">
                        <h6 class="header text-uppercase font-weight-bold">H??? TR??? KH??CH H??NG</h6>
                        <a href="#">H?????ng d???n ?????t h??ng</a>
                        <a href="#">Ph????ng th???c thanh to??n</a>
                        <a href="#">Ph????ng th???c v???n chuy???n</a>
                        <a href="#">Ch??nh s??ch ?????i tr???</a>
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="lienket">
                        <h6 class="header text-uppercase font-weight-bold">H???P T??C V?? LI??N K???T</h6>
                        <img src="images/dang-ky-bo-cong-thuong.png" alt="dang-ky-bo-cong-thuong">
                    </div>
                </div>
                <div class="col-md-3 col-xs-6">
                    <div class="ptthanhtoan">
                        <h6 class="header text-uppercase font-weight-bold">Ph????ng th???c thanh to??n</h6>
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
