@extends('layout')
@section('content')
    </header>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>
@endif
    <section id="breadcrumb-wrapper" class="">
        <div class="breadcrumb-overlay">

        </div>
        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-big">

                <div class="title-banner-cart">
                    3H STORE - Thương hiệu quần áo may sẵn hàng đầu Việt Nam
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <div id="features" class="cards-1">
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    <div class="col">
                        <img src="{{ URL::to('/public/uploads/products/' . $product->product_image) }}" alt="">
                    </div>
                    <div class="col">

                        <div class="product-page-ticky">
                            <h1 itemprop="name">{{ $product->product_name }}</h1>
                            <p class="line-price">

                            <div class="product-info grid">

                                <div class="grid__item one-whole text-left">
                                    <span id="ProductPrice" class="ProductPrice">Giá:
                                        {{ $product->product_price }}₫</span><br><br>

                                    <div class="ProductCategory">
                                        <div class="pro-type">
                                            <span class="categoty">Loại: {{ $product->category_name }}</span>
                                        </div>
                                    </div>
                                    <div class="product-desc text-left">
                                        <br>
                                        {{ $product->product_desc }}
                                    </div>
                                </div>
                            </div>
                            <div id="product-single-details">
                                <form class="form-vertical">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $product->product_id }}"
                                        class="cart_product_id_{{ $product->product_id }}">
                                    <input type="hidden" value="{{ $product->product_name }}"
                                        class="cart_product_name_{{ $product->product_id }}">
                                    <input type="hidden" value="{{ $product->product_image }}"
                                        class="cart_product_image_{{ $product->product_id }}">
                                    <input type="hidden" value="{{ $product->product_price }}"
                                        class="cart_product_price_{{ $product->product_id }}">

                                    <div id="product-select-watch" class="select-swatch text-left">
                                        <div id="variant-swatch-0" class="swatch swatch-product-single clearfix"
                                            data-option="option1" data-option-index="0">
                                            <div style="margin: 0px 20px 0px 0px">SIZE</div>


                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label class="btn btn-secondary active">
                                                    <input type="radio"
                                                        class="cart_product_size_{{ $product->product_id }}" value="S"
                                                        id="option1" autocomplete="off" checked> S
                                                </label>
                                                <label class="btn btn-secondary">
                                                    <input type="radio"
                                                        class="cart_product_size_{{ $product->product_id }}" value="M"
                                                        id="option2" autocomplete="off"> M
                                                </label>
                                                <label class="btn btn-secondary">
                                                    <input type="radio"
                                                        class="cart_product_size_{{ $product->product_id }}" value="L"
                                                        id="option3" autocomplete="off"> L
                                                </label>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="qty-addcart clearfix text-left">
                                        {{-- <div style="padding-right: 15px; display: block" >Số Lượng:</div> --}}
                                        <p for="Quantity" class="quantity-selector" style="display: inline">Số Lượng</p>
                                        {{-- <input type="number" value="1" min="1" max="50" onKeyUp="if(this.value>50){this.value='50';}else if(this.value<1){this.value='1';}" > --}}
                                        <div class="input-group">
                                            <input type="button" value="-" class="button-minus" data-field="quantity">
                                            <input type="number" step="1" max="50" value="1" name="quantity"
                                                class="quantity-field cart_product_quantity_{{ $product->product_id }}"
                                                onKeyUp="if(this.value>50){this.value='50';}else if(this.value<1){this.value='1';}">
                                            <input type="button" value="+" class="button-plus" data-field="quantity">
                                        </div>
                                        
                                    </div>
                                    <div class="qty-addcart clearfix text-left">
                                        <div class="col">
                                    <button type="button" class="btn btn-danger add-to-cart"
                                                    data-id_product="{{ $product->product_id }}">
                                                    <i class="fas fa-cart-plus pr-2"></i> Thêm vào
                                                    giỏ</button>
                                                </div>          
                                    
                                </form>
                            </div>


                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- size bảo hành -->
    <div id="features" class="cards-1">
        <div class="container">
            <div class="wrapper">
                <div class="row">
                    <div class="col">
                        <h6 style="text-align:center">THÔNG SỐ</h6>
                        <img width="750" height="490"
                            src="//theme.hstatic.net/1000333436/1000835503/14/vendor_value_4.jpg?v=218"
                            padding-bottom="30px">
                    </div>
                    <div class="col text-left">
                        <h6 style="text-align:center">CHÍNH SÁCH ĐỔI TRẢ</h6>
                        <ul>
                            <div style="font-weight: 900; margin-bottom: 10px">I. Quý khách mua hàng tại hệ thống 3H STORE
                            </div>
                            <li>Quý khách hàng được đổi hàng khi sản phẩm trong tình trạng còn mới, còn nguyên tem tác, chưa
                                qua sử dụng, giặt ủi và có mùi lạ</li>
                            <l>Khi đổi hàng Quý khách hàng phải mang theo hóa đơn đính kèm sản phẩm cần đổi</l>
                            <li>Hàng đã được đổi 01 lần, Quý khách vui lòng không đổi lại trừ trường hợp lỗi kỹ thuật</li>
                            <li>Chính sách áp dụng cho cả mua hàng trực tiếp và Online</li>
                        </ul>
                        <ul>
                            <div style="font-weight: 900; margin-bottom: 10px">II. Danh mục sản phẩm không đổi trả</div>
                            <li>Các sản phẩm đặt may đo hoặc theo yêu cầu riêng.</li>
                            <l>Sản phẩm đặt hàng/sửa hàng theo số đo của khách</l>
                            <li>Sản phẩm nằm trong chương trình khuyến mại, Sale</li>
                            <li>Sản phẩm được thiết kế theo yêu cầu của khách hàng</li>
                        </ul>
                        <ul>
                            <div style="font-weight: 900; margin-bottom: 10px">III. Thời gian đổi trả</div>
                            <li>Khách hàng mua hàng trực tiếp tại showroom của Adam Store được đổi sản phẩm trong ba ngày kể
                                từ ngày mua</li>
                            <li>Khách hàng mua hàng online sẽ được đổi sản phẩm trong vòng 3-4 ngày kể từ ngày nhận hàng
                            </li>
                            <li>Đối với hàng Sale, hàng nằm trong chương trình khuyến mại: Không áp dụng đổi trả</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end size bảo hành -->

    <!-- category -->
    <div id="features" class="cards-1">
        <div class="container" style="margin-bottom: 20px;">
            <div class="row ">
                <div class="col-lg-12 ">
                    <h4 class="h2-heading "><a href="{{ url('/category-product/' . $product->category_id) }}">SẢN PHẨM
                            CÙNG LOẠI</a></h4>
                </div>
            </div>
            <div class="wrapper ">
                <div class="row">
                    @foreach ($cate_product as $item => $pro)
                        <div class="col-4 ">
                            <a href="{{ URL::to('/details-product/' . $pro->product_id) }}"><img
                                    src="{{ URL::to('/public/uploads/products/' . $pro->product_image) }}"></a>
                            <div class="product-title">{{ $pro->product_name }}</div>
                            <div class="product-price">{{ $pro->product_price }}₫</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- end category -->
   
@endsection
