@extends('checkout_layout')
@section('checkout-content')
    <div class="main">
        <div class="main-header">

            <a href="/" class="logo">

                <h1 class="logo-text">Lama Fashion</h1>

            </a>

            <style>
                a.logo {
                    display: block;
                }

                .logo-cus {
                    width: 100%;
                    padding: 15px 0;
                    text-align: ;
                }

                .logo-cus img {
                    max-height: 4.2857142857em
                }

                .logo-text {
                    text-align: ;
                }

                @media (max-width: 767px) {
                    .banner a {
                        display: block;
                    }
                }

            </style>


        </div>
        <div class="main-content">



            <div>
                <div class="section">
                    <div class="section-header os-header">

                        <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#000"
                            stroke-width="2" class="hanging-icon checkmark">
                            <path class="checkmark_circle"
                                d="M25 49c13.255 0 24-10.745 24-24S38.255 1 25 1 1 11.745 1 25s10.745 24 24 24z"></path>
                            <path class="checkmark_check" d="M15 24.51l7.307 7.308L35.125 19"></path>
                        </svg>

                        <div class="os-header-heading">
                            <h2 class="os-header-title">

                                Đặt hàng thành công

                            </h2>
                            

                            <span class="os-description">
                                Cám ơn bạn đã mua hàng!
                            </span>

                        </div>
                    </div>
                </div>

                <div class="thank-you-additional-content">
                    abc
                </div>

                <div class="section thank-you-checkout-info">
                    <div class="section-content">
                        <div class="content-box">
                            <div class="content-box-row content-box-row-padding content-box-row-no-border">
                                <h2>Thông tin đơn hàng</h2>
                            </div>
                            <div class="content-box-row content-box-row-padding">
                                <div class="section-content">
                                    <div class="section-content-column">
                                        <h3>Thông tin giao hàng</h3>
                                        @php
                                        foreach (Session::get('checkout') as $key =>$checkout){
                                            $name = $checkout['checkout_name'];
                                            $email = $checkout['checkout_email'];
                                            $phone = $checkout['checkout_phone'];
                                            $address = $checkout['checkout_address'];
                                        }
                                        
                                        @endphp
                                    @if (session()->has('checkout'))
                                        
                                    
                                        {{$name}}
                                        <br>



                                        {{$email}}
                                        <br>


                                        {{$phone}}
                                        <br>


                                        <p>


                                            {{$address}}
                                            <br>

                                        </p>
                                        @endif


                                        <h3>Phương thức thanh toán</h3>
                                        <p>

                                            Thanh toán khi giao hàng (COD)

                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step-footer">

                    <a href="/" class="step-footer-continue-btn btn">
                        <span class="btn-content">Tiếp tục mua hàng</span>
                    </a>

                    <p class="step-footer-info">
                        <i class="icon icon-os-question"></i>
                        <span>


                            Cần hỗ trợ? <a href="mailto:khoa.nguyenduc@haravan.com">Liên hệ chúng tôi</a>
                        </span>
                    </p>
                </div>
            </div>


        </div>
    @endsection
