@extends('checkout_layout')
@section('checkout-content')
    <div class="main">
        <div class="main-header">

            <a href="/" class="logo">

                <h1 class="logo-text">3H STORE</h1>

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


            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/cart">Giỏ hàng</a>
                </li>

                <li class="breadcrumb-item breadcrumb-item-current">

                    Thông tin giao hàng

                </li>


            </ul>

        </div>
        <div class="main-content">


            
            <script>
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
            </script>

            
            <div class="step">
                <form action="{{URL::to('/payment')}}" method="POST">
                    @csrf
                <div class="step-sections " step="1">

                    

                        <div class="section">
                            <div class="section-header">
                                <h2 class="section-title">Thông tin giao hàng</h2>
                            </div>
                            <div class="section-content section-customer-information ">
                                
                                @php
                                    if (session()->has('user_email')) {
                                        $email = Session::get('user_email');
                                        $name = Session::get('user_name');
                                        $phone = Session::get('user_phone');
                                    }
                                    
                                @endphp




                                <div class="fieldset">


                                    <div class="field">
                                        <div class="field-input-wrapper">
                                            <label class="field-label" for="billing_address_full_name">Họ và
                                                tên</label>
                                            <input placeholder="Họ và tên" readonly autocapitalize="off" spellcheck="false"
                                                class="field-input" size="30" type="text" id="billing_address_full_name"
                                                name="name" value="{{ $name }}" autocomplete="false" />
                                        </div>

                                    </div>



                                    <div class="field  field-two-thirds  ">
                                        <div class="field-input-wrapper">
                                            <label class="field-label" for="checkout_user_email">Email</label>
                                            <input autocomplete="false" readonly placeholder="Email" autocapitalize="off"
                                                spellcheck="false" class="field-input" size="30" type="email"
                                                id="checkout_user_email" name="email" value="{{ $email }}" />
                                        </div>

                                    </div>



                                    <div class="field field-required field-third  ">
                                        <div class="field-input-wrapper">
                                            <label class="field-label" for="billing_address_phone">Số điện
                                                thoại</label>
                                            <input autocomplete="false" readonly placeholder="Số điện thoại"
                                                class="field-input" size="30" maxlength="15" type="tel"
                                                id="billing_address_phone" name="phone" value="{{ $phone }}" />
                                        </div>

                                    </div>
                                    <div class="field">
                                        <div class="field-input-wrapper">
                                            <label class="field-label" for="billing_address_full_name">Địa chỉ</label>
                                            <input required placeholder="Địa chỉ" autocapitalize="off" spellcheck="false"
                                                class="field-input" size="30" type="text" id="billing_address_full_name"
                                                name="address" />
                                        </div>

                                    </div>

                                </div>
                            </>
                        </div>
                        <div id="section-payment-method" class="section">
                            <div class="section-header">
                                <h2 class="section-title">Phương thức thanh toán</h2>
                            </div>
                            <div class="section-content">
                                <div class="content-box">


                                    <div class="radio-wrapper content-box-row">
                                        <label class="two-page" for="payment_method_id_921188">
                                            <div class="radio-input payment-method-checkbox">
                                                <input type-id='1' id="payment_method_id_921188" class="input-radio"
                                                    name="payment_method_id" type="radio" value="1" checked />
                                            </div>

                                            <div class='radio-content-input'>
                                                <img class='main-img'
                                                    src="https://hstatic.net/0/0/global/design/seller/image/payment/cod.svg?v=1" />
                                                <div class='content-wrapper'>
                                                    <span class="radio-label-primary">Thanh toán khi giao hàng (COD)</span>
                                                  
                                                </div>
                                            </div>
                                        </label>
                                    </div>




                                    <div class="radio-wrapper content-box-row">
                                        <label class="two-page" for="payment_method_id_921190">
                                            <div class="radio-input payment-method-checkbox">
                                                <input type-id='2' id="payment_method_id_921190" class="input-radio"
                                                    name="payment_method_id" type="radio" value="1" />
                                            </div>

                                            <div class='radio-content-input'>
                                                <img class='main-img'
                                                    src="https://hstatic.net/0/0/global/design/seller/image/payment/other.svg?v=1" />
                                                <div class='content-wrapper'>
                                                    <span class="radio-label-primary">Chuyển khoản qua ngân hàng</span>
                                                    

                                                </div>
                                            </div>
                                        </label>
                                    </div>








                                </div>
                            </div>
                        </div>

                        </div>

                        
                    
                </div>
                <div class="step-footer">
                    
                    <button type="submit" class="btn btn-success">Bấm</button>

                    
                    <a class="step-footer-previous-link" href="{{ url('/cart') }}">
                        Giỏ hàng
                    </a>


                </div>
            </form>
        
            
        </div>
    </div>
@endsection
