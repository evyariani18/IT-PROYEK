<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>lighten</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      <style>
        .top-box{
            text-align: center;
        }
    </style>
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader --> 
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="head_top">
               <div class="container">
               <div class="row justify-content-center">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 text-center">
                  <div class="top-box">
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                       <div class="top-box">
                        <p>Perlengkapan Rumah Toko Shadad </p>
                    </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                  <div class="full">
                     <div class="center-desk">
                        <div class="logo"> <a href="index.html"><img src="images/logo.png" alt="logo"/></a> </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-9 col-sm-9">
                  <div class="menu-area">
                     <div class="limit-box">
                        <nav class="main-menu">
                           <ul class="menu-area-main">
                              <li class="active"> <a href="beranda.html">Beranda</a> </li>
                              <li class="active"> <a href="{{ url('tentang') }}">Tentang</a> </li>
                              <li> <a href="produk.html">produk</a> </li>
                              <li> <a href="blog.html"> Blog</a> </li>
                              <li> <a href="kontak.html">Kontak</a> </li>
                                                             
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
               <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                  <li><a class="buy" href="#">Login</a></li>
               </div>
            </div>
         </div>
         <!-- end header inner --> 
      </header>
      <!-- end header -->
      <section class="slider_section">
    <div id="main_slider" class="carousel slide banner-main" data-ride="carousel" data-interval="3000">

        <div class="carousel-inner">
            <!-- Slide pertama -->
            <div class="carousel-item active">
                <img class="first-slide" src="images/banner2.png" alt="First slide">
                <div class="container">
                    <div class="carousel-caption relative">
                        <h1>Perlengkapan <br> <strong class="black_bold">Rumah </strong><br>
                            <strong class="yellow_bold">Toko Shadad </strong></h1>
                        <p>Temukan berbagai perlengkapan rumah berkualitas tinggi di Toko Shadad. <br>
                            Kami menyediakan berbagai produk yang akan membuat rumah Anda lebih nyaman dan fungsional.</p>
                        <a href="#">Belanja Sekarang</a>
                    </div>
                </div>
            </div>

            <!-- Slide kedua -->
<div class="carousel-item">
    <img class="second-slide" src="images/banner3.png" alt="Second slide">
    <div class="container">
        <div class="carousel-caption relative">
            <h1>Temukan <br> <strong class="black_bold">Perlengkapan </strong><br>
                <strong class="yellow_bold">Rumah Terbaru </strong></h1>
            <p>Jelajahi berbagai produk terbaru yang akan menambah kenyamanan dan keindahan rumah Anda.</p>
            <a href="#">Lihat Semua Produk</a>
        </div>
    </div>
</div>

        </div>

        <!-- Tombol navigasi prev/next -->
        <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
            <i class='fa fa-angle-left'></i>
        </a>
        <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
            <i class='fa fa-angle-right'></i>
        </a>

    </div>
</section>


<!-- CHOOSE US -->
<div class="whyschose">
    <div class="container">

        <div class="row">
            <div class="col-md-7 offset-md-3">
                <div class="title">
                    <h2>Mengapa <strong class="black">Memilih Toko Shadad</strong></h2>
                    <span>Produk berkualitas tinggi dengan harga terbaik, untuk rumah yang lebih nyaman!</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="choose_bg">
    <div class="container">
        <div class="white_bg">
            <div class="row">
                <!-- Produk Pilihan 1 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="for_box">
                        <i><img src="icon/1.png"/></i>
                        <h3>Perlengkapan Dapur</h3>
                        <p>Temukan alat-alat dapur berkualitas untuk membantu Anda memasak dengan mudah dan praktis.</p>
                    </div>
                </div>

                <!-- Produk Pilihan 2 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="for_box">
                        <i><img src="icon/2.png"/></i>
                        <h3>Perabotan Rumah</h3>
                        <p>Perabotan rumah yang nyaman dan modern untuk memperindah setiap sudut rumah Anda.</p>
                    </div>
                </div>

                <!-- Produk Pilihan 3 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="for_box">
                        <i><img src="icon/3.png"/></i>
                        <h3>Dekorasi Rumah</h3>
                        <p>Berbagai dekorasi rumah untuk menciptakan suasana yang menyenangkan di rumah Anda.</p>
                    </div>
                </div>

                <!-- Produk Pilihan 4 -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="for_box">
                        <i><img src="icon/4.png"/></i>
                        <h3>Perlengkapan Tidur</h3>
                        <p>Kenyamanan tidur Anda penting, temukan kasur dan perlengkapan tidur terbaik di sini.</p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="col-md-12">
                    <a class="read-more" href="#">Lihat Semua Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end CHOOSE -->

      <!-- Merek dan Kategori -->
<div class="service">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="title">
                <h2>Merek &amp; Kategori</h2>
                <span>Temukan berbagai merek dan kategori perlengkapan rumah terbaik di sini</span>
                </div>
            </div>
        </div>

        <!-- Merek dengan Scroll Horizontal -->
        <div class="row product-slider-container">
            <button class="scroll-btn prev-btn" onclick="scrollSlider('merek', 'left')"><</button>

            <div class="product-slider" id="merek">
                <!-- Merek 1 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand1.png" alt="Brand 1" /></i>
                        <h3>Merek A</h3>
                        <p>Produk berkualitas dari Merek A, untuk keperluan rumah Anda.</p>
                    </div>
                </div>
                <!-- Merek 2 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand2.png" alt="Brand 2" /></i>
                        <h3>Merek B</h3>
                        <p>Perlengkapan rumah dari Merek B dengan harga terjangkau.</p>
                    </div>
                </div>
                <!-- Merek 3 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand3.png" alt="Brand 3" /></i>
                        <h3>Merek C</h3>
                        <p>Temukan koleksi Merek C yang cocok untuk setiap kebutuhan rumah.</p>
                    </div>
                </div>
                <!-- Merek 4 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand4.png" alt="Brand 4" /></i>
                        <h3>Merek D</h3>
                        <p>Produk-produk berkualitas dengan harga terbaik.</p>
                    </div>
                </div>
                <!-- Merek 5 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand5.png" alt="Brand 5" /></i>
                        <h3>Merek E</h3>
                        <p>Perlengkapan rumah yang tahan lama dan elegan.</p>
                    </div>
                </div>
                <!-- Merek 6 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand6.png" alt="Brand 6" /></i>
                        <h3>Merek F</h3>
                        <p>Kualitas terbaik untuk segala kebutuhan rumah Anda.</p>
                    </div>
                </div>
                <!-- Merek 7 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand7.png" alt="Brand 7" /></i>
                        <h3>Merek G</h3>
                        <p>Inovasi terbaru dalam produk rumah tangga.</p>
                    </div>
                </div>
                <!-- Merek 8 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand8.png" alt="Brand 8" /></i>
                        <h3>Merek H</h3>
                        <p>Produk dengan kualitas premium yang selalu dapat diandalkan.</p>
                    </div>
                </div>
                <!-- Merek 9 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/brand9.png" alt="Brand 9" /></i>
                        <h3>Merek I</h3>
                        <p>Perlengkapan rumah terbaik yang memberi kenyamanan.</p>
                    </div>
                </div>
            </div>

            <button class="scroll-btn next-btn" onclick="scrollSlider('merek', 'right')">></button>
        </div>

        <!-- Kategori dengan Scroll Horizontal -->
        <div class="row category-slider-container">
            <button class="scroll-btn prev-btn" onclick="scrollSlider('kategori', 'left')"><</button>

            <div class="category-slider" id="kategori">
                <!-- Kategori 1 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category1.png" alt="Category 1" /></i>
                        <h3>Perabotan Rumah</h3>
                        <p>Perabotan rumah yang modern dan fungsional untuk kenyamanan Anda.</p>
                    </div>
                </div>
                <!-- Kategori 2 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category2.png" alt="Category 2" /></i>
                        <h3>Perlengkapan Dapur</h3>
                        <p>Alat dapur praktis dan berkualitas untuk kebutuhan memasak Anda.</p>
                    </div>
                </div>
                <!-- Kategori 3 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category3.png" alt="Category 3" /></i>
                        <h3>Dekorasi Rumah</h3>
                        <p>Hiasan dan dekorasi rumah untuk menciptakan suasana yang indah.</p>
                    </div>
                </div>
                <!-- Kategori 4 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category4.png" alt="Category 4" /></i>
                        <h3>Pencahayaan</h3>
                        <p>Perlengkapan pencahayaan untuk menciptakan atmosfer nyaman di rumah.</p>
                    </div>
                </div>
                <!-- Kategori 5 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category5.png" alt="Category 5" /></i>
                        <h3>Elektronik Rumah</h3>
                        <p>Alat elektronik yang efisien dan canggih untuk kenyamanan rumah.</p>
                    </div>
                </div>
                <!-- Kategori 6 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category6.png" alt="Category 6" /></i>
                        <h3>Kamar Tidur</h3>
                        <p>Perlengkapan kamar tidur yang nyaman dan berkualitas tinggi.</p>
                    </div>
                </div>
                <!-- Kategori 7 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category7.png" alt="Category 7" /></i>
                        <h3>Furniture Outdoor</h3>
                        <p>Perabotan luar ruangan untuk menikmati waktu santai di luar rumah.</p>
                    </div>
                </div>
                <!-- Kategori 8 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category8.png" alt="Category 8" /></i>
                        <h3>Renovasi Rumah</h3>
                        <p>Produk untuk membantu renovasi rumah Anda dengan harga terbaik.</p>
                    </div>
                </div>
                <!-- Kategori 9 -->
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="service-box">
                        <i><img src="icon/category9.png" alt="Category 9" /></i>
                        <h3>Perawatan Rumah</h3>
                        <p>Produk perawatan rumah tangga yang mudah digunakan.</p>
                    </div>
                </div>
            </div>

            <button class="scroll-btn next-btn" onclick="scrollSlider('kategori', 'right')">></button>
        </div>
    </div>
</div>

<!-- Kode JavaScript untuk Mengontrol Scroll -->
<script>
    function scrollSlider(id, direction) {
        var slider = document.getElementById(id);
        var scrollAmount = 200; // Jumlah pengguliran setiap kali tombol ditekan
        if (direction === 'left') {
            slider.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else if (direction === 'right') {
            slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
</script>

<style>
    /* Gaya CSS untuk Scroll dan Panah */
    .product-slider-container, .category-slider-container {
        position: relative;
        display: flex;
        align-items: center;
    }
    .scroll-btn {
        background-color: transparent;
        border: none;
        font-size: 2rem;
        color: #333;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .prev-btn {
        left: 0;
    }
    .next-btn {
        right: 0;
    }
    .product-slider, .category-slider {
        display: flex;
        overflow-x: auto;
        scroll-behavior: smooth;
        padding-bottom: 20px;
    }
    .service-box {
        flex: 0 0 auto;
        margin-right: 20px;
    }
    .service-box img {
        width: 100%;
        height: auto;
    }
</style>



     <!-- Produk Kami -->
<div class="product">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="title">
               <h2>Temukan Produk <strong class="black">Unggulan Kami</strong></h2>
               <span>Menawarkan produk berkualitas tinggi untuk meningkatkan kenyamanan rumah Anda.</span>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="product-bg">
   <div class="product-bg-white">
      <div class="container">
         <div class="row">
            <!-- Produk 1 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p1.png"/></i>
                  <h3>Set Sofa Premium</h3>
                  <span>Rp 14.999.000</span>
               </div>
            </div>
            <!-- Produk 2 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p2.png"/></i>
                  <h3>Meja Makan Mewah</h3>
                  <span>Rp 11.999.000</span>
               </div>
            </div>
            <!-- Produk 3 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p3.png"/></i>
                  <h3>Kasur Nyaman</h3>
                  <span>Rp 8.999.000</span>
               </div>
            </div>
            <!-- Produk 4 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p4.png"/></i>
                  <h3>Mesin Pembuat Kopi Pintar</h3>
                  <span>Rp 2.199.000</span>
               </div>
            </div>
            <!-- Produk 5 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p5.png"/></i>
                  <h3>Lampu Gantung Modern</h3>
                  <span>Rp 1.299.000</span>
               </div>
            </div>
            <!-- Produk 6 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p6.png"/></i>
                  <h3>TV Smart LED 50"</h3>
                  <span>Rp 7.499.000</span>
               </div>
            </div>
            <!-- Produk 7 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p7.png"/></i>
                  <h3>Vase Kristal</h3>
                  <span>Rp 899.000</span>
               </div>
            </div>
            <!-- Produk 8 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p8.png"/></i>
                  <h3>Rak Buku Minimalis</h3>
                  <span>Rp 2.599.000</span>
               </div>
            </div>
            <!-- Produk 9 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p9.png"/></i>
                  <h3>Meja Kopi Kayu</h3>
                  <span>Rp 1.899.000</span>
               </div>
            </div>
            <!-- Produk 10 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p10.png"/></i>
                  <h3>Peralatan Dapur Set</h3>
                  <span>Rp 899.000</span>
               </div>
            </div>
            <!-- Produk 11 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p11.png"/></i>
                  <h3>Standing Fan Digital</h3>
                  <span>Rp 1.499.000</span>
               </div>
            </div>
            <!-- Produk 12 -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
               <div class="product-box">
                  <i><img src="icon/p12.png"/></i>
                  <h3>Blender Multifungsi</h3>
                  <span>Rp 699.000</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
        
                   
               
               
      <footr>
         <div class="footer">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 offset-md-3">
                     <ul class="sociel">
                         <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                         <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                         <li> <a href="#"><i class="fa fa-instagram"></i></a></li>
                     </ul>
                  </div>
            </div>
            <div class="row">
               <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>conatct us</h3>
                     <span>123 Second Street Fifth Avenue,<br>
                       Manhattan, New York<br>
                        +987 654 3210</span>
                  </div>
               </div>
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>ADDITIONAL LINKS</h3>
                     <ul class="lik">
                         <li> <a href="#">About us</a></li>
                         <li> <a href="#">Terms and conditions</a></li>
                         <li> <a href="#">Privacy policy</a></li>
                         <li> <a href="#">News</a></li>
                          <li> <a href="#">Contact us</a></li>
                     </ul>
                  </div>
               </div>
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>service</h3>
                      <ul class="lik">
                    <li> <a href="#"> Data recovery</a></li>
                         <li> <a href="#">Computer repair</a></li>
                         <li> <a href="#">Mobile service</a></li>
                         <li> <a href="#">Network solutions</a></li>
                          <li> <a href="#">Technical support</a></li>
                  </div>
               </div>
                 <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                  <div class="contact">
                     <h3>About lighten</h3>
                     <span>Tincidunt elit magnis nulla facilisis. Dolor Sapien nunc amet ultrices, </span>
                  </div>
               </div>
            </div>
         </div>
            <div class="copyright">
               <p>Copyright 2019 All Right Reserved By <a href="https://html.design/">Free html Templates</a> Distributed By <a href="https://themewagon.com">ThemeWagon </a></p>
            </div>
         
      </div>
      </footr>
      <!-- end footer -->
      <!-- Javascript files--> 
      <script src="js/jquery.min.js"></script> 
      <script src="js/popper.min.js"></script> 
      <script src="js/bootstrap.bundle.min.js"></script> 
      <script src="js/jquery-3.0.0.min.js"></script> 
      <script src="js/plugin.js"></script> 
      <!-- sidebar --> 
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script> 
      <script src="js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <script>
         $(document).ready(function(){
         $(".fancybox").fancybox({
         openEffect: "none",
         closeEffect: "none"
         });
         
         $(".zoom").hover(function(){
         
         $(this).addClass('transition');
         }, function(){
         
         $(this).removeClass('transition');
         });
         });
         
      </script> 
   </body>
</html>