@extends('layout')
@section('content')
    <header id="header" class="header">

    </header>
    <section id="breadcrumb-wrapper" class="">
        <div class="breadcrumb-overlay">

        </div>

        <div class="breadcrumb-content text-center">
            <div class="breadcrumb-big">

                <div class="title-banner-cart">
                    Thương hiệu quần áo may sẵn hàng đầu Việt Nam
                </div>
            </div>
        </div>


    </section>
    <div id="PageContainer" class="">
        <main class=" main-content" role="main">
            <div id="page-wrapper">
                <div class="wrapper">
                    <div class="inner">
                    @if (Session::get('cart') == true)
                        <h1 style="font-weight: bold">Giỏ hàng</h1>
                        <form action="{{ URL::to('/update-cart') }}" method="POST" class="cart table-wrap small--hide">
                            @csrf
                            
                                <table class="cart-table full table--responsive">
                                    <thead class="cart__row cart__header-labels">
                                        <tr>
                                            <th colspan="2" class="text-center">Thông tin chi tiết sản phẩm</th>
                                            <th class="text-center">Đơn giá</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-right">Tổng giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $total = 0;
                                        @endphp

                                        @foreach (Session::get('cart') as $key => $cart)
                                            @php
                                                $price = str_replace(',', '', $cart['product_price']);
                                                $subtotal = (int) $price * $cart['product_quantity'];
                                                $total += $subtotal;
                                            @endphp

                                            <tr class="cart__row table__section cartpage ">
                                                <td data-label="Sản phẩm">
                                                    <a href="{{ URL::to('/details-product/' . $cart['product_id']) }}"
                                                        class="cart__image">

                                                        <img
                                                            src="{{ URL::to('/public/uploads/products/' . $cart['product_image']) }}">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ URL::to('/details-product/' . $cart['product_id']) }}"
                                                        class="h4">
                                                        {{ $cart['product_name'] }}
                                                    </a>
                                                   
                                                    <small>Size: {{ $cart['product_size'] }}</small>
                                                    <a class="cart_quantity_delete"
                                                        href="{{ URL::to('/delete-cart/' . $cart['session_id']) }}"><i
                                                            class="fa fa-times"></i>
                                                        <small>Xóa</small>
                                                    </a>
                                                </td>
                                                <td data-label="Đơn giá">
                                                    <span class="h3">
                                                        {{ $cart['product_price'] }}đ
                                                    </span>
                                                </td>
                                                <td data-label="Số lượng">

                                                    <input class="cart_quantity" type="number" min="1" max="50"
                                                        name="cart_quantity[{{ $cart['session_id'] }}]"
                                                        value="{{ $cart['product_quantity'] }}"
                                                        onKeyUp="if(this.value>50){this.value='50';}else if(this.value<1){this.value='1';}">


                                                </td>

                                                <td data-label="Tổng giá" class="text-right">
                                                    <span class="h3">
                                                        {{ number_format($subtotal) }}đ
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="grid cart__row">
                                    
                                    <div class="grid__item text-right one-third small--one-whole">
                                        <p>
                                            <span class="cart__subtotal-title">Tổng tiền</span>
                                            <span class="h3 cart__subtotal">{{ number_format($total) }}đ</span>
                                        </p>
                                        <p><em>Vận chuyển</em></p>
                                        <button type="submit" name="update_quantity" class="btn btn-danger update-cart">Cập
                                            nhật</button>
                                            <a name="checkout" class="btn btn-success" href="{{ URL::to('/check-out')}}">Thanh toán</a>
                                        
                                    </div>

                                </div>
                           
                        </form>
                        @else
                        <H1>Giỏ hàng trống</H1>
                        <a href="{{URL::to('/home-page')}}"> Trở lại trang chủ</a>
                    @endif   
                    </div>
                </div>
            </div>
        </main>
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
            } elseif (session()->has('error')) {
                $error = session()->get('message');
                echo '<script type="text/javascript">
                    $(document).ready(function() {
                        swal("'.$error.'", {
                            icon: "error",
                        });
                    });
                </script>';
            }
            
        @endphp
    </div>

@endsection
