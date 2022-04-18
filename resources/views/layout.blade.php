<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="" />
    <!-- website name -->
    <meta property="og:site" content="" />
    <!-- website link -->
    <meta property="og:title" content="" />
    <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" />
    <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" />
    <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" />
    <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image">
    <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>3H Store</title>

    <!-- Styles -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script> --}}
    <!-- Latest compiled and minified CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/fontawesome-all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/swiper.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('public/frontend/images/favi_3h.png') }}" type="image/png">
</head>


<body data-bs-spy="scroll" data-bs-target="#navbarExample">

    <!-- Navigation -->
    <nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light" aria-label="Main navigation">

        <div class="container">

            <!-- Image Logo -->
            <!-- <a class="navbar-brand logo-image" href="index.html"><img src="./public/frontend/images/logo.png" alt="alternative"></a> -->

            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <a href="{{ url('/homepage') }}">3 H S T O R E</a>
                <ul class="navbar-nav ms-auto navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/homepage') }}">Trang chủ</a>
                    </li>
                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown"
                            aria-expanded="false">Sản phẩm</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            @foreach ($category as $item => $cate)
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ url('/category-product/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                </li>
                            @endforeach



                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <!-- giỏ hàng -->
                        <div id="show-cart"></div>
                    </li>

                    <li class="nav-item">
                        <!-- user login -->
                        <div class="header-card header-icon desktop-cart-wrapper" margin-left="30px">
                           @php
                               if(!session()->has('user_email')){
                                   echo '
                                <a href="'.url('/sign-in').'" class="nav-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Đăng nhập     
                                </a>';
                                 
                               }else {
                                echo '
                                <a href="'.url('/sign-in').'" class="nav-link">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                '.session()->get('user_name').'    
                                </a>';
                               }
                           @endphp
                            
                            
                            
                            <div class="quickview-cart">
                                <h3>
                                    Giỏ hàng trống
                                </h3>
                                <span class="close-qv-cart"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <ul class="no-bullets cart-list">
                                    <p class="cart-empty text-left">
                                        Chưa có sản phẩm nào trong giỏ hàng
                                    </p>
                                </ul>
                            </div>
                        </div>
                        
                    </li>
                   
                    <li class="nav-item">
                        <div class="header-card header-icon desktop-cart-wrapper">
                        <!-- Logout -->
                        @php
                        if(session()->has('user_email')){
                                 echo '
                              <a href="'.url('/log-out').'" class="nav-link">
                              <i class="fa fa-sign-out" aria-hidden="true"></i>
                              Logout  
                              </a>';
                               
                             }
                  @endphp
                  </div>
                    </li>
                    
                </ul>
                
            </div>
            <!-- end of navbar-collapse -->
        </div>
        <!-- end of container -->
    </nav>
    <!-- end of navbar -->
    <!-- end of navigation -->




    @yield('content')


    <section id="banner-collection">
        <div class="banner-image">
            <a href="">
                <img src="//theme.hstatic.net/1000333436/1000696015/14/banner_list_col_img.png?v=798 "
                    alt="Bộ Sưu Tập Suit 2022">
                <div class="overlay">

                </div>
            </a>
            <div class="banner-list-collection">
                <div class="banner-list-inner text-center">
                    <h2 class="section-title">
                        THỜI TRANG CHO NGƯỜI ĐẲNG CẤP
                    </h2>

                    <ul class="inline-list">

                    </ul>
                </div>
            </div>
        </div>

    </section>



    <!-- Footer -->
    <footer class="footer-distributed">
        <div class="footer-left">
            <h3>3H<span>STORE</span></h3>
            <p class="footer-links">
                <a href="{{ url('/homepage') }}" class="link-1">Home</a>
                
            </p>
            <p class="footer-company-name">3H Store © 2022</p>
        </div>
        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>Hutech</span> Quận 9, HCM</p>
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <p>+1.555.555.5555</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:support@company.com">deptraimathattinh@gmail.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span> Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod
                convallis velit, eu auctor lacus vehicula sit amet.
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>

        </div>

    </footer>
    <!-- end of footer -->


    <!-- Scripts -->
    <script src="{{asset('public/frontend/js/bootstrap.min.js ')}}"></script>
    <!-- Bootstrap framework -->
    <script src="{{ asset('public/frontend/js/swiper.min.js') }}"></script>
    <!-- Swiper for image and text sliders -->
    <script src="{{ asset('public/frontend/js/purecounter.min.js') }}"></script>
    <!-- Purecounter counter for statistics numbers -->
    <script src="{{ asset('public/frontend/js/replaceme.min.js') }}"></script>
    <!-- ReplaceMe for rotating text -->
    <script src="{{ asset('public/frontend/js/scripts.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('public/frontend/js/plusminus.js') }}"></script>
    <!-- Custom scripts -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Cart scripts -->
    <script type="text/javascript">
    function show_cart() {
                $.ajax({
                    url: '{{ url('/show-cart') }}',
                    method: 'GET',
                  
                    success: function(data) {

                        $('#show-cart').html(data)


                    }

                });
            }
        $(document).ready(function() {
            //show cart quantity
            show_cart();
            
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_size = $('.cart_product_size_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/add-to-cart') }}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_quantity: cart_product_quantity,
                        cart_product_size: cart_product_size,
                        _token: _token
                    },
                    success: function(data) {

                        swal({
                            title: "Thêm vào giỏ hàng thành công!",
                            text: "Bạn có muốn xem giỏ hàng!",
                            icon: "success",
                            buttons: [
                                'Tôi muốn xem sản phẩm thêm!',
                                'Có!'
                            ],
                            successMode: true,
                        }).then(function(isConfirm) {
                            if (isConfirm) {
                                window.location.href = "{{ url('/cart') }}";
                            }
                        });
                        show_cart();

                    }

                });
            });
        });
    </script>
       @php
       if (session()->has('message')) {
           $message = session()->get('message');
           echo '<script type="text/javascript">
               $(document).ready(function() {
                   swal({
                       title: "'.$message.'",
                       icon: "success",
   
                   });
               });
           </script>';
           Session::put('message',null);
       } 
       elseif (session()->has('error')) {
                $error = session()->get('error');
                echo '<script type="text/javascript">
                    $(document).ready(function() {
                        swal("'.$error.'", {
                            icon: "error",
                        });
                    });
                </script>';
                Session::put('error',null);
            }
       
   @endphp
</body>

</html>
